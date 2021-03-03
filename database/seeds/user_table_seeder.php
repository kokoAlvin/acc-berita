<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class user_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create('id_ID');

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Password@_1'),
            'created_at' => '2020-01-01 00:00:00',
            'updated_at' => '2020-01-01 00:00:00',
            'role' => '1'
        ]);

        for($i = 2; $i <= 50; $i++){
            DB::table('users')->insert([
                'id' => $i,
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => Hash::make('Password@_1'),
                'created_at' => '2020-01-01 00:00:00',
                'updated_at' => '2020-01-01 00:00:00',
                'role' => '2'
            ]);
        }
    }
}
