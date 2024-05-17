<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\company;
use App\Models\Documentation;
use App\Models\documentation_info;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DocumentationController extends Controller
{
    //open the page view config
    public function configView(){
        $config = Documentation::where("panel", "PAINEL DO ADMINISTRADOR")
        ->where("section", "CONFIGURAÇÕES")->get();
        $company_id = auth()->user()->company_id;
        // $termos = Termo::where("company_id", isset($company_id) ? $company_id : "")->first();
        $statusSite = company::where("id", $company_id)->first();
        return view("site.Config", compact("statusSite", "termos", "config"));
    }

    public function updateStatus(Request $request)
    {
        $company_id = auth()->user()->company_id;
        $item = company::find($company_id);
        
        // Atualiza o estado baseado no valor do checkbox
        $item->status = $request->input('status') ? 'active' : 'inactive';
        $item->save();
        
        return redirect()->back()->with('success', 'Estado atualizado com sucesso!');
    }

    public function index(){
        $documentations = Documentation::all();
        return view("superadmin.documentation.App", compact("documentations"));
    }

    public function store(Request $request){
        try {
            //code...
            $documentation = new Documentation();
            $documentation->panel = $request->painel;
            $documentation->section = $request->section;
            $documentation->action = $request->action;
            $documentation->save();

            $documentation_info = new Documentation_info();
            $documentation_info->description = $request->description;
            $documentation_info->documentation_id = $documentation->id;
            $documentation_info->save();

            Alert::success("Documentação criada");
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
