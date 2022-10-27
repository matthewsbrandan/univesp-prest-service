<div class="multisteps-form__panel border-radius-xl bg-white js-active" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Informações do Serviço</h5>
  <div class="multisteps-form__content">
    {{ csrf_field() }}
    <div class="row mt-3">
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
    <div class="button-row d-flex mt-4">
      <button
        class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
        type="button"
        title="Próximo"
      >Próximo</button>
    </div>
  </div>
</div>