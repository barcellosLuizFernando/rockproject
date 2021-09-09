<?php

namespace App\Http\Controllers;

use App\Mail\TimeSheetLog;
use App\Models\Periodsheet;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use stdClass;
use TypeError;

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

        $users = User::orderBy('name')->get();

        if (auth()->user()->current_team_id != env('TEAMS_MANAGER')) {

            $users = $users->where('id', auth()->user()->id);
        }


        foreach ($users as $user) {

            $user->years = Periodsheet::select(Periodsheet::raw('YEAR(datetime) as year'))
                ->distinct()
                ->where('idUser', $user->id)
                ->get();


            foreach ($user->years as $year) {

                $year->months = Periodsheet::select(
                    Periodsheet::raw('MONTH(datetime) as month'),
                    Periodsheet::raw('count(distinct DAY(datetime)) as days')
                )
                    ->where(Periodsheet::raw('YEAR(DATETIME)'), $year->year)
                    ->where('idUser', $user->id)
                    ->groupBy('month')
                    ->get();

                foreach ($year->months as $month) {
                    //return $month;
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
        }

        //$years->load('users');

        //return $users;

        session(['page' => 'periodreport']);
        return view('periodsheet.report.show', ['users' => $users]);
    }


    public function showPeriod($year, $month)
    {

        $idUser = auth()->user()->id;
        return $this->getPeriod($year, $month, $idUser);
    }

    public function showPeriodAdm($year, $month, $idUser)
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            $idUser = auth()->user()->id;
        }

        return $this->getPeriod($year, $month, $idUser);
    }

    private function getPeriod($year, $month, $idUser)
    {

        $timesheets = Periodsheet::with('user')
            ->where('idUser', $idUser)
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
            $object->year = $year;
            $object->month = $month;
            $object->i = $i;
            $object->idUser = $idUser;
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            $object->dayName = strftime("%A", strtotime($month . "/" . $i . "/" . $year));
            $object->sheets = [];
            $sheets = new stdClass();

            $sheet = [];
            $lastflow = null;
            $lasttime = new DateTime();

            $results = count($timesheets);
            $hasEntry = false;
            $hasTrouble = false;
            $endOfDay = false;


            foreach ($timesheets as $timesheet) {

                $flow = $timesheet->flow;

                if ($day == date('d/m/Y', strtotime($timesheet->datetime))) {


                    if ($flow == 0) $hasEntry = true;

                    /** Verifica se o dia já teve uma entrada */
                    if (!$hasEntry) {
                        array_push($sheet, [
                            'flow' => 0,
                            'data' => null,
                            'adjusted' => null,
                            'hasTrouble' => $hasTrouble
                        ]);
                        $hasTrouble = true;
                        $hasEntry = true;
                        $lastflow = 0;
                        
                    } elseif ($flow == 0 && $lastflow === 0 ){
                        
                        $hasTrouble = true;
                        array_push($sheet, [
                            'flow' => 1,
                            'data' => null,
                            'adjusted' => null,
                            'hasTrouble' => $hasTrouble
                        ]);

                        array_push($object->sheets, $sheet);
                        $sheet = array();

                    }

                    array_push($sheet, [
                        'flow' => $flow,
                        'data' => $timesheet->datetime,
                        'adjusted' => $timesheet->adjusted ? "Ajustado" : "Original",
                        'id' => $timesheet->id
                    ]);

                    $lastflow = $flow;

                    $results--;
                    /** Vai salvar o Array se:
                     * 1. Chegar no final do array
                     * 2. For um movimento de saída
                     */
                    if ($i <= 0 || $lastflow == 1) {

                        if ($lastflow == 0) {
                            array_push($sheet, [
                                'flow' => '',
                                'data' => null,
                                'adjusted' => null,
                                'hasTrouble' => $hasTrouble
                            ]);
                            $hasTrouble = true;
                        }

                        try {
                            $time = date_diff(new DateTime($timesheet->datetime), new DateTime($lasttime));
                            $sheet[2] = [
                                'sumformatted' => $time->format('%Hh %Im %Ss'),
                                'sum' => $time
                            ];
                        } catch (TypeError $err) {
                            $sheet[2] = ['sumformatted' => 'Erro!'];
                        }


                        array_push($object->sheets, $sheet);
                        $sheet = array();
                        $hasEntry = false;
                        $hasTrouble = false;
                    }

                    $endOfDay = true;
                    $lasttime = $timesheet->datetime;
                }

                /** Informa que a entrada já foi lançada */
                if ($flow == 1) $hasEntry == false;

            } // END OF TIMESHEETS

            /** Se o último fluxo foi uma entrada e chegou o final do dia, 
             * acrescenta uma saída fictícia */
            if ($lastflow == 0 && $endOfDay) {

                array_push($sheet, [
                    'flow' => 1,
                    'data' => null,
                    'adjusted' => null,
                    'hasTrouble' => $hasTrouble
                ]);
                array_push($object->sheets, $sheet);
                $sheet = array();
                $hasEntry = false;
                $hasTrouble = false;
                $lastflow = 1;
            }

            //$object->sheets = $sheets;

            /** Inclui dia no array final */
            array_push($timesheet2, $object);
        }

        $balance = array();
        $i = 0;
        $worktime = new DateTime('00:00');
        $wt_start = clone $worktime;
        $qtdDays = 0;

        foreach ($timesheet2 as $timesheet) {


            $date = DateTime::createFromFormat('d/m/Y', $timesheet->day)->format('Y-m-d');
            $wday = getdate(strtotime($date))['wday'];

            $balance[$i]['week'] = $i;
            $balance[$i]['qtddays'] = $qtdDays;
            $qtdDays++;

            if (isset($timesheet->sheets)) {

                foreach ($timesheet->sheets as $sum) {

                    if (isset($sum[2])) {

                        try {
                            $worktime->add($sum[2]['sum']);
                            $balance[$i]['worktimeformatted'] = $wt_start->diff($worktime)->format("%H horas %I minutos %S segundos");
                            $balance[$i]['worktime'] = $wt_start->diff($worktime);
                        } catch (Exception $err) {
                        }
                    }
                }
            }

            if ($wday == 6) {
                $i++;
                $worktime = new DateTime('00:00');
                $qtdDays = 0;
            }
        }

        /** Totalizador dos tempos de trabalho */
        $worktime = new DateTime('00:00');
        foreach ($balance as $week) {
            // return $week;
            try {
                $worktime->add($week['worktime']);
            } catch (Exception $err) {
            }
        }
        $i++;

        $total = $wt_start->diff($worktime);

        $balance[$i]['week'] = 'TOTAL';
        $balance[$i]['qtddays'] = count($timesheet2);
        $balance[$i]['worktimeformatted'] = (($total->d * 24) + $total->h) . $total->format(' horas %I minutos %s segundos');
        $balance[$i]['worktime'] = $total;

        // return $balance;

        session(['page' => 'periodreport']);

        //return $timesheet2;

        return view('periodsheet.report.period.show', [
            'timesheet' => $timesheets,
            'days' => $days,
            'tt' => $timesheet2,
            'x' => [$year, $month, $idUser],
            'balance' => $balance
        ]);
    }

    public function destroy($id)
    {
        $periodsheet = Periodsheet::findOrFail($id);

        $idUser = $periodsheet->idUser;
        $date = $periodsheet->datetime;
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        $periodsheet->delete();

        return redirect('/periodsheet/report/' . $year . '/' . $month . '/' . $idUser);
    }

    public function showoneadjust($id)
    {
        $periodsheet = Periodsheet::findOrFail($id);
        $users = User::All()
            ->where('id', $periodsheet->idUser);

        return view('periodsheet.adjust.show', ['periodsheet' => $periodsheet, 'users' => $users]);
    }

    public function shownewadjust()
    {

        $users = User::All()
            ->sortBy('name');


        $object = new stdClass();
        $object->datetime = date('Y-m-d H:i', time());
        $object->time = date('Y-m-d H:i:s', time());;
        $object->flow = null;
        $object->id = "Novo";
        $object->description = null;

        // return json_encode($object);

        session(['page' => 'manageperiod']);
        return view('periodsheet.adjust.show', ['periodsheet' => $object, 'users' => $users]);
    }

    public function storeadjust(Request $request)
    {
        $periodsheet = Periodsheet::findOrFail($request->id);

        $idUser = $request->idUser;
        $year = date('Y', strtotime($request->datetime));
        $month = date('m', strtotime($request->datetime));

        $periodsheet->idUser = $idUser;
        $periodsheet->datetime = $request->datetime . " " . $request->time;
        $periodsheet->flow = $request->flow;
        $periodsheet->adjusted = true;
        $periodsheet->description = $request->observation;
        $periodsheet->ip = request()->ip();

        $periodsheet->save();

        return redirect('/periodsheet/report/' . $year . '/' . $month . '/' . $idUser);
    }

    public function showadjust($idUser, $year, $month, $day)
    {

        $users = User::All()
            ->where('id', $idUser);

        $object = new stdClass();
        $object->datetime = date('Y-m-d', strtotime($year . '/' . $month . '/' . $day));
        $object->time = null;
        $object->flow = null;
        $object->id = "Novo";
        $object->description = null;


        session(['page' => 'manageperiod']);

        return view('periodsheet.adjust.show', ['periodsheet' => $object, 'users' => $users]);
    }

    public function createadjust(Request $request)
    {
        $periodsheet = new Periodsheet();

        $idUser = $request->idUser;
        $year = date('Y', strtotime($request->datetime));
        $month = date('m', strtotime($request->datetime));

        $periodsheet->idUser = $idUser;
        $periodsheet->datetime = $request->datetime . " " . $request->time;
        $periodsheet->flow = $request->flow;
        $periodsheet->adjusted = true;
        $periodsheet->description = $request->observation;
        $periodsheet->ip = request()->ip();

        $periodsheet->save();

        return redirect('/periodsheet/report/' . $year . '/' . $month . '/' . $idUser);
    }
}
