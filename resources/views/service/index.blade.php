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
  
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
  
          <section class="py-5">
            <div class="card card-plain card-blog mt-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-architecture.jpg"
                        alt="architecture">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-architecture.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">Rover raised to $65 million</a>
                  </h4>
                  <p>
                    Finding temporary housing for your dog should be as easy as renting an Airbnb. That’s the idea behind
                    Rover, which raised $65 million to expand its pet sitting <a href="javascript:;"> Read More </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-4.jpg" alt="team-4" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">Katie Roof</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog mt-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-estate.jpg"
                        alt="estate">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-estate.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">MateLabs mixes machine learning</a>
                  </h4>
                  <p>
                    If you’ve ever wanted to train a machine learning model and integrate it with IFTTT, a new offering from
                    MateLabs. MateVerse, a platform where novices can spin out machine... <a href="javascript:;"> Read More
                    </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-3.jpg" alt="team-3" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">John Mannes</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog my-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-buildings.jpg"
                        alt="buildings">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-buildings.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">US venture investment tricks</a>
                  </h4>
                  <p>
                    Venture investment in U.S. startups rose sequentially in the second quarter of 2017, boosted by large,
                    late-stage financings and a few outsized early-stage rounds in tech and healthcare.. <a
                      href="javascript:;"> Read More </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-2.jpg" alt="team-2" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">Devin Coldewey</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
  
          <div class="card card-blog card-background">
            <div class="full-background"
              style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/desert.jpg')">
            </div>
            <div class="card-body body-left">
              <div class="content-left text-start">
                <h2 class="card-title text-white">Flexible office space means growing your team.</h2>
                <p class="card-description">Rather than worrying about switching offices every couple years, you can instead
                  stay in the same location and grow-up from your shared coworking space to an office that takes up an
                  entire floor.</p>
                <div class="author">
                  <img src="../../assets/img/team-2.jpg" alt="..." class="avatar me-2">
                  <div class="name ms-2">
                    <span>Mathew Glock</span>
                    <div class="stats">
                      <small>Marketing Manager</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <section class="py-5">
            <div class="card card-plain card-blog mt-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-architecture.jpg"
                        alt="architecture">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-architecture.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">Rover raised to $65 million</a>
                  </h4>
                  <p>
                    Finding temporary housing for your dog should be as easy as renting an Airbnb. That’s the idea behind
                    Rover, which raised $65 million to expand its pet sitting <a href="javascript:;"> Read More </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-4.jpg" alt="team-4" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">Katie Roof</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog mt-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-estate.jpg"
                        alt="estate">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-estate.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">MateLabs mixes machine learning</a>
                  </h4>
                  <p>
                    If you’ve ever wanted to train a machine learning model and integrate it with IFTTT, a new offering from
                    MateLabs. MateVerse, a platform where novices can spin out machine... <a href="javascript:;"> Read More
                    </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-3.jpg" alt="team-3" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">John Mannes</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog my-5">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg"
                        src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-buildings.jpg"
                        alt="buildings">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/color-buildings.jpg&quot;);">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-7 my-sm-auto mt-3 ms-sm-3">
                  <h4>
                    <a href="javascript:;" class="text-dark">US venture investment tricks</a>
                  </h4>
                  <p>
                    Venture investment in U.S. startups rose sequentially in the second quarter of 2017, boosted by large,
                    late-stage financings and a few outsized early-stage rounds in tech and healthcare.. <a
                      href="javascript:;"> Read More </a>
                  </p>
                  <div class="author">
                    <img src="../../assets/img/team-2.jpg" alt="team-2" class="avatar avatar-sm shadow me-2">
                    <p class="my-auto">Devin Coldewey</p>
                  </div>
                </div>
              </div>
            </div>
          </section>
  
          <ul class="pagination pagination-primary mt-4 ms-2">
            <li class="page-item">
              <a class="page-link" href="javascript:;" aria-label="Previous">
                <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">2</a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="javascript:;">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">4</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">5</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;" aria-label="Next">
                <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-lg-4 ms-auto px-3">
          <div class="pt-1 pb-5 position-sticky top-1 mt-lg-8 mt-5">
            <h4>Deseja oferecer algum serviço?</h4>
            <p>Se você exerce alguma atividade e deseja divulgá-la na plataforma clique no botão abaixo para começar a divulgação.</p>
            <a
              href="{{ route('service.create') }}"
              class="btn bg-gradient-primary w-100"
            >Adicionar Serviço</a>
            <h4 class="mt-5">Últimos serviços solicitados</h4>
            <a href="javascript::">
              <div class="card justify-content-center mb-3">
                <div class="card-body p-3">
                  <h6 class="mb-0">Top 50 Tips for Creative Tim</h6>
                  <p class="mb-0 text-body">Mar 08, 2020</p>
                </div>
                <div class="position-absolute end-0 me-3 ">
                  <i class="fas fa-angle-right" aria-hidden="true"></i>
                </div>
              </div>
            </a>
            <a href="javascript::">
              <div class="card justify-content-center mb-3">
                <div class="card-body p-3">
                  <h6 class="mb-0">Best ways to avoid the Burnout</h6>
                  <p class="mb-0 text-body">Aug 11, 2020</p>
                </div>
                <div class="position-absolute end-0 me-3 ">
                  <i class="fas fa-angle-right" aria-hidden="true"></i>
                </div>
              </div>
            </a>
            <a href="javascript::">
              <div class="card justify-content-center mb-3">
                <div class="card-body p-3">
                  <h6 class="mb-0">Fascinating tactics to help your Business</h6>
                  <p class="mb-0 text-body">Jan 07, 2021</p>
                </div>
                <div class="position-absolute end-0 me-3 ">
                  <i class="fas fa-angle-right" aria-hidden="true"></i>
                </div>
              </div>
            </a>
            <h4 class="mt-5">Serviços em Alta</h4>
            <div class="card card-plain card-blog mt-4">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg" src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved11.jpg" alt="curved11">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved11.jpg&quot;);"></div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 my-sm-auto mt-3">
                  <h5>
                    <a href="javascript:;" class="text-dark font-weight-normal">MateLabs mixes machine learning</a>
                  </h5>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog mt-4">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg" src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved9.jpg" alt="curved9">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved9.jpg&quot;);"></div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 my-sm-auto mt-3">
                  <h5>
                    <a href="javascript:;" class="text-dark font-weight-normal">Mixes machine learning</a>
                  </h5>
                </div>
              </div>
            </div>
            <div class="card card-plain card-blog mt-4">
              <div class="row">
                <div class="col-lg-4 col-md-4">
                  <div class="card-image position-relative border-radius-lg">
                    <div class="blur-shadow-image">
                      <img class="img border-radius-lg" src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved8.jpg" alt="curved8">
                    </div>
                    <div class="colored-shadow"
                      style="background-image: url(&quot;https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/curved-images/curved8.jpg&quot;);"></div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-8 my-sm-auto mt-3">
                  <h5>
                    <a href="javascript:;" class="text-dark font-weight-normal">MateLabs mixes machine learning</a>
                  </h5>
                </div>
              </div>
            </div>
            <h4 class="mt-5 mb-4">Tags</h4>
            <span class="badge bg-light text-dark">Support</span>
            <span class="badge bg-light text-dark">Business</span>
            <span class="badge bg-light text-dark">Analytics</span>
            <span class="badge bg-light text-dark">Tutorials</span>
            <span class="badge bg-light text-dark mt-2">Sponsorships</span>
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