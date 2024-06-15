<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-5" id="exampleModalLabel">Cadastro de Empresa</h3>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route("super.admin.register.company")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nome da Empresa</label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Insira o nome da empresa...">
                    @error('name') <span>{{ $message }}</span> @enderror
                </div>
                

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" value="{{old("email")}}" name="email" class="form-control" placeholder="Insira o email...">
                    @error("email") <span> {{ $message}} </span>  @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">NIF</label>
                    <input type="text" value="{{old("nif")}}" name="nif" class="form-control" placeholder="Insira o nif...">
                    @error("nif") <span> {{ $message}} </span>  @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tipo de Negócio</label>
                    <input type="text" name="type" class="form-control" placeholder="Insira o tipo de negócio...">
                </div>

                <div class="form-group">
                    <label class="form-label">Token Loja Online</label>
                    <input type="text" name="apitoken" class="form-control" placeholder="Insira o token de acesso da loja online...">
                </div>

                <div class="form-group">
                    <label class="form-label">Carregar Logotipo</label>
                    <input type="file" name="logotipo" class="form-control">
                </div>
            
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>