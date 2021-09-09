<?php

namespace App\Http\Controllers;

use App\Jobs\Banking\CreateTransaction;
use App\Models\Financeplan;
use App\Models\Payment;
use App\Models\PaymentsMove;
use App\Models\People;
use App\Models\Purchase;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        # code...

        $suppliers = People::orderBy('name')
            ->where('supplier', true)
            ->get();

        $purchases = Purchase::orderByDesc('date');

        if ($request->startdate != null) {
            $purchases->whereDate('date', '>=', $request->startdate);
        }
        if ($request->enddate != null) {
            $purchases->whereDate('date', '<=', $request->enddate);
        }
        if ($request->supplier != null) {
            $purchases->where('idSupplier', $request->supplier);
        }

        $purchases = $purchases->get();
        $purchases->load(['supplier', 'payments', 'payments.paymentmoves', 'payments.paymentmoves.transaction']);


        foreach ($purchases as $purchase) {
            if ($purchase->filename != null) {
                $purchase->filename = Storage::url('purchases/' . $purchase->filename);
            }

            //return $purchase->payments;

            /** Identifica quanto falta pagar */
            $purchase->balance = 0.00;
            foreach ($purchase->payments as $payment) {
                foreach ($payment->paymentmoves as $move) {


                    if ($move->transaction->type == "NA") {
                        $purchase->balance += $move->value;
                    } else {
                        $purchase->balance -= $move->value;
                    }
                }
            }

            if ($purchase->balance == $purchase->value) {
                $purchase->status = "Aberto";
            } elseif ($purchase->balance <= 0.00) {
                $purchase->status = "Baixado";
            } else {
                $purchase->status = "Baixado parcial";
            }
        }

        //return $purchases;




        return view('finance.purchase.show', ['purchases' => $purchases, 'suppliers' => $suppliers]);
    }

    public function show($id)
    {
        $purchases = Purchase::findOrFail($id);
        $purchases->value = number_format($purchases->value, 2, ',', '.');

        $purchases->load(['payments', 'payments.supplier']);



        $suppliers = People::orderBy('name')
            ->where('supplier', true)
            ->get();
        $financeplans = Financeplan::orderBy('classification')->get();

        $transactions = Transaction::orderBy('description')
            ->where('module', 'CPR')
            ->get();

        return view('finance.purchase.create', [
            'purchase' => $purchases,
            'suppliers' => $suppliers,
            'financeplans' => $financeplans,
            'transactions' => $transactions
        ]);
    }

    public function create()
    {
        # code...

        $purchases = new Purchase();
        $suppliers = People::orderBy('name')
            ->where('supplier', true)
            ->get();
        $financeplans = Financeplan::orderBy('classification')->get();

        $transactions = Transaction::orderBy('description')
            ->where('module', 'CPR')
            ->get();

        return view('finance.purchase.create', [
            'purchase' => $purchases,
            'suppliers' => $suppliers,
            'financeplans' => $financeplans,
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {

        $name = null;

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/purchases', $file, $name);
        }

        DB::beginTransaction();

        /** It saves the general data from purchases */
        $purchases = new Purchase();
        $purchases->date = $request->date;
        $purchases->idSupplier = $request->supplier;
        $purchases->value = str_replace(',', '.', $request->value);
        $purchases->description = $request->description;
        $purchases->idFinancePlan = $request->financeplan;
        $purchases->idTransaction = $request->transaction;
        $purchases->filename = $name;
        $purchases->idUser = auth()->user()->id;
        $purchases->idUserUpd = auth()->user()->id;
        $purchases->order = $request->order;
        $purchases->invoicenumber = $request->invoicenumber;
        $purchases->save();

        /**It saves the finance payments from purchases */
        $i = 0;

        foreach ($request->duedate as $duedate) {
            $payments = new Payment();
            $payments->date = $purchases->date;
            $payments->description = $purchases->description;
            $payments->idFinancePlan = $purchases->idFinancePlan;
            $payments->idUser = auth()->user()->id;
            $payments->idUserUpd = auth()->user()->id;
            $payments->docnumber = $purchases->invoicenumber;
            $payments->idTransaction = 'PAG01';
            $payments->idPurchase = $purchases->id;

            $payments->duedate = $duedate;
            $payments->value = str_replace(',', '.', str_replace('.', '', $request->duevalue[$i]));
            $payments->idSupplier = $request->liableperson[$i];
            $payments->save();

            $paymentsMove = new PaymentsMove();
            $paymentsMove->idPayment = $payments->id;
            $paymentsMove->idTransaction = 'PAG01';
            $paymentsMove->datemove = $payments->date;
            $paymentsMove->value = $payments->value;
            $paymentsMove->idUser = $payments->idUser;
            $paymentsMove->save();

            $i++;
        }


        DB::commit();

        return redirect('/finance/purchases');
    }

    public function update(Request $request)
    {

        $name = null;
        $purchases = Purchase::findOrFail($request->id);

        if ($request->hasFile('formFile')) {
            $file = $request->formFile;
            $extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
            $name = md5(time()) . '.' . $extension;
            Storage::putFileAs('public/purchases', $file, $name);
            $purchases->filename = $name;
        }

        DB::beginTransaction();

        /** It saves the general data from purchases */
        $purchases->date = $request->date;
        $purchases->idSupplier = $request->supplier;
        $purchases->value = str_replace(',', '.', $request->value);
        $purchases->description = $request->description;
        $purchases->idFinancePlan = $request->financeplan;
        $purchases->idTransaction = $request->transaction;
        $purchases->idUser = auth()->user()->id;
        $purchases->idUserUpd = auth()->user()->id;
        $purchases->order = $request->order;
        $purchases->invoicenumber = $request->invoicenumber;
        $purchases->save();




        DB::commit();

        return redirect('/finance/purchases');
    }

    public function destroy($id)
    {
        # code...
        DB::beginTransaction();

        $purchases = Purchase::findOrFail($id);

        $payments = Payment::where('idPurchase', $purchases->id);
        $payments->delete();
        $purchases->delete();

        DB::commit();

        return redirect('/finance/purchases');
    }
}
