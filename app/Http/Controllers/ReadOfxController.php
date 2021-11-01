<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleXMLElement;
use stdClass;

class ReadOfxController extends Controller
{

    private function handleOfx($file)
    {
        $source = utf8_encode(file_get_contents($file));

        //add end tag
        $source = preg_replace('#^<([^>]+)>([^\r\n]+)\r?\n#mU', "<$1>$2</$1>\n", $source);

        //skip header
        $source = substr($source, strpos($source, '<OFX>'));

        //convert to array
        $xml = simplexml_load_string($source);
        $array = json_decode(json_encode($xml), true);

        return $array;
    }

    public function OfxToArray($file) {

        $array = $this->handleOfx($file);

        return $array;
    }
    
    public function OfxToObject($file)
    {
        # code...
        $array = $this->handleOfx($file);
        $ofxData = $array['BANKMSGSRSV1']['STMTTRNRS']['STMTRS'];

        $data = new stdClass();
        $data->currency = $ofxData['CURDEF'];
        $data->bankid = $ofxData['BANKACCTFROM']['BANKID'];
        $data->accountnumber = $ofxData['BANKACCTFROM']['ACCTID'];
        $data->datestart = $ofxData['BANKTRANLIST']['DTSTART'];
        $data->dateend = $ofxData['BANKTRANLIST']['DTEND'];
        $data->transactions = $ofxData['BANKTRANLIST']['STMTTRN'];

        return $data;
    }
}
