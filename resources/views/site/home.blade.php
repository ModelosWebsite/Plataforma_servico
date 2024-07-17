@extends("layouts.App")
@section("title", "Pagina Inicial do site")
@section("content")
@include("components.color")

  <!-- Button trigger modal termos de cprivacidades e condições-->
  @include("components.pacote.privacy")
  @include("components.pacote.conditions")


  @if ($WhatsApp && $WhatsApp->pacote === "WhatsApp" && $WhatsApp->status === "premium")
    @include("components.pacote.whatsaApp")
  @endif


  <!-- about section -->
    <section class="about_section layout_padding-bottom mt-5" id="about">
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        @foreach ($about as $item)
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                   Sobre a Empresa
                </h2>
              </div>
              <p>
                {{ $item->description}}
              </p>
            </div>
          </div>
          <div class="col-md-6 ">
            <div class="img-box">
              <img src="{{url("image/$item->image")}}" alt="">
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>
  <!-- end about section -->

  <div class="container-fluid px-3 px-md-3 px-lg-4">
    <div class="position-relative">
      <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach ($apiArray as $anuncio)
          <div class="carousel-item active">
              @if ($anuncio["tipo"] === "Horizontal")
                <a href="{{$anuncio["link"] ?? NULL}}" target="_blank">
                  <div style="width: 100%">
                    <img src="{{url("{$anuncio["image_full_url"]}")  ?? NULL}}" alt="" style="width:100%">
                    <div style="position: absolute; top:5px; width:10px; height: 10px; right:28px;"><i class="bi bi-info-circle-fill cursor-pointer" style="color: #ffffff" title="Está Publicidade é de inteira responsabilidade da Fort-Code"></i></div>
                  </div>
                </a>
              @endif
            </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>

  <!-- service section -->
  <section class="service_section layout_padding" id="service">
    <div class="service_container">
      <div class="container-fluid px-3 px-md-3 px-lg-4">
        <div class="heading_container">
          <h2>
             Nossos <span>Serviços</span>
          </h2>
        </div>
        <div class="row">
          @foreach ($service as $item)
          <div class="col-md-6">
            <div class="box">
              <div class="img-box">
                <img src="{{url("site/images/service.svg")}}" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  {{$item->title}}
                </h5>
                <p>
                  {{$item->description}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  <!-- end service section -->
  <!-- track section -->
  <section class="track_section layout_padding" id="start">
    <div class="track_bg_box">
      <img src="{{url(isset($startImage->image) ? "image/$startImage->image" : "")}}" alt="">
    </div>
    <div class="container-fluid px-3 px-md-3 px-lg-4">
      <div class="row">
        @foreach ($start as $item)
          
        <div class="col-md-6">
          <div class="heading_container">
            <h2>
              {{$item->title}}  
            </h2>
          </div>
          <p>
            {{$item->description}}
          </p>
          {{-- <form action="">
            <input type="text" placeholder="Inscreva-se o seu email para mais novidades" />
            <button type="submit">
              Enviar
            </button>
          </form> --}}
        </div>
        @endforeach

      </div>
    </div>
  </section>
  <!-- end track section -->

  <!-- contact section -->
  <section class="contact_section mt-5" id="contact">
    <div class="container-fluid px-3 px-md-3 px-lg-4">
      <div class="row">
        <div class="container-fluid px-3 px-md-3 px-lg-4">
          <div class="position-relative">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach ($apiArray as $anuncio)
                <div class="carousel-item active">
                    @if ($anuncio["tipo"] === "Horizontal")
                      <a href="{{$anuncio["link"] ?? NULL}}" target="_blank">
                        <div>
                          <img src="{{url("{$anuncio["image_full_url"]}")  ?? NULL}}" alt="" width="100%">
                          <div style="position: absolute; top:5px; width:10px; height: 10px; right:28px;"><i class="bi bi-info-circle-fill cursor-pointer" style="color: #ffffff" title="Está Publicidade é de inteira responsabilidade da Fort-Code"></i></div>
                        </div>
                      </a>
                    @endif
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- info section -->
  <section class="info_section layout_padding2" id="bgfooter">
    <div class="container-fluid px-3 px-md-3 px-lg-4">
      <div class="row">
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_contact">
            <h4>
              Contactos
            </h4>
            @foreach ($footer as $item)
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  {{$item->endereco}}
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  +244 {{$item->telefone}}
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  {{$item->email}}
                </span>
              </a>
            </div>
            @endforeach

          </div>
          {{-- <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div> --}}
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            @foreach ($texts as $item)
              <p>
                {{$item->title}}
              </p>
            @endforeach
            <a type="button" class="text-white" data-toggle="modal" data-target="#exampleModal">
              Politicas de Privacidade |  
            </a>
            <a type="button" class="text-white" data-toggle="modal" data-target="#conditions">
              Termos e Condições  
            </a>
          </div>
        </div>
        <div class="col-md-6 col-lg-2 mx-auto info_col">
          <div class="info_link_box">
            <h4>
              Links
            </h4>
            <div class="info_links">
              <a class="active" href="#home">
                Home
              </a>
              <a class="" href="#about">
                Sobre
              </a>
              <a class="" href="#service">
                Serviços
              </a>
              <a class="" href="#contact">
                Contactos
              </a>
              <a class="" href="{{route("anuncio.login.view")}}">
                Login
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 info_col">
          <div class="position-relative">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach ($apiArray as $anuncio)
                <div class="carousel-item active">
                    @if ($anuncio["tipo"] === "Quadrado")
                      <a href="{{$anuncio["link"] ?? NULL}}" target="_blank">
                        <div >
                          <img src="{{url("{$anuncio["image_full_url"]}")  ?? NULL}}" style="width: 100%;">
                          <div style="position: absolute; top:1px; width:10px; height: 10px; right:15px;"><i class="bi bi-info-circle-fill cursor-pointer" style="color: #ffffff" title="Está Publicidade é de inteira responsabilidade da Fort-Code"></i></div>
                        </div>
                      </a>
                    @endif
                  </div>
                  @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end info section -->
@endsection