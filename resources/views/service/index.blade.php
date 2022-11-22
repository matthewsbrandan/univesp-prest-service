@php
  $head_title = 'Serviços';
  $body_class = 'blog-posts g-sidenav-show  bg-gray-200';
@endphp
@extends('layout.app')
@section('head')
  <style>
    .card.card-blog .card-image {
      box-shadow: 0 .3125rem .625rem 0 rgba(0, 0, 0, .12)
    }
    .card.card-blog .card-image .img {
      width: 100%
    }
    .card.card-blog .card-title a {
      color: #344767
    }
  </style>
@endsection
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'service'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Serviços',
        'href' => '#'
      ]]
    ]])

    @if($categories->count() > 0)
      <header>
        <div id="carouselCategoriesControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item">
              <div class="page-header min-vh-75 m-3 border-radius-xl"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/mark.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 my-auto">
                      <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Pricing Plans</h4>
                      <h1 class="text-white fadeIn2 fadeInBottom">Work with the rockets</h1>
                      <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Wealth creation is an evolutionarily recent
                        positive-sum game. Status is an old zero-sum game. Those attacking wealth creation are often just
                        seeking status.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid px-3">
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    @include('components.card.category',[
                      'category' => $categories[0],
                      'card_category_style' => (object)[
                        'container_class' => 'info-horizontal bg-gradient-primary border-radius-xl py-5 px-4',
                        'text_class' => 'text-white',
                        'button_class' => 'text-white'
                      ]
                    ])
                  </div>
                  @if($categories->count() > 1)
                    <div class="col-lg-4 col-md-6 px-sm-1 mt-md-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[1],
                        'card_category_style' => (object)['button_class' => 'text-primary']
                      ])
                    </div>
                  @endif
                  @if($categories->count() > 2)
                    <div class="col-lg-4 mt-lg-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[2],
                        'card_category_style' => (object)['button_class' => 'text-primary']
                      ])
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="page-header min-vh-75 m-3 border-radius-xl"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/meeting.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 my-auto">
                      <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Our Team</h4>
                      <h1 class="text-white fadeIn2 fadeInBottom">Work with the best</h1>
                      <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">Free people make free choices. Free choices
                        mean you get unequal outcomes. You can have freedom, or you can have equal outcomes. You can’t have
                        both.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid px-3">
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    @include('components.card.category',[
                      'category' => $categories[0],
                      'card_category_style' => (object)['button_class' => 'text-dark']
                    ])
                  </div>
                  @if($categories->count() > 1)
                    <div class="col-lg-4 col-md-6 px-sm-1 mt-md-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[1],
                        'card_category_style' => (object)[
                          'container_class' => 'info-horizontal bg-gradient-info border-radius-xl py-5 px-4',
                          'text_class' => 'text-white',
                          'button_class' => 'text-white'
                        ]
                      ])
                    </div>
                  @endif
                  @if($categories->count() > 2)
                    <div class="col-lg-4 mt-lg-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[2],
                        'card_category_style' => (object)['button_class' => 'text-dark']
                      ])
                    </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="carousel-item active">
              <div class="page-header min-vh-75 m-3 border-radius-xl"
                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/lounge.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 my-auto">
                      <h4 class="text-white mb-0 fadeIn1 fadeInBottom">Office Places</h4>
                      <h1 class="text-white fadeIn2 fadeInBottom">Work from home</h1>
                      <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">You’re spending time to save money when you
                        should be spending money to save time.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid px-3">
                <div class="row">
                  <div class="col-lg-4 col-md-6">
                    @include('components.card.category',[
                      'category' => $categories[0],
                      'card_category_style' => (object)['button_class' => 'text-dark']
                    ])
                  </div>
                  @if($categories->count() > 1)
                    <div class="col-lg-4 col-md-6 px-sm-1 mt-md-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[1],
                        'card_category_style' => (object)['button_class' => 'text-dark']
                      ])
                    </div>
                  @endif
                  @if($categories->count() > 2)
                    <div class="col-lg-4 mt-lg-0 mt-4">
                      @include('components.card.category',[
                        'category' => $categories[2],
                        'card_category_style' => (object)[
                          'container_Class' => 'info-horizontal bg-gradient-danger border-radius-xl py-5 px-4',
                          'text_class' => 'text-white',
                          'button_class' => 'text-white'
                        ]
                      ])
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="min-vh-75 position-absolute w-100 top-0">
            <a class="carousel-control-prev" href="#carouselCategoriesControls" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
              <span class="visually-hidden">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselCategoriesControls" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
              <span class="visually-hidden">Próximo</span>
            </a>
          </div>
        </div>
      </header>
    @endif
  
    <div class="container" style="min-height: calc(100vh - 9rem);">
      <div class="row">
        <div class="col-lg-7">
          @if($services->count() > 0)
            <section class="{{ $categories->count() > 0 ? 'py-5' : 'pb-5' }} mb-5">
              @foreach($services->take(3) as $service)
                <div class="card card-plain card-blog mt-5">
                  <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="card-image position-relative border-radius-lg">
                        <div class="blur-shadow-image">
                          <img
                            class="img border-radius-lg"
                            src="{{ $service->image }}"
                            alt="architecture"
                          >
                        </div>
                        <div class="colored-shadow"
                          style="background-image: url('{{ $service->image }}');">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                      <h4>
                        <a href="javascript:;" class="text-dark">{{ $service->name }}</a>
                      </h4>
                      <p>
                        {{ $service->description }}... <a href="{{ route('service.show',['slug' => $service->slug]) }}"> Mais Detalhes </a>
                      </p>
                      <div class="author">
                        <img src="{{ $service->user->profile }}" alt="team-4" class="avatar avatar-sm shadow me-2">
                        <p class="my-auto">{{ $service->profile->name }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </section>

            @if($services->count() > 3)
              @php $highlightService = $services[4] @endphp
              <div class="card card-blog card-background">
                <div class="full-background"
                  style="background-image: url('{{ $highlightService->image }}')">
                </div>
                <div class="card-body body-left">
                  <div class="content-left text-start">
                    <h2 class="card-title text-white">{{ $highlightService->name }}</h2>
                    <p class="card-description">{{ $highlightService->description }}</p>
                    <div class="author">
                      <img src="{{ $service->user->profile }}" alt="..." class="avatar me-2">
                      <div class="name ms-2 my-auto">{{ $service->profile->name }}</div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            
            @if($services->count() > 4)
              <section class="py-5 mb-5">
                @foreach($services->slice(4) as $service)
                  <div class="card card-plain card-blog mt-5">
                    <div class="row">
                      <div class="col-lg-4 col-md-4">
                        <div class="card-image position-relative border-radius-lg">
                          <div class="blur-shadow-image">
                            <img
                              class="img border-radius-lg"
                              src="{{ $service->image }}"
                              alt="architecture"
                            >
                          </div>
                          <div class="colored-shadow"
                            style="background-image: url('{{ $service->image }}');">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                        <h4>
                          <a href="javascript:;" class="text-dark">{{ $service->name }}</a>
                        </h4>
                        <p>
                          {{ $service->description }}... <a href="{{ route('service.show',['slug' => $service->slug]) }}"> Mais Detalhes </a>
                        </p>
                        <div class="author">
                          <img src="{{ $service->user->profile }}" alt="team-4" class="avatar avatar-sm shadow me-2">
                          <p class="my-auto">{{ $service->profile->name }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </section>
            @endif
          @else
            <div class="card card-body my-4 mt-lg-5">
              <p class="bg-gray-200 py-4 rounded-3 text-center mb-0">
                Ainda não há nenhum serviço sendo oferecido
              </p>
            </div>
          @endif
        </div>
        <div class="col-lg-4 ms-auto px-3">
          <div class="pt-1 pb-5 position-sticky top-1 {{ $categories->count() > 0 ? 'mt-lg-8 mt-5' : 'mt-5' }}">
            <h4>Deseja oferecer algum serviço?</h4>
            <p>Se você exerce alguma atividade e deseja divulgá-la na plataforma clique no botão abaixo para começar a divulgação.</p>
            <a
              href="{{ route('service.create') }}"
              class="btn bg-gradient-primary w-100"
            >Adicionar Serviço</a>

            @if($lastThreeServicesRequested->count() > 0)
              <h4 class="mt-5">Últimos serviços solicitados</h4>
              @foreach($lastThreeServicesRequested as $work)
                <a href="{{ route('service.show',['slug' => $work->service->slug]) }}">
                  <div class="card justify-content-center mb-3">
                    <div class="card-body p-3">
                      <h6 class="mb-0">{{ $work->service->name }}</h6>
                      <p class="mb-0 text-body">{{ $work->created_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="position-absolute end-0 me-3 ">
                      <i class="fas fa-angle-right" aria-hidden="true"></i>
                    </div>
                  </div>
                </a>
              @endforeach
            @endif        
            @if($highServices->count() > 0)
              <h4 class="mt-5">Serviços em Alta</h4>
              @foreach($highServices as $service)
                <div class="card card-plain card-blog mt-4">
                  <div class="row">
                    <div class="col-lg-4 col-md-4">
                      <div class="card-image position-relative border-radius-lg">
                        <div class="blur-shadow-image">
                          <img
                            class="img border-radius-lg"
                            src="{{ $service->image }}"
                            alt="{{ $service->name }}"
                          >
                        </div>
                        <div
                          class="colored-shadow"
                          style="background-image: url('{{ $service->image }}');"
                        ></div>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 my-sm-auto mt-3">
                      <h5>
                        <a href="{{ route('service.show', ['slug' => $service->slug]) }}" class="text-dark font-weight-normal">
                          {{ $service->name }}
                        </a>
                      </h5>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
            @if($outherCategories->count() > 0)
              <h4 class="mt-5 mb-4">Categorias</h4>
              @foreach($outherCategories as $outher)
                <a
                  href="{{ route('service.index',['slug' => $outher->slug]) }}"
                  class="badge bg-light text-dark"
                >{{ $outher->name }}</a>
              @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  
    @include('layout.footer',['footer_options' => (object)[
      'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
      'mode' => 'transparent'
    ]])
  </main>
@endsection