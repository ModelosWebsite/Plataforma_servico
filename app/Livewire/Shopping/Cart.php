<?php

namespace App\Livewire\Shopping;

use App\Models\company;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Cart extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $number = 0, $localizacao, $cartContent, $getTotal, $getSubTotal,
    $getTotalQuantity, $location, $cupon, $taxapb = 0, $finalCompra,
    $totalFinal = 0, $code, $delveryId;

    //propriedades de checkout
    public $name, $lastname, $province, $municipality, $street, $phone, $otherPhone,
    $email, $deliveryPrice =0, $paymentType ="Trasnferencia",  $taxPayer,$receipt,$otherAddress;
    public $company;

    protected $listeners = ["updateQuantity"];

    public function render()
    {
        try {
            $this->cartContent = CartFacade::getContent();
            $this->getTotal = CartFacade::getTotal();
            $this->getSubTotal = CartFacade::getSubTotal();
            $this->getTotalQuantity = CartFacade::getTotalQuantity();
            $this->finalCompra = $this->getSubTotal + $this->localizacao;
            $this->taxapb = ($this->finalCompra * 14) / 100;
            $this->totalFinal = $this->finalCompra + $this->taxapb;
            return view('livewire.shopping.cart', [
                "locations"=>$this->getAllLocations()
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAllLocations()
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://kytutes.com/api/locations",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => [
                  "Accept: application/json",
                  "Authorization: Bearer 2|KLgAGFkyGxcwcMQIg1GAPPPBvR64BwtRxw9oTWsRd9fee9ee",
                  "Content-Type: application/json"
                ],
            ]);              

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                return Collect(json_decode($response, true));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function selectLocation($price)
    {
        $this->localizacao = $price;
    }

    //logica para aplicar cupon de desconto
    public function cuponDiscount()
    {   
        //Acesso a API com um token
        $headers = [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => $this->apitoken,
        ];
        
        $response = Http::withHeaders($headers)
        ->post("https://kytutes.com/api/cupons",[
            "code"=>$this->code,
            "total"=>$this->totalFinal,
        ]);
        $cupon = collect(json_decode($response));
          
        if (isset($cupon['discount'])) {
            session()->put('discountvalue',$cupon['discount']);
            $this->code = "";
        }
    }
    
    public function checkout($company)
    {
        try {
                $dataCompany = company::where("companyhashtoken", $company)->firstOrFail();
                //manipulacao de arquivo;
                $filaName = null;
                if ($this->receipt != null and !is_string($this->receipt)) {
                    $filaName = md5($this->receipt->getClientOriginalName())
                                .".".$this->receipt->getClientOriginalExtension();
                    $this->receipt->storeAs("public/recibos",$filaName);
                }
        
                //Acesso a API com um token
                $items = [];
                if (count(CartFacade::getContent()) > 0) {
                    foreach(CartFacade::getContent() as $key => $item) {
                    array_push($items,[
                            "name"=>$item->name,
                            "price"=>$item->price,
                            "quantity"=>$item->quantity,
                    ]);
                    }
                }
            
                $headers = [
                    "Accept" => "application/json",
                    "Content-Type" => "application/json",
                    "Authorization" => $dataCompany->companytokenapi,
                ];
        
                $data = [
                    "clientName" => $this->name,
                    "clientLastName" => $this->lastname,
                    "province" => $this->province,
                    "municipality" => $this->municipality,
                    "street" => $this->street,
                    "cupon" => "",
                    "deliveryPrice" => 0,
                    "phone" => $this->phone,
                    "otherPhone" => $this->otherPhone,
                    "email" => $this->email,
                    "taxPayer" => $this->taxPayer,
                    "receipt" => $filaName,
                    "paymentType" => $this->paymentType,
                    "items" => $items,
                ];
        
                //Chamada a API
                $response = Http::withHeaders($headers)
                ->post("https://kytutes.com/api/deliveries",$data);

                $result  = collect(json_decode($response));
                if ($result) {
                    session()->put("idDelivery", $result['reference']);
                    session()->put("companyapi", $dataCompany->companyhashtoken);
                }

                $this->alert('success', 'Encomenda Finalizada');
            
                return redirect()->route("plataform.service.delivery.status",[
                    $result['reference']
                ]);
        } catch (\Throwable $th) {
                $this->alert("error", "Falha na encomenda");
        }
    }

    public function remove($id)
    {
        try {
            $itenDelete = CartFacade::remove($id);
            $this->alert("success", "Item eliminado");
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateQuantity($id, $quantity)
    {
        CartFacade::update($id, [
            'quantity' => 1,
        ]);
    }
}