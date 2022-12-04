<div class="multisteps-form__panel border-radius-xl bg-white js-active" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Informações do Condomínio/Região</h5>
  <div class="multisteps-form__content">
    {{ csrf_field() }}
    @isset($area) <input type="hidden" name="area_id" value="{{ $area->id }}"> @endisset
    <div class="row mt-3">
      <div class="col-12">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->name ? 'is-filled':'' }}">
          <label for="area-name" class="form-label">Nome</label>
          <input
            class="multisteps-form__input form-control"
            type="text"
            name="name"
            id="area-name"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-1"
            data-error-message="Preencha o nome do Condomínio"
            value="{{ $area->name ?? '' }}"
            required
          />
        </div>
      </div>
      <div class="col-12 mt-3">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->description ? 'is-filled':'' }}">
          <label for="area-description" class="form-label">Descrição</label>
          <textarea
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            id="area-description"
            name="description"
            data-step="#step-1"
            data-error-message="Preencha a descrição do Condomínio"
          >{{ $area->description ?? '' }}</textarea>
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