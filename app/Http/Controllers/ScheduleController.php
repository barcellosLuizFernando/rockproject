<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        # code...
        /*
        $data = Event::all();
        foreach ($data as $key => $value) {
            # code...
            $value->start = str_replace(' ', 'T', $value->start);
            $value->end = str_replace(' ', 'T', $value->end);
        }
        return response()->json($data);
        */

        if (false) {
        }


        session(['page' => 'schedule']);
        return view('schedule.show');
    }

    public function getSchedule(Request $request)
    {
        # code...
        $data = Event::whereDate('start', '>=', $request->start)
            ->whereDate('end', '<=', $request->end)
            ->get();
        //$data = Event::all();

        foreach ($data as $key => $value) {
            # code...
            $value->start = str_replace(' ', 'T', $value->start);
            $value->end = str_replace(' ', 'T', $value->end);
        }


        return response()->json($data);
    }
}
