<?php

namespace Database\Factories;

use App\Models\Tarjeta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarjeta>
 */
class TarjetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tarjeta::class;

    public function definition(): array
    {
        return [
            'numTarjeta' => $this->faker->creditCardNumber,
            'titular' => $this->faker->name,
            'fecExpira' => $this->faker->creditCardExpirationDateString, 
            'cvc' => $this->faker->numberBetween(100, 999),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
