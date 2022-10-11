<!-- Modal -->
<div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="modal-message-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="modal-message-title"></h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
  <script>
    function showMessage(message, title = `{{ config('app.name') }}`, timeout = false){
      $('#modal-message .modal-title').html(title);
      $('#modal-message .modal-body .message').html(message).addClass('text-center');
      $('#modal-message').modal('show');
  
      if(timeout) setTimeout(() => $('#modal-message').modal('hide'), 5000);
    }
  </script>
</div>