@php
  $head_title = 'Cadastrar Condomínio';
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['multisteps-form','jquery-mask','cropper'];
@endphp
@extends('layout.app')
@section('content')
  @include('layout.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Home',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div class="row min-vh-80">
        <div class="col-lg-8 col-md-10 col-12 m-auto">
          <h3 class="mt-3 mb-0 text-center">Adicionar Condomínio/Região</h3>
          <p class="lead font-weight-normal opacity-8 mb-7 text-center">
            Crie aqui a sua área de atuação, conominío ou região que ira divulgar os diversos serviços.
          </p>
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
                    title="Endereço"
                    id="step-2"
                  ><span>2. Endereço</span></button>
                  <button
                    class="multisteps-form__progress-btn"
                    type="button"
                    title="Imagem"
                    id="step-3"
                  >3. Imagem</button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form
                method="POST"
                action="{{ route('area.store') }}"
                class="multisteps-form__form"
                id="form-area"
              >
                @include('area.create.step.info')
                @include('area.create.step.address')
                @include('area.create.step.image')
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  @include('layout.fixed-plugin')
  @include('utils.modals.gallery',[
    'gallery_active' => 'areas',
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
  <!-- BEGIN:: HANDLE ZIP CODE -->
  <script>
    var lastZipCodeShowError = null;
    function completeAddress(){
      let code = $('#area-code').val();
      code = code.replace('-','');
      console.log(code);
      if(code.length == 8){
        delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
        $.ajax({
          url: `https://viacep.com.br/ws/${code}/json/`,
          method: 'GET',
          success: function(data){
            if(data.erro === true || !data.cep){
              if(!lastZipCodeShowError ||
                lastZipCodeShowError !== code
              ){
                lastZipCodeShowError = code;
                alertNotify('danger','CEP Inválido');
              }
              return;
            }

            if(data.bairro.length > 0) $('#area-district').val(data.bairro)
              .parent().addClass('is-filled');
            if(data.cep.length > 0) $('#area-code').val(data.cep)
              .parent().addClass('is-filled');
            if(data.complemento.length > 0) $('#area-complement').val(data.complemento)
              .parent().addClass('is-filled');
            if(data.localidade.length > 0) $('#area-city').val(data.localidade)
              .parent().addClass('is-filled');
            if(data.logradouro.length > 0) $('#area-street').val(data.logradouro)
              .parent().addClass('is-filled');
            if(data.uf.length > 0) $('#area-state').val(data.uf)
              .parent().addClass('is-filled');

            $('#area-number').focus();
          },
        });
        $.ajaxSettings.headers['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
      }
    }
    $(function(){
      $("#area-code").mask("00000-000");
      $("#area-code").on('keyup', () => completeAddress());
    });
  </script>
  <!-- END:: HANDLE ZIP CODE -->
  <!-- BEGIN:: HANDLE MULTISTEPS-FORM -->
  
  <!-- END:: HANDLE MULTISTEPS-FORM -->
@endsection