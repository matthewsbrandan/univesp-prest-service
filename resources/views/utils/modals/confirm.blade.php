<div 
  class="modal fade" 
  id="modalConfirm" 
  tabindex="-1" 
  role="dialog" 
  aria-hidden="true"
  style="z-index: 1052;"
>
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja continuar?</p>
      </div>
      <div class="modal-footer">
        <a href="javascript:;" class="btn bg-gradient-primary">Sim</a>
        <button type="button" class="btn btn-link text-dark ml-auto" data-bs-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
<script>
  function callModalConfirm(message = "Tem certeza que deseja continuar?", href = "javascript:;"){
    $('#modalConfirm .modal-body > p').html(message);
    $('#modalConfirm .modal-footer .bg-gradient-primary').attr('href',href);
    $('#modalConfirm').modal('show');
  }
</script>