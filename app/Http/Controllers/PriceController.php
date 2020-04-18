<?php

namespace App\Http\Controllers;

use App\ProductLinked;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


class PriceController extends Controller
{
    public function loadData(Request $request){
        $client = new Client();
		$headers = [
	        'content-type' => 'application/json',
	        'Authorization' =>  'Basic '.env('NEXUS_KEY')
            ];
        $urlbase="http://nexus.vetro.vet:5100/api/v3/read/preturi";
        $response = $client->post($urlbase, [
            "json"=>
                [
                    "id_document" => "2(1)",
                    "id_gestiune"=>"1(1)"
                ],

            "headers"=>$headers
            ]);
        $data=json_decode($response->getBody());
        $data=$data->result;
        $toEncode=["data"=>$data];
        $data=json_encode($toEncode);
        return $data;

    }

    public function index(Request $request){

        return view('prices.index');
    }

    public function checkPrices(Request $request, $id){
        $product= ProductLinked::where('code',$id)->first();

        $client = new Client();
		$headers = [
	        'content-type' => 'application/json',
	        'Authorization' =>  'Basic '.env('NEXUS_KEY')
            ];

        $urlbase="http://nexus.vetro.vet:5100/api/v3/read/preturi";
        $response = $client->post($urlbase, [
            "json"=>
                [
                    "id_document" => "2(1)",
                    "id_gestiune"=>"1(1)",
                    "id_produs"=>$id


                ],

            "headers"=>$headers
            ]);

            $data=json_decode($response->getBody());
            $data=$data->result[0];
            // dd($data);
        return view('prices.check',["data"=>$data]);
    }

}
