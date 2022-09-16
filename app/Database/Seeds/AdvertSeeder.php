<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\Seeder;

class AdvertSeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();

            $categories = $this->db->table('categories')->select('id')->get()->getResultArray();
            $categoriesIDS = array_column($categories, 'id');

            helper('superadmin');
            $userManager = get_superadmin();

            $anunciantes = $this->db->table('users')->select('id')->where('id !=', $userManager->id)->orderBy('id', 'ASC')->get()->getResultArray();
            $anunciantesIDS = array_column($anunciantes, 'id');

            $faker =  \Faker\Factory::create('pt-BR');
            $adverts = [];

            foreach ($anunciantes as $anunciante) {
                for ($counter = 0; $counter < 5; $counter++) {

                    $city = $faker->city;
                    $citySlug = mb_url_title($city, lowercase: true);
                    $advert = [
                        'user_id'       => $faker->randomElement($anunciantesIDS),
                        'category_id'   => $faker->randomElement($categoriesIDS),
                        'code'          => strtoupper(uniqid('ADVERT_', true)),
                        'title'         => $faker->unique()->name,
                        'description'   => $faker->realText(500),
                        'price'         => $faker->randomFloat(2, 50, 1000),
                        'is_published'  => $faker->numberBetween(0, 1),
                        'situation'     => $faker->randomElement(['new', 'used']),
                        'zipcode'       => $faker->postcode,
                        'street'        => $faker->streetName,
                        'number'        => $faker->buildingNumber,
                        'neighborhood'  => $faker->city,
                        'city'          => $faker->city,
                        'city_slug'     => $citySlug,
                        'state'         => $faker->stateAbbr,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ];
                    $adverts[] = $advert;
                }
            }

            $this->db->table('adverts')->insertBatch($adverts, escape: true, batchSize: count($adverts));
            $this->db->transComplete();
            echo 'Anuncios criados com sucesso!';
        } catch (\Exception $e) {
            print $e;
        }
    }
}
