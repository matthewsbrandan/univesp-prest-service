<!-- Modal -->
<div class="modal fade" id="modalFullScreen" tabindex="-1" role="dialog" aria-hidden="true">
  <style>
    #modalFullScreen .modal-body::-webkit-scrollbar{
      width: 0;
    }
  </style>
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content" style="background: transparent;border: 0;">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="
        background: #0024;
        border: none;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        margin: auto;
      " onclick="$('#modalFullScreen').modal('hide');"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<script>
  function callModalFullScreen(html){
    $('#modalFullScreen').modal('show');
    $('#modalFullScreen .modal-body').html(html);
  }
</script>