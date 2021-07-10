<?php

namespace App\Http\Controllers;

use App\Mail\TimeSheetLog;
use App\Models\Periodsheet;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

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

        $this->createdefault();

        return redirect('/periodsheet');
    }

    private function createdefault()
    {
        /** Define qual o período, para não precisar configurar o servidor
         * No Raspbian, o horário ficava errado
         */
        date_default_timezone_set('America/Sao_Paulo');

        /**Busca a última Folha de Horários */
        $periodsheet = Periodsheet::orderBy('datetime', 'DESC')
            ->where('idUser', auth()->user()->id)
            ->get();

        /** Se tiver um fluxo, recupera esse fluxo. Se não tiver, o fluxo é true.
         * Necessário marcar isso para quando é a primeira batida da pessoa.
         */
        $flow = isset($periodsheet[0]->flow) ? $periodsheet[0]->flow : true;


        if (count($periodsheet)) {
            /** AVALIA SE O ÚLTIMO DIA É O MESMO ATUAL */
            $dateDB = date('d-m-Y', strtotime($periodsheet[0]->datetime));
            $dateNow = new DateTime();


            if (date('d-m-Y', $dateNow->getTimestamp()) != $dateDB) $flow = true;
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

        return $periodsheet;
    }

    public function createmobile()
    {

        $timesheet = $this->createdefault();

        return redirect('/periodsheet/mobile');
    }

    public function mobile()
    {
        $timesheet = Periodsheet::orderBy('datetime', 'DESC')
            ->where('idUser', auth()->user()->id)
            ->get();
        $timesheet = Periodsheet::find($timesheet[0]->id);
        $timesheet->load(['user']);

        return view('periodsheet.mobile', ['timesheet' => $timesheet]);
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

        $timesheets = Periodsheet::with('user')
            ->where('idUser', auth()->user()->id)
            ->where(Periodsheet::raw('YEAR(datetime)'), $year)
            ->where(Periodsheet::raw('MONTH(datetime)'), $month)
            ->orderBy('datetime', 'ASC')
            ->get();

        $days = date('t', strtotime($year . "/" . $month . "/01"));

        $timesheet2 = [];


        for ($i = 1; $i <= $days; $i++) {

            $day = date('d/m/Y', strtotime($year . "/" . $month . "/" . $i));

            $object = new stdClass();
            $object->day = $day;
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            $object->dayName = strftime("%A", strtotime($month . "/" . $i . "/" . $year ));
            $object->sheets = [];
            $sheets = new stdClass();

            $sheet = [];
            $lastflow = null;

            $results = count($timesheets);
            $hasEntry = false;
            $hasTrouble = false;


            foreach ($timesheets as $timesheet) {

                if ($day == date('d/m/Y', strtotime($timesheet->datetime))) {

                    $flow = $timesheet->flow;

                    if ($flow == 0) $hasEntry = true;

                    if (!$hasEntry) {
                        array_push($sheet, [
                            'flow' => 0,
                            'data' => null,
                            'adjusted' => null,
                            'hasTrouble' => $hasTrouble
                        ]);
                        $hasTrouble = true;
                    }

                    array_push($sheet, [
                        'flow' => $flow,
                        'data' => $timesheet->datetime,
                        'adjusted' => $timesheet->adjusted ? "Ajustado" : "Original"
                        
                    ]);


                    $results--;
                    /** Vai salvar o Array se:
                     * 1. Chegar no final do array
                     * 2. For um movimento de saída
                     * 3. For um movimento igual ao movimento anterior
                     */
                    if ($i <= 0 || $timesheet->flow == 1 || $lastflow == $flow) {

                        if ($hasEntry && $lastflow == $flow) {
                            array_push($sheet, [
                                'flow' => '',
                                'data' => null,
                                'adjusted' => null,
                                'hasTrouble' => $hasTrouble
                            ]);
                            $hasTrouble = true;
                        }

                        array_push($object->sheets, $sheet);
                        $sheet = array();
                        $hasEntry = false;
                        $hasTrouble = false;
                    }
                    $lastflow = $flow;
                }
            }

            //$object->sheets = $sheets;

            array_push($timesheet2, $object);
        }



        session(['page' => 'periodreport']);

        return view('periodsheet.report.period.show', [
            'timesheet' => $timesheets,
            'days' => $days,
            'tt' => $timesheet2
        ]);
    }
}
