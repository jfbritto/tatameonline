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
        $this->call(AcademiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SportsTableSeeder::class);
        $this->call(HistoricTypeTableSeeder::class);
    }
}
