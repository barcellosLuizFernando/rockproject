<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    //
    public function index()
    {
        # code...
        $courses = Course::orderBy('name')->get();
        return view('courses.show', ['courses' => $courses]);
    }

    public function create()
    {
        # code...
        $course = new Course();
        return view('courses.create', ['course' => $course]);
    }
    
    public function store(Request $request)
    {
        # code...
        $course = new Course();
        $course->name = $request->coursename;
        $course->save();

        return redirect('/registers/courses');
    }
    
    public function show($id)
    {
        # code...
        $course = Course::findOrFail($id);
        
        return view('courses.create', ['course' => $course]);
    }
    
    public function update(Request $request)
    {
        # code...
        $course = Course::findOrFail($request->id);
        
        $course->name = $request->coursename;
        $course->save();
        
        return redirect('/registers/courses');
        
    }
    
    public function destroy($id)
    {
        # code...
        $course = Course::findOrFail($id);
        $course->delete();
        
        
        return redirect('/registers/courses');
    }
}
