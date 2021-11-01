<?php

namespace App\Http\Controllers;

use App\Models\Bank_account;
use App\Models\Financeplan;
use App\Models\People;
use App\Models\Receivable;
use App\Models\ReceivablesMove;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReceivableController extends Controller
{
    //
    public function index()
    {
        # code...
        $receivables = Receivable::orderBy('duedate', 'desc')
            ->with(['moves', 'moves.transaction'])
            ->get();

        $bankaccounts = Bank_account::orderBy('description')->get();

        $clients = People::where('client', true)
            ->orderBy('name')
            ->get();

        foreach ($receivables as $key => $item) {
            # code...

            // Calcula saldo
            $balance = 0.00;

            foreach ($item->moves as $key => $move) {
                # code...


                if ($move->transaction->type == "NA") {
                    $item->balance += $move->value;
                } else {
                    $item->balance -= $move->value;
                }
            }

            if ($item->balance == $item->value) {
                $item->status = "Aberto";
            } elseif ($item->balance == 0.00) {
                $item->status = "Baixado";
            } else {
                $item->status = "Baixado parcial";
            }

            if ($item->idSale != null) {
                $item->origin = "VEN";
            } else {
                $item->origin = "REC";
            }
        }

        return view('finance.receivables.show', [
            'receivables' => $receivables, 
            'clients' => $clients,
            'bankaccounts' => $bankaccounts]);
    }

    public function create()
    {
        # code...
        $receivable = new Receivable();

        $clients = People::where('client', true)
            ->orderBy('name')
            ->get();

        $financeplans = Financeplan::orderBy('classification')->get();

        $transactions = Transaction::where('module', 'REC')
            ->whereIn('type', ['NA', 'AD'])
            ->get();

        return view('finance.receivables.create', [
            'receivable' => $receivable,
            'clients' => $clients,
            'financeplans' => $financeplans,
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        # code...
        DB::beginTransaction();

        $receivable = new Receivable();

        if ($request->hasFile('formFile')) {
            $name = null;
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/receivables', $file, $name);
            $receivable->filename = $name;
        }

        $receivable->idClient = $request->client;
        $receivable->idFinancePlan = $request->financeplan;
        $receivable->idTransaction = $request->transaction;
        $receivable->date = $request->date;
        $receivable->duedate = $request->duedate;
        $receivable->value = str_replace(',', '.', $request->value);
        $receivable->description = $request->description;
        $receivable->docnumber = $request->docnumber;
        $receivable->idUser = auth()->user()->id;
        $receivable->save();

        $move = new ReceivablesMove();
        $move->idReceivable = $receivable->id;
        $move->idTransaction = $receivable->idTransaction;
        $move->datemove = $receivable->date;
        $move->value = $receivable->value;
        $move->idUser = auth()->user()->id;
        $move->save();

        DB::commit();

        return redirect('/finance/receivables');
    }

    public function show($id)
    {
        # code...
        $receivable = Receivable::findOrFail($id);
        $receivable->value = number_format($receivable->value, 2, ',', '.');

        $clients = People::where('client', true)
            ->orderBy('name')
            ->get();

        $financeplans = Financeplan::orderBy('classification')->get();

        $transactions = Transaction::where('module', 'REC')
            ->whereIn('type', ['NA', 'AD'])
            ->get();

        return view('finance.receivables.create', [
            'receivable' => $receivable,
            'clients' => $clients,
            'financeplans' => $financeplans,
            'transactions' => $transactions
        ]);
    }

    public function update(Request $request)
    {
        # code...
        # code...
        DB::beginTransaction();

        $receivable = Receivable::findOrFail($request->id);

        if ($request->hasFile('formFile')) {
            $name = null;
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/receivables', $file, $name);
            $receivable->filename = $name;
        }

        $receivable->idClient = $request->client;
        $receivable->idFinancePlan = $request->financeplan;
        $receivable->idTransaction = $request->transaction;
        $receivable->date = $request->date;
        $receivable->duedate = $request->duedate;
        $receivable->value = str_replace(',', '.', $request->value);
        $receivable->description = $request->description;
        $receivable->docnumber = $request->docnumber;
        $receivable->idUserUpd = auth()->user()->id;
        $receivable->save();


        $move = ReceivablesMove::where('idReceivable', $receivable->id)->first();
        $move = ReceivablesMove::findOrFail($move->id);
        $move->idReceivable = $receivable->id;
        $move->datemove = $receivable->date;
        $move->value = $receivable->value;
        $move->idUser = auth()->user()->id;
        $move->save();

        DB::commit();

        return redirect('/finance/receivables');
    }

    public function destroy($id)
    {
        # code...

        DB::beginTransaction();

        $receivable = Receivable::findOrFail($id);

        $moves = ReceivablesMove::where('idReceivable', $receivable->id)->get();

        if (count($moves) == 1) {

            $moves = ReceivablesMove::where('idReceivable', $receivable->id)->first();
            $moves = ReceivablesMove::findOrFail($moves->id);
            $moves->delete();

            $moves->delete();
        }


        $receivable->delete();

        DB::commit();

        return redirect('/finance/receivables');
    }
}
