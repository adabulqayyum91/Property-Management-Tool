<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([

            [
                'name'        => 'monthly-',
                'price'        => '15',
                'description'        => 'monthly ',
                'stripe_plan'        => 'plan_GySTuRm7Fhc0ku',
                'created_at' => \Carbon\Carbon::now()
            ],
            [
                'name'        => 'annual-',
                'price'        => '99',
                'description'        => 'annual ',
                'stripe_plan'        => 'plan_GySek2qPORJqIp',
                'created_at' => \Carbon\Carbon::now()

            ],

        ]);
    }
}
