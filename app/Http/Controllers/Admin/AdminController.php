<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{About, Color, Detail,footer, Hero, service};
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //principal do panel admin
    public function index(){
        return view("sbadmin.home");
    }

    public function heroview(){
        $company_id = auth()->user()->company_id;
        $hero = hero::where("company_id", $company_id)->get();
        return view("sbadmin.section1", compact("hero"));
    }
 
    public function registerdatas(Request $request){
        try {
        $company_id = auth()->user()->company_id;
        $data = new hero();

        $data->title = $request->title;
        $data->description = $request->description;
        $data->company_id = $company_id;
       
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data->image = $profileImage;
        }

        $data->save();
        return redirect()->back()->with('success', 'Informações do Hero Registrados');
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Não é possivel");
        }
    }

    public function update(Request $request, $id){
        $data = hero::find($id);

        $data->title = $request->title;
        $data->description = $request->description;

        if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . "." . $extension;
            $file->move("image/", $filename);
            $data->image = $filename;
        }

        $data->update();
        return redirect()->back()->with("success", "Dados Actualizados");
    }

    //Imformações do footer Painel Admin
    public function footer(){
        $company_id = auth()->user()->company_id;

        $footer = footer::where("company_id", $company_id)->get();
        return view("sbadmin.footer", compact("footer"));
    }

    public function contactStore(Request $request){
        $company_id = auth()->user()->company_id;
        $data = new footer();

        $data->telefone = $request->telefone;
        $data->endereco = $request->endereco;
        $data->email = $request->email;
        $data->company_id = $company_id;

        $data->save();

        return redirect()->back()->with("success", "Footer Adicionado");
        
    }

    public function actualizarContact(Request $request, $id){
        footer::where(["id" => $id])->update([
            "telefone" => $request->telefone,
            "endereco" => $request->endereco,
            "email" => $request->email,
            "id" => $request->id,
        ]);
        return redirect()->back()->with("success", "Footer actualizado");
    }

    //Infromações sobre os detalhes
    public function detailview(){
        $company_id = auth()->user()->company_id;
        $skills = Detail::where("company_id", $company_id)->get();
        return view("sbadmin.skill", compact("skills"));
    }

    public function storeDetail(Request $request){
       
       $company_id = auth()->user()->company_id;
       $skills = new Detail();

       $skills->title = $request->title;
       $skills->description = $request->description;
       $skills->company_id = $company_id;

       if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . "." . $extension;
            $file->move("image/", $filename);
            $skills->image = $filename;
        }

       $skills->save();
       return redirect()->back()->with("success", "Skill adicionada");
    }
    
     public function actualizarDetalhes(Request $request, $id){
        $skills = Detail::find($id);

        $skills->title = $request->title;
        $skills->description = $request->description;
 
        if($request->hasFile("image")){
             $file = $request->file("image");
             $extension = $file->getClientOriginalExtension();
             $filename = date('YmdHis') . "." . $extension;
             $file->move("image/", $filename);
             $skills->image = $filename;
         }
         $skills->update();
         return redirect()->back()->with("success", "Skill actualizada");
     }

     //Imformações sobre o site OU Sobre
    public function about(){
        $company_id = auth()->user()->company_id;
        $data = About::where("company_id", $company_id)->get();
        return view("sbadmin.about", ["data" => $data]);
    }
    
    public function storeAbout(Request $request){
        $company_id = auth()->user()->company_id;
        $data = new About();

        $data->description = $request->description;
        $data->company_id = $company_id;

        if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis'). "." . $extension;
            $file->move("image/", $filename);
            $data->image = $filename;
        }

        $data->save();

        return redirect()->back();
    }

    public function actualizarAbout(Request $request, $id){
        $data = About::find($id);

        $data->description = $request->description;

        if($request->hasFile("image")){
            $file = $request->file("image");
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis'). "." . $extension;
            $file->move("image/", $filename);
            $data->image = $filename;
        }

        $data->update();
        return redirect()->back()->with("success", "Sobre Actualizado");
    }

    //services
    public function viewservice(){
        $company_id = auth()->user()->company_id;
        $data = Service::where("company_id", $company_id)->get();
        return view("sbadmin.service", compact("data"));
    }

    public function storeservice(Request $request){
        try {
            
            $company_id = auth()->user()->company_id;
            $services = new Service();

            $services->title = $request->title;
            $services->description = $request->description;
            $services->company_id = $company_id;

            $services->save();

            return redirect()->back()->with("success", "Serviço Cadastrado");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Noão é possivel");

        }
    }

    public function actualizarservice(Request $request, $id){
        Service::where(["id" => $id])->update([
            "title" => $request->title,
            "description" => $request->description,
            "id" => $request->id
        ]);

        return redirect()->back()->with("success" , "Serviço actualizado");
    }

    //Alteração de cores nos websites
    public function colorview(){
        $colors = Color::all();
        return view("sbadmin.color", compact("colors"));
    }

    public function storecolor(Request $request){
        try {
            $company_id = Auth()->user()->company_id;

            $countSelectColor = Color::where("company_id", $company_id)->first();

            if (isset($countSelectColor)) {
                $countSelectColor->codigo = $request->codigo;
                $countSelectColor->letra = $request->letra;
                $countSelectColor->company_id = $company_id;
                $countSelectColor->save();
            } else {
                $color = new Color();
                $color->codigo = $request->codigo;
                $color->letra = $request->letra;
                $color->company_id = $company_id;
                $color->save();
            }
            
            return redirect()->back()->with("success", "Cores adicionadas");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Não é possivel"); 
        }
    }

}