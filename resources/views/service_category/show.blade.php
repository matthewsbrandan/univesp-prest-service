@php
  $head_title = 'Category: ' . $category->name;
  $body_class = 'g-sidenav-show bg-gray-200';
  if(!function_exists('handlePlural')){
    function handlePlural($value, $sigular, $plural){
      return $value == 1 ? $sigular : $plural;
    }
  }
@endphp
  
@extends('layout.app')
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'service'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Serviços',
        'href' => route('service.index')
      ],(object)[
        'name' => 'Categoria',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid px-2 px-md-4 mb-4" style="position:relative;">
      <div style="min-height: calc(100vh - 10rem);">
        <div class="page-header min-height-300 border-radius-xl mt-2" style="
          background-image: url('{{ $category->image }}');
          background-size: contain;
        ">
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>

        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-1">
                Categoria: {{ $category->name }}
              </h5>
              <p class="mb-2 font-weight-normal text-sm" style="max-width: 27rem">
                {{ $category->description }}
              </p>
              <span class="badge badge-white border text-dark">
                {{ $category->count_services . handlePlural($category->count_services, ' serviço', ' serviços') }}
              </span>
            </div>
          </div>
        </div>
        <div class="card card-body my-4">          
          <h4 class="mb-3">Serviços</h4>
          <div class="row">
            @foreach($category->services as $service)
              @include('components.card.service')
            @endforeach
          </div>
        </div>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'footer bottom-2 py-2 w-100'
      ]])
    </div>
  </main>
@endsection