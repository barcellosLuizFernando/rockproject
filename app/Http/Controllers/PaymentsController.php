<?php

namespace App\Http\Controllers;

use App\Models\Bank_account;
use App\Models\Payment;
use App\Models\People;
use Illuminate\Http\Request;

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
}
