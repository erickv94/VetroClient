<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index()
    {
    	$client = new \GuzzleHttp\Client();
		$headers = [
	        'content-type' => 'application/json',
	        'accept'     => 'application/json',
	        'x-vtex-api-appkey'      => 'vtexappkey-vetro-YLNZZA',
	        'x-vtex-api-apptoken' =>  'GKUYKCSHRWTOCMLMNIKVTOSFNIADICSKHAMTOHCVTBXWBADGTVAZFPPSRPLBBPZODJGCZSYGGOCSQWDMFUJMCSFRKUBYWATEBJSSUAGBWTSQNXBVMYWHFNLKDOREQAJG'
	    	];
	    $body = 'hello!';
		$response = $client->request('GET',
			'https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search/vectra', $headers);
		//echo $response->getStatusCode(); // 200
		//echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
		$products = json_decode($response->getBody());
		//dd($products)
        return view('products.index',compact('products'));
    }
}
