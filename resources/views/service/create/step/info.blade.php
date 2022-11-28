<div class="multisteps-form__panel border-radius-xl bg-white js-active" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Informações do Serviço</h5>
  <div class="multisteps-form__content">
    {{ csrf_field() }}
    @isset($service) <input type="hidden" name="service_id" value="{{ $service->id }}"> @endisset
    <div class="row mt-3">
      <div class="col-md-5">
        <div class="d-flex justify-content-center align-items-center flex-column">
          <div
            class="text-muted d-flex justify-content-center align-items-center m-1"
            style="width: 20rem; max-width: 100%; height: 13rem;
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
      </div>
      <div class="col-md-7 ps-0 ps-md-2">
        <div class="row">
          <div class="col-12">
            <div class="input-group input-group-dynamic">
              <label for="service-name" class="form-label">Nome</label>
              <input
                class="multisteps-form__input form-control"
                type="text"
                name="name"
                id="service-name"
                onfocus="focused(this)"
                onfocusout="defocused(this)"
                data-step="#step-1"
                data-error-message="Preencha o nome do Condomínio"
                value="{{ $service->name ?? '' }}"
                required
              />
            </div>
          </div>
          <div class="col-12 mt-3">
            <div class="input-group input-group-dynamic">
              <label for="service-description" class="form-label">Descrição</label>
              <textarea
                class="multisteps-form__input form-control"
                onfocus="focused(this)"
                onfocusout="defocused(this)"
                id="service-description"
                name="description"
                data-step="#step-1"
                data-error-message="Preencha a descrição do Condomínio"
              >{{ $service->description ?? '' }}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="button-row d-flex mt-4">
      <button
        class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
        type="button"
        title="Próximo"
      >Próximo</button>
    </div>
  </div>
</div>