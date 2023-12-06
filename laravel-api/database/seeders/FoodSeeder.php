<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $indices = ['id', 'name', 'category_id', 'description', 'value'];

        $data = [
            [1,  'Mandioca', 4, 'Mandioca: Delicie-se com a crocância da mandioca, um petisco irresistível.', 50.90],
            [2,  'Batata Frita', 8, 'Batata Frita: Saboreie a batata frita perfeitamente dourada, um clássico que conquista paladares.', 27.99],
            [3,  'Porção de Croquete', 8, 'Porção de Croquete: Experimente nossa porção de croquete, uma explosão de sabores a cada mordida.', 13.99],
            [4,  'Caldo de Mandioca', 3, 'Caldo de Mandioca: Aconchegue-se com nosso caldo de mandioca, uma opção reconfortante e deliciosa.', 16.99],
            [5,  'Caldo de Calabresa', 3, 'Caldo de Calabresa: Aqueça-se com o saboroso caldo de calabresa, uma combinação única de temperos.', 29.99],
            [6,  'Maminha', 7, 'Maminha: Sinta a suculência da maminha, uma carne macia e irresistível.', 23.89],
            [7,  'Marmitex M', 1, 'Marmitex M: Conheça nosso marmitex M, uma opção prática e deliciosa para levar seu sabor preferido.', 53.99],
            [8,  'Ravioli de 4 Formaggio', 6, 'Ravioli de 4 Formaggio: Surpreenda-se com o sabor do ravioli de 4 formaggio, uma explosão de queijos refinados.', 32.99],
            [9,  'Capelete Vegetariano', 6, 'Capelete Vegetariano: Descubra o sabor leve e delicioso do capelete vegetariano, uma opção para todos os gostos.', 52.99],
            [10, 'Nhoque recheado com Catupiry', 6, 'Nhoque recheado com Catupiry: Delicie-se com nosso nhoque recheado com Catupiry, uma combinação irresistível', 21.99],
            [11, 'Picanha ao Alho', 7, 'Picanha ao Alho: Saboreie a picanha ao alho, uma opção suculenta para os amantes de carne.', 31.99],
            [12, 'Pudim de Leite Condensado', 9, 'Pudim de Leite Condensado: Termine sua refeição com o clássico pudim de leite condensado, uma sobremesa divina', 50.99],
            [13, 'Tortinhas de laranja', 9, 'Tortinhas de Laranja: Surpreenda-se com as tortinhas de laranja, uma explosão cítrica em cada mordida.', 51.99],
            [14, 'Doce de Leite', 9, 'Doce de Leite: Delicie-se com o doce de leite, uma sobremesa tradicional e irresistível.', 15.99],
            [15, 'H2O', 10, 'H2O: Refresque-se com nossa água mineral, a escolha perfeita para acompanhar sua refeição.', 25.99],
            [16, 'Suco de Laranja', 10, 'Suco de Laranja: Desfrute do suco de laranja fresco e natural, uma opção saudável e deliciosa', 26.99],
            [17, 'Coca Cola lata', 10, 'Coca Cola lata: Complemente sua experiência com uma Coca Cola gelada, o clássico que nunca sai de moda.', 22.86],
            [18, 'Agua Mineral', 10, 'Mineral e geladinha.', 41.59],
            [19, 'Salada Caprese', 5, 'Salada Caprese: Explore os sabores frescos da salada Caprese, uma combinação perfeita de tomate, mussarela e manjericão.', 33.99],
            [20, 'Batata e Croquete', 2, 'Porção Batata e Croquete: Combine a batata frita com a porção de croquete para uma experiência ainda mais deliciosa', 24.99],
        ];

        $foods = [];
        $st = [];
        foreach ($data as $values) {
            foreach ($values as $key => $food) {
                $st += [$indices[$key] => $food];
            }
            array_push($foods, $st);
            $st = [];
        }
        DB::table('foods')->insert($foods);
    }
}
