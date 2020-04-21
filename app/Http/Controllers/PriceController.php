<?php

namespace App\Http\Controllers;

use App\ProductLinked;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use stdClass;

class PriceController extends Controller
{
    public function loadData(Request $request)
    {
        $client = new Client();
        $headers = [
            'content-type' => 'application/json',
            'Authorization' =>  'Basic ' . env('NEXUS_KEY')
        ];
        $urlbase = "http://nexus.vetro.vet:5100/api/v3/read/preturi";
        $response = $client->post($urlbase, [
            "json" =>
            [
                "id_document" => "2(1)",
                "id_gestiune" => "1(1)"
            ],

            "headers" => $headers
        ]);
        $data = json_decode($response->getBody());
        $data = $data->result;
        $toEncode = ["data" => $data];
        $listSkus = json_encode($toEncode);
        return $listSkus;
    }

    public function index(Request $request)
    {

        return view('prices.index');
    }

    public function checkPrices(Request $request, $id)
    {
        $product = ProductLinked::where('code', $id)->first();

        $client = new Client();
        $headers = [
            'content-type' => 'application/json',
            'Authorization' =>  'Basic ' . env('NEXUS_KEY')
        ];
        // get prices
        $urlbase = "http://nexus.vetro.vet:5100/api/v3/read/preturi";
        $response = $client->post($urlbase, [
            "json" =>
            [
                "id_document" => "2(1)",
                "id_gestiune" => "1(1)",
                "id_produs" => $id


            ],

            "headers" => $headers
        ]);

        // get stock details
        $urlStock = "http://nexus.vetro.vet:5100/api/v3/read/stoc_detaliat";
        $data = json_decode($response->getBody());
        $productSku = $data->result[0];
        // dd($productSku);
        $response = $client->post($urlStock, [
            "json" =>
            [
                "campuri"=>"id_produs, den_produs, pret_achizitie, data_expirare, cantitate",
                "id_gestiune" => "1(1)",
                "id_produs" => $id
            ],

            "headers" => $headers
        ]);
        $dataStock=json_decode($response->getBody())->result;

        $stockAvaible=[];
        foreach ($dataStock as $stock) {
            if($stock->cantitate > 0)
                array_push($stockAvaible,$stock);
        }


        // getting skuid from vtex if it's possible
        $headersVtex=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];

        $urlGetSku = "https://vetro.vtexcommercestable.com.br/api/catalog/pvt/stockkeepingunit?refId=".$id;
        try {
            $response = $client->get($urlGetSku, ["headers"=>$headersVtex]);
            $skuVtex=json_decode($response->getBody());
        } catch (Exception $e) {
            $skuVtex=null;

        }

        // getting data through search this info is equal to prices lists, and discounts
        $priceB2C=null;
        $priceWithDiscount=null;
        $percentDiscount=null;

        if($skuVtex){
            $urlSearch='https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search?fq=skuId:'.$skuVtex->Id;
            $response = $client->get($urlSearch, ["headers"=>$headersVtex]);
            $skuSearch=json_decode($response->getBody())[0];
            foreach ($skuSearch->items as $item) {
                if($skuVtex->Id==$item->itemId){
                    $priceWithDiscount=$item->sellers[0]->commertialOffer->PriceWithoutDiscount;
                    $priceB2C=$item->sellers[0]->commertialOffer->Price;
                    // it means that it doesn't have discount on it
                    if($priceWithDiscount==$priceB2C){
                        $priceWithDiscount=null;
                    }else{
                        $percentDiscount=1-round($priceB2C/$priceWithDiscount,3);
                    }


                }
            }

        }


        return view('prices.check', compact('productSku','stockAvaible','priceB2C','priceWithDiscount','percentDiscount','id'));
    }


    public function updateUrls(Request $request, $id){
        $pullOfUrls=ProductLinked::where('code',$id)->first();
        $site=$request->post('site');
        $url= $request->post('url');

        if($pullOfUrls){
            $pullOfUrls[$site]=$url;
            $pullOfUrls->save();
        }
        else{
            $newPullOfUrls=new ProductLinked();
            $newPullOfUrls[$site]=$url;
            $newPullOfUrls->code=$id;
            $newPullOfUrls->save();
        }

       return response()->json("URL saved on ".$site, 200);
    }

    public function getUrl(Request $request, $id){
        $pullOfUrls=ProductLinked::where('code',$id)->first();
        $site=$request->post('site');

        $url=$pullOfUrls[$site]??'';

        return response()->json($url,200);

    }
}
