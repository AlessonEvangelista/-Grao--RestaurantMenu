<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        $cnpj = $faker->cnpj();
        $lerolero = [
            'Desta maneira, a mobilidade dos capitais internacionais estende o alcance e a importância das posturas dos órgãos dirigentes com relação às suas atribuições.',
            'Desta maneira, a valorização de fatores subjetivos talvez venha a ressaltar a relatividade de todos os recursos funcionais envolvidos.',
            'Desta maneira, o desafiador cenário globalizado apresenta tendências no sentido de aprovar a manutenção dos paradigmas corporativos.',
            'O empenho em analisar o aumento do diálogo entre os diferentes setores produtivos apresenta tendências no sentido de aprovar a manutenção do orçamento setorial.',
        ];

        return [
            'fantasy_name' => $this->faker->domainName(),
            'company_name' => $this->faker->company(),
            'identification_doc' => $cnpj,
            'describe' => $this->faker->randomElement($lerolero),
            'address' => $this->faker->address(),
        ];
    }
}
