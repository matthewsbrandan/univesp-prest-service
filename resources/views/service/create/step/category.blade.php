<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Selecione a Categoria</h5>
  <div class="multisteps-form__content">
    <div class="row" id="container-service-categories">
      <!-- TO-DO -->
      @foreach($categories as $category)
        <div
          class="col-lg-4 col-md-6"
          id="service-category-{{ $category->slug }}"
          data-name="{{ $category->name }}"
          data-slug="{{ $category->slug }}"
          data-keywords="{{ $category->keywords }}"
        >
          <div class="info-horizontal bg-gradient-primary border-radius-xl p-5">
            <div class="icon">
              <img src="{{ $category->image_formatted }}"/>
            </div>
            <div class="description ps-5">
              <h5 class="text-white">{{ $category->name }}</h5>
              <p class="text-white">{{ $category->description }}</p>
              <a href="javascript:;" class="text-white icon-move-right">
                Mais sobre a categoria
                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
      
      <!-- 
        -- CATEGORIES
        'service_category_id'
      -->
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