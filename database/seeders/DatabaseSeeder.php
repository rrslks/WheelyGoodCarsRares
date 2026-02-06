<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 150 gebruikers
        User::factory(150)->create();

        // 20 tags
        Tag::factory(20)->create();

        // 250 auto's
        Car::factory(250)->create()->each(function($car){
            // 1-3 random tags per auto
            $tags = Tag::inRandomOrder()->take(rand(1,3))->pluck('id');
            $car->tags()->attach($tags);
        });
    }
}
