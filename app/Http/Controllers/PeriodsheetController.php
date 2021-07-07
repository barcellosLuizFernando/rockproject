<?php

namespace App\Http\Controllers;

use App\Mail\TimeSheetLog;
use App\Models\Periodsheet;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PeriodsheetController extends Controller
{
    public function show(Request $request)
    {

        $periodsheet = Periodsheet::orderBy('datetime', 'DESC')
            ->where('idUser', auth()->user()->id)
            ->get();
        session(['page' => 'periodsheet']);

        if (count($periodsheet) > 0) {
            $periodsheet = $periodsheet[0];

            /** AVALIA SE É O MESMO DIA
             * SE NÃO FOR, INICIA UM NOVO REGISTRO
             */
            $dateDB = date('d-m-Y', strtotime($periodsheet->datetime));
            $dateNow = new DateTime();

            $periodsheet->dateDB = $dateDB;
            $periodsheet->dateNow = date('d-m-Y', $dateNow->getTimestamp());

            if (date('d-m-Y', $dateNow->getTimestamp()) != $dateDB) $periodsheet->alternativeflow = 0;
        } else {
            $periodsheet->flow = 1;
        }
        //$periodsheet[0]->aaa = date_default_timezone_get();


        return view('periodsheet.show', ['periodsheet' => $periodsheet]);
    }

    public function create()
    {

        date_default_timezone_set('America/Sao_Paulo');

        $periodsheet = Periodsheet::orderBy('datetime', 'DESC')
            ->where('idUser', auth()->user()->id)
            ->get();

        $flow = isset($periodsheet[0]->flow) ? $periodsheet[0]->flow : true;

        if (count($periodsheet)) {
            /** AVALIA SE O ÚLTIMO DIA É O MESMO ATUAL */
            $dateDB = date('d-m-Y', strtotime($periodsheet[0]->datetime));
            $dateNow = new DateTime();

            if (date('d-m-Y', $dateNow->getTimestamp()) != $dateDB) $flow = false;
        }

        $periodsheet = new Periodsheet();

        $ip = request()->ip();

        $periodsheet->idUser = auth()->user()->id;
        $periodsheet->datetime = now();
        $periodsheet->flow = $flow == false ? true : false;
        $periodsheet->adjusted = false;
        $periodsheet->description = '';
        $periodsheet->ip = $ip;
        $periodsheet->save();

        
        Mail::to(auth()->user())
            ->cc('fernando.dbarcellos@gmail.com')
            ->queue(new TimeSheetLog($periodsheet));

        return redirect('/periodsheet');
    }

    public function mailable()
    {
        $timesheet = Periodsheet::find(7);
        $timesheet->load(['user']);

        return new TimeSheetLog($timesheet);
        
    }
}
