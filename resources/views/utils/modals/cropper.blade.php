<style>
  #sample_image{
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    margin: auto;
  }
</style>
<!-- BEGIN: MODAL CROPPER -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cortar Imagem</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-5">
        <img id="sample_image" src=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-primary js-main-image">Salvar</button>
        <button 
          type="button"
          class="btn bg-gradient-light"
          data-bs-dismiss="modal" aria-label="Close"
        >Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- END: MODAL CROPPER -->