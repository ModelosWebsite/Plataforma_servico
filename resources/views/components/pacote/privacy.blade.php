<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Politicas de Privacidades da Entidade {{$name->companyname}}, NIF: {{$name->companynif}}</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-dark text-justify fs-6">{{isset($termos->privacy) ? $termos->privacy : ""}}</p>
        </div>
      </div>
    </div>
  </div>
  