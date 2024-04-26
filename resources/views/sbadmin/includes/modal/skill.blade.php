<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar ´Secção Start</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.detalhes.update", $item->id)}}" method="post" enctype="multipart/form-data">
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
                        <input type="submit" value="Actualizar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>