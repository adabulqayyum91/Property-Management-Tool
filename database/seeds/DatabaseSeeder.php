<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeds\PermissionsTableSeeder;
use Database\Seeds\RolesTableSeeder;
use Database\Seeds\ConnectRelationshipsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
       $this->call(TypesTableSeeder::class);
       $this->call(FaqsTableSeeder::class);
       $this->call(SlidersTableSeeder::class);
       $this->call(VideosTableSeeder::class);
       $this->call(PagesTableSeeder::class);
       $this->call(\PermissionsTableSeeder::class);
       $this->call(\RolesTableSeeder::class);
       $this->call(\ConnectRelationshipsSeeder::class);
       $this->call(\UsersTableSeeder::class);

        Model::reguard();
    }
}
