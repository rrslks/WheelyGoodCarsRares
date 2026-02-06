<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'license_plate' => strtoupper($this->faker->bothify('??-###-??')),
            'brand' => $this->faker->randomElement(['BMW','Audi','Mercedes','Volkswagen','Toyota','Ford','Opel']),
            'model' => $this->faker->word,
            'color' => $this->faker->safeColorName,
            'year' => $this->faker->numberBetween(1990, 2026),
            'mileage' => $this->faker->numberBetween(0, 250000),
            'price' => $this->faker->numberBetween(1000, 100000),
            'is_sold' => $this->faker->boolean(20), // 20% kans dat verkocht is
            'views' => $this->faker->numberBetween(0, 50),
        ];
    }
}
