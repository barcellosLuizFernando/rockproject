<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Financeplan;
use App\Models\People;
use App\Models\Product;
use App\Models\Receivable;
use App\Models\ReceivablesMove;
use App\Models\Sale;
use App\Models\SalesItem;
use Exception;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    //
    public function index()
    {
        # code...
        $sales = Sale::orderBy('date', 'desc')->get();
        $sales->load('client');

        foreach ($sales as $sale) {
            if ($sale->file != null) {
                $sale->file = Storage::url('sales/' . $sale->file);
            }
        }

        //return $sales;

        return view('finance.sales.show', ['sales' => $sales]);
    }

    public function create(Request $request)
    {
        # code...
        //return $request->hasFile('file') ? 'true' : 'false';
        $fileHandler = new ReadXmlController;
        $sales = [];

        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $file) {


                // PULA ARQUIVOS QUEM NÃO SEJAM XML
                if ($file->getMimeType() != 'text/xml') continue;

                // ADICIONA XML A UM ARRAY
                $convertedFile = $fileHandler->index(file_get_contents($file));
                array_push($sales, $convertedFile);


                // Adiciona pessoa ao cadastro de pessoas
                $person = People::where('taxnumber', $convertedFile->identificacaoTomador)
                    ->first();

                if (!$person) {

                    $city = City::where('ibge', $convertedFile->codigoMunicipioTomador)->first();

                    $person = new People();
                    $person->name = $convertedFile->razaoSocialTomador;
                    $person->taxnumber = $convertedFile->identificacaoTomador;
                    $person->taxtype = "F";
                    $person->client = true;
                    $person->supplier = false;
                    $person->employee = false;
                    $person->idCity = $city->id;
                    $person->zipcode = $convertedFile->codigoPostalTomador;
                    $person->district = $convertedFile->bairroTomador;
                    try {
                        $person->address = $convertedFile->logradouroTomador . ', ' . $convertedFile->numeroEnderecoTomador;
                    } catch (Exception $err) {
                        $person->address = $convertedFile->logradouroTomador;
                    }
                    $person->email = $convertedFile->emailTomador;
                    $person->save();
                }


                // RECORD SALE
                $sale = Sale::where('docnumber', $convertedFile->numeroSerie)
                    ->first();

                if ($sale) continue; // SE JÁ TIVER UMA VENDA, VAI PARA A PRÓXIMA

                $docDate = date('Y-m-d', strtotime($convertedFile->dataEmissao));
                //$extension = pathinfo($_FILES['formFile']['name'], PATHINFO_EXTENSION);
                $name = md5(time() . $convertedFile->numeroSerie) . '.xml';


                DB::beginTransaction();
                $sale = new Sale();
                $sale->idClient = $person->id;
                $sale->idTransaction = "VEN01";
                $sale->date = $docDate;
                $sale->value = $convertedFile->valorTotalServicos;
                $sale->docnumber = $convertedFile->numeroSerie;
                $sale->idUser = auth()->user()->id;
                $sale->file = $name;

                $sale->save();

                Storage::putFileAs('public/sales', $file, $name);

                //RECORD SALE ITENS
                foreach ($convertedFile->itensServico as $service) {

                    $expression = 'Livro';
                    if (str_contains($service->descricaoServico, 'Matrícula') || str_contains($service->descricaoServico, 'Matricula')) {
                        $expression = 'Matriculas';
                    } elseif (str_contains($service->descricaoServico, 'Mensalidade')) {
                        $expression = 'Mensalidades';
                    }

                    $financePlan = Financeplan::where('name', 'LIKE', '%' . $expression  . '%')
                        ->first();

                    //return $financePlan;

                    $product = Product::where('description', 'like', '%' . $expression . '%')
                        ->first();


                    $saleItem = new SalesItem();
                    $saleItem->idSale = $sale->id;
                    $saleItem->idProduct = $product->id;
                    $saleItem->idFinancePlan = $financePlan->id;
                    $saleItem->value = $service->valorTotal;
                    $saleItem->unitvalue = $service->valorUnitario;
                    $saleItem->quantity = $service->quantidade;
                    $saleItem->description = $service->descricaoServico;
                    $saleItem->save();
                }


                //RECORD RECEIVABLE
                $receivable = new Receivable();
                $receivable->idClient = $sale->idClient;
                $receivable->idFinancePlan = 1;
                $receivable->idTransaction = 'REC01';
                $receivable->date = $docDate;
                $receivable->duedate = $docDate;
                $receivable->value = $sale->value;
                $receivable->description = 'Nota Fiscal ' . $sale->docnumber;
                $receivable->idSale = $sale->id;
                $receivable->idUser = auth()->user()->id;
                $receivable->save();

                //RECORD RECEIVABLE MOVE
                $recMove = new ReceivablesMove();
                $recMove->idReceivable = $receivable->id;
                $recMove->idTransaction = $receivable->idTransaction;
                $recMove->datemove = $receivable->date;
                $recMove->value = $receivable->value;
                $recMove->idUser = auth()->user()->id;
                $recMove->save();

                DB::commit();
            }
        }


        return redirect('/finance/sales');
    }

    public function getSales()
    {
        # code...
        $sales = Sale::all();
        $sales->load('client');
        $sales->load('itens');
        $sales->load('itens.financeplan');

        $database = [];

        foreach ($sales as $sale) {
            # code...
            foreach ($sale->itens as $item) {
                # code...
                $financeplan = $item->financeplan->name;

                //It verify if the finance plan already exists into the array
                if (!array_key_exists($financeplan, $database)) {

                    $database[$financeplan] = [];
                }

                //This sort the registers by theirs last day month
                $lastDateOfMonth = date("Y-m-t", strtotime($sale->date));
                if (!array_key_exists($lastDateOfMonth, $database[$financeplan])) {
                    $database[$financeplan][$lastDateOfMonth] = [];
                    $database[$financeplan][$lastDateOfMonth]['sumValue'] = 0.00;
                    $database[$financeplan][$lastDateOfMonth]['qtdRegisters'] = 0;
                    $database[$financeplan][$lastDateOfMonth]['details'] = [];
                }

                //At least, it stores the result into the array
                //array_push($database[$financeplan][$lastDateOfMonth], 0.00);
                array_push($database[$financeplan][$lastDateOfMonth]['details'], $sale);
                $database[$financeplan][$lastDateOfMonth]['sumValue'] += $sale->value;
                $database[$financeplan][$lastDateOfMonth]['qtdRegisters']++;
            }
        }



        return ($database);
    }

    public function show($getPDF = false)
    {
        # code...

        $sales = $this->getSales();
        $financeplans = [];
        foreach ($sales as $key => $value) {
            # code...
            $financeplans[$key] = $key;
        }

        $salesDates = [];
        $salesSum = [];
        foreach ($financeplans as $fplan) {
            $salesSum[$fplan] = 0.00;
        }
        $salesSum['Total'] = 0.00;

        // First, add all the dates
        foreach ($sales as $key => $value) {
            # code...

            foreach ($value as $dayKey => $dayValue) {
                if (!array_key_exists($dayKey, $salesDates)) {
                    $salesDates[$dayKey] = [];
                }

                $salesDates[$dayKey]['Data'] = '';
                foreach ($financeplans as $fplan) {
                    $salesDates[$dayKey][$fplan] = 0.00;
                }
                $salesDates[$dayKey]['Total'] = 0.00;
            }
        }

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //Now, add the values
        foreach ($sales as $key => $value) {
            # code...
            foreach ($value as $dayKey => $dayValue) {
                $salesDates[$dayKey]['Data'] = strftime('%B/%Y', strtotime($dayKey));
                $salesDates[$dayKey][$key] += $dayValue['sumValue'];
                $salesSum[$key] += $dayValue['sumValue'];
                $salesDates[$dayKey]['Total'] += $dayValue['sumValue'];
                $salesSum['Total'] += $dayValue['sumValue'];
            }
        }

        if (!$getPDF) {
            return view('finance.sales.report.show', [
                'salesDates' => $salesDates,
                'financeplans' => $financeplans,
                'salesSum' => $salesSum
            ]);
        } else {
            $pdf = PDF::loadView('pdf.sales', [
                'salesDates' => $salesDates,
                'financeplans' => $financeplans,
                'salesSum' => $salesSum
            ]);
        }
        $fileName = 'Histórico de Faturamento.pdf';
        return $pdf->download($fileName);
    }

    public function getPDF()
    {
        return $this->show(true);
    }
}
