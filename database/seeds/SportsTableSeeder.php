<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert([
        [
            'id' => '1',
            'name' => 'Jiu-Jitsu',
        ],[
            'id' => '2',
            'name' => 'Jiu-Jitsu NoGi',
        ],[
            'id' => '3',
            'name' => 'Muay thai',
        ],[
            'id' => '4',
            'name' => 'Caratê',
        ],[
            'id' => '5',
            'name' => 'Judô',
        ],[
            'id' => '6',
            'name' => 'Aiquidô',
        ]]);
    }
}