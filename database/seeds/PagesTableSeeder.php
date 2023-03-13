<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Pages
         *
         */
        DB::table('pages')->insert([


            [
                'title'        => 'company',
                'slug'        => 'company',
                'content'        => 'Property Management Tool was born out of frustration with the current offerings available for a low risk short term return

',
            ],[
                'title'        => 'REAL ESTATE',
                'slug'        => 'real-estate-investment-joint-ventures-simplified',
                'content'        => 'ou must be 18 years of age to open an account, but we encourage kids to get involved under their parents account by creating a sub account. There is not fee for this kind of account if the account has less than $5000 in it. You must be 18 years of age to open an account, but we encourage kids to get involved under their parents account by creating a sub account. There is not fee for this kind of account if the account has less than $5000 in it. You must be 18 years of age to open an account, but we encourage kids to get involved under their parents account by creating a sub account. There is not fee for this kind of account if the account has less than $5000 in it',
            ],

        ]);



    }
}
