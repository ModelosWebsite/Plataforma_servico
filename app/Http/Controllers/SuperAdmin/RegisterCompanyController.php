<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\{company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterCompanyController extends Controller
{
    public function companyRegister(Request $request) {
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,companyemail',
            'nif' => 'required|string|unique:companies,companynif',
            'type' => 'required|string',
        ]);
    
        DB::beginTransaction();
        try {
            // Create token for company
            $tokenCompany = $validatedData['name']. rand(2000, 3000);
    
            $company = new Company();
            $company->companyname = $validatedData['name'];
            $company->companyemail = $validatedData['email'];
            $company->companynif = $validatedData['nif'];
            $company->companybusiness = $validatedData['type'];
            $company->companyhashtoken = $tokenCompany;
            $company->save();
    
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make('f0rtc0d3'); 
            $user->role = "Administrador";
            $user->company_id = $company->id;
            $user->save();
    
            DB::commit();
    
            return redirect()->back()->with("success", "Empresa Adicionada");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", "Erro ao adicionar empresa: " . $th->getMessage());
        }
    }
    
}
