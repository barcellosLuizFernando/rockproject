<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CfpsCstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = City::where('name', 'Florianópolis')->get();

        $cityId = $cities[0]->id;

        $cfpscst = array(
            '9201|0|0|1',
            '9201|1|2|1',
            '9201|2|0|1',
            '9201|3|1|1',
            '9201|4|0|1',
            '9201|5|0|1',
            '9201|6|1|1',
            '9201|7|0|1',
            '9201|8|1|1',
            '9201|9|1|1',
            '9201|10|1|1',
            '9201|11|1|1',
            '9201|12|2|1',
            '9201|13|2|1',
            '9201|14|2|1',
            '9201|15|2|1',
            '9201|16|2|1',
            '9202|0|0|1',
            '9202|1|2|1',
            '9202|2|9|0',
            '9202|3|9|0',
            '9202|4|9|0',
            '9202|5||1',
            '9202|6|9|0',
            '9202|7|9|0',
            '9202|8|1|1',
            '9202|9|9|0',
            '9202|10|9|0',
            '9202|11|9|0',
            '9202|12|2|1',
            '9202|13|2|1',
            '9202|14|2|1',
            '9202|15|2|1',
            '9202|16|2|1',
            '9203|0|0|1',
            '9203|1|2|1',
            '9203|2|9|0',
            '9203|3|9|0',
            '9203|4|9|0',
            '9203|5||1',
            '9203|6|9|0',
            '9203|7|9|0',
            '9203|8|1|1',
            '9203|9|9|0',
            '9203|10|9|0',
            '9203|11|9|0',
            '9203|12|2|1',
            '9203|13|2|1',
            '9203|14|2|1',
            '9203|15|2|1',
            '9203|16|2|1',
            '9204|0|0|1',
            '9204|1|2|1',
            '9204|2|9|0',
            '9204|3|9|0',
            '9204|4|9|0',
            '9204|5||1',
            '9204|6|9|0',
            '9204|7|9|0',
            '9204|8|1|1',
            '9204|9|9|0',
            '9204|10|9|0',
            '9204|11|9|0',
            '9204|12|2|1',
            '9204|13|2|1',
            '9204|14|2|1',
            '9204|15|2|1',
            '9204|16|2|1',
            '9205|0|2|1',
            '9205|1|2|1',
            '9205|2|9|0',
            '9205|3|9|0',
            '9205|4|9|0',
            '9205|5|9|0',
            '9205|6|9|0',
            '9205|7|9|0',
            '9205|8|9|0',
            '9205|9|9|0',
            '9205|10|9|0',
            '9205|11|9|0',
            '9205|12|9|0',
            '9205|13|9|0',
            '9205|14|2|1',
            '9205|15|9|0',
            '9205|16|9|0',
            '9206|0|2|1',
            '9206|1|2|1',
            '9206|2|9|0',
            '9206|3|9|0',
            '9206|4|9|0',
            '9206|5|9|0',
            '9206|6|9|0',
            '9206|7|9|0',
            '9206|8|9|0',
            '9206|9|9|0',
            '9206|10|9|0',
            '9206|11|9|0',
            '9206|12|9|0',
            '9206|13|9|0',
            '9206|14|2|1',
            '9206|15|9|0',
            '9206|16|9|0',
            '9207|0|2|1',
            '9207|1|2|1',
            '9207|2|9|0',
            '9207|3|9|0',
            '9207|4|9|0',
            '9207|5|9|0',
            '9207|6|9|0',
            '9207|7|9|0',
            '9207|8|9|0',
            '9207|9|9|0',
            '9207|10|9|0',
            '9207|11|9|0',
            '9207|12|9|0',
            '9207|13|9|0',
            '9207|14|2|1',
            '9207|15|9|0',
            '9207|16|9|0',
            '9208|0|0|1',
            '9208|1|2|1',
            '9208|2|0|1',
            '9208|3|1|1',
            '9208|4|0|1',
            '9208|5|0|1',
            '9208|6|1|1',
            '9208|7|0|1',
            '9208|8|1|1',
            '9208|9|1|1',
            '9208|10|1|1',
            '9208|11|1|1',
            '9208|12|2|1',
            '9208|13|2|1',
            '9208|14|2|1',
            '9208|15|2|1',
            '9208|16|2|1',
            '9209|0|0|1',
            '9209|1|2|1',
            '9209|2|9|0',
            '9209|3|9|0',
            '9209|4|9|0',
            '9209|5|9|0',
            '9209|6|9|0',
            '9209|7|9|0',
            '9209|8|1|1',
            '9209|9|9|0',
            '9209|10|9|0',
            '9209|11|9|0',
            '9209|12|2|1',
            '9209|13|2|1',
            '9209|14|2|1',
            '9209|15|2|1',
            '9209|16|2|1',
            '9210|0|0|1',
            '9210|1|2|1',
            '9210|2|9|0',
            '9210|3|9|0',
            '9210|4|9|0',
            '9210|5|9|0',
            '9210|6|9|0',
            '9210|7|9|0',
            '9210|8|1|1',
            '9210|9|9|0',
            '9210|10|9|0',
            '9210|11|9|0',
            '9210|12|2|1',
            '9210|13|2|1',
            '9210|14|2|1',
            '9210|15|2|1',
            '9210|16|2|1',
            '9211|0|0|1',
            '9211|1|2|1',
            '9211|2|9|0',
            '9211|3|9|0',
            '9211|4|9|0',
            '9211|5|9|0',
            '9211|6|9|0',
            '9211|7|9|0',
            '9211|8|1|1',
            '9211|9|9|0',
            '9211|10|9|0',
            '9211|11|9|0',
            '9211|12|2|1',
            '9211|13|2|1',
            '9211|14|2|1',
            '9211|15|2|1',
            '9211|16|2|1',
        );

        $array = [];
        $x = 0;

        foreach ($cfpscst as $validation) {

            $pieces = explode("|", $validation);
            $element = [];

            for ($i = 0; $i < count($pieces); $i++) {
                switch ($i) {
                    case 0:
                        $element['cfps'] = $pieces[$i];
                        break;
                    case 1:
                        $element['cst'] = $pieces[$i];
                        break;
                    case 2:
                        $cdnfe = null;
                        if ($pieces[$i] <> "") {
                            $cdnfe = $pieces[$i];
                        }
                        $element['cdnfe'] = $cdnfe;
                        break;
                    case 3:
                        $element['exibe_cst'] = $pieces[$i];
                        break;
                }
            }

            $element['cityId'] = $cityId;
            $array[$x] = $element;
            $x++;
        }

        DB::table('nfs_cfps_csts')->insert($array);
    }
}
