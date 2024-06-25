<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\company;
use App\Models\Termpb;
use App\Models\Termpb_has_Company;
use App\Models\TermsCompany;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    //Cadastrar as conditions
    public function conditionsCreate(Request $request){
        try {
            $conditions = new TermsCompany();

            $conditions->privacity = $request->privacity;
            $conditions->term = $request->term;
            $conditions->company_id = auth()->user()->company_id;
            $conditions->save();

            if ($conditions) {
                return redirect()->back()->with("success", "Termo Criado");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Campos Vazios");
        }
    }
    
        public function termoStatus(Request $request)
        {            
            try {
                //code...
                $termPbs = Termpb::first();
                $termspb_has_company = new Termpb_has_Company();
                $termspb_has_company->company_id = auth()->user()->company_id;
                $termspb_has_company->termpb_id = $termPbs->id;
                $termspb_has_company->save();
    
                $company = company::find(auth()->user()->company_id);
                // Atualiza o estado baseado no valor do checkbox
                $company->status = $request->input('status') ? 'active' : 'inactive';
                $company->save();
    
                if ($company) {
                    return redirect()->back()->with("success", "Termo Criado");
                }
            } catch (\Throwable $th) {
                //throw $th;
            }   
        }
}
