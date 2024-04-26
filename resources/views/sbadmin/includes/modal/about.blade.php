<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Dados Historicos</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.about.update", $item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="form-group">
                            <label class="form-label">Carregar uma Imagem</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Breve descrição sobre a empresa</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Insira uma breve Descrição...">{{$item->description}}</textarea>
                        </div>
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
  