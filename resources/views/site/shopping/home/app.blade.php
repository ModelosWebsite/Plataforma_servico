@extends("layouts.App")
@section("title", "Loja Online")
@section("content")
@include("components.color")

    <section id="menu" class="menu">

        <div class="section-header text-center" style="margin-top: 3rem">
          <h2>Nossos Produtos</h2>
        </div>

        <div class="container-fluid px-3 px-md-3 px-lg-4 tab-content" data-aos="fade-up" data-aos-delay="300">
          <div class="row gy-5">
            @if (isset($CollectionsProducts))
              @foreach($CollectionsProducts as $item)
              <div class="col-lg-4 menu-item text-center align-items-center mt-2 mb-2">
                {{-- @if ($item->imagem != null)
                  <img src="https://kytutes.com/storage/{{$item['imagem']}}" class="menu-img img-fluid" alt="{{$item['nome']}}">
                @else 
                @endif --}}
                <img src="{{asset("notfound.svg")}}" class="menu-img img-fluid" alt="Imagem não encontrada">
                <h4 style="font-size: 1.2rem;">{{$item['name']}}</h4>
        
                <p class="price">
                  {{number_format($item['price'], 2, ',', '.')}} kz 
                </p>
        
                <a data-id="{{$item['reference']}}" data-company="{{$data->companyhashtoken}}" class="btn btn-primary text-white">
                  Adicionar
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0"/>
                  </svg>
                </a>
              </div>
              @endforeach
            @endif
          </div>
        </div>
    </section>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        $(".btn-primary").click(function(event) {
            event.preventDefault();
            let company = $(event.currentTarget).data("company")
            let code  = $(event.currentTarget).data("id")
            $.ajax({
                type: "GET",
                url: "/loja/adicionar/"+company+"/"+code,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: "Sucesso",
                        showConfirmButton: false,
                        timer: 1000,
                        html: "Adicionado no Carrinho"
                    });
                },
            });
        });
    });
</script>

<a href="{{route("plataform.service.get.cart", ["company" => $data->companyhashtoken])}}" id="cartcout" style="color: #fff;background: var(--background);" class="cartcout d-flex align-items-center justify-content-center">      
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
  </svg>
</a>

<style>
  .cartcout {
  position: fixed;
  width: 60px;
  height: 60px;
  bottom: 140px;
  right: 40px;
  background-color: #fafafa;
  color: #FFF;
  border-radius: 50px;
  text-align: center;
  font-size: 30px;
  box-shadow: 1px 1px 2px #888;
  z-index: 1000;
}

.menu-item{
  width: 100px;
  height: 300px;
}

.menu-item .menu-img{
  width: 200px;
  height: 150px;
}
</style>
@endsection