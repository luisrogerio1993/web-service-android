<?php

use Illuminate\Database\Seeder;
use App\Models\notice;

class noticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 10; $i++){
            notice::create([
                'title' => $faker->text(30),
                'notice' => $faker->text(200),
            ]);
        }
    }
}
