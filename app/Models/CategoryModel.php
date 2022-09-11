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
}
