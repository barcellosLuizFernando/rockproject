<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function index()
    {
        # code...
        $transactions = Transaction::orderBy('module')
            ->orderBy('description')
            ->get();

        return view('transactions.show', ['transactions' => $transactions]);
    }

    public function create()
    {
        # code...

        $transaction = new Transaction();

        return view('transactions.create', ['transaction' => $transaction]);
    }

    public function show($id)
    {
        # code...

        $transaction =  Transaction::findOrFail($id);

        return view('transactions.create', ['transaction' => $transaction]);
    }

    public function update(Request $request)
    {
        # code...

        $transaction = Transaction::findOrFail($request->id);

        $transaction->load('purchases');
        $transaction->load('payments');
        $transaction->load('sales');
        $transaction->load('receivables');

        // Define if will change the ID
        // This will not change the ID if the transaction has already been used.
        $count = 0;
        $count = $transaction->purchases->count();
        $count += $transaction->payments->count();
        $count += $transaction->sales->count();
        $count += $transaction->receivables->count();

        if ($count == 0 && $transaction->module != $request->tnsModule) {

            $transactions = Transaction::where('module', $request->tnsModule)->get();

            $count = $transactions->count();
            $count++;
            $id = $request->tnsModule . sprintf("%02d", $count);

            $transaction->id = $id;
            $transaction->module = $request->tnsModule;
        }

        
        if ($count == 0) $transaction->type = $request->tnsType;

        $transaction->description = $request->tnsDescription;
        $transaction->save();

        return redirect('/registers/transactions');
    }

    public function store(Request $request)
    {
        # code...
        $transaction = new Transaction();

        $transactions = Transaction::where('module', $request->tnsModule)->get();

        $count = $transactions->count();
        $count++;

        $id = $request->tnsModule . sprintf("%02d", $count);

        $transaction->id = $id;
        $transaction->description = $request->tnsDescription;
        $transaction->type = $request->tnsType;
        $transaction->module = $request->tnsModule;
        $transaction->save();

        return redirect('/registers/transactions');
    }

    public function destroy($id)
    {
        # code...
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect('/registers/transactions');
    }
}
