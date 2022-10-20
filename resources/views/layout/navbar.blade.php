@php
  $mode = 'internal';
  if(isset($navbar_options) && isset($navbar_options->mode)) $mode = $navbar_options->mode;  
@endphp
@if($mode == 'internal')
  <nav
    class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-2 shadow-none border-radius-xl"
    id="navbarBlur"
    data-scroll="true"
  >
    <div class="container-fluid py-2 px-3">
      @if(isset($navbar_options) && $navbar_options->items)
        <nav aria-label="breadcrumb">
          @if(count($navbar_options->items) > 1)
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
              @foreach($navbar_options->items as $k => $item)
                @if($k == (count($navbar_options->items) - 1))
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    {{ $item->name }}
                  </li>
                @else
                  <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="{{ $item->href }}">{{ $item->name }}</a>
                  </li>
                @endif
              @endforeach
            </ol>
          @endif
          <h6 class="font-weight-bolder mb-0">            
            {{ $navbar_options->items[count($navbar_options->items) - 1]->name }}
          </h6>
        </nav>
      @endif
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          @if(isset($navbar_options) && isset($navbar_options->search))
            <div class="input-group input-group-outline">
              <label class="form-label">Digite aqui...</label>
              <input type="text" class="form-control">
            </div>
          @endif
        </div>
        <ul class="navbar-nav  justify-content-end">
          @auth
          @else
            <li class="nav-item d-flex align-items-center">
              <a href="{{ route('login') }}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Login</span>
              </a>
            </li>
          @endauth
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
          </li>
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-bell cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New message</span> from Laur
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        13 minutes ago
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New album</span> by Travis Scott
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        1 day
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                      <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>credit-card</title>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                              <g transform="translate(453.000000, 454.000000)">
                                <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                              </g>
                            </g>
                          </g>
                        </g>
                      </svg>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        Payment successfully completed
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        2 days
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
@elseif($mode == 'external')
  <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
    <div class="container-fluid ps-2 pe-0">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{ route('/') }}">
        {{ config('app.name') }}
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('home') }}">
                <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="{{ route('profile.index') }}">
                <i class="fa fa-user opacity-6 text-dark me-1"></i>
                Perfil
              </a>
            </li>
          @else
            <li class="nav-item">
              <a class="nav-link me-2" href="{{ route('register') }}">
                <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                Cadastrar-se
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-2" href="{{ route('login') }}">
                <i class="fas fa-key opacity-6 text-dark me-1"></i>
                Login
              </a>
            </li>
          @endauth
        </ul>
        <?php
          /*
            <ul class="navbar-nav d-lg-block d-none">
              <li class="nav-item">
                <a href="javascript:;" class="btn btn-sm mb-0 me-1 bg-gradient-dark">Entrar em Contato</a>
              </li>
            </ul>
          */
        ?>
      </div>
    </div>
  </nav>
@endif