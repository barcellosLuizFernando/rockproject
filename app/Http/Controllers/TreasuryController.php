<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Bank_account;
use App\Models\Financeplan;
use App\Models\People;
use App\Models\Transaction;
use App\Models\Treasury;
use App\Models\TreasuryMove;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

use function GuzzleHttp\json_decode;

class TreasuryController extends Controller
{
    //

    public function index()
    {
        # code...


        $bankaccounts = Bank_account::all();
        $bankaccounts->load('bank');

        foreach ($bankaccounts as $key => $item) {
            # code...
            if (!isset($item->bank)) {
                $item->bankname = $item->description;
            } else {
                $item->bankname = $item->bank->name;
            }

            $filelogo = "https://ui-avatars.com/api/?name=" . str_replace(' ', '+', $item->bankname) . "&color=7F9CF5&background=EBF4FF";
            if (isset($item->bank)) {
                if ($item->bank->filename != null)
                    $filelogo = '/storage/banks/' . $item->bank->filename;
            }

            $item->filelogo = $filelogo;


            $item->data = $this->getBankAccountData($item->id, null, null);
        }

        //return $bankaccounts;

        return view('finance.treasury.show', ['bankaccounts' => $bankaccounts]);
    }

    public function show(Request $request)
    {
        # code...



        $startdate = $request->startdate;
        $enddate = $request->enddate;


        $moves = $this->getBankAccountData($request->id, $startdate, $enddate);
        $bankaccounts = Bank_account::findOrFail($request->id);
        $bankaccounts->load('bank');
        //return $bankaccounts;
        $bank = $bankaccounts->bank;

        if ($bank == null) {
            $bank = new stdClass();
            $bank->name = $bankaccounts->description;
        }


        return view('finance.treasury.moves.show', [
            'moves' => $moves,
            'bank' => $bank
        ]);
    }

    public function create($id)
    {
        # code...

        $treasuryMove = new Treasury();
        $transactions = Transaction::where('module', 'TES')->get();
        $bankaccounts = Bank_account::findOrFail($id);
        $bankaccounts->load('bank');
        $people = People::orderBy('name')->get();

        $financeplans = Financeplan::orderBy('classification')->get();

        $otherAccounts = Bank_account::where('id', '<>', $bankaccounts->id)->get();

        if ($bankaccounts->bank == null) {

            $bankaccounts->bank = new stdClass();
            $bankaccounts->bank->name = $bankaccounts->description;
        }

        return view('finance.treasury.moves.create', [
            'bankaccount' => $bankaccounts,
            'bankaccounts' => $otherAccounts,
            'treasurymove' => $treasuryMove,
            'transactions' => $transactions,
            'financeplans' => $financeplans,
            'people' => $people
        ]);
    }

    public function store(Request $request)
    {
        # code...
        DB::beginTransaction();

        $treasuryMove = new TreasuryMove();
        $treasuryMove->idBank = $request->id;
        $treasuryMove->idFinancePlan = $request->financeplan;
        $treasuryMove->idTransaction = $request->transaction;
        $treasuryMove->datemove = $request->datemove;
        $treasuryMove->value = str_replace(',', '.', $request->value);
        $treasuryMove->description = $request->description;
        $treasuryMove->idPeople = $request->people;
        $treasuryMove->idUser = auth()->user()->id;
        $treasuryMove->save();

        $transaction = Transaction::where('id', $treasuryMove->idTransaction)
            ->whereIn('type', ['TC', 'TD'])
            ->first();


        if ($transaction) {
            $type = 'TC';
            if ($transaction->type == 'TC') {
                $type = 'TD';
            }

            $transaction = Transaction::where('type', $type)->first();

            $ntreasuryMove = new TreasuryMove();
            $ntreasuryMove->idBank = $request->destinyAccount;
            $ntreasuryMove->idFinancePlan = $request->financeplan;
            $ntreasuryMove->idTransaction = $transaction->id;
            $ntreasuryMove->datemove = $request->datemove;
            $ntreasuryMove->value = str_replace(',', '.', $request->value);
            $ntreasuryMove->description = $request->description;
            $ntreasuryMove->idPeople = $request->people;
            $ntreasuryMove->idTreasuryMove = $treasuryMove->id;
            $ntreasuryMove->idUser = auth()->user()->id;
            $ntreasuryMove->save();

            $treasuryMove->idTreasuryMove = $ntreasuryMove->id;
            $treasuryMove->save();  
        }

        DB::commit();

        return redirect('/finance/treasury/' . $request->id);
    }

    public function destroy($id)
    {
        # code...
        $treasuryMove = TreasuryMove::findOrFail($id);
        $idAccount = $treasuryMove->idBank;


        try {
            $ntreasuryMove = TreasuryMove::findOrFail($treasuryMove->idTreasuryMove);
            $ntreasuryMove->delete();
        } catch (Exception $err){

        }
        $treasuryMove->delete();

        return redirect('/finance/treasury/' . $idAccount);

    }

    public function getBankAccountData($id, $datestart = null, $dateend = null)
    {
        # code...

        $treasuryMoves = TreasuryMove::where('idBank', $id)
            ->with('transaction')
            ->orderBy('datemove')
            ->get();

        $bankaccounts = Bank_account::findOrFail($id);

        $balance = $bankaccounts->startvalue;
        $startvalue = $bankaccounts->startvalue;

        $lastdate = null;
        $debit = 0.00;
        $credit = 0.00;
        $i = -1;
        $move_i = 0;
        $bkstatement = [];
        $moves = [];


        foreach ($treasuryMoves as $key => $move) {
            # code...

            if ($lastdate <> $move->datemove) {
                $i++;
                $move_i = 0;
                $moves = [];
                $debit = 0.00;
                $credit = 0.00;
            }


            if ($move->transaction->type == 'CR' || $move->transaction->type == 'TC') {
                $credit += $move->value;
                $balance += $move->value;
                $moves['credits'][$move_i] = $move;
            } else {
                $debit += $move->value;
                $balance -= $move->value;
                $moves['debits'][$move_i] = $move;
            }

            if ($datestart > $move->datemove) {

                $startvalue = $balance;
            } else if ($dateend >= $move->datemove || $dateend == null) {

                $bkstatement[$i] = [
                    'date' => $move->datemove,
                    'credit' => $credit,
                    'debit' => $debit,
                    'balance' => $balance,
                    'moves' => $moves
                ];
            }

            $lastdate = $move->datemove;
            $move_i++;
        }


        $lastdate = $lastdate ?: $bankaccounts->startdate;

        $moves = [
            'idBankAccount' => $id,
            'startvalue' => $startvalue,
            'detail' => $bkstatement,
            'balance' => $balance,
            'lastmove' => $lastdate
        ];

        return $moves;
    }
}
