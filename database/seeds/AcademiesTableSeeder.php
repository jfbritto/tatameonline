<?php

use Illuminate\Database\Seeder;

class AcademiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academies')->insert([
            'id' => 1,
            'name' => 'Team Atitude',
            'siteName' => 'team-atitude',
            'phone' => '(28)99448-9448',
            'responsible' => 'Júnior',
            'phoneResponsible' => '(28)99448-9448',
            'token' => 123456,
            'isActive' => 1,
        ]);
    }
}
