<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <h5 class="font-weight-bolder pt-1">Selecione a Categoria</h5>
  <div class="multisteps-form__content">
    <div class="row" id="container-service-categories">
      <!-- TO-DO -->
      @foreach($categories as $category)
        <div
          class="col-md-6 service-category-item"
          id="service-category-{{ $category->slug }}"
          data-name="{{ $category->name }}"
          data-slug="{{ $category->slug }}"
          data-keywords="{{ implode(',',$category->keywords) }}"
          onclick="handleSelectCategory($(this), '{{ $category->id }}')"
        >
          @include('components.card.category',[
            'category' => $category
          ])
        </div>
      @endforeach
      <input
        type="hidden"
        name="service_category_id"
        id="category_id"
        data-step="2"
        data-message="Selecione uma categoria"
        required
      />
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