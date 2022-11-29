@php
  $head_title = 'Serviço: ' . $service->name;
  $body_class = 'g-sidenav-show bg-gray-200';
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
        'name' => $service->name,
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid px-2 px-md-4 mb-4" style="position:relative;">
      <div style="min-height: calc(100vh - 10rem);">
        <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('{{ $service->image }}');">
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>

        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h5 class="mb-1">
                Serviço: {{ $service->name }}
              </h5>
              <p class="mb-0 font-weight-normal text-sm" style="max-width: 27rem">
                {{ $service->description }}
              </p>
            </div>
            <a
              href="javascript:;"
              class="btn bg-gradient-primary mb-0 ms-2"
            >Contratar</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 mb-md-0 mb-4">
            <div class="card card-body my-4">
            </div>
          </div>
          <div class="col-md-4 my-4">
            <div class="mb-3"> 
              @include('components.card.working',[
                'requestedInThisMonth' => $requestedInThisMonth,
                'works' => $works,
                'hide_columns' => ['service','provider']
              ])
            </div>
            <div>
              @include('components.card.finalized-work',[
                'finalizedInThisMonth' => $finalizedInThisMonth,
                'finalizedWorks' => $finalizedWorks
              ])
            </div>
          </div>
        </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'footer bottom-2 py-2 w-100'
      ]])
    </div>
  </main>
@endsection