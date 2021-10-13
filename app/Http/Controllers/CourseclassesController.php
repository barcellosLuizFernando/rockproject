<?php

namespace App\Http\Controllers;

use App\Models\Classlocal;
use App\Models\Company;
use App\Models\Courseclass;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseclassesController extends Controller
{
    //

    public function index()
    {
        # code...
        $courseclasses = Courseclass::all();
        //$courses = Course::orderBy('name')->get();

        return view('courseclasses.show', ['courseclasses' => $courseclasses]);
    }

    public function create()
    {
        # code...
        $courseclass = new Courseclass();
        $companies = Company::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        $classlocals = Classlocal::orderBy('description')->get();
        
        return view('courseclasses.create', [
            'courseclass' => $courseclass,
            'companies' => $companies,
            'courses' => $courses,
            'classlocals' => $classlocals,
        ]);
    }
    
    public function store(Request $request)
    {
        # code...
        $courseclass = new Courseclass();
        $courseclass->idCompany = $request->company;
        $courseclass->idCourse = $request->course;
        $courseclass->idClassLocal = $request->classlocal;
        $courseclass->rock_id = $request->rockId;
        $courseclass->name = $request->coursename;
        $courseclass->save();
        
        return redirect('/registers/classcourses');
    }
    
    public function show($id)
    {
        # code...
        $courseclass = Courseclass::findOrFail($id);
        $companies = Company::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        $classlocals = Classlocal::orderBy('description')->get();
        
        return view('courseclasses.create', [
            'courseclass' => $courseclass,
            'companies' => $companies,
            'courses' => $courses,
            'classlocals' => $classlocals,
        ]);
    }
    
    public function update(Request $request)
    {
        # code...
        $courseclass = Courseclass::findOrFail($request->id);
        $courseclass->idCompany = $request->company;
        $courseclass->idCourse = $request->course;
        $courseclass->idClassLocal = $request->classlocal;
        $courseclass->rock_id = $request->rockId;
        $courseclass->name = $request->coursename;
        $courseclass->save();
        
        return redirect('/registers/classcourses');
    }
    
    public function destroy($id)
    {
        # code...
        $courseclass = Courseclass::findOrFail($id);
        $courseclass->delete();
        
        
        return redirect('/registers/classcourses');
    }
}
