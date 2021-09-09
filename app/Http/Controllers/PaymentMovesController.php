<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentsMove;
use App\Models\TreasuryMove;
use Illuminate\Support\Facades\DB;

class PaymentMovesController extends Controller
{
    public function store(Request $request)
    {
        $i = 0;
        DB::beginTransaction();
        foreach ($request->originalvalue as $value) {
            
            $move = new PaymentsMove();
            $move->idPayment = $request->idpayment[$i];
            $move->idTransaction = 'PAG02';
            $move->datemove = $request->date;
            $move->value = str_replace(',','.',str_replace('.', '', $request->originalvalue[$i]));
            $move->interest = $request->interestvalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->interestvalue[$i]));
            $move->fine = $request->finevalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->finevalue[$i]));
            $move->discount = $request->discountvalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->discountvalue[$i]));
            $move->idUser = auth()->user()->id;
            $move->save();
            
            $move->load('payment');
            
            $treasuryMove = new TreasuryMove();
            $treasuryMove->idBank = $request->bankaccount;
            $treasuryMove->datemove = $move->datemove;
            $treasuryMove->idFinancePlan = $move->payment->idFinancePlan;
            $treasuryMove->idTransaction = 'TES02';
            $treasuryMove->description = 'Baixa ' . $move->payment->description;
            $treasuryMove->value = $move->value + $move->interest + $move->fine - $move->discount;
            $treasuryMove->idPaymentMove = $move->id;
            $treasuryMove->idPeople = $move->payment->idSupplier;
            $treasuryMove->idUser = auth()->user()->id;
            $treasuryMove->save();


            $i++;
        }
        DB::commit();


        return redirect('/finance/payments');
    }
}
