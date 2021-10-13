<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Classlocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClasslocalsController extends Controller
{
    //
    public function index()
    {
        # code...

        $classlocals = Classlocal::orderBy('description')->get();
        //$classlocals->load('city');
        
        return view('classlocals.show', ['classlocals' => $classlocals]);
    }

    public function create(Request $request)
    {
        # code...
        $classlocal = new Classlocal();
        $cities = City::orderBy('Name')->get();
        $cities->load('state');
        //return $cities;
        return view('classlocals.create', ['classlocal' => $classlocal, 'cities' => $cities]);
    }

    public function store(Request $request)
    {
        # code...
        $classlocal = new Classlocal();
        $classlocal->description = $request->localdescription;
        $classlocal->idCity = $request->localcity;
        $classlocal->address = $request->localaddress;
        $classlocal->district = $request->localdistrict;
        $classlocal->zipcode = $request->localzipcode;

        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/classlocals', $file, $name);
        }

        $classlocal->filename = $name;
        $classlocal->save();

        return redirect('/registers/classlocals');

    }

    public function show($id)
    {
        # code...
        $classlocal = Classlocal::findOrFail($id);
        $cities = City::orderBy('name')->get();

        return view('classlocals.create', ['classlocal' => $classlocal, 'cities' => $cities]);
    }

    public function update(Request $request)
    {
        # code...
        $classlocal = Classlocal::findOrFail($request->id);
        $classlocal->description = $request->localdescription;
        $classlocal->idCity = $request->localcity;
        $classlocal->address = $request->localaddress;
        $classlocal->district = $request->localdistrict;
        $classlocal->zipcode = $request->localzipcode;

        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/classlocals', $file, $name);
        }

        $classlocal->filename = $name;
        $classlocal->save();

        return redirect('/registers/classlocals');
    }

    public function destroy($id)
    {
        # code...
        $classlocal = Classlocal::findOrFail($id);
        $classlocal->delete();

        return redirect('/registers/classlocals');

    }
}
