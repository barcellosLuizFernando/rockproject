<?php

namespace App\Http\Controllers;

use App\Models\ReceivablesMove;
use App\Models\TreasuryMove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivableMovesController extends Controller
{
    //
    public function store(Request $request)
    {
        # code...
        $i = 0;
        DB::beginTransaction();

        foreach ($request->originalvalue as $value) {
            
            $move = new ReceivablesMove();
            $move->idReceivable = $request->idpayment[$i];
            $move->idTransaction = 'REC02';
            $move->datemove = $request->date;
            $move->value = str_replace(',','.',str_replace('.', '', $request->originalvalue[$i]));
            $move->interest = $request->interestvalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->interestvalue[$i]));
            $move->fine = $request->finevalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->finevalue[$i]));
            $move->discount = $request->discountvalue[$i] == null ? 0.00 : str_replace(',','.',str_replace('.', '', $request->discountvalue[$i]));
            $move->idUser = auth()->user()->id;
            $move->save();
            
            $move->load('receivable');
            
            $treasuryMove = new TreasuryMove();
            $treasuryMove->idBank = $request->bankaccount;
            $treasuryMove->datemove = $move->datemove;
            $treasuryMove->idFinancePlan = $move->receivable->idFinancePlan;
            $treasuryMove->idTransaction = 'TES01';
            $treasuryMove->description = 'Recebimento ' . $move->receivable->description;
            $treasuryMove->value = $move->value + $move->interest + $move->fine - $move->discount;
            $treasuryMove->idReceivableMove = $move->id;
            $treasuryMove->idPeople = $move->receivable->idClient;
            $treasuryMove->idUser = auth()->user()->id;
            $treasuryMove->save();


            $i++;
        }
        DB::commit();


        return redirect('/finance/receivables');
    }
}
