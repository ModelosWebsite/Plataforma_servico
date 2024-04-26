<div class="hero_area" id="home">
    <!-- header section strats -->
    <header class="header_section fixed-top">
      <div class="header_bottom">
        <div class="container-fluid px-3 px-md-3 px-lg-4">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="">
              <span>
                {{isset($data->companyname) ? $data->companyname : ""}}
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#about"> Sobre</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#service">Serviços</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contact">Contacto </a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->

    <!-- slider section -->
    @include("components.slider")
    <!-- end slider section -->
  </div>