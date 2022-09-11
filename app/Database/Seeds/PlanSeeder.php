<?php

namespace App\Database\Seeds;

use App\Models\PlanModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run()
    {
        try {
            $this->db->transStart();
            $planModel = Factories::models(PlanModel::class);
            foreach (self::plans() as $plan) {
                $planModel->insert($plan);
            }
            $this->db->transCommit();
            echo 'Planos criados com sucesso!';
        } catch (\Exception $e) {
            print $e;
        }
    }

    private static function plans()
    {

        return [
            [
                "plan_id" => 9314,
                "name" => "Plano Mensal",
                "recorrence" => "monthly",
                "adverts" => 5,
                "description" => "Descrição plano mensal Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam imperdiet ornare tellus, ac malesuada mi congue in. Aliquam metus orci, ornare a lacus id, pellentesque luctus nisi. Sed nec nisi vel elit dictum porttitor eu a eros. Praesent facilisis tempor mollis. Integer at velit vestibulum, sodales magna sed, pretium turpis. Donec venenatis odio vitae lacus vehicula tempor. Mauris ornare, ipsum ac aliquam volutpat, enim dolor mattis ex, id finibus ligula tortor posuere risus.",
                "value" => 39.99,
                "is_highlighted" => 0,
            ],

            [
                "plan_id" => 9315,
                "name" => "Plano Trimestral",
                "recorrence" => "quarterly",
                "adverts" => 15,
                "description" => "Descrição plano trimestral Duis elit dui, molestie vitae vestibulum sed, mattis ac orci. Curabitur pharetra vestibulum elementum. Nunc vitae lacus ac urna auctor facilisis. Duis at blandit nisi. Nulla facilisi. Sed lorem tortor, porttitor eu iaculis ut, rutrum ut nisl. Nunc sed sem pharetra, faucibus lacus sed, fermentum purus. Phasellus dictum varius justo at tempor. Maecenas non arcu at est maximus laoreet ac id urna. Sed tempor felis et dui mollis, vel efficitur risus volutpat.",
                "value" => 99.99,
                "is_highlighted" => 0,
            ],

            [
                "plan_id" => 9316,
                "name" => "Plano Semestral",
                "recorrence" => "semester",
                "adverts" => 50,
                "description" => "Descrição plano semestral Phasellus dignissim, sem imperdiet finibus tempus, nulla mauris vulputate ante, finibus suscipit quam ex in justo. Nunc consequat lectus quis augue gravida, euismod consequat urna elementum. Sed finibus velit orci, tincidunt dictum velit mattis placerat. Aliquam erat volutpat. Aliquam eget leo dapibus, vehicula sem ut, consectetur nisi. In hac habitasse platea dictumst. Curabitur dapibus ante elit, at lacinia mi dignissim dictum. Etiam quis ullamcorper libero, sed eleifend dolor. In eu est eu turpis dignissim bibendum. Quisque id congue ex, a volutpat ipsum. Suspendisse mattis dictum velit aliquet scelerisque. Duis sodales efficitur mi quis euismod. Curabitur id felis nisi.",
                "value" => 169.99,
                "is_highlighted" => 1,
            ],
            [
                "plan_id" => 9317,
                "name" => "Plano Anual",
                "recorrence" => "yearly",
                "adverts" => NULL,
                "description" => "Descrição plano anual Sed ac ante et dolor cursus porttitor eu tincidunt lacus. Proin maximus interdum libero, et sodales est congue sit amet. Aenean luctus finibus eros, vel suscipit tortor congue ac. Aliquam blandit diam turpis, eget fringilla est blandit vitae. Nunc laoreet risus id urna convallis mattis. Etiam lobortis vel lorem ornare ultrices. Suspendisse fermentum nec ante at vulputate. Ut elementum quam ex, nec ultrices quam gravida eget. Nam pulvinar blandit purus. Aliquam ultricies porta tempor. Aliquam ultrices metus ut ex facilisis, eu tempor urna hendrerit. Mauris volutpat maximus imperdiet. Nulla convallis urna eget faucibus malesuada. Suspendisse pulvinar et sapien in rutrum. Aliquam eu pretium mauris, non suscipit orci.",
                "value" => 129.99,
                "is_highlighted" => 1,
            ],
        ];
    }
}
