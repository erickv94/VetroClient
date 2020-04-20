<?php

namespace App\Http\Controllers;

use App\Image;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index(Request $request)
    {
    	$client = new Client();

        $headers=[
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
        $client = new Client();
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];



        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());

        return view('Products.edit',['product'=>$product]);
    }


    public function updateDescription(Request $request){
            $client = new Client();
            $id= $request->post('id');
            $headers=[
                'content-type' => 'application/json',
                'accept'     => 'application/json',
                'X-VTEX-API-AppKey'      => env('API_KEY'),
                'X-VTEX-API-AppToken' =>  env('API_TOKEN')
            ];
            

            $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
            $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
            $product=json_decode($response->getBody());
            $product->Description=$request->post('description');

            //create action
            $user = Auth::user();
            $user->logs()->create([
                'action' => 'updated description product: ' . $product->Name   
            ]);

            $urlUpdate="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/product/".$id;
            $response = $client->request('PUT',$urlUpdate,
                [
                "json"=> (array) $product,
                "headers"=>$headers
                ]);
            return response()->json((array) json_encode($response->getBody()));
    }

    public function updateMeta(Request $request){


        $client = new Client();
        $id= $request->post('id');
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];


        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());
        $product->MetaTagDescription=$request->post('meta');

         //create action
        $user = Auth::user();
        $user->logs()->create([
            'action' => 'updated metadescription product: ' . $product->Name   
        ]);

        $urlUpdate="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/product/".$id;
        $response = $client->request('PUT',$urlUpdate,
            [
            "json"=> (array) $product,
            "headers"=>$headers
            ]);

        return response()->json((array) json_encode($response->getBody()));

    }

    public function updateKeyword(Request $request){

        $client = new Client();
        $id= $request->post('id');
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];


        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());
        $product->KeyWords=$request->post('keyword');

         //create action
        $user = Auth::user();
        $user->logs()->create([
            'action' => 'updated keywords product: ' . $product->Name   
        ]);

        $urlUpdate="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/product/".$id;
        $response = $client->request('PUT',$urlUpdate,
            [
            "json"=> (array) $product,
            "headers"=>$headers
            ]);

        return response()->json((array) json_encode($response->getBody()));

    }



    public function updateTitle(Request $request){

        $client = new Client();
        $id= $request->post('id');
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];

        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());
        $product->Title=$request->post('title');

        //create action
        $user = Auth::user();
        $user->logs()->create([
            'action' => 'updated title product: ' . $product->Name   
        ]);

        $urlUpdate="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/product/".$id;
        $response = $client->request('PUT',$urlUpdate,
            [
            "json"=> (array) $product,
            "headers"=>$headers
            ]);

        return response()->json((array) json_encode($response->getBody()));

    }



    public function imagesEdit(Request $request,$id){
        //first request
        $client = new Client();
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];
        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog_system/pvt/products/ProductGet/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $product=json_decode($response->getBody());
        //dd($product->LinkId);

        //second request
        $urlSearch = "https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search/". $product->LinkId ."/p";
        $responseSearch = $client->request('GET',$urlSearch, ["headers"=>$headers]);
        $productSearch = json_decode($responseSearch->getBody());
        $itemsSku = $productSearch[0]->items;

        $items=[];
        $elements=[];
        $name = $product->Name;
        foreach($itemsSku as $item)
        {
            $elements['id']=$item->itemId;
            $elements['name']=$item->name;
            $elements['url'] = $item->images[0]->imageUrl;
            $elements['updated'] = $item->images[0]->imageLastModified;
            array_push($items,(object) $elements);
        }
        //dd($items);

        return view('Products.images', compact('items','name'));
    }

    public function updateImages(Request $request){
        //Cloudinary
        \Cloudinary::config(array(
            "cloud_name" =>  env('API_CLOUDINARY_NAME'),
            "api_key" =>  env('API_CLOUDINARY_KEY'),
            "api_secret" => env('API_CLOUDINARY_SECRET'),
        ));

        $file_img = \Cloudinary\Uploader::upload($request->image);

        $image = Image::create([
            'public_id' => $file_img['public_id'],
            'url' => $file_img['url'],
        ]);
        //first request
        $client = new Client();
        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];
        $urlbase="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/stockkeepingunit/". $request->id. "/file";
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $images=json_decode($response->getBody());
        $imageObj = $images[0];
        $imageObj->Url = $image->url;
        $imageObj->Text = $imageObj->Name;
        
      
        //second request updated
        $urlUpdate="https://vetro.vtexcommercestable.com.br/api/catalog/pvt/stockkeepingunit/" . $imageObj->SkuId. "/file/" . $imageObj->Id;

          //create action
        $user = Auth::user();
        $user->logs()->create([
            'action' => 'updated image with name: ' . $imageObj->Name .' with Id SKU: ' . $imageObj->SkuId
        ]);

        $response = $client->request('PUT',$urlUpdate,
            [
            "json"=> (array) $imageObj,
            "headers"=>$headers
            ]);

        return response()->json((array) json_encode($response->getBody()));

    }

}
