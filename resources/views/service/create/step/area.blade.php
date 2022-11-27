<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <style>
    .area-item.bg-gradient-primary{ padding: .5rem; }
    .area-item.bg-gradient-primary h5,
    .area-item.bg-gradient-primary p{ color: white; }
  </style>
  <h5 class="font-weight-bolder pt-1 mb-0">Condomínios</h5>
  <p class="text-sm mb-4">Selecione o(s) codomínio(s) que você atende.</p>
  <div class="multisteps-form__content">
    <div class="row">
      @foreach($areas as $area)
        <div class="col-md-6 mb-2">
          <div
            class="card card-blog card-plain area-item"
            id="{{ $area->id }}"
            onclick="handleSelectArea($(this), '{{ $area->id }}')"
          >
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="{{ $area->image_formatted }}"
                  alt="{{ $area->slug }}" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url({{ $area->image_formatted }});">
              </div>
            </div>
            <div class="card-body px-1 pt-3 pb-0">
              <p class="text-gradient text-dark mb-2 text-sm">
                CEP: {{ $area->code }}
              </p>
              <h5>{{ $area->name }}</h5>
            </div>
          </div>
        </div>
      @endforeach
      <input
        type="hidden"
        name="area_ids"
        id="service_area_id"
        data-step="2"
        data-message="Selecione pelo menos um condominio"
        required
        />
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