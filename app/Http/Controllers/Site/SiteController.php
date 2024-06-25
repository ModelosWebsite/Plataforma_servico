<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{About, service, Color, company, Detail, footer, Hero, pacote, Termpb_has_Company, TermsCompany};
use Illuminate\Support\Facades\Http;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class SiteController extends Controller
{
    public function getAcceptCompany($company)
    {
        try {
            return company::where("companyhashtoken", $company)->first();
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    //index ou pagina principal do site
    public function index($company){
        try {
            $data = $this->getAcceptCompany($company);
            if ($data  && $data->status === 'active') {
                $heroImage = Hero::where("company_id", isset($data->id) ? $data->id : "")->first();
                $texts = Hero::where("company_id", isset($data->id) ? $data->id : "")->get();
                $about = About::where("company_id", isset($data->id) ? $data->id : "")->get();
                $service = service::where("company_id", isset($data->id) ? $data->id : "")->get();
                $footer = footer::where("company_id", isset($data->id) ? $data->id : "")->get();
                $start = Detail::where("company_id", isset($data->id) ? $data->id : "")->get();
                $startImage = Detail::where("company_id", isset($data->id) ? $data->id : "")->first();
                $color = Color::where("company_id", isset($data->id) ? $data->id : "")->first();
                $WhatsApp = pacote::where("company_id", isset($data->id) ? $data->id : "")->first();
                $name = company::where("companyhashtoken", $company)->first();
                $packges = Pacote::where("company_id", $data->id)->first();
    
                $phonenumber = footer::where("company_id", $data->id)->first();
                
                $companies = Termpb_has_Company::where("company_id", $data->id)->with('termsPBs')->first();

                $termos = TermsCompany::where("company_id", $data->id)->first();
    
                $api = Http::post("http://karamba.ao/api/anuncios", ["key" => "wRYBszkOguGJDioyqwxcKEliVptArhIPsNLwqrLAomsUGnLoho"]);
                $apiArray = $api->json();
        
                return view("site.home", [
                    "heroImage" => $heroImage,
                    "texts" => $texts,
                    "about" => $about,
                    "apiArray" => $apiArray,
                    "service" => $service,
                    "footer" => $footer,
                    "start" => $start,
                    "startImage" => $startImage,
                    "color" => $color,
                    "WhatsApp" => $WhatsApp,
                    "termos" => $termos,
                    "name" => $name,
                    "data" => $data,
                    "packges" => $packges,
                    "companies" => $companies,
                ]);
            } else {
                $companyname = company::where("companyhashtoken", $company)->first();
                return view("disable.App", compact("companyname"));
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    //loja online
    public function shopping($company)
    {
        try {
            $data = $this->getAcceptCompany($company);
            $color = Color::where("company_id", isset($data->id) ? $data->id : "")->first();
            $packges = pacote::where("company_id", $data->id)->first();
            $texts = Hero::where("company_id", isset($data->id) ? $data->id : "")->get();
            $WhatsApp = pacote::where("company_id", isset($data->id) ? $data->id : "")->first();

            $curl = curl_init();
    
            curl_setopt_array($curl, [
            CURLOPT_URL => "https://kytutes.com/api/items",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => [
                "Accept: application/json",
                "Authorization: {$data->companytokenapi}",
                "Content-Type: application/json"
            ],
            ]);
    
            $response = curl_exec($curl);
            $err = curl_error($curl);
    
            curl_close($curl);
    
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $CollectionsProducts = Collect(json_decode($response,true));
                return view("site.shopping.home.App", compact(
                    "data", 
                    "CollectionsProducts",
                    "packges",
                    "texts",
                    "color",
                    "WhatsApp"
                ));
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back();
        }
    }

    public function addCart($company, $id)
    {
        try {
            $companydata = $this->getAcceptCompany($company);
            $curl = curl_init();
    
             curl_setopt_array($curl, [
            
             CURLOPT_URL => "https://kytutes.com/api/items?reference=$id",
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "GET",
             CURLOPT_POSTFIELDS => "",
             CURLOPT_HTTPHEADER => [
                 "Accept: application/json",
                 "Authorization: {$companydata->companytokenapi}",
                 "Content-Type: application/json"
             ]
            ]);
    
             $response = curl_exec($curl);
             $err = curl_error($curl);
    
             curl_close($curl);
    
             if ($err) {
                 echo "cURL Error #:" . $err;
             } else {
                $data = Collect(json_decode($response,true));
               
                Cart::add(array(
                    'id' => $data[0]["reference"],
                    'name' => $data[0]["name"],
                    'price' => $data[0]["price"],
                    'quantity' => 1,
                ));
    
                Alert::success("Adicionado");
                return redirect()->back();
             }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getCart($company)
    {
        try {
        $data = $this->getAcceptCompany($company);
        Session::put("companytoken", $data->companyhashtoken);
        
        $packges = pacote::where("company_id", $data->id)->first();

        Session::put('locationPrice',0);
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "https://kytutes.com/api/locations",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Authorization: {$data->companytokenapi}",
            "Content-Type: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $cartContent = Cart::getContent();
            $getTotal = Cart::getTotal();
            $getSubTotal = Cart::getSubTotal();
            $getTotalQuantity = Cart::getTotalQuantity();
            $location = Collect(json_decode($response,true));
            $result = ($getTotal * 14) / 100;
            $taxapb = $result + $getSubTotal;
            $color = Color::where("company_id", isset($data->id) ? $data->id : "")->first();

            return view("site.shopping.checkout.app",compact(
                'location',
                'cartContent',
                'getTotal',
                'getSubTotal',
                'getTotalQuantity',
                'result',
                'taxapb',
                'packges',
                'data',
                'color'
            ));
        }
        } catch (\Throwable $th) {
            Alert::error("Falha ao carregar dados");
            return redirect()->back();

        }
    }

    public function deliveryStatus()
    {
        $itensColletions = collect();
        $id = request('codereference');
        // Check for search input
        if ($id) {
            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
            ];
            
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");

            $itensColletions = collect(json_decode($response));
        } else {
            $itensColletions = collect();
        }

        return view("site.shopping.estado.app",
            compact("itensColletions") 
        );
    }
}