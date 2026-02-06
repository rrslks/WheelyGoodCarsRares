<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    public function run()
    {
        // 150 aanbieders
        User::factory(150)->create()->each(function($user){
            // Elke aanbieder 1-3 auto's
            $count = rand(1,3);
            for($i=0;$i<$count;$i++){
                Car::create([
                    'user_id' => $user->id,
                    'license_plate' => strtoupper(Str::random(2) . '-' . rand(100,999) . '-' . Str::random(2)),
                    'brand' => fake()->company(),
                    'model' => fake()->word(),
                    'year' => rand(2000,2023),
                    'mileage' => rand(5000,200000),
                    'price' => rand(1000,50000),
                    'is_sold' => false,
                ]);
            }
        });
    }
}
