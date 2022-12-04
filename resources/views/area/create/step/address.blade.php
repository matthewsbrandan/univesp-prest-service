<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Endereço</h5>
  <div class="multisteps-form__content">
    <!-- ADDRESS: CODE | STREAT | NUMBER  -->
    <div class="row mx-0 mt-3">
      <div class="col-md-4 px-1">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->code ? 'is-filled' : '' }}">
          <label class="form-label" for="area-code">CEP</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            data-error-message="Preencha o CEP do Condomínio"
            maxlength="9"
            name="code" id="area-code"
            value="{{ $area->code ?? '' }}"
            required
          />
        </div>
      </div>
      <div class="col-md-6 px-1 mt-3 mt-md-0">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->street ? 'is-filled' : '' }}">
          <label class="form-label" for="area-streat">Logradouro</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            data-error-message="Preencha o nome do Logradouro/Rua"
            maxlength="191"
            name="street" id="area-street"
            value="{{ $area->street ?? '' }}"
            required
          />
        </div>
      </div>
      <div class="col-md-2 px-1 mt-3 mt-md-0">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->number ? 'is-filled' : '' }}">
          <label class="form-label" for="area-number">Número</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            maxlength="10"
            data-step="#step-2"
            name="number" id="area-number"
            value="{{ $area->number ?? '' }}"
          />
        </div>
      </div>
    </div>
    <!-- ADDRESS: DISTRICT | CITY | STATE -->
    <div class="row mx-0 mt-3">
      <div class="col-md-5 px-1">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->district ? 'is-filled' : '' }}">
          <label class="form-label" for="area-district">Bairro</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            data-error-message="Preencha o nome do Bairro"
            maxlength="191"
            name="district" id="area-district"
            value="{{ $area->district ?? '' }}"
            required
          />
        </div>
      </div>
      <div class="col-md-5 px-1 mt-3 mt-md-0">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->city ? 'is-filled' : '' }}">
          <label class="form-label" for="area-city">Cidade</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            data-error-message="Preencha o nome da Cidade"
            maxlength="191"
            name="city" id="area-city"
            value="{{ $area->city ?? '' }}"
            required
          />
        </div>
      </div>
      <div class="col-md-2 px-1 mt-3 mt-md-0">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->state ? 'is-filled' : '' }}">
          <label class="form-label" for="area-state">Estado</label>
          <input
            type="text"
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            data-error-message="Preencha a sigla do Estado com 2 caracteres"
            maxlength="2"
            name="state" id="area-state"
            value="{{ $area->state ?? '' }}"
            required
          />
        </div>
      </div>
    </div>
    <!-- ADDRESS: COMPLEMENT -->
    <div class="row mx-0 mt-3">
      <div class="col-12 px-1">
        <div class="input-group input-group-dynamic {{ isset($area) && $area->complement ? 'is-filled' : '' }}">
          <label class="form-label" for="area-complement">Complemento (opcional)</label>
          <textarea
            class="multisteps-form__input form-control"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
            data-step="#step-2"
            name="complement" id="area-complement"
          >{{ $area->complement ?? '' }}</textarea>
          
        </div>
      </div>
    </div>

    <div class="button-row d-flex mt-5">
      <button
        class="btn bg-gradient-light mb-0 js-btn-prev"
        type="button" title="Anterior"
      >Anterior</button>
      <button
        class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
        type="button" title="Próximo"
      >Próximo</button>
    </div>
  </div>
</div>