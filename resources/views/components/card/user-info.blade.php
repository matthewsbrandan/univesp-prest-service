{{-- 
  REQUIRED $user
  --}}
<div class="card card-blog card-plain">
  <div class="position-relative">
    <a class="d-block blur-shadow-image">
      <img
        src="{{ $user->profile }}"
        alt="{{ $user->name }}"
        class="img-fluid shadow border-radius-lg"
        style="width: 10rem;"
      >
    </a>
    <div class="colored-shadow"
      style="background-image: url({{ $user->profile }});">
    </div>
  </div>
  <div class="card-body px-1 pt-3">
    <h5>{{ $user->name }}</h5>
    <p class="text-sm mb-1">
      <span style="font-weight: 500;">Email: </span>{{ $user->email }}<br/>
      @if($user->whatsapp)
        <span style="font-weight: 500;">Whatsapp: </span>{{ $user->whatsapp }}<br/>
      @endif
    </p>
    @include('components.user-contact-box')
  </div>
</div>