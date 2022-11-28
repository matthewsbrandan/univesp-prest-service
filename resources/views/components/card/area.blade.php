@once
  @php
    function handlePlural($value, $sigular, $plural){ return $value == 1 ? $sigular : $plural; }
  @endphp
@endonce
<div class="col-lg-4 col-md-6">
  <div class="card card-blog card-plain">
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
    <div class="card-body px-1 pt-3">
      <p class="text-gradient text-dark mb-2 text-sm">
        {{ $area->num_services . handlePlural($area->num_services, ' serviço', ' serviços') }} • 
        {{ $area->countCategoriesIncluded() . handlePlural($area->countCategoriesIncluded(), ' categoria', ' categorias') }}
      </p>
      <a href="{{ route('area.show',['slug' => $area->slug]) }}">
        <h5>{{ $area->name }}</h5>
      </a>
      <p>{{ $area->description }}</p>
      @if(!auth()->user() || !$area->iAmVinculed())
        <a
          href="{{ route('area.show',['slug' => $area->slug]) }}"
          class="btn btn-outline-primary btn-sm"
        >Saber Mais</a>
      @elseif($area->id != auth()->user()->active_area_id)
        <a
          href="{{ route('user_area.store',['id' => $area->id]) }}"
          class="btn btn-outline-dark btn-sm"
        >Selecionar</a>        
      @endif
    </div>
  </div>
</div>