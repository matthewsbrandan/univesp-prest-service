@php
  $head_title = 'Nova Categoria';
  $body_class = 'blog-posts g-sidenav-show  bg-gray-200';
  $plugins = ['multisteps-form','cropper'];
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
        'href' => route('admin.service_category.index')
      ],(object)[
        'name' => 'Nova Categoria',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-lg-8 col-md-10 col-12 m-auto">
          <h3 class="mt-3 mb-0 text-center">Adicionar Categoria</h3>
          <div class="card">
            <div class="card-header p-0 position-relative mt-n5 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <div class="multisteps-form__progress">
                  <button
                    class="multisteps-form__progress-btn js-active"
                    type="button"
                    title="Informações"
                    id="step-1"
                  ><span>1. Informações</span></button>
                  <button
                    class="multisteps-form__progress-btn"
                    type="button"
                    title="Imagem"
                    id="step-2"
                  >2. Imagem</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form
                method="POST"
                action="{{ route('admin.service_category.store') }}"
                class="multisteps-form__form"
                id="form-service_category"
              >
                @include('admin.service_category.create.step.info')
                @include('admin.service_category.create.step.image')
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('layout.fixed-plugin')
  @include('utils.modals.gallery',[
    'gallery_active' => 'service_categories',
    'gallery_add_fn' => 'handleAddNewImage()',
    'gallery_fn' => 'selectItemGallery($(this))'
  ])
@endsection
@section('scripts')
  <!-- BEGIN:: HANDLE IMAGE -->
  @include('utils.scripts.cropper',['cropper_options' => (object)[
    'viewport' => (object)['w' => 380, 'h' => 253],
    'boundary' => (object)['w' => 440, 'h' => 294],
    'size' => (object)['w'=> 800, 'h'=> 533]
  ]])
  <!-- END:: HANDLE IMAGE -->
@endsection