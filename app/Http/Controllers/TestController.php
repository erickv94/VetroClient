<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class TestController extends Controller
{

    public function index(Request $request)
    {
        $options = array(
            'login' => env('API_KEY'),
            'password' => env('API_TOKEN'),
            'soap_version' => SOAP_1_1,
            'exceptions' => false,
            'trace' => 1
          );
          $url="http://webservice-vetro.vtexcommerce.com.br/service.svc?wsdl";
        $client = new SoapClient($url,$options);
        $response=$client->ImageServiceInsertUpdate(['urlImage'=>"https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQ6Lu0obmddsQX3JELe04hUs_hSelsmU8_W1yn5ztgdAk5SJC7D",
        'imageName'=>'Jar',
        'stockKeepingUnitId'=>'651'
        ]);
        dd($response);
    }

}


