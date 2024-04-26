<section class="slider_section" id="slider_section" style="margin-top: 4.80rem;">
    <div class="slider_bg_box">
      <img src="{{url(isset($heroImage->image) ? "image/$heroImage->image" : "")}}" alt="">
    </div>
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        @foreach ($texts as $item)
        <div class="carousel-item active">
          <div class="container-fluid px-3 px-md-3 px-lg-4">
            <div class="row">
              <div class="col-md-7 ">
                <div class="detail-box">
                  <h1>
                    {{$item->title}}
                  </h1>
                  <p>
                    {{$item->description}}
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Solicitar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

  </section>