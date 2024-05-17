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
                                    <h6 class="m-0 font-weight-bold text-white">Minha Conta</h6>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body d-flex">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="">Nome de Utilizador</label>
                                        <input type="text" class="form-control" value="{{auth()->user()->name}}" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" value="{{auth()->user()->email}}" disabled>
                                    </div>

                                    <div class="from-group">
                                        <button class="btn btn-primary px-4" data-toggle="modal" data-target="#credential{{auth()->user()->id}}">Editar </button>
                                        @include("sbadmin.account.credential")
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