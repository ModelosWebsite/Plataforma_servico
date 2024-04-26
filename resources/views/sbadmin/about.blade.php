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
                                    <h6 class="m-0 font-weight-bold text-white">Dados Historicos da Empresa</h6>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                <div class="col-xl-12">
                                        <div class="{{count($data) == 1 ? "d-none" : ""}}">
                                            <form action="{{route("admin.store.about")}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="d-flex justify-content-between">
                                                    <div class="form-group col-xl-6">
                                                        <label class="form-label">Carregar uma Imagem</label>
                                                        <input type="file" class="form-control" name="image">
                                                    </div>

                                                    <div class="form-group col-xl-6">
                                                        <label class="form-label">Breve descrição sobre a empresa</label>
                                                        <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Insira uma breve Descrição..."></textarea>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" value="Cadastrar" class="btn btn-primary">
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-xl-6">
                                            @foreach ($data as $item)
                                                <div class="form-group">
                                                    <label class="form-label">Descrição</label>
                                                    <h5>{{$item->description}}</h5>
                                                </div>

                                                <div class="form-group">
                                                    <img width="100" src="{{url("image",$item->image)}}" alt="">
                                                </div>

                                                <div class="form-group">
                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$item->id}}">Editar</a>                                         
                                                    @include("sbadmin.includes.modal.about")
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
        </div>
    </div>
@endsection