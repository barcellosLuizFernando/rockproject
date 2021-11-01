<?php

namespace App\Http\Controllers;

use App\Models\Bank_account;
use App\Models\BankStatement;
use Illuminate\Http\Request;

class BankStatementController extends Controller
{
    //

    public function index()
    {
        # code...

        return view('finance.treasury.bankstatement.show');
    }

    public function store(Request $request)
    {
        # code...

        $fileHandler = new ReadOfxController();

        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {

                $statement = $fileHandler->OfxToObject($file);
                $bankaccount = Bank_account::where('accountnumber', 'like', $statement->accountnumber . '%')
                    ->first();
                //return $statement;

                foreach ($statement->transactions as $key => $move) {
                    # code...

                    $bankstatement = BankStatement::where('fitId', $move['FITID'])
                        ->where('checknum', $move['CHECKNUM'])
                        ->first();

                    if($bankstatement) continue;

                    $bankstatement = new BankStatement();
                    $bankstatement->idBankAccount = $bankaccount->id;
                    $bankstatement->type = $move['TRNTYPE'];
                    $bankstatement->date = $move['DTPOSTED'];
                    $bankstatement->value = str_replace(',', '.', $move['TRNAMT']);
                    $bankstatement->fitId = $move['FITID'];
                    $bankstatement->checknum = $move['CHECKNUM'];
                    $bankstatement->memo = $move['MEMO'];
                    $bankstatement->idUser = auth()->user()->id;
                    $bankstatement->save();

                }    
                
            }
        }

        return redirect('/finance/treasury');

    }
}
