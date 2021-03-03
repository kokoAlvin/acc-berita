<?php

use Illuminate\Database\Seeder;

class blog_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $faker->addProvider(new BlogArticleFaker\FakerProvider($faker));

        for($i = 2; $i <= 20; $i++){
            for($j = 1; $j <= 5; $j++){
                DB::table('blog')->insert([
                    'title' => $faker->articleTitle,
                    'content' => $faker->articleContentMarkdown,
                    'user_id' => $i,
                    'status' => 3,
                    'accepted_at' => '2020-01-01 00:00:00',
                    'flag_active' => 1,
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-01-01 00:00:00'
                ]);
            }
        }

       
        //
    }
}
