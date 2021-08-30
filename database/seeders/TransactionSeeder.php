<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert( array(
            0 => array('id' => 'CPR01', 
                    'module' => 'CPR', 
                    'description' => 'Compras diversas', 
                    'type' => 'NA'),
            1 => array('id' => 'PAG01', 
                    'module' => 'PAG', 
                    'description' => 'Entrada de título a pagar', 
                    'type' => 'NA'),
            2 => array('id' => 'VEN01', 
                    'module' => 'VEN', 
                    'description' => 'Venda de mercadorias / serviços', 
                    'type' => 'NA'),
            3 => array('id' => 'REC01', 
                    'module' => 'REC', 
                    'description' => 'Entrada de título a receber', 
                    'type' => 'NA'),
            4 => array('id' => 'REC02', 
                    'module' => 'REC', 
                    'description' => 'Baixa de título a receber', 
                    'type' => 'PG'),
            5 => array('id' => 'PAG02', 
                    'module' => 'PAG', 
                    'description' => 'Baixa de título a pagar', 
                    'type' => 'PG'),
            6 => array('id' => 'TES01', 
                    'module' => 'TES', 
                    'description' => 'Outros créditos', 
                    'type' => 'CR'),
            7 => array('id' => 'TES02', 
                    'module' => 'TES', 
                    'description' => 'Outros débitos', 
                    'type' => 'DB'),
            8 => array('id' => 'TES03', 
                    'module' => 'TES', 
                    'description' => 'Transferência - crédito', 
                    'type' => 'CR'),
            9 => array('id' => 'TES04', 
                    'module' => 'TES', 
                    'description' => 'Transferência - débito', 
                    'type' => 'DB'),
            10 => array('id' => 'PAG03', 
                    'module' => 'PAG', 
                    'description' => 'Adiantamento a fornecedor', 
                    'type' => 'AD'),
            11 => array('id' => 'REC03', 
                    'module' => 'REC', 
                    'description' => 'Adiantamento de cliente', 
                    'type' => 'AD'),

        ));
    }
}
