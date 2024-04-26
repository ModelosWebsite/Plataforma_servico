<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Meus Dados</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="">
                <form action="{{route("admin.update",$item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Titulo</label>
                        <input type="text" name="title" class="form-control" placeholder="Insira a informação..." value="{{$item->title}}">
                    </div>
    
                    <div class="form-group">
                        <label class="form-label">Descrição</label>
                        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="insira uma descrição....">{{$item->description}}</textarea>
                    </div>
    
                    <div class="col-lg-12 d-flex">
                        <div class="form-group col-lg-6 mt-3">
                            <label class="form-label">Fotografia</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group col-lg-6">
                            <img src="{{asset("image/$item->img")}}" alt="" style="width: 8rem; heigth: 8rem; border-radius: 100%;">
                        </div>
                    </div>
    
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  