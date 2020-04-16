<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index(Request $request)
    {
    	$client = new \GuzzleHttp\Client();
		$headers = [
	        'content-type' => 'application/json',
	        'accept'     => 'application/json',
	        'X-VTEX-API-AppKey'      => env('API_KEY'),
	        'X-VTEX-API-AppToken' =>  env('API_TOKEN')
	    	];
	    //logica de paginación
	    $per_page=5; //cantidad de elementos en cada pagina
	    $page=$request["page"];

	    if($page && $page!=1){
		    $to=($per_page*$page)-1; // el ultimo elemento que se vera
		    $from= ($to-$per_page)+1; // desde que elemento se vera
	    }
	 	else
	 	{
	 		$to=$per_page-1;
	 		$from=0;
	 	}
        $urlbase='https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search/';
        if($request['search'])
	        $urlbase = 'https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search/'.$request['search'];
	    //esto funcionaba cuando pasaba el la url los parametros
	    //$url = $urlbase . $request["from"] . '&_to=' . $request["to"] ;
	    //$url = $urlbase . '&_from=' . $from . '&_to=' . $to ;
	    //dd($url);

		//todos los productos
		$response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $productsAll = json_decode($response->getBody());
        $count=count($productsAll);
		$totalPages=(int) ceil($count/$per_page);
        $products=array_slice($productsAll,$from,$per_page);



		$current_page = $request["page"]??1;
		//dd($products);
        return view('Products.index',compact('products','totalPages','current_page'));
    }

    public function edit(Request $request, $id){
        $client = new \GuzzleHttp\Client();
		$headers = [
	        'content-type' => 'application/json',
	        'accept'     => 'application/json',
	        'X-VTEX-API-AppKey'      => env('API_KEY'),
	        'X-VTEX-API-AppToken' =>  env('API_TOKEN')
            ];

        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());
        //dd($product);
        return view('Products.edit',['product'=>$product]);
    }
}
