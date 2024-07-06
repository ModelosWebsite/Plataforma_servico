<div class="hero_area" id="home" style="{{(Route::Current()->getName() == 'site.index') ? 'min-height: 100vh !important;':'min-height: 0vh !important;'}}">
    <!-- header section strats -->
    <header class="header_section fixed-top">
      <div class="header_bottom">
        <div class="container-fluid px-3 px-md-3 px-lg-4">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ route("site.index", ["company" => $data->companyhashtoken]) }}">
              @if ($data->logotipo != null)
                <img width="50rem" src="{{asset("image/$data->logotipo")}}" alt="">
              @else
                <span>
                  {{isset($data->companyname) ? $data->companyname : ""}}
                </span>
              @endif
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route("site.index", ["company" => $data->companyhashtoken]) }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route("site.index", ["company" => $data->companyhashtoken]) }}#about"> Sobre</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route("site.index", ["company" => $data->companyhashtoken]) }}#service">Serviços</a>
                </li>
                @if ($packges && $packges->pacote === "Shopping" && $packges->status === "premium")
                  <li class="nav-item">
                    <a class="nav-link" href="{{route("platafom.service.product.list", ["company" => $data->companyhashtoken])}}">Loja</a>
                  </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="{{ route("site.index", ["company" => $data->companyhashtoken]) }}#contact">Contacto </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->

    @if ((Route::Current()->getName() == 'site.index'))
      @include("components.slider")
    @endif
    
    <!-- end slider section -->
  </div>