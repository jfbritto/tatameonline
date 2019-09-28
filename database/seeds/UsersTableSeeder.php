<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'João Filipi',
            'email' => 'root@hotmail.com',
            'password' => bcrypt('root12345678'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'isRoot' => 1,
            'isAdmin' => 0,
            'isStudent' => 0,
            'idAcademy' => null,
        ]);
    }
}