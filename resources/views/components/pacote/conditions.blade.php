<!-- Modal -->
<div class="modal fade" id="conditions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Termos e Condições da Entidade {{$name->companyname}}, NIF: {{$name->companynif}}</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-dark text-justify fs-6">{{isset($termos->condition) ? $termos->condition : ""}}</p>
        </div>
      </div>
    </div>
  </div>
  