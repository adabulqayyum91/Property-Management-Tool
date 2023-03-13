<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
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
        DB::table('statuses')->insert([


            [
                'title'        => 'New Venture',
                'type'        => 'Listing',
            ],
            [
                'title'        => 'Current Venture',
                'type'        => 'Listing',
            ],
            [
                'title'        => 'Open Access',
                'type'        => 'User',
            ],
            [
                'title'        => 'Open Access Locked',
                'type'        => 'User',
            ],
            [
                'title'        => 'Limited Access',
                'type'        => 'User',

            ],

            [
                'title'        => 'Limited Access Locked',
                'type'        => 'User',

            ],
            [
                'title'        => 'Inactive',
                'type'        => 'User',

            ],
            [
                'title'        => 'Cancelled',
                'type'        => 'User',

            ],[
                'title'        => 'Joined',
                'type'        => 'Referral',

            ],
            [
                'title'        => 'Not Joined',
                'type'        => 'Referral',

            ],
            [
                'title'        => 'In Process',
                'type'        => 'Referral',

            ]

        ]);



    }
}
