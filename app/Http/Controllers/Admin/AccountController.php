<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        $account = Documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "CONTA")->get();
        return view("sbadmin.account.App", compact("account"));
    }

    public function updateProfile(Request $request){
        try {
           $credential = User::find($request->id);

           $credential->name = $request->name;
           $credential->email = $request->email;
           $credential->password = Hash::make($request->password);

           $credential->update();
           return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
