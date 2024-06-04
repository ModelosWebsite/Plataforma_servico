@extends("layouts.Sbadmin")
@section("title", "Painel Admin - Elementos Premium")
@section("content")
@include("sweetalert::alert")
    {{-- side bar --}}
    @include("sbadmin.includes.sidebar")

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include("sbadmin.includes.topbar")

            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header bg-primary py-3 flex-row align-items-center justify-content-between col-xl-12">
                                <div class="col-xl-12 d-flex justify-content-between">
                                    <div>
                                        <h6 class="m-0 font-weight-bold text-white">Elementos Premium</h6>
                                    </div>
                                    {{-- <div>
                                        <svg data-toggle="modal" data-target="#exampleModal" style="color: #fff; cursor: pointer;" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                        </svg>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="container-fluid tab-content" data-aos="fade-up" data-aos-delay="300">
            
                                    <div class="row gy-5">
                                    @foreach($data as $item)          
                                    <div class="col-lg-4 menu-item text-center align-items-center mt-2 mb-2">
                                      @if ($item['imagem'] != null)
                                        <img src="https://kytutes.com/storage/{{$item['imagem']}}" class="menu-img img-fluid" alt="">
                                      @else 
                                        <img src="{{asset("notfound.png")}}" class="menu-img img-fluid" alt="">
                                      @endif
                                      <h4 style="font-size: 1.2rem;">{{$item['nome']}}</h4>
                        
                                      <p class="price">
                                        kz {{number_format($item['preco'], 2,'.',',')}} 
                                      </p>
                        
                                      <a href="{{route("loja.add.cart", $item['reference'])}}" class="btn btn-primary">
                                          Adicionar
                                          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0"/>
                                          </svg> 
                                      </a>                  
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{route("loja.get.cart.total")}}" style="color: #fff;background: #4E73DF;" class="cartcout d-flex align-items-center justify-content-center">      
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
              <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
            </svg>
        </a>
    <style>
        .cartcout {
            position: fixed;
            right: 70px;
            bottom: 50px;
            z-index: 99999;
            width: 60px;
            height: 60px;
            border-radius: 50px;
            transition: all 0.4s;
          }
    </style>
    </div>
@endsection