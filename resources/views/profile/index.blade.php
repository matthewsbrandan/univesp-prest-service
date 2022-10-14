@php
  $head_title = 'Perfil';
  $body_class = 'g-sidenav-show bg-gray-200';
@endphp
@extends('layout.app')
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'profile'
  ]])
  <div class="main-content position-relative max-height-vh-100 h-100">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Perfil',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ $user->getProfile() }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ $user->name }}
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                {{ $user->username }}
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                    <i class="material-icons text-lg position-relative">home</i>
                    <span class="ms-1">Home</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">email</i>
                    <span class="ms-1">Msg</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="material-icons text-lg position-relative">settings</i>
                    <span class="ms-1">Config.</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="row">
            @if($user->id == auth()->user()->id)
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Configurações da Plataforma</h6>
                  </div>
                  <div class="card-body p-3">
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Conta</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                        </div>
                      </li>
                    </ul>
                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Aplicação</h6>
                    <ul class="list-group">
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                        </div>
                      </li>
                      <li class="list-group-item border-0 px-0 pb-0">
                        <div class="form-check form-switch ps-0">
                          <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                          <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <div class="row">
                      <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Informações de Perfil</h6>
                      </div>
                      <div class="col-md-4 text-end">
                        <a href="javascript:;">
                          <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body p-3">
                    <ul class="list-group">
                      <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                        <strong class="text-dark">Nome:</strong> &nbsp; {{ $user->name }}
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Celular:</strong> &nbsp; {!! $user->phone ?? '<em>-- não informado --</em>' !!}
                      </li>
                      <li class="list-group-item border-0 ps-0 text-sm">
                        <strong class="text-dark">Email:</strong> &nbsp; {{ $user->email }}
                      </li>
                      @if($user->social_network)
                        <li class="list-group-item border-0 ps-0 pb-0">
                          <strong class="text-dark text-sm">Social:</strong> &nbsp;
                          @foreach($user->getSocialNetwork() as $social => $link)
                            <a
                              class="btn btn-{{ $social }} btn-simple mb-0 ps-1 pe-2 py-0"
                              href="{{ $link }}"
                            >
                              <i class="fab fa-{{ $social }} fa-lg"></i>
                            </a>
                          @endforeach
                        </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12 col-xl-4">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Conversas</h6>
                  </div>
                  <div class="card-body p-3">
                    <ul class="list-group">
                      @if(!isset($works) || $works->count() == 0)
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                          <p class="text-center">Você ainda não iniciou nenhuma conversa</p>
                        </li>
                      @else
                        @foreach($works as $work)
                          <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                            <?php
                              $user_conversation = $work->user_id == $user->id ?
                                $work->user :
                                $work->provider;
                            ?>

                            <div class="avatar me-3">
                              <img
                                src="{{ $user_conversation->getProfile() }}"
                                alt="foto de perfil" class="border-radius-lg shadow"
                              >
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $user_conversation->name }}</h6>
                              <p class="mb-0 text-xs">{{ $work->description }}</p>
                            </div>
                            <a
                              class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                              href="javascript:;"
                            >Reply</a>
                          </li>
                        @endforeach
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            @endif
            <div class="col-12 mt-4">
              <div class="mb-5 ps-3">
                <h6 class="mb-1">Serviços</h6>
                <p class="text-sm">Últimos serviços solicitados</p>
              </div>
              <div class="row">
                @foreach($applicant_works as $work)                
                  <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                    <div class="card card-blog card-plain">
                      <div class="card-header p-0 mt-n4 mx-3">
                        <a class="d-block shadow-xl border-radius-xl">
                          <img
                            src="{{ $work->service->getImage() }}"
                            alt="trabalho solicitado"
                            class="img-fluid shadow border-radius-xl"
                          >
                        </a>
                      </div>
                      <div class="card-body p-3">
                        <p class="mb-0 text-sm">{{ $work->provider->name }}</p>
                        <a href="javascript:;">
                          <h5>{{ $work->service->name }}</h5>
                        </a>
                        <p class="mb-4 text-sm">
                          {{ $work->description }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between">
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0">Ver Mais</button>
                          <div class="avatar-group mt-2">
                            <a
                              href="{{ route('profile.index',['username' => $work->provider->slug])}}"
                              class="avatar avatar-xs rounded-circle"
                              data-bs-toggle="tooltip" data-bs-placement="bottom"
                              title="{{ $work->provider->name }}"
                            >
                              <img
                                alt="{{ $work->provider->name }}"
                                src="{{ $work->provider->getProfile() }}"
                              >
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @if($applicant_works->count() == 0)
                  <p class="text-center">Você ainda não solicitou nenhum serviço</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('layout.footer',['footer_options' => (object)[
      'mode' => 'transparent',
      'class_name' => ''
    ]])
    <footer class="  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  @include('layout.fixed-plugin')
@endsection