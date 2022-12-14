<?php

namespace App\Models;

use App\Entities\Advert;

class AdvertModel extends MyBaseModel
{

    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user  = service('auth')->user() ?? auth('api')->user();
    }

    protected $DBGroup          = 'default';
    protected $table            = 'adverts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Advert::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'code',
        'title',
        'description',
        'price',
        //'is_published', //Vai ter manipulação pelo manager
        'situation',
        'zipcode',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeDataXSS', 'generateCitySlug', 'generateCode', 'setUserID'];
    protected $beforeUpdate   = ['escapeDataXSS', 'generateCitySlug', 'unpublished'];



    /**
     * Função que gera de forma automática o slug da cidade
     * essa função só é executada no cadastro de um advert
     *
     * @param array $data
     * @return array
     */
    protected function generateCitySlug(array $data): array
    {
        if (isset($data['data']['city'])) {
            $data['data']['city_slug'] = mb_url_title($data['data']['city'], lowercase: true);
        }
        return $data;
    }

    /**
     * Função que gera de forma automática o code do advert 
     * ADVERT_6546548979797897
     * Nesse caso ele vai gerar um codigo de forma a não repiti-lo
     *
     * @param array $data
     * @return array
     */
    protected function generateCode(array $data): array
    {
        if (isset($data['data'])) {
            $data['data']['code'] = strtoupper(uniqid('ADVERT_', true));
        }
        return $data;
    }

    /**
     * Função que vai sertar o id do usuário logado para que ele seja relacionado ao advert
     * nessa função vai ser pego os dados somente do usuário logado
     *
     * @param array $data
     * @return array
     */
    protected function setUserID(array $data): array
    {
        if (isset($data['data'])) {
            $data['data']['user_id'] = $this->user->id;
        }
        return $data;
    }

    public function unpublished(array $data): array
    {
        //Verifica se houve alteração no titulo ou na descrição
        if (isset($data['data']['title']) || isset($data['data']['description'])) {
            $data['data']['is_published'] = false;
        }
        return $data;
    }

    /**
     * Recupera todos os anúncios de acordo com o usuário logado
     * se o usuário logado for o superadmin ele puzará todas as imagens de todos os usuarios
     *
     * @param boolean $onlyDeleted
     * @return array
     */
    public function getAllAdverts(bool $onlyDeleted = false)
    {
        $this->setSQLMode();

        $builder = $this;
        if ($onlyDeleted) {
            $builder->onlyDeleted();
        }

        //Campos buscados e fazendo os joins nas tabelas
        $tableFields = [
            'adverts.*',
            'categories.name AS category',
            'adverts_images.image AS images',
        ];

        $builder->select($tableFields);

        //Quem está logado é o manager(admin)
        if (!$this->user->isSuperadmin()) {
            //É o usuario anunciante... buscará somente os anuncios dele
            $builder->where('adverts.user_id', $this->user->id);
        }

        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->join('adverts_images', 'adverts_images.advert_id = adverts.id', 'LEFT');
        $builder->groupBy('adverts.id'); //Para não repetir os registros
        $builder->orderBy('adverts.id', 'DESC'); //ordenação de forma decrecente
        return $builder->findAll();
    }


    public function getAdvertByID(int $id, bool $withDeleted = false)
    {
        $builder = $this;

        //Campos buscados e fazendo os joins nas tabelas
        $tableFields = [
            'adverts.*',
            'users.email' //Será notificado o anunciante quando houver atualização no anuncio dele

        ];

        $builder->select($tableFields);
        $builder->withDeleted($withDeleted);

        //Verifica se o usuário que está logado é um superadmin
        if (!$this->user->isSuperadmin()) {
            $builder->where('adverts.user_id', $this->user->id);
        }
        $builder->join('users', 'users.id = adverts.user_id');
        $advert = $builder->find($id);

        if (!is_null($advert)) {
            $advert->images = $this->getAdvertImages($advert->id);
        }
        return $advert;
    }

    /**
     * Busca as imagens de acordo com o anuncio selecionado
     *
     * @param integer $advertID
     * @return array| null
     */
    public function getAdvertImages(int $advertID): array
    {
        return $this->db->table('adverts_images')
            ->where('advert_id', $advertID)
            ->get()
            ->getResult();
    }


    public function trySaveAdvert(Advert $advert, bool $protect = true)
    {
        try {
            $this->db->transStart();
            $this->protect($protect)->save($advert);
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data model');
        }
    }

    public function tryStoreAdvertImages(array $dataImages, int $advertID)
    {
        try {
            $this->db->transStart();
            $this->db->table('adverts_images')->insertBatch($dataImages);
            $this->protect(false)->set('is_published', false)->where('id', $advertID)->update();
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data images model');
        }
    }

    public function tryDeleteAdvertImage(int $advertID, string $image)
    {
        $criteria = [
            'advert_id' => $advertID,
            'image' => $image
        ];
        return $this->db->table('adverts_images')->where($criteria)->delete();
    }

    public function tryArchiveAdvert(int $advertID)
    {
        try {
            $this->db->transStart();

            //Verifica se a pessoa que esta logada é o manager
            if (!$this->user->isSuperadmin()) {
                //Se for o user. Permitimos ele arquivar somente anuncios dele mesmo
                $this->where('user_id', $this->user->id)->delete($advertID);
            } else {
                //É o manager ele pode arquivar todos os anuncios
                $this->delete($advertID);
            }
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error archive advert images model');
        }
    }

    public function tryDeleteAdvert(int $advertID)
    {
        try {
            $this->db->transStart();
            //Verifica se é o manager
            if (!$this->user->isSuperadmin()) {
                $this->where('user_id', $this->user->id)->delete($advertID, purge: true);
            } else {
                $this->delete($advertID, purge: true);
            }
            $this->db->transCommit();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error deleting data model');
        }
    }

    public function getAllAdvertsPaginated(int $perPage = 10, array $criteria = [])
    {
        $this->setSQLMode();
        $builder = $this;

        $tableFields = [
            'adverts.*',
            'categories.name AS category',
            'categories.slug AS category_slug',
            'adverts_images.image AS images', //Será usado no metodo imagemno entoty advert
        ];

        $builder->select($tableFields);
        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->join('adverts_images', 'adverts_images.advert_id = adverts.id');
        if (!empty($criteria)) {
            $builder->where($criteria);
        }
        $builder->where('adverts.is_published', true);
        $builder->orderBy('adverts.id', 'DESC');
        $builder->groupBy('adverts.id');
        $adverts = $builder->paginate($perPage);
        return $adverts;
    }


    public function getAdvertByCode(string $code, bool $ofTheLoggedInUser = false)
    {
        $builder = $this;
        $tableFields = [
            'adverts.*',
            'users.name',
            'users.email', //usaremos para a parte dep perguntas e respostas
            'users.username',
            'users.phone',
            'users.display_phone',
            'users.created_at AS user_since',
            'categories.name AS category',
            'categories.slug AS category_slug', //usaremos para filtrar os anuncos por categorias
        ];

        $builder->select($tableFields);
        $builder->join('users', 'users.id = adverts.user_id');
        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->where('adverts.is_published', true);
        $builder->where('adverts.code', $code);

        //Verifica se quem está visualizando o anuncio é o dono do anuncio
        if ($ofTheLoggedInUser) {
            $builder->where('adverts.user_id', $this->user->id);
        }
        $advert = $builder->first();

        //Busca as imagens do anuncio encontrado
        if (!is_null($advert)) {
            $advert->images = $this->getAdvertImages($advert->id);
        }

        //Busca as perguntas e respostas do anuncio selecionado
        if (!is_null($advert)) {
            $advert->questions = $this->getAdvertQuestions($advert->id);
        }

        return $advert;
    }

    public function getCitiesFromPublishedAdverts(int $limit = 5, string $categorySlug = null): array
    {
        $this->setSQLMode();
        $tableFields = [
            'adverts.*',
            'categories.name AS category', //Para debug
            'COUNT(adverts.id) AS total_adverts'
        ];

        $advertsIDS = array_column($this->db->table('adverts_images')->select('advert_id')->get()->getResultArray(), 'advert_id');
        $builder = $this;
        $builder->select($tableFields);
        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->where('adverts.is_published', true);
        $builder->where('categories.slug', $categorySlug);
        $builder->whereIn('adverts.id', $advertsIDS); //Apenas anuncios que possuem imagens
        $builder->groupBy('adverts.city');
        $builder->orderBy('total_adverts', 'DESC');
        return $builder->findAll($limit);
    }

    public function countAllUserAdverts(int $userID, bool $withDeleted = true, array $criteria = []): int
    {
        $builder = $this;

        if (!empty($criteria)) {
            $builder->where($criteria);
        }
        $builder->where('adverts.user_id', $userID);
        $builder->withDeleted($withDeleted);
        return $builder->countAllResults();
    }

    /**::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * :::::::::: PERGUNTAS E RESPOSTAS :::::::::::::::::::::::::::::::::::::::::
     :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    public function getAdvertQuestions(int $advertID): array
    {
        $builder = $this->db->table('adverts_questions');
        $builder->where('advert_id', $advertID);
        $builder->orderBy('id', 'DESC');
        return $builder->get()->getResult();
    }

    public function insertAdvertQuestion(int $advertID, string $question)
    {
        try {
            $this->db->transStart();

            $data = [
                'advert_id'         => $advertID,
                'user_question_id'  => $this->user->id,
                'question'          => esc($question),
                'created_at'        => date('Y-m-d H:i:s'),
            ];
            $this->db->table('adverts_questions')->insert($data);
            $this->db->transComplete();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao salvar pergunta');
        }
    }

    public function answerAdvertQuestion(int $questionID, int $advertID, string $answer)
    {
        try {
            $this->db->transStart();

            $criteria = [
                'id'        => $questionID,
                'advert_id' => $advertID
            ];

            $data = [
                'answer'       => esc($answer),
                'updated_at'   => date('Y-m-d H:i:s'),
            ];
            $this->db->table('adverts_questions')->where($criteria)->update($data);

            $this->db->transComplete();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Erro ao responder pergunta');
        }
    }

    //--------------------- Pesquisar Autocomplete -------------////
    public function getAllAdvertsByTerm(string $term = null): array
    {
        $this->setSQLMode();
        $builder = $this;

        $tableFields = [
            'adverts.id',
            'adverts.code',
            'adverts.title',
            'adverts_images.image AS images',
        ];
        $builder->select($tableFields);
        $builder->join('adverts_images', 'adverts_images.advert_id = adverts.id', 'LEFT'); //nem todos os anuncios terão imagens
        $builder->groupBy('adverts.id'); //Para não repetir os registros
        $builder->orderBy('adverts.id', 'DESC'); //ordenação de forma decrecente
        $builder->where('is_published', true); //Apenas anuncios publicados
        $builder->like('title', $term, 'both');
        return $builder->findAll();
    }

    /**::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
     * :::::::::: METODOS PARA API ::::::::::::::::::::::::::::::::::::::::::::::
     :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    public function getAllAdvertsForUserAPI(int $perPage = null, int $page = null)
    {
        $this->setSQLMode();

        $builder = $this;

        //Campos buscados e fazendo os joins nas tabelas
        $tableFields = [
            'adverts.*',
            'categories.name AS category',
            'categories.slug AS category_slug',
            'users.username', //mostra quem é o dono dos anuncios

        ];

        $builder->select($tableFields);
        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->join('users', 'users.id = adverts.user_id');
        $builder->where('adverts.user_id', $this->user->id);
        $builder->groupBy('adverts.id'); //Para não repetir os registros
        $builder->orderBy('adverts.id', 'DESC'); //ordenação de forma decrecente

        $adverts = $this->paginate(perPage: $perPage, page: $page);

        //Pega as imagens
        if (!empty($adverts)) {
            foreach ($adverts as $advert) {
                $advert->images = $this->getAdvertImages($advert->id);
            }
        }


        return $adverts;
    }
}
