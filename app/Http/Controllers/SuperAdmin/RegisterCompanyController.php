<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\{company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterCompanyController extends Controller
{

    //criar a conta de cada portfolio
    public function accountView(){
        $companies = company::all();
        return view("superadmin.company.account", ["companies" => $companies]);
    }

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
            
            if ($image = $request->file('logotipo')) {
                $destinationPath = 'image/';
                $profileImage = rand(2000, 3000) . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $company->logotipo = $profileImage;
            }
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

    public function updateCompany(Request $request){
        // Validation
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,companyemail',
            'nif' => 'required|string|unique:companies,companynif',
            'type' => 'required|string',
        ]);
    
        DB::beginTransaction();
        try {
    
            $company = company::find($request->id);
            $company->companyname = $validatedData['name'];
            $company->companyemail = $validatedData['email'];
            $company->companynif = $validatedData['nif'];
            $company->companybusiness = $validatedData['type'];
            if ($image = $request->file('image')) {
                $destinationPath = 'image/';
                $profileImage = rand(2000, 3000) . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $company->logotipo = $profileImage;
            }
            $company->update();
    
            DB::commit();
    
            return redirect()->back()->with("success", "Empresa Adicionada");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", "Erro ao adicionar empresa: ");
        }
    }

    public function deleteCompany($id){
        company::find($id)->delete();
        return redirect()->back();
    }
    
}
