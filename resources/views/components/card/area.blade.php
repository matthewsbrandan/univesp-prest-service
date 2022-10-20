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
      <p class="text-gradient text-dark mb-2 text-sm">N serviços • N categorias</p>
      <a
        href="javascript:;"
      ><h5>{{ $area->name }}</h5></a>
      <p>{{ $area->description }}</p>
      <button type="button" class="btn btn-outline-primary btn-sm">Saber Mais</button>
    </div>
  </div>
</div>