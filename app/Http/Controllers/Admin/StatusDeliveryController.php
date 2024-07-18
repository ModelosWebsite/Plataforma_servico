<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class StatusDeliveryController extends Controller
{
    public function index()
    {
        $itensColletions = collect();
        $id = request('codereference');
        // Check for search input
        if ($id) {

            $headers = [
                "Accept" => "application/json",
                "Content-Type" => "application/json",
                "Authorization" => "Bearer 12|dm3tMWyRNdIiRMoaDovs4ReOSf94k3FpQhOtiHU2936a5b21",
            ];
            
            //Chamada a API
            $response = Http::withHeaders($headers)
            ->get("https://kytutes.com/api/deliveries?reference=$id");

            $itensColletions = collect(json_decode($response));
        } else {
            $itensColletions = collect();
        }

        return view("sbadmin.shooping.status.app",
            compact("itensColletions") 
        );
    }
}