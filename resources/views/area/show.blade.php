@php
  $head_title = 'Condomínio: ' . $area->name;
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['cropper'];
@endphp
@extends('layout.app')
@section('head')
  <style> .nav-pills .moving-tab{ display: none; } </style>
@endsection
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'dashboard'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Home',
        'href' => route('home')
      ],(object)[
        'name' => 'Condomínio',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid px-2 px-md-4 mb-4" style="position:relative;">
      <div style="min-height: calc(100vh - 10rem);">
        <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('{{ $area->image_formatted }}');">
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>

        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-1">
                {{ $area->name }}
              </h5>
              <p class="mb-0 font-weight-normal text-sm" style="max-width: 27rem">
                {{ $area->description }}
              </p>
            </div>
            @if(!$area->i_am_vinculed)
              <a
                href="{{ route('user_area.store',['id' => $area->id]) }}"
                class="btn bg-gradient-primary mb-0 ms-2"
              >Vincular</a>
            @elseif($area->id == auth()->user()->active_area_id)
              <a
                href="{{ route('/') }}"
                class="btn bg-gradient-primary mb-0 ms-2"
              >Ver Outros</a>
            @else
              <a
                href="{{ route('user_area.store',['id' => $area->id]) }}"
                class="btn bg-gradient-primary mb-0 ms-2"
              >Selecionar</a>
            @endif
          </div>
        </div>
        <div class="card card-body my-4">
          @if($area->services->count() == 0)
            <p class="bg-gray-200 py-4 rounded-3 text-center mb-0">
              Ainda não há nenhum serviço sendo oferecido nesse condomínio.
            </p>
          @else
            <div class="row">
              @foreach($area->services as $service)
                @include('components.card.service')
              @endforeach
            </div>
          @endif
        </div>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'footer bottom-2 py-2 w-100'
      ]])
    </div>
  </main>
@endsection