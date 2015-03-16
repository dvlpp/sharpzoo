<?php

use Illuminate\Database\Seeder;
use App\Sharp\Zookeeper\Zookeeper;

class ZookeeperTableSeeder extends Seeder {

    public function run()
    {
        DB::table('zookeepers')->delete();

        $faker = Faker\Factory::create('en_US');

        for( $x=0 ; $x<3; $x++ )
        {
            Zookeeper::create([
                'id' => $x+1,
                'name' => $faker->name
            ]);
        }
    }

} 