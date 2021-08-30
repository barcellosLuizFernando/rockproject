<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Nfs_cfps_cst;
use App\Models\Nfs_cnae;
use App\Models\Transaction;
use Database\Seeders\CfpsCstSeeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\CnaeSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\TransactionSeeder;
use Illuminate\Http\Request;
use stdClass;

class SeederController extends Controller
{
    public function seedcountry()
    {

        $countries = Country::all();

        if (count($countries) == 0) {

            $country = new CountrySeeder;
            $country->run();
        }

        return redirect('/configs');
    }

    public function seedstate()
    {

        $states = State::all();

        if (count($states) == 0) {
            $state = new StateSeeder();
            $state->run();
        }

        return redirect('/configs');
    }

    public function seedcity()
    {

        $cities = City::all();

        if (count($cities) == 0) {
            $city = new CitySeeder();
            $city->run();
        }

        return redirect('/configs');
    }

    public function seedcnae()
    {
        $cnaes = Nfs_cnae::all();

        if (count($cnaes) == 0) {
            $cnae = new CnaeSeeder();
            $cnae->run();
        }

        return redirect('/configs');
    }

    public function seedcfpscst()
    {

        $cfps = Nfs_cfps_cst::all();

        if (count($cfps) == 0) {
            $cfpscst = new CfpsCstSeeder();
            $cfpscst->run();
        }

        return redirect('/configs');
    }
    
    public function seedtransaction()
    {
        $transactions = Transaction::all();
        
        if(count($transactions) == 0) {
            $transactions = new TransactionSeeder();
            $transactions->run();
        }

        return redirect('/configs');
    }
}
