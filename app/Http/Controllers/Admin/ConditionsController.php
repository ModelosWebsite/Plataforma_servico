<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Termo;
use Illuminate\Http\Request;

class ConditionsController extends Controller
{
    //Cadastrar as conditions
        public function conditionsCreate(Request $request){
            try {
    
                $company_id = auth()->user()->company_id;
                $conditions = new Termo();
    
                $conditions->privacy = $request->privacy;
                $conditions->condition = $request->condition;
                $conditions->company_id = $company_id;
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
            $company_id = auth()->user()->company_id;
            $item = Termo::where("company_id", $company_id)->first();
            // Atualiza o estado baseado no valor do checkbox
            $item->status = $request->input('status') ? 'active' : 'inactive';
            $item->save();
            
            return redirect()->back()->with('success', 'Estado atualizado com sucesso!');
        }
}
