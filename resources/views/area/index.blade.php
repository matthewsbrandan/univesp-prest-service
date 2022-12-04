@php
  $head_title = 'Home';
  $body_class = 'rental';
@endphp
@extends('layout.app')
@section('head')
  <style>
    .colored-shadow {
      transform: scale(.94);
      top: 3.5%;
      filter: blur(12px);
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      z-index: -1;
    }
  </style>
@endsection
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'manage.area'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Gerenciar Condomínios',
        'href' => '#'
      ]]
    ]])
  
    <section class="pt-2 pb-4">
      <div class="container">
        <div class="row">
          @foreach($areas as $area)
            @include('components.card.area',['card_area_option' => (object)[
                'mode' => 'edit'
              ]
            ])
          @endforeach        
        </div>
      </div>
    </section>
  </main>
@endsection