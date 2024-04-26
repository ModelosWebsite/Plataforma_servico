@extends("layouts.Sbadmin")
@section("title", "Painel Admin - Hero")
@section("content")

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
                                <div class="col-xl-6">
                                    <h6 class="m-0 font-weight-bold text-white">Secção Start</h6>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                <div class="col-xl-6 {{count($skills) == 1 ? "d-none" : ""}}">
                                    <form action="{{route("admin.store.detail")}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label">Destaque</label>
                                            <input type="text" name="title" class="form-control" placeholder="Uma breve Frase ">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Descrição</label>
                                            <input type="text" name="description" class="form-control" placeholder="Uma breve descrição sobre a empresa">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Carregar uma Imagem</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Adicionar">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-xl-6 mt-4">
                                    <label class="form-label">Secção Start</label>
                                    @foreach ($skills as $item)
                                        <div class="form-group">
                                            <div class="form-group">
                                                <h5>{{$item->title}}</h5>
                                            </div>
                                            <div class="form-group">
                                                <h5>{{$item->description}}</h5>
                                            </div>
                                            <div class="form-group">
                                                <img width="200" src="{{url("image/$item->image")}}" alt="">
                                            </div>

                                            <div>
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$item->id}}">Editar</button>
                                                @include("sbadmin.includes.modal.skill")
                                            </div>
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
@endsection