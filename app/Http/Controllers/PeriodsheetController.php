<?php

namespace App\Http\Controllers;

use App\Mail\TimeSheetLog;
use App\Models\Periodsheet;
use Carbon\Carbon;
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

    public function showPeriods()
    {

        $years = Periodsheet::select(Periodsheet::raw('YEAR(datetime) as year'))
            ->distinct()
            ->where('idUser', auth()->user()->id)
            ->get();


        foreach ($years as $year) {

            $months = Periodsheet::select(
                Periodsheet::raw('MONTH(datetime) as month'),
                Periodsheet::raw('count(distinct DAY(datetime)) as days')
            )

                ->where(Periodsheet::raw('YEAR(DATETIME)'), $year->year)
                ->where('idUser', auth()->user()->id)
                ->groupBy('month')
                ->get();

            foreach ($months as $month) {

                switch ($month->month) {
                    case 1:
                        $year->january = $month->days;
                        break;
                    case 2:
                        $year->february = $month->days;
                        break;
                    case 3:
                        $year->march = $month->days;
                        break;
                    case 4:
                        $year->april = $month->days;
                        break;
                    case 5:
                        $year->may = $month->days;
                        break;
                    case 6:
                        $year->june = $month->days;
                        break;
                    case 7:
                        $year->july = $month->days;
                        break;
                    case 8:
                        $year->august = $month->days;
                        break;
                    case 9:
                        $year->september = $month->days;
                        break;
                    case 10:
                        $year->october = $month->days;
                        break;
                    case 11:
                        $year->november = $month->days;
                        break;
                    case 12:
                        $year->december = $month->days;
                        break;
                }
            }
        }

        session(['page' => 'periodreport']);
        return view('periodsheet.report.show', ['years' => $years]);
    }

    public function showPeriod($year, $month)
    {

        $days = date('t', strtotime($year . "/" . $month . "/01"));

        $timesheet = Periodsheet::with('user')
            ->where('idUser', auth()->user()->id)
            ->where(Periodsheet::raw('YEAR(datetime)'), $year)
            ->where(Periodsheet::raw('MONTH(datetime)'), $month)
            ->orderBy('datetime', 'ASC')
            ->get();

        session(['page' => 'periodreport']);
        return view('periodsheet.report.period.show', ['timesheet' => $timesheet, 'days' => $days]);
    }
}
