<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $countries = Country::where('name', 'Brasil')->get();
        
        $countryId = $countries[0]->id; 

        DB::table('states')->insert( array(
            0=>array( 'name' => 'Rondônia', 'ibge' => 11, 'alias' => 'RO', 'countryId' => $countryId),
            1=>array( 'name' => 'Acre', 'ibge' => 12, 'alias' => 'AC', 'countryId' => $countryId),
            2=>array( 'name' => 'Amazonas', 'ibge' => 13, 'alias' => 'AM', 'countryId' => $countryId),
            3=>array( 'name' => 'Roraima', 'ibge' => 14, 'alias' => 'RR', 'countryId' => $countryId),
            4=>array( 'name' => 'Pará', 'ibge' => 15, 'alias' => 'PA', 'countryId' => $countryId),
            5=>array( 'name' => 'Amapá', 'ibge' => 16, 'alias' => 'AP', 'countryId' => $countryId),
            6=>array( 'name' => 'Tocantins', 'ibge' => 17, 'alias' => 'TO', 'countryId' => $countryId),
            7=>array( 'name' => 'Maranhão', 'ibge' => 21, 'alias' => 'MA', 'countryId' => $countryId),
            8=>array( 'name' => 'Piauí', 'ibge' => 22, 'alias' => 'PI', 'countryId' => $countryId),
            9=>array( 'name' => 'Ceará', 'ibge' => 23, 'alias' => 'CE', 'countryId' => $countryId),
            10=>array( 'name' => 'Rio Grande do Norte', 'ibge' => 24, 'alias' => 'RN', 'countryId' => $countryId),
            11=>array( 'name' => 'Paraíba', 'ibge' => 25, 'alias' => 'PB', 'countryId' => $countryId),
            12=>array( 'name' => 'Pernambuco', 'ibge' => 26, 'alias' => 'PE', 'countryId' => $countryId),
            13=>array( 'name' => 'Alagoas', 'ibge' => 27, 'alias' => 'AL', 'countryId' => $countryId),
            14=>array( 'name' => 'Sergipe', 'ibge' => 28, 'alias' => 'SE', 'countryId' => $countryId),
            15=>array( 'name' => 'Bahia', 'ibge' => 29, 'alias' => 'BA', 'countryId' => $countryId),
            16=>array( 'name' => 'Minas Gerais', 'ibge' => 31, 'alias' => 'MG', 'countryId' => $countryId),
            17=>array( 'name' => 'Espírito Santo', 'ibge' => 32, 'alias' => 'ES', 'countryId' => $countryId),
            18=>array( 'name' => 'Rio de Janeiro', 'ibge' => 33, 'alias' => 'RJ', 'countryId' => $countryId),
            19=>array( 'name' => 'São Paulo', 'ibge' => 35, 'alias' => 'SP', 'countryId' => $countryId),
            20=>array( 'name' => 'Paraná', 'ibge' => 41, 'alias' => 'PR', 'countryId' => $countryId),
            21=>array( 'name' => 'Santa Catarina', 'ibge' => 42, 'alias' => 'SC', 'countryId' => $countryId),
            22=>array( 'name' => 'Rio Grande do Sul', 'ibge' => 43, 'alias' => 'RS', 'countryId' => $countryId),
            23=>array( 'name' => 'Mato Grosso do Sul', 'ibge' => 50, 'alias' => 'MS', 'countryId' => $countryId),
            24=>array( 'name' => 'Mato Grosso', 'ibge' => 51, 'alias' => 'MT', 'countryId' => $countryId),
            25=>array( 'name' => 'Goiás', 'ibge' => 52, 'alias' => 'GO', 'countryId' => $countryId),
            26=>array( 'name' => 'Distrito Federal', 'ibge' => 53, 'alias' => 'DF', 'countryId' => $countryId),
             
        ));
        
        return $countryId;
    }
}
