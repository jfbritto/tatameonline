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
            'name' => 'Jiu Jitsu infantil',
        ],[
            'id' => '4',
            'name' => 'Muay Thai',
        ],[
            'id' => '5',
            'name' => 'Muay Thai Kids',
        ],[
            'id' => '6',
            'name' => 'Caratê',
        ],[
            'id' => '7',
            'name' => 'Judô',
        ],[
            'id' => '8',
            'name' => 'Aiquidô',
        ]]);
    }
}