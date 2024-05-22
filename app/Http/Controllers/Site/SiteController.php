<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\{About, service, Color, company, Detail, footer, Hero, pacote, Termo};
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{
    //index ou pagina principal do site
    public function index($company){
        $data = company::where("companyhashtoken", $company)->first();
        if ($data  && $data->status === 'active') {
            $heroImage = Hero::where("company_id", isset($data->id) ? $data->id : "")->first();
            $texts = Hero::where("company_id", isset($data->id) ? $data->id : "")->get();
            $about = About::where("company_id", isset($data->id) ? $data->id : "")->get();
            $service = service::where("company_id", isset($data->id) ? $data->id : "")->get();
            $footer = footer::where("company_id", isset($data->id) ? $data->id : "")->get();
            $start = Detail::where("company_id", isset($data->id) ? $data->id : "")->get();
            $startImage = Detail::where("company_id", isset($data->id) ? $data->id : "")->first();
            $color = Color::where("company_id", isset($data->id) ? $data->id : "")->first();
            $pacotes = pacote::where("company_id", isset($data->id) ? $data->id : "")->first();
            $name = company::where("companyhashtoken", $company)->first();

            $phonenumber = footer::where("company_id", $data->id)->first();

            $termo = Termo::where("company_id", $data->id)->first();

            if ($termo && $termo->status === "active" && $termo->company_id == $data->id) {
                $termos = $termo;
            } else {
                $termos = Termo::where("company_id", 0)->first();
            }

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
                "pacotes" => $pacotes,
                "termos" => $termos,
                "name" => $name,
                "data" => $data,
            ]);
        } else {
            $companyname = company::where("companyhashtoken", $company)->first();
            return view("disable.App", compact("companyname"));
        }
    }

}
