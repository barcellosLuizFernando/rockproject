<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadXmlController extends Controller
{
    //
    public function index($xmlDataString)
    {
        # code...

        $xmlObject = simplexml_load_string($xmlDataString);

        $json = json_encode($xmlObject);
        $phpDataArray = json_decode($json);

        return $phpDataArray;
    }
    
}
