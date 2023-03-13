<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
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
        DB::table('sliders')->insert([


            [
                'title'        => 'Monthly Rent Payments From Your Ownership',
                'description'        => 'Any US resident, unaccredited or accredited.',
                'photo'        => '1583145500.jpg',
            ],
            [
                'title'        => 'Real Estate Investment Joint Ventures... Simplified',
                'description' => 'Historically, these kinds of deals were reserved for the affluent',
                'photo'        => '1583145550.jpg',
            ],
            [
                'title'        => 'Monthly Rent Payments From Your Ownership',
                'description' => 'No. This is the beautiful thing about our technology.',
                'photo'        => '1583474695.jpg',

            ],
            [
                'title'        => 'Real Estate Investment Joint Ventures... Simplified',
                'description' => 'Historically, these kinds of deals were reserved for the affluent',
                'photo'        => '1583731836.jpg',

            ],

        ]);



    }
}
