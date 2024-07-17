<?php

namespace App\Livewire\Shopping;

use App\Models\company;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class Categories extends Component
{
    use LivewireAlert;
    public $category, $company, $categoria;

    public function render()
    {
        return view('livewire.shopping.categories',[
            'categories' => $this->getCategories(),
            'getCollectionsItens' => $this->getItems($this->category),
        ]);
    }

    public function getHeaders()
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "{$this->company->companytokenapi}",
        ];
    }

    //Pegar todas as categorias 
    public function getCategories()
    {
        try {
            $this->company = company::where("companyhashtoken", session("company"))->first();
    
            //Chamada a API
            $response = Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/categories");

            return json_decode($response, true);
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação'
            ]);
        }
    }

    public function getItems($category)
    {
        try {
            if ($category) {
                $this->category = $category;
                $response = Http::withHeaders($this->getHeaders())
                ->get("https://kytutes.com/api/items?category=$category");   
                return collect(json_decode($response,true));
            }else{
                $this->category = $category;
                $response = Http::withHeaders($this->getHeaders())
                ->get("https://kytutes.com/api/items");
                return collect(json_decode($response,true));   
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => false,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação'
            ]);
        }
    }
    
    //adicionar no carrinho
    public function addToCart($itemid)
    {
        try {
            $getItemCart = Http::withHeaders($this->getHeaders())
            ->get("https://kytutes.com/api/items?description=$itemid");

            $product = Collect(json_decode($getItemCart,true));
               
            Cart::add(array(
                'id' => $product[0]["reference"],
                'name' => $product[0]["name"],
                'price' => $product[0]["price"],
                'quantity' => 1,
            ));

            $this->alert('success', 'SUCESSO', [
                'toast'=>false,
                'position'=>'center',
                'timer' => '1500',
                'text'=>'Item '.$product[0]["name"].', adicionado'
            ]);
            return;
        } catch (\Throwable $th) {
            $this->alert('error', 'ERRO', [
                'toast'=>false,
                'position'=>'center',
                'showConfirmButton' => true,
                'confirmButtonText' => 'OK',
                'text'=>'Falha ao realizar operação'
            ]);
        }
    }
}