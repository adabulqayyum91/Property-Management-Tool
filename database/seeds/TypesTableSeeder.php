<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
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
        DB::table('types')->insert([


            [
                'title'        => 'Single Family',
                'type'        => 'Listing',
            ],
            [
                'title'        => 'Multi Family',
                'type'        => 'Listing',

            ],

            [
                'title'        => 'Retail',
                'type'        => 'Listing',

            ],
            [
                'title'        => 'Commercial',
                'type'        => 'Listing',

            ],[
                'title'        => 'Annual Member',
                'type'        => 'User',
            ],
            [
                'title'        => 'Month to Month Member',
                'type'        => 'User',
            ],
            [
                'title'        => 'Admin',
                'type'        => 'User',

            ],

            [
                'title'        => 'Power Admin',
                'type'        => 'User',

            ],
            [
                'title'        => 'Perspective User',
                'type'        => 'User',

            ],
            [
                'title'        => 'Property Manager',
                'type'        => 'User',

            ],
            [
                'title'        => 'Any User',
                'type'        => 'User',

            ],
            [
                'title'        => 'Bank Statements',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Articles of Inc.',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Tax Documents',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Purchase & Sales Agreement',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Property History',
                'type'        => 'Document',

            ],
            [
                'title'        => 'P&L Statements',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Property Summary',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Operating Agreements',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Insurance',
                'type'        => 'Document',

            ],
            [
                'title'        => 'Misc Documents',
                'type'        => 'Document',

            ]

        ]);



    }
}
