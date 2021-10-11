<?php

declare(strict_types=1);

namespace App\Charts;

use App\Http\Controllers\SalesController;
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

        $sales = new SalesController();
        $data = $sales->getSales();

        $chart = Chartisan::build();
        $labels = [];
        $dataset = [];

        //First it discovers how much labels there are
        foreach ($data as $key => $value) {

            array_push($labels, $key);

        }
        array_push($labels, 'Total');

        //It verifies if exists the day into the dataset
        foreach ($data as $key => $value) {
            # code...
            foreach ($value as $dayKey => $dayValue) {
                $formattedData = date('m/Y', strtotime($dayKey));
                $dayKey = $formattedData;
                # code...
                if (!array_key_exists($dayKey, $dataset)) {
                    foreach ($labels as $labelKey => $labelValue) {
                        # code...
                        $dataset[$dayKey][$labelKey] = 0.00;
                    }
                }

                //Finally, it sets the value into the array
                $labelKey = array_keys($labels, $key)[0];
                $dataset[$dayKey][$labelKey] += $dayValue['sumValue'];

                $labelKey = array_keys($labels, 'Total')[0];
                $dataset[$dayKey][$labelKey] += $dayValue['sumValue'];
            }
        }

        $chart->labels($labels);

        foreach ($dataset as $key => $value) {
            # code...
            $chart->dataset($key, $value);
        }

        //$chart->dataset('Valor', [5.01, 2]);
        //$chart->dataset('Valor2', [2, 4]);

        return $chart;
    }
}
