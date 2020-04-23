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
        // $this->getValueFromZooplus('https://www.zooplus.ro/shop/pisici/hrana_uscata_pisici/royal_canin_feline/health_specialty/243185?rrec=true&pr=home4_rr&slot=1&exprienceid=4571&strategyid=51867');

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
        $vtexId=null;
        $link=null;


        if($skuVtex){
            $urlSearch='https://vetro.vtexcommercestable.com.br/api/catalog_system/pub/products/search?fq=skuId:'.$skuVtex->Id;
            $response = $client->get($urlSearch, ["headers"=>$headersVtex]);
            $skuSearch=json_decode($response->getBody())[0];
            $vtexId=$skuSearch->productId;
            $link=$skuSearch->link;
            foreach ($skuSearch->items as $item) {
                if($skuVtex->Id==$item->itemId){
                    $item->sellers[0]->commertialOffer->Price;
                    $priceWithDiscount=$item->sellers[0]->commertialOffer->Price;
                    $priceB2C=$item->sellers[0]->commertialOffer->PriceWithoutDiscount;
                    // it means that it doesn't have discount on it
                    if($priceWithDiscount==$priceB2C){
                        $priceWithDiscount=null;
                    }else{
                        $percentDiscount=1-round($priceWithDiscount/$priceB2C,3);
                    }


                }
            }

        }

        // applying scraping to sites
        $linkedList= ProductLinked::where('code',$id)->first();

        $priceEmag=null;
        $pricePetmart=null;
        $pricePetru=null;
        $listPrices=null;

        if($linkedList){
            $priceEmag=$this->getValueFromEMAG($linkedList->emag??'');
            $pricePetmart=$this->getValueFromPetmart($linkedList->petmart??'');
            $pricePetru=$this->getValueFromPentruAnimale($linkedList->pentruanimale??'');
            $listPrices= $this->getValueFromZooplus($linkedList->zooplus??'');
        }

        // dd($listPrices);

        return view('prices.check', compact('productSku','stockAvaible','priceB2C'
                    ,'priceWithDiscount','percentDiscount','id'
                    ,'linkedList','pricePetmart','priceEmag','pricePetru',
                    'link','vtexId','listPrices'));
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
        $priceCompetition=null;
        switch ($site) {
            case 'petmart':
                $priceCompetition=$this->getValueFromPetmart($url);
                break;
            case 'emag':
                $priceCompetition=$this->getValueFromEMAG($url);
                break;
            case 'pentruanimale':
                $priceCompetition=$this->getValueFromPentruAnimale($url);
                break;
            case 'zooplus':
                $priceCompetition=$this->getValueFromZooplus($url);
                break;
            default:
                # code...
                break;
        }
       return response()->json([
           'message'=>'URL Updated for '.$site,
           'site'=>$site,
           'priceCompetition'=>$priceCompetition
       ]);
    }

    public function getUrl(Request $request, $id){
        $pullOfUrls=ProductLinked::where('code',$id)->first();
        $site=$request->get('site');

        $url=$pullOfUrls[$site]??'';
        return response()->json($url,200);

    }


    public function getValueFromPetmart($url){
        $price=null;
        $client=new \Goutte\Client;
        try{
            $crawler = $client->request('GET', $url);
            $price=$crawler->filter('[id*="product-price-"]')->text();
            $price=substr($price,0,-5);
            $entirePart=substr($price,0,-3);
            $decimalPart=substr($price,-2,2);
            $price="{$entirePart}.{$decimalPart} RON";
        }
        catch(Exception $e){}

        return $price;
    }



    public function getValueFromEMAG($url){
        $price=null;
        $client=new \Goutte\Client;
        try{
            $crawler = $client->request('GET', $url);
            $price=$crawler->filter('.product-page-pricing > .product-new-price')->text();
            // only price without decimals
            $price=substr($price,0,-4);
            $entirePart=substr($price,0,-2);
            $decimalPart=substr($price,-2,2);

            $price="{$entirePart}.{$decimalPart} RON";
        }
        catch(Exception $e){

        }
        return $price;
    }

    public function getValueFromPentruAnimale($url){
        $price=null;
        $client=new \Goutte\Client;

        try{
            $crawler = $client->request('GET', $url);
            $price=$crawler->filter('[itemprop=price]')->text();
            $price=$price." RON";
        }
        catch(Exception $ex){}
        return $price;
    }

    public function getValueFromZooplus($url){
        $client=new \Goutte\Client;
        try{
            $crawler = $client->request('GET', $url);

            $title=$crawler->filter('.producttitle')->text();
            $price=null;
            $variant=null;

            $productList=$crawler->filter('.product__offer ')->each(function($el) use($title){
                $price=$el->filter('.product__prices_col')->text();
                $price=str_replace('LEI','RON',$price);
                $variant=$el->filter('.product__varianttitle')->text();
                return (object) ["price"=>$price,'variant'=>$variant,'title'=>$title];
            });


            return $productList;

        }
        catch(Exception $e){

        }
        return null;
    }

    public function updatePrice(Request $request){
        $id=$request->post('id');
        $priceToUpdate=$request->post('price');

        $headers=[
            'content-type' => 'application/json',
            'accept'     => 'application/json',
            'X-VTEX-API-AppKey'      => env('API_KEY'),
            'X-VTEX-API-AppToken' =>  env('API_TOKEN')
        ];


        $client= new Client();
        // url base to update and get data

        $urlbase="https://api.vtex.com/vetro/pricing/prices/".$id;
        $response = $client->request('GET',$urlbase, ["headers"=>$headers]);
        $price=json_decode($response->getBody());

        // modified price base
        $price->basePrice=(float) $priceToUpdate;
        unset($price->fixedPrices);
        unset($price->costPrice);

        $response = $client->request('PUT',$urlbase,
            [
            "json"=> (array) $price,
            "headers"=>$headers
            ]);

        return response()->json($price);
    }
}
