<?php

namespace App\Services;

use App\Entities\Advert;
use App\Models\AdvertModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Events\Events; //Para disparar os eventos

class AdvertService
{
    private $user;
    private $advertModel;
    public const SITUATION_NEW  = 'new';
    public const SITUATION_USED = 'used';

    public function __construct()
    {
        /** @todo Alterar quando for trabalhar com (API)....  */
        $this->user         = service('auth')->user();
        $this->advertModel  = Factories::models(AdvertModel::class);
    }


    public function getAllAdverts(
        bool $showBtnArchive = true,
        bool $showBtnViewAdvert = true,
        bool $showBtnQuestions = true,
        string $classBtnActions = 'btn btn-primary btn-block',
        string $sizeImage = 'small',
    ): array {

        $adverts = $this->advertModel->getAllAdverts();
        $data = [];

        //Cria rotas personalizadas para serem colocadas no btns de acordo com o tipo de usuário logado
        $baseRouteToEditImages  = $this->user->isSuperadmin() ? 'adverts.manager.edit.images' : 'adverts.my.edit.images';
        $baseRouteToQuestions   = $this->user->isSuperadmin() ? 'adverts.manager.edit.questions' : 'adverts.my.edit.questions';

        foreach ($adverts as $advert) {

            //Verifica se é para mostrar o botão de archive
            if ($showBtnArchive) {
                //Monta o btnArchive
                $btnArchive = form_button(
                    [
                        'data-id'   => $advert->id, //Será buscado pelo código do anuncio
                        'id'        => 'btnArchiveAdvert',
                        'class'     => 'dropdown-item',
                    ],
                    lang('App.btn_archive')
                );
            }

            //Monta o btnEdit 
            $btnEdit = form_button(
                [
                    'data-id'   => $advert->id, //Será buscado pelo código do anuncio
                    'id'        => 'btnEditAdvert',
                    'class'     => 'dropdown-item',
                ],
                lang('App.btn_edit')
            );

            $finalRouteToEditImages = route_to($baseRouteToEditImages, $advert->id);
            //Monta o btnEditImages
            $btnEditImages = form_button(
                [
                    'class'     => 'dropdown-item',
                    'onClick'   => "location.href='{$finalRouteToEditImages}'"
                ],
                lang('Adverts.btn_edit_images')
            );


            /*
             Verifica se o anuncio está publicado
             caso ele esteja mostra o btn par avisualizar 
             abrindo em uma nova guia
            */
            if ($showBtnViewAdvert && $advert->is_published) {
                $routeToViewAdvert = route_to('adverts.detail', $advert->code);
                //Monta o btnViewAdverts
                $btnViewAdvert = form_button(
                    [
                        'class'     => 'dropdown-item',
                        'onClick'   => "window.open('{$routeToViewAdvert}', '_blank')",
                    ],
                    lang('Adverts.btn_view_advert')
                );
            }


            /*** Verifica se o anuncio tem perguntas */
            if ($showBtnQuestions && $advert->is_published) {
                $finalRouteToEditQuestions = route_to($baseRouteToQuestions, $advert->code);

                //Monta o btnViewQuestion
                $btnViewQuestions = form_button(
                    [
                        'class'     => 'dropdown-item',
                        'onClick'   => "window.open('{$finalRouteToEditQuestions}', '_blank')",
                    ],
                    lang('Adverts.btn_view_questions')
                );
            }
            //Começa a montar o dropdown
            $btnActions = '<div class="dropdown dropup">'; //Abre a div do dropdown

            //Propriedades do btn que vai ser mostrado
            $attrBtnActions = [
                'type'              => 'button',
                'id'                => 'actions',
                'class'             => "dropdown-toggle {$classBtnActions}",
                'data-toggle'       => "dropdown", //Para BS4
                'data-bs-toggle'    => "dropdown", //Para BS5
                // 'aria-haspopup'     => "true",
                'aria-expanded'     => "false",
            ];

            $btnActions .= form_button($attrBtnActions, lang('App.btn_actions'));

            $btnActions .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; //Abre o menu dropdown

            $btnActions .= $btnEdit;
            $btnActions .= $btnEditImages;

            //Verifica se o anuncio está publicado
            if ($showBtnViewAdvert && $advert->is_published) {
                $btnActions .= $btnViewAdvert;
            }

            /*** Verifica se o anuncio tem perguntas */
            if ($showBtnQuestions && $advert->is_published) {
                $btnActions .= $btnViewQuestions;
            }

            //Verifica se é para mostrar o botão de archive
            if ($showBtnArchive) {
                $btnActions .= $btnArchive;
            }


            $btnActions .= '</div>'; //Fecha o menu dropdown
            $btnActions .= '</div>'; //Fecha a div

            $data[] = [
                'image'         => $advert->image(classImage: 'img-fluid img-custom', sizeImage: $sizeImage),
                'title'         => $advert->title,
                'code'          => $advert->code,
                'category'      => $advert->category,
                'is_published'  => $advert->isPublished(),
                'address'       => $advert->address(),
                'actions'       => $btnActions,
            ];
        }

        return $data;
    }


