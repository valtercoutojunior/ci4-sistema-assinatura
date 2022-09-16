<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();

            foreach (self::categories() as $category) {
                $this->db->table('categories')->insert($category);
            }

            $this->db->transComplete();
            echo 'Categorias criadas com sucesso!';
        } catch (\Exception $e) {
            print $e;
        }
    }


    private static function categories(): array
    {

        return [
            [
                "name" => "Esportes e Fitness",
                "slug" => "esportes-e-fitness",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Futebol",
                "slug" => "futebol",
                "parent_id" => 1,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Futebol de Campo",
                "slug" => "futebol-de-campo",
                "parent_id" => 2,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para Veículos",
                "slug" => "acessorios-para-veiculos",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Som Automotivo",
                "slug" => "som-automotivo",
                "parent_id" => 4,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Limpeza Automotiva",
                "slug" => "limpeza-automotiva",
                "parent_id" => 4,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Ferramentas Automotivas",
                "slug" => "ferramentas-automotivas",
                "parent_id" => 4,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Celulares e Telefones",
                "slug" => "celulares-e-telefones",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para Celulares",
                "slug" => "acessorios-para-celulares",
                "parent_id" => 8,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Peças para Celular",
                "slug" => "pecas-para-celular",
                "parent_id" => 8,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Eletrodomésticos",
                "slug" => "eletrodomesticos",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Fornos e Fogões",
                "slug" => "fornos-e-fogoes",
                "parent_id" => 11,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Eletrônicos, Áudio e Vídeo",
                "slug" => "eletronicos-audio-e-video",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para Áudio e Vídeo",
                "slug" => "acessorios-para-audio-e-video",
                "parent_id" => 13,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para TV",
                "slug" => "acessorios-para-tv",
                "parent_id" => 13,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Ferramentas",
                "slug" => "ferramentas",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Ferramentas Industriais",
                "slug" => "ferramentas-industriais",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Games",
                "slug" => "games",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para Consoles",
                "slug" => "acessorios-para-consoles",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para PC Gaming",
                "slug" => "acessorios-para-pc-gaming",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Consoles",
                "slug" => "consoles",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Fliperama e Arcade",
                "slug" => "fliperama-e-arcade",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Peças para Consoles",
                "slug" => "pecas-para-consoles",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Video Games",
                "slug" => "video-games",
                "parent_id" => 18,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Imóveis",
                "slug" => "imoveis",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Apartamentos",
                "slug" => "apartamentos",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Casas",
                "slug" => "casas",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Chácaras",
                "slug" => "chacaras",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Fazendas",
                "slug" => "fazendas",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Lojas Comerciais",
                "slug" => "lojas-comerciais",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Terrenos",
                "slug" => "terrenos",
                "parent_id" => 25,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Informática",
                "slug" => "informatica",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Armazenamento",
                "slug" => "armazenamento",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Componentes para PC",
                "slug" => "componentes-para-pc",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Conectividade e Redes",
                "slug" => "conectividade-e-redes",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Impressão",
                "slug" => "impressao",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Leitores e Scanners",
                "slug" => "leitores-e-scanners",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Monitores e Acessórios",
                "slug" => "monitores-e-acessorios",
                "parent_id" => 32,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Instrumentos Musicais",
                "slug" => "instrumentos-musicais",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Baterias e Percussão",
                "slug" => "baterias-e-percussao",
                "parent_id" => 39,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Caixas de Som",
                "slug" => "caixas-de-som",
                "parent_id" => 39,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Estúdio de Gravação",
                "slug" => "estudio-de-gravacao",
                "parent_id" => 39,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Instrumentos de Corda",
                "slug" => "instrumentos-de-corda",
                "parent_id" => 39,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Instrumentos de Sopro",
                "slug" => "instrumentos-de-sopro",
                "parent_id" => 39,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Joias e Relógios",
                "slug" => "joias-e-relogios",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Acessórios para Relógios",
                "slug" => "acessorios-para-relogios",
                "parent_id" => 45,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Joias e Bijuterias",
                "slug" => "joias-e-bijuterias",
                "parent_id" => 45,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Relógios",
                "slug" => "relogios",
                "parent_id" => 45,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Porta Joias",
                "slug" => "porta-joias",
                "parent_id" => 45,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Serviços",
                "slug" => "servicos",
                "parent_id" => null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Academias",
                "slug" => "academias",
                "parent_id" => 50,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Animais",
                "slug" => "animais",
                "parent_id" => 50,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Festas e Eventos",
                "slug" => "festas-e-eventos",
                "parent_id" => 50,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Marketing e Internet",
                "slug" => "marketing-e-internet",
                "parent_id" => 50,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Suporte Técnico",
                "slug" => "suporte-tecnico",
                "parent_id" => 50,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
        ];
    }
}
