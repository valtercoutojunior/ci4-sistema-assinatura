<?php

namespace App\Models;

use App\Entities\Category;

class CategoryModel extends MyBaseModel
{

    protected $table            = 'categories';
    protected $returnType       = Category::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'parent_id',
        'name',
        'slug',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeDataXSS', 'generateSlug'];
    protected $beforeUpdate   = ['escapeDataXSS', 'generateSlug'];

    /**
     * Cria o slug de forma automática com o nome que foi rececbido
     *
     * @param array $data
     * @return array
     */
    protected function generateSlug(array $data): array
    {
        if (isset($data['data']['name'])) {
            $data['data']['slug'] = mb_url_title($data['data']['name'], lowercase: true);
        }
        return $data;
    }

    /**
     * Busca todas as categorias pai com execessão 
     * da que já está atrelada a categoria filha
     *
     * @param integer|null $exceptCategoryID
     * @return array
     */
    public function getParentCategories(int $exceptCategoryID = null): array
    {
        $builder = $this;
        if ($exceptCategoryID) {
            $builder->where('id !=', $exceptCategoryID);
        }
        $builder->orderBy('name', 'ASC');
        $builder->asArray();
        return $builder->findAll();
    }


    public function getCategoriesFromPublishedAdverts(int $limit = 5): array
    {
        $this->setSQLMode();
        $tableFields = [
            'categories.*',
            'COUNT(adverts.id) AS total_adverts'
        ];
        //Recupera apenas os valores da coluna advert_is da tabela images
        $advertsIDS = array_column($this->db->table('adverts_images')->select('advert_id')->get()->getResultArray(), 'advert_id');
        $builder = $this;
        //Busca os campos da tabela definidos acima
        $builder->select($tableFields);
        //retorna como um objeto
        $builder->asObject();
        //Faz os joins necessários
        $builder->join('adverts', 'adverts.category_id = categories.id');
        //Faz o where necessario (buscara somente anuncios publicados)
        $builder->where('adverts.is_published', true);

        //Verifica se os anuncios encontrados na tabela images tem imagens
        if (!empty($advertsIDS)) {
            $builder->whereIn('adverts.id', $advertsIDS);
        }

        //Agrupa os registro pelo nome da categoria para não repiti-los
        $builder->groupBy('categories.name');
        /* Ordena pela quantidade de anuncios por categorias 
            A categoria que tiver mais anuncios que tiver mais anuncios será listada primeiro
        */
        $builder->orderBy('total_adverts', 'DESC');
        return $builder->findAll($limit);
    }
}
