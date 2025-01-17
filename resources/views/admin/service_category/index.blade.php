@php
  $head_title = 'Gerenciar Categorias';
  $body_class = 'blog-posts g-sidenav-show  bg-gray-200';
@endphp
@extends('layout.app')
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'admin.service_category'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Gerenciar Categorias',
        'href' => '#'
      ]]
    ]])
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <a href="{{ route('admin.service_category.create') }}" class="
            info-horizontal p-5 
            bg-gradient-primary border-radius-xl
            d-flex align-items-center justify-content-center h-100
          " style="min-height: 12rem;">
            <span class="material-icons text-white">add</span>
          </a>
        </div>
        @foreach($categories as $category)
          <div class="col-lg-4 col-md-6 px-sm-1 mt-md-0 mt-4 mb-2">
            @include('components.card.category',[
              'category' => $category,
              'mode' => 'admin'
            ])
          </div>
        @endforeach
      </div>
    </div>
  </main>
@endsection