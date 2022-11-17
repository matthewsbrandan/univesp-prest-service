@auth
  @php
    $active = isset($aside_options) && isset($aside_options->active) ? $aside_options->active : null;
  @endphp
  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main"
  >
    <style>
      .navbar-vertical.navbar-expand-xs .navbar-collapse{
        height: calc(100vh - 199px);
      }
    </style>
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('/') }}">
        <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">{{ config('app.name') }}</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white {{
            $active == 'dashboard' ? 'active bg-gradient-primary':''
          }}" href="{{ route('home') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{
            $active == 'service' ? 'active bg-gradient-primary':''
          }}" href="{{ route('service.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Serviços</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{
            $active == 'work' ? 'active bg-gradient-primary':''
          }}" href="{{ route('work.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Histórico</span>
          </a>
        </li>
        <?php
          /*
            <li class="nav-item">
              <a class="nav-link text-white " href="../pages/notifications.html">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">notifications</i>
                </div>
                <span class="nav-link-text ms-1">Notificações</span>
              </a>
            </li>
          */
        ?>
        @if(auth()->user() && auth()->user()->hasPermissionTo('admin'))
          @include('layout.aside-admin')
        @endif
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Minha Conta</h6>
        </li>
        @auth
          <li class="nav-item">
            <a class="nav-link text-white {{
              $active == 'profile' ? 'active bg-gradient-primary':''
            }}" href="{{ route('profile.index') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Perfil</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('logout') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">logout</i>
              </div>
              <span class="nav-link-text ms-1">Sair</span>
            </a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('login') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">login</i>
              </div>
              <span class="nav-link-text ms-1">Login</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('register') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">assignment</i>
              </div>
              <span class="nav-link-text ms-1">Cadastrar-se</span>
            </a>
          </li>
        @endauth
      </ul>
    </div>
    @if(auth()->user()->active_area)
      <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
          <a
            href="{{ route('area.show',['slug' => auth()->user()->active_area->slug]) }}"
            class="btn bg-gradient-primary mt-4 w-100 text-ellipsis"
          >{{ auth()->user()->active_area->name }}</a>
        </div>
      </div>
    @endif
  </aside>
@endauth