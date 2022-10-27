@php
  $head_title = 'Cadastrar Serviço';
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['multisteps-form','jquery-mask','cropper'];
@endphp
@extends('layout.app')
@section('content')
  @include('layout.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Serviços',
        'href' => route('service.index')
      ],(object)[
        'name' => 'Adicionar Serviço',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-lg-8 col-md-10 col-12 m-auto">
          <h3 class="mb-7 text-center">Adicionar Serviço</h3>
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
                    title="Categoria"
                    id="step-2"
                  ><span>2. Categoria</span></button>
                  <button
                    class="multisteps-form__progress-btn"
                    type="button"
                    title="Contatos"
                    id="step-3"
                  >3. Contatos</button>
                  <button
                    class="multisteps-form__progress-btn"
                    type="button"
                    title="Imagem"
                    id="step-4"
                  >4. Imagem</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form
                method="POST"
                action="{{ route('service.store') }}"
                class="multisteps-form__form"
                id="form-service"
              >
                @include('service.create.step.info')
                @include('service.create.step.category')
                @include('service.create.step.contact')
                @include('service.create.step.image')
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('layout.fixed-plugin')
  @include('utils.modals.gallery',[
    'gallery_active' => 'services',
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