<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Sale;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Chartisan\PHP\Chartisan;
use Illuminate\Support\Facades\DB;

class SalesChart extends BaseChart
{
    public ?array $middlewares = ['auth'];
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $sales = DB::table('sales')
            ->join('sales_items', 'sales.id', '=', 'sales_items.idSale')
            ->join('financeplans', 'sales_items.idFinancePlan', '=', 'financeplans.id')
            ->select('financeplans.name', DB::raw('SUM(sales.value) as total_sales'))
            ->groupBy('financeplans.name')
            ->get();

        $chart = Chartisan::build();
        $labels = [];
        $dataset = [];

        foreach ($sales as $item) {
            array_push($labels, $item->name);
            array_push($dataset, $item->total_sales);
        }

        $chart->labels($labels);
        $chart->dataset('Valor', $dataset);

        


        return $chart;
    }
}
