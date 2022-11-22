<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Selecione a Categoria</h5>
  <div class="multisteps-form__content">
    <div class="row" id="container-service-categories">
      <!-- TO-DO -->
      @foreach($categories as $category)
        <div
          class="col-md-6"
          id="service-category-{{ $category->slug }}"
          data-name="{{ $category->name }}"
          data-slug="{{ $category->slug }}"
          data-keywords="{{ implode(',',$category->keywords) }}"
        >
          @include('components.card.category',[
            'category' => $category
          ])
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