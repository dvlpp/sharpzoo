<?php

use Illuminate\Database\Seeder;
use App\Sharp\Giraffe\Giraffe;

class GiraffeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('giraffes')->delete();

        $faker = Faker\Factory::create('en_US');

        for( $x=0 ; $x<150; $x++ )
        {
            Giraffe::create([
                'name' => $faker->name,
                'age' => $faker->numberBetween(1, 15),
                'height' => $faker->numberBetween(400, 580),
                'desc' => $faker->paragraph(3),
                'alive' => $faker->boolean(),
                'lang' => $faker->randomElement(['fr', 'en']),
                'zookeeper_id' => $faker->numberBetween(1,3)
            ]);
        }
    }

} 