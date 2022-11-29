<div class="col-lg-4 col-md-6">
  <div class="card card-blog card-plain">
    <div class="position-relative">
      <a class="d-block blur-shadow-image">
        <img
          src="{{ $service->image }}"
          alt="{{ $service->slug }}" class="img-fluid shadow border-radius-lg">
      </a>
      <div class="colored-shadow"
        style="background-image: url({{ $service->image }});">
      </div>
    </div>
    <div class="card-body px-1 pt-3">
      <a href="{{ route('service.show',['slug' => $service->slug]) }}">
        <h5>{{ $service->name }}</h5>
      </a>
      <p>{{ $service->description }}</p>
      <a
        href="{{ route('service.show',['slug' => $service->slug]) }}"
        class="btn btn-outline-primary btn-sm"
      >Saber Mais</a>
    </div>
  </div>
</div>