@php
  if(!isset($card_category_style)) $card_category_style = (object)[];
  if(!isset($card_category_style->container_class)) $card_category_style->container_class = null;
  if(!isset($card_category_style->text_class)) $card_category_style->text_class = null;
  if(!isset($card_category_style->button_class)) $card_category_style->button_class = null;
@endphp
<div class="{{ $card_category_style->container_class ?? 'info-horizontal bg-light shadow border-radius-xl py-5 px-4' }}">
  <div class="icon" style="width: 4rem;">
    <img class="w-100 border-radius-lg" src="{{ $category->image }}" alt="{{ $category->name }}"/>
  </div>
  <div class="description ps-3">
    <h5 class="{{ $card_category_style->text_class ?? '' }}">{{ $category->name }}</h5>
    <p class="{{ $card_category_style->text_class ?? '' }}">{{ $category->description }}</p>
    @if(isset($mode) && $mode == 'admin')
      <a
        href="{{ route('admin.service_category.edit',['slug' => $category->slug]) }}"
        class="{{ $card_category_style->button_class ?? 'font-weight-bold' }} icon-move-right"
      >
        Editar
        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
      </a>
    @else
      <a
        href="{{ route('service_category.show',['slug' => $category->slug]) }}"
        class="{{ $card_category_style->button_class ?? 'font-weight-bold' }} icon-move-right"
        target="_blank"
      >
        Ver mais
        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
      </a>
    @endif
  </div>
</div>