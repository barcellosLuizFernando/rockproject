<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    //
    public function index()
    {
        # code...
        $companies = Company::orderBy('name')->get();

        return view('companies.show', ['companies' => $companies]);
    }

    public function create()
    {
        # code...
        $company = new Company();
        $cities = City::orderBy('name')->get();

        return view('companies.create', ['company' => $company, 'cities' => $cities]);
    }
    
    public function store(Request $request)
    {
        # code...
        $company = new Company();
        $company->name = $request->name;
        $company->taxnumber = $request->taxnumber;
        $company->statetaxnumber = $request->statetaxnumber;
        $company->citytaxnumber = $request->citytaxnumber;
        $company->zipcode = $request->zipcode;
        $company->idCity = $request->city;
        $company->district = $request->district;
        $company->address = $request->address;
        $company->save();
        
        return redirect('/registers/companies');
    }
    
    public function show($id)
    {
        # code...
        $company = Company::findOrFail($id);
        $cities = City::orderBy('name')->get();
        
        
        return view('companies.create', ['company' => $company, 'cities' => $cities]);
    }

    public function update(Request $request)
    {
        # code...
        $company = Company::findOrFail($request->id);
        $company->name = $request->name;
        $company->taxnumber = $request->taxnumber;
        $company->statetaxnumber = $request->statetaxnumber;
        $company->citytaxnumber = $request->citytaxnumber;
        $company->zipcode = $request->zipcode;
        $company->idCity = $request->city;
        $company->district = $request->district;
        $company->address = $request->address;
        $company->save();
        
        return redirect('/registers/companies');
    }
    
    public function destroy($id)
    {
        # code...
        $company = Company::findOrFail($id);
        $company->delete();
        
        return redirect('/registers/companies');
    }
}
