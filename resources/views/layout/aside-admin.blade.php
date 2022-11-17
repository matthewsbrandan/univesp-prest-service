<li class="nav-item mt-3">
  <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Administrador</h6>
</li>
<li class="nav-item">
  <a class="nav-link text-white {{
    $active == 'admin.user' ? 'active bg-gradient-primary':''
  }}" href="{{ route('admin.user.index') }}">
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">group</i>
    </div>
    <span class="nav-link-text ms-1">Usuários</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link text-white {{
    $active == 'admin.service_category' ? 'active bg-gradient-primary':''
  }}" href="{{ route('admin.service_category.index') }}">
    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="material-icons opacity-10">category</i>
    </div>
    <span class="nav-link-text ms-1">Categorias</span>
  </a>
</li>