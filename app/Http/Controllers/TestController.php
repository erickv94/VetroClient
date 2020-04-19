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
        $response=$client->ImageServiceInsertUpdate(['urlImage'=>"https://images.theconversation.com/files/319375/original/file-20200309-118956-1cqvm6j.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1200&h=1200.0&fit=crop",
        'imageName'=>'dog',
        'stockKeepingUnitId'=>'651'
        ]);
        dd($response);
    }

}