    public function getArchivedAdverts(
        bool $showBtnRecover = true,
        string $classBtnRecover = '',
        string $classBtnDelete = '',
        string $classBtnActions = 'btn btn-primary',
    ): array {

        $adverts = $this->advertModel->getAllAdverts(onlyDeleted: true);
        $data = [];
        $btnRecover = '';
        foreach ($adverts as $advert) {

            //Verifica se é para mostrar o botão de archive
            if ($showBtnRecover) {
                //Monta o btnRecover
                $btnRecover = form_button(
                    [
                        'data-id'   => $advert->id, //Será buscado pelo código do anuncio
                        'id'        => 'btnRecoverAdvert',
                        'class'     => 'dropdown-item',
                    ],
                    lang('App.btn_recover')
                );
            }

            //Monta o btnDelete 
            $btnDelete = form_button(
                [
                    'data-id'   => $advert->id, //Será buscado pelo código do anuncio
                    'id'        => 'btnDeleteAdvert',
                    'class'     => 'dropdown-item',
                ],
                lang('App.btn_delete')
            );


            //Começa a montar o dropdown
            $btnActions = '<div class="dropdown dropup">'; //Abre a div do dropdown

            //Propriedades do btn que vai ser mostrado
            $attrBtnActions = [
                'type'              => "button",
                'id'                => "actions",
                'class'             => "dropdown-toggle {$classBtnActions}",
                'data-toggle'       => "dropdown", //Para BS4
                'data-bs-toggle'    => "dropdown", //Para BS5
                'aria-haspopup'     => "true",
                'aria-expanded'     => "false",
            ];

            $btnActions .= form_button($attrBtnActions, lang('App.btn_actions'));

            $btnActions .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; //Abre o menu dropdown

            $btnActions .= $btnRecover;
            $btnActions .= $btnDelete;


            $btnActions .= '</div>'; //Fecha o menu dropdown
            $btnActions .= '</div>'; //Fecha a div

            $data[] = [
                'title'         => $advert->title,
                'code'          => $advert->code,
                'actions'       => $btnActions,
            ];
        }

        return $data;
    }

    public function getAdvertByID(int $id, bool $withDeleted = false)
    {
        $advert = $this->advertModel->getAdvertByID($id, $withDeleted);
        if (is_null($advert)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Advert not found");
        }
        return $advert;
    }

    public function getDropdownSituations(string $advertSituation = null)
    {
        $options    = [];
        $selected   = [];

        $options = [
            ''                      => lang('Adverts.label_situation'),
            self::SITUATION_NEW     => lang('Adverts.text_new'),
            self::SITUATION_USED    => lang('Adverts.text_used'),
        ];

        //Esta criando um novo anuncio
        if (is_null($advertSituation)) {
            return form_dropdown('situation', $options, $selected, ['class' => 'form-control']);
        }

        //Editando um anuncio
        $selected[] = match ($advertSituation) {
            self::SITUATION_NEW     => self::SITUATION_NEW,
            self::SITUATION_USED    => self::SITUATION_USED,
            default => throw new \Exception("Unsupported {$advertSituation}"),
        };
        return form_dropdown('situation', $options, $selected, ['class' => 'form-control']);
    }

    public function trySaveAdvert(Advert $advert, bool $protect = true, bool $notifyUserPublished = false)
    {
        try {
            $advert->unsetAuxiliaryAttributes();
            if ($advert->hasChanged()) {
                $this->advertModel->trySaveAdvert($advert, $protect);

                $this->fireAdvertsEvents($advert, $notifyUserPublished);
            }
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data on service');
        }
    }

    public function tryStoreAdvertImages(array $images, int $advertID)
    {
        try {
            $advert = $this->getAdvertByID($advertID);
            $dataImages = ImageService::storeImages($images, 'adverts', 'advert_id', $advert->id);
            $this->advertModel->tryStoreAdvertImages($dataImages, $advert->id);
            $this->fireAdvertsEventForNewImages($advert);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data image on service');
        }
    }

    public function tryDeleteAdvertImage(int $advertID, string $image)
    {
        try {
            $advert = $this->getAdvertByID($advertID);
            $this->advertModel->tryDeleteAdvertImage($advert->id, $image);
            ImageService::destroyImage('adverts', $image);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error delete data image on service');
        }
    }

