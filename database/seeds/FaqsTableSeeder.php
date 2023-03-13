<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
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
        DB::table('faqs')->insert([


            [
                'title'        => 'Who can invest?',
                'description'        => 'Any US resident, unaccredited or accredited.',
            ],
            [
                'title'        => 'Is there an age limit?',
                'description' => 'You must be 18 years of age to open an account, but we encourage kids to get involved under their parents account by creating a sub account. There is not fee for this kind of account if the account has less than $5000 in it',
            ],
            [
                'title'        => 'Are their limits in how much I can invest?',
                'description' => 'No. This is the beautiful thing about our technology. Historically, it would have been very difficult to get into this kind of investment and manage it. With technology, we provide you with the tools to participate and make management decisions (actually, it is required)',

            ],

        ]);



    }
}
