<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public function index()
    {
        $people = People::all();
        $people->load(['city', 'city.state']);

        return view('finance.people.show', ['people' => $people]);
    }

    public function create()
    {
        # code...
        $people = new People();
        $cities = City::orderBy('name')->get();
        $cities->load('state');

        return view('finance.people.create', ['people' => $people, 'cities' => $cities]);
    }

    public function store(Request $request)
    {
        # code...
        $people = new People();
        $people->name = $request->name;
        $people->taxnumber = $request->taxnumber;
        $people->taxtype = $request->btnfisicajuridica;
        $people->client = isset($request->client);
        $people->supplier = isset($request->supplier);
        $people->employee = isset($request->employee);
        $people->zipcode = $request->zipcode;
        $people->idCity = $request->city;
        $people->district = $request->district;
        $people->address = $request->address;
        $people->email = $request->email;
        $people->phonenumber = $request->phonenumber;
        $people->cellphonenumber = $request->cellphonenumber;
        $people->save();


        return redirect('/finance/people');
    }
    public function update(Request $request)
    {
        # code...
        $people = People::findOrFail($request->id);
        $people->name = $request->name;
        $people->taxnumber = $request->taxnumber;
        $people->taxtype = $request->btnfisicajuridica;
        $people->client = isset($request->client);
        $people->supplier = isset($request->supplier);
        $people->employee = isset($request->employee);
        $people->zipcode = $request->zipcode;
        $people->idCity = $request->city;
        $people->district = $request->district;
        $people->address = $request->address;
        $people->email = $request->email;
        $people->phonenumber = $request->phonenumber;
        $people->cellphonenumber = $request->cellphonenumber;
        $people->save();


        return redirect('/finance/people');
    }

    public function show($id)
    {
        # code...
        $people = People::findOrFail($id);
        $cities = City::orderBy('name')->get();
        $cities->load('state');
        return view('finance.people.create', ['people' => $people, 'cities' => $cities]);
    }

    public function destroy($id)
    {
        # code...
        $people = People::findOrFail($id)->delete();

        return redirect('/finance/people');
    }
}
