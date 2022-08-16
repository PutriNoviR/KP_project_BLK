<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(KlasterSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(KejuruanSeeder::class);
        $this->call(SubKejuruanSeeder::class);
    }
}
