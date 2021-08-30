<?php

namespace App\Http\Controllers;

use App\Models\Financeplan;
use Illuminate\Http\Request;

class FinancePlanController extends Controller
{
    public function index()
    {
        # code...
        $financeplans = Financeplan::orderBy('classification')->get();

        foreach($financeplans as $item) {
            switch ($item->anasin) {
                case "A":
                    $item->anasin = "Analítica";
                    break;
                case "S":
                    $item->anasin = "Sintética";
                    break;
            }

            switch ($item->type) {
                case "C":
                    $item->type = "CAPEX";
                    break;
                case "O":
                    $item->type = "OPEX";
                    break;
                case "F":
                    $item->type = "Financeiro";
                    break;
                case "S":
                    $item->type = "Vendas";
                    break;
                case "U":
                    $item->type = "Outras";
                    break;
            }

        }


        return view('finance.financeplan.show', ['financeplans' => $financeplans]);
    }

    public function create()
    {
        # code...
        $financeplan = new Financeplan();
        //$financeplan->classification = "01";

        return view('finance.financeplan.create', ['financeplan' => $financeplan]);
    }

    public function store(Request $request)
    {
        # code...
        $financeplan = new Financeplan();
        $financeplan->classification = $request->classification;
        $financeplan->name = $request->name;
        $financeplan->anasin = $request->anasin;
        $financeplan->description = $request->description;
        $financeplan->type = $request->type;
        $financeplan->save();

        return redirect('/finance/financeplan');
    }

    public function show($id)
    {
        $financeplan = Financeplan::findOrFail($id);

        return view('finance.financeplan.create', ['financeplan' => $financeplan]);
    }

    public function update(Request $request)
    {
        # code...
        $financeplan = Financeplan::findOrFail($request->id);
        $financeplan->classification = $request->classification;
        $financeplan->name = $request->name;
        $financeplan->anasin = $request->anasin;
        $financeplan->description = $request->description;
        $financeplan->type = $request->type;
        $financeplan->save();

        return redirect('/finance/financeplan');
    }
}
