<?php

namespace App\Http\Controllers;

use App\Models\Bank_account;
use App\Models\Financeplan;
use App\Models\Payment;
use App\Models\PaymentsMove;
use App\Models\People;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        # code...
        $payments = Payment::orderBy('duedate');

        $payments = $payments->get();
        $payments->load(['supplier', 'paymentmoves', 'paymentmoves.transaction']);

        //return $payments;

        foreach ($payments as $payment) {

            /** Link para compras */
            if ($payment->idPurchase != null) {
                $payment->origin = 'CPR';
                $payment->originurl = '/finance/purchases/' . $payment->idPurchase;
            }

            /** Calcula saldo */
            $payment->balance = 0.00;
            foreach ($payment->paymentmoves as $move) {

                if ($move->transaction->type == "NA") {
                    $payment->balance += $move->value;
                } else {
                    $payment->balance -= $move->value;
                }
            }

            if ($payment->balance == $payment->value) {
                $payment->status = "Aberto";
            } elseif ($payment->balance == 0.00) {
                $payment->status = "Baixado";
            } else {
                $payment->status = "Baixado parcial";
            }
        }

        $suppliers = People::where('supplier', true)
            ->orderBy('name')
            ->get();

        $bankaccounts = Bank_account::orderBy('description')->get();


        return view('finance.payments.show', ['payments' => $payments, 'suppliers' => $suppliers, 'bankaccounts' => $bankaccounts]);
    }

    public function create()
    {
        # code...
        $payment = new Payment();

        $suppliers = People::where('supplier', true)
            ->orderBy('name')
            ->get();

        $financeplans = Financeplan::orderBy('classification')
            ->orderBy('name')
            ->get();

        $transactions = Transaction::orderBy('description')
            ->where('module', 'PAG')
            ->where('type', '<>', 'PG')
            ->get();

        return view('finance.payments.create', [
            'payment' => $payment,
            'suppliers' => $suppliers,
            'financeplans' => $financeplans,
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        # code...
        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/payments', $file, $name);
        }

        DB::beginTransaction();

        $payments = new Payment();
        $payments->idSupplier = $request->supplier;
        $payments->date = $request->date;
        $payments->docnumber = $request->docnumber;
        $payments->duedate = $request->duedate;
        $payments->value = str_replace(',', '.', $request->value);
        $payments->description = $request->description;
        $payments->idTransaction = $request->transaction;
        $payments->idFinancePlan = $request->financeplan;
        $payments->filename = $name;
        $payments->idUser = auth()->user()->id;
        $payments->idUserUpd = auth()->user()->id;
        $payments->save();

        $paymentsMove = new PaymentsMove();
        $paymentsMove->idPayment = $payments->id;
        $paymentsMove->idTransaction = $payments->idTransaction;
        $paymentsMove->datemove = $payments->date;
        $paymentsMove->value = $payments->value;
        $paymentsMove->idUser = $payments->idUser;
        $paymentsMove->save();

        DB::commit();

        return redirect('/finance/payments');
    }

    public function show($id)
    {
        # code...

        $payment = Payment::findOrFail($id);
        $payment->value = number_format($payment->value, 2, ',', '.');
        
        $suppliers = People::where('supplier', true)
        ->orderBy('name')
            ->get();
            
            $financeplans = Financeplan::orderBy('classification')
            ->orderBy('name')
            ->get();
            
            $transactions = Transaction::orderBy('description')
            ->where('module', 'PAG')
            ->where('type', '<>', 'PG')
            ->get();
            
            return view('finance.payments.create', [
                'payment' => $payment,
                'suppliers' => $suppliers,
                'financeplans' => $financeplans,
                'transactions' => $transactions
            ]);
            
            
        
        
    }

    public function update(Request $request)
    {
        # code...

        $payments = Payment::findOrFail($request->id);
        
        DB::beginTransaction();
        $payments->idSupplier = $request->supplier;
        $payments->date = $request->date;
        $payments->docnumber = $request->docnumber;
        $payments->duedate = $request->duedate;
        $payments->value = str_replace(',', '.', $request->value);
        $payments->description = $request->description;
        $payments->idFinancePlan = $request->financeplan;


        
        if ($request->hasFile('formFile')) {
            $name = null;
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/payments', $file, $name);
            $payments->filename = $name;
        }

        $payments->idUserUpd = auth()->user()->id;
        $payments->save();

        $paymentsMove = PaymentsMove::where('idPayment', $payments->id)->first();
        $paymentsMove = PaymentsMove::findOrFail($paymentsMove->id);
        $paymentsMove->datemove = $payments->date;
        $paymentsMove->value = $payments->value;
        $paymentsMove->save();

        DB::commit();

        return redirect('/finance/payments');
        
    }

    public function destroy($id)
    {
        # code...
        $payments = Payment::findOrFail($id);

        DB::beginTransaction();

        $paymentsMove = PaymentsMove::where('idPayment', $payments->id)->get();

        if(count($paymentsMove) == 1){

            $paymentsMove = PaymentsMove::where('idPayment', $payments->id)->first();
            $paymentsMove = PaymentsMove::findOrFail($paymentsMove->id);
            $paymentsMove->delete();

            $payments->delete();

        }


        DB::commit();

        return redirect('/finance/payments');

    }
}
    