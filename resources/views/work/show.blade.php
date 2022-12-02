@php
  $head_title = 'Pedido';
  $body_class = 'g-sidenav-show  bg-gray-200';
  $is_provider = $work->provider_id == auth()->user()->id;
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
    'active' => $is_provider ? 'work.order' : 'work'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Pedido',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div style="min-height: calc(100vh - 11rem);">
        <div class="row">
          <div class="col-12">
            <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('{{ $work->service->image }}');">
              <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="mb-1">
                    Serviço: {{ $work->service->name }}
                  </h5>
                  <p class="mb-2 font-weight-normal text-sm" style="max-width: 27rem">
                    <span class="text-dark" style="font-weight: 500;">Usuário que solicitou: </span>{{ $work->user->name }}<br/>
                    <span class="text-dark" style="font-weight: 500;">Prestador do serviço: </span>{{ $work->provider->name }}<br/>
                    <span class="text-dark" style="font-weight: 500;">Descrição: </span>{{ $work->description }}
                  </p>
                  <span class="badge badge-white border text-dark">
                    {{ $work->getStatus() }}
                  </span>
                </div>
              </div>
              <div>
                {{-- CRIAR AÇÕES --}}
                @if($is_provider)
                @else
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
        'mode' => 'transparent'
      ]])
    </div>
  </main>
@endsection