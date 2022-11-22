<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <style>
    #container-add-image .overlay{
      position: absolute;
      top: 0; left: 0;
      bottom: 0; right: 0;
      z-index: 1;

      background: #ddea;
      border-radius: 1rem;

      height: 100%;
      width: 100%;
      opacity: 0;

      transition: .6s;
    }
    #container-add-image:hover .overlay{ opacity: 1; }
  </style>
  <h5 class="font-weight-bolder pt-1">Imagem</h5>
  <div class="multisteps-form__content">
    <div class="d-flex justify-content-center align-items-center flex-column">
      <div
        class="text-muted d-flex justify-content-center align-items-center m-1"
        style="width: 20rem; height: 13rem;
        position: relative;"
        onclick="$('#modalGallery').modal('show');"
        id="container-add-image"
      >
        <img
          src="{{ isset($service) ? $service->image : asset('images/solid-color-pale-blue.jpg') }}"
          style="
            width: 100%;
            height: 13rem;
            object-fit: cover;
            border: 2px dotted #dde;
          "
          class="border-radius-lg"
          id="uploaded_image"
        />
        <input type="file" name="image" class="image" id="upload_image" style="display:none" />
        <input
          type="hidden"
          name="image_name"
          id="image_name"
          value="{{ isset($service) ? $service->getImageWithoutAsset('') : '' }}"
        />

        <div class="overlay">
          <div
            class="d-flex align-items-center justify-content-center h-100"
            style="padding: 1.5rem;"
          >
            <img 
              class="w-20 position-relative z-index-2" 
              src="{{ asset('images/add-img-icon-light.png') }}" 
              alt="Clique para adicionar imagem" 
            />
          </div>
        </div>
      </div>
    </div>

    <div class="button-row d-flex mt-5">
      <button
        class="btn bg-gradient-light mb-0 js-btn-prev"
        type="button" title="Anterior"
      >Anterior</button>
      <button
        class="btn bg-gradient-dark ms-auto mb-0"
        type="submit" title="Próximo"
      >Salvar</button>
    </div>
  </div>
</div>