<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use stdClass;

class BankAccountsController extends Controller
{
    public function index()
    {
        # code...
        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }

        $bankaccounts = Bank_account::all();
        $bankaccounts->load('bank');

        //return $bankaccounts;

        return view('finance.bankaccounts.show', ['bankaccounts' => $bankaccounts]);
    }

    public function create()
    {
        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }
        
        $bankaccount = new Bank_account();
        $bankaccount->startdate = date('Y-m-d', time());
        $bankaccount->startvalue = 0.00;

        $banks = Bank::orderBy('name')->get();

        return view('finance.bankaccounts.create', ['bankaccount' => $bankaccount, 'banks' => $banks]);
    }

    public function store(Request $request)
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }

        # code...
        $bankaccount = new Bank_account();
        $bankaccount->description = $request->description;
        $bankaccount->idBank = $request->bank;
        $bankaccount->agencynumber = $request->agencynumber;
        $bankaccount->accountnumber = $request->accountnumber;
        $bankaccount->startdate = $request->startdate;
        $bankaccount->startvalue = str_replace(',', '.', $request->startvalue);
        $bankaccount->pixkey = $request->pixkey;
        $bankaccount->save();

        return redirect('/finance/bankaccounts');
    }

    public function show($id)
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }

        # code...
        $bankaccount = Bank_account::findOrFail($id);
        $banks = Bank::orderBy('name')->get();

        return view('finance.bankaccounts.create', ['bankaccount' => $bankaccount, 'banks' => $banks]);
    }

    public function update(Request $request)
    {
        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }

        $bankaccount = Bank_account::findOrFail($request->id);
        $bankaccount->description = $request->description;
        $bankaccount->idBank = $request->bank;
        $bankaccount->agencynumber = $request->agencynumber;
        $bankaccount->accountnumber = $request->accountnumber;
        $bankaccount->startdate = $request->startdate;
        $bankaccount->startvalue = str_replace(',', '.', $request->startvalue);
        $bankaccount->pixkey = $request->pixkey;
        $bankaccount->save();

        return redirect('/finance/bankaccounts');
    }

    public function destroy($id)
    {

        /** Somente usuário ADM pode acessar esta função */
        if (!Gate::allows('isAdmin')) {
            abort(404, 'Opa, você não tem permissão para executar esta ação.');
        }
        
        # code...
        $bankaccount = Bank_account::findOrFail($id)->delete();
        return redirect('/finance/bankaccounts');
    }
}
