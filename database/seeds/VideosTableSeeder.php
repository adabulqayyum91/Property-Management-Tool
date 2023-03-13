<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Faqs
         *
         */
        DB::table('videos')->insert([


            [
                'title' => 'Its just a matter of getting started',
                'link'        => 'https://www.youtube.com/embed/2zg9kEejfxs',
                'description' => 'Learn how it works'
            ],

        ]);



    }
}
