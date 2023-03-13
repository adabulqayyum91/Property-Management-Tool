<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],
            [
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ],
            [
                'name'        => 'Annual Member',
                'slug'        => 'annual',
                'description' => 'Annual Member Exists',
                'level'       => 1,
            ],
            [
                'name'        => 'Month to Month Member',
                'slug'        => 'monthly',
                'description' => 'Month to Month Member Exists',
                'level'       => 1,
            ],
            [
                'name'        => 'Power Admin',
                'slug'        => 'powerAdmin',
                'description' => 'Power Admin has rights about every thing',
                'level'       => 1,
            ],
            [
                'name'        => 'Perspective User',
                'slug'        => 'PerspectiveUser',
                'description' => 'Perspective User exists',
                'level'       => 1,
            ],
            [
                'name'        => 'Property Manager',
                'slug'        => 'manager',
                'description' => 'Property Manager',
                'level'       => 1,
            ],
            [
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ],
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}