    public function tryArchiveAdvert(int $advertID)
    {
        try {
            $advert = $this->getAdvertByID($advertID);
            $this->advertModel->tryArchiveAdvert($advert->id);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error archive service');
        }
    }

    public function tryRecoverAdvert(int $advertID)
    {
        try {
            $advert = $this->getAdvertByID($advertID, withDeleted: true);
            $advert->recover();
            $this->trySaveAdvert($advert, protect: false);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error delete service');
        }
    }

    public function tryDeleteAdvert(int $advertID)
    {
        try {
            $advert = $this->getAdvertByID($advertID, withDeleted: true);
            $this->advertModel->tryDeleteAdvert($advert->id);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error deleting data service');
        }
    }

    public function getAllAdvertsPaginated(int $perPage = 10, array $criteria = []): array
    {
        return [
            'adverts'   => $this->advertModel->getAllAdvertsPaginated($perPage, $criteria),
            'pager'     => $this->advertModel->pager
        ];
    }

    public function getAdvertByCode(string $code, bool $ofTheLoggedInUser = false)
    {
        $advert = $this->advertModel->getAdvertByCode($code, $ofTheLoggedInUser);

        if (is_null($advert)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Advert not found');
        }

        return $advert;
    }

    public function getCitiesFromPublishedAdverts(int $limit = 5, string $categorySlug = null): array
    {
        return $this->advertModel->getCitiesFromPublishedAdverts($limit, $categorySlug);
    }

    public function tryInsertAdvertQuestion(Advert $advert, string $question)
    {
        try {
            $this->advertModel->insertAdvertQuestion($advert->id, $question);
            session()->remove('ask');
            $this->fireAdvertHasNewQuestion($advert);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error deleting data service');
        }
    }

    public function tryAnswerAdvertQuestion(int $questionID, Advert $advert, object $request)
    {
        try {
            $this->advertModel->answerAdvertQuestion(questionID: $questionID, advertID: $advert->id, answer: $request->answer);
            $this->fireAdvertQuestionHasBeenAnswered($advert, $request->question_owner);
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error  responder');
        }
    }



    //----------------------- Serach --------------//
    public function getAllAdvertsByTerm(string $term = null): array
    {
        $adverts = $this->advertModel->getAllAdvertsByTerm($term);
        $data = [];

        foreach ($adverts as $advert) {
            $data[] = [
                'code'      => $advert->code,
                'value'     => $advert->title,
                'label'     => $advert->image(classImage: 'image-autocomplete rounded-lg', sizeImage: 'small') . ' ' . $advert->title,
            ];
        }

        return $data;
    }


    private function fireAdvertsEvents(Advert $advert, bool $notifyUserPublished)
    {
        $advert->email = !empty($advert->email) ? $advert->email : $this->user->email;
        if ($advert->hasChanged('title') || $advert->hasChanged('description')) {
            Events::trigger('notify_user_advert', $advert->email, "Estamos analisando o seu anúncio {$advert->code}, assim que finalizarmos a análise você será notificado via email");
            Events::trigger('notify_manager', "Existem anúncios para serem auditados");
        }

        if ($notifyUserPublished) {
            $this->fireAdvertPublished($advert);
        }
    }

    private function fireAdvertsEventForNewImages(Advert $advert)
    {
        $advert->email = !empty($advert->email) ? $advert->email : $this->user->email;
        Events::trigger('notify_user_advert', $advert->email, "Estamos analisando as novas imagens do seu anúncio {$advert->code}, assim que finalizarmos a análise você será notificado via email");
        Events::trigger('notify_manager', "Existem imagens de anúncios para serem auditadas");
    }

    private function fireAdvertHasNewQuestion(Advert $advert)
    {
        Events::trigger('notify_user_advert', $advert->email, "Seu anúncio {$advert->title}, tem uma nova pergunta...");
    }

    private function fireAdvertQuestionHasBeenAnswered(Advert $advert, int $userQuestionID)
    {
        $userWhoAskedQuestion = Factories::class(UserService::class)->getUserByCriteria(['id' => $userQuestionID]);
        Events::trigger('notify_user_advert', $userWhoAskedQuestion->email, "A pergunta que você fez para o anúncio {$advert->title}, foi respondida...");
    }

    private function fireAdvertPublished(Advert $advert)
    {
        if ($advert->weMustNotifyThePublication()) {
            Events::trigger('notify_user_advert', $advert->email, "Seu anúncio {$advert->title}, foi publicado");
        }
    }
}
