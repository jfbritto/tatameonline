<?php

use Illuminate\Database\Seeder;

class HistoricTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historic_types')->insert([
        [
            'id' => '1',
            'name' => 'Login',
        ],
        [
            'id' => '2',
            'name' => 'Pagamento',
        ],
        [
            'id' => '3',
            'name' => 'Edição fatura',
        ]]);
    }
}
