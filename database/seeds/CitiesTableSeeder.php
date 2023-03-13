<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'id' => 1,
                'state_id' => 2,
                'name' => 'Adak',
            ],
            [
                'id' => 2,
                'state_id' => 2,
                'name' => 'Akiachak',
            ],
            [
                'id' => 3,
                'state_id' => 2,
                'name' => 'Akiak',
            ],
            [
                'id' => 4,
                'state_id' => 2,
                'name' => 'Akutan',
            ],
            [
                'id' => 5,
                'state_id' => 2,
                'name' => 'Alakanuk',
            ],
            [
                'id' => 6,
                'state_id' => 2,
                'name' => 'Aleknagik',
            ],
            [
                'id' => 7,
                'state_id' => 2,
                'name' => 'Allakaket',
            ],
            [
                'id' => 8,
                'state_id' => 2,
                'name' => 'Ambler',
            ],
            [
                'id' => 9,
                'state_id' => 2,
                'name' => 'Anaktuvuk Pass'
            ],
            [
                'id' => 10,
                'state_id' => 2,
                'name' => 'Anchor Point',
            ],
        ];

            City::insert($cities);

    }
}
