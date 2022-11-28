@php
  $head_title = 'Cadastrar Serviço';
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['multisteps-form','jquery-mask','cropper'];
@endphp
@extends('layout.app')
@section('head')
  <style>
    .service-category-item > div.bg-gradient-primary h5,
    .service-category-item > div.bg-gradient-primary a{
      color: white;
    }
    #container-add-image .overlay{
      position: absolute;
      top: 0; left: 0;
      bottom: 0; right: 0;
      z-index: 1;

      background: #ddea;
      border-radius: 1rem;

      height: 100%;
      width: 100%;
      opacity: 0;

      transition: .6s;
    }
    #container-add-image:hover .overlay{ opacity: 1; }
    /* BEGIN:: HANDLE SERVICES HIDE DETAILS */
    .service-category-item.hide-details .description p,
    .service-category-item.hide-details a{ display: none; }
    .service-category-item.hide-details .icon{ height: auto; }
    .service-category-item.hide-details h5{ margin: 0 !important; }
    .service-category-item.hide-details .info-horizontal{
      display: flex;
      align-items: center;
      padding-top: 2.7rem !important;
    }
    /* BEGIN:: HANDLE SERVICES HIDE DETAILS */
  </style>
@endsection
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
                    title="Endereço"
                    id="step-4"
                  >4. Endereço</button>
                  <button
                    class="multisteps-form__progress-btn"
                    type="button"
                    title="Endereço"
                    id="step-5"
                  >5. Condomínios</button>
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
                @include('service.create.step.address')
                @include('service.create.step.area')
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
  @include('utils.modals.address')
  <!-- BEGIN:: HANDLE IMAGE -->
  @include('utils.scripts.cropper',['cropper_options' => (object)[
    'viewport' => (object)['w' => 380, 'h' => 253],
    'boundary' => (object)['w' => 440, 'h' => 294],
    'size' => (object)['w'=> 800, 'h'=> 533]
  ]])
  <!-- END:: HANDLE IMAGE -->
  <script>
    $('.js-btn-prev, .js-btn-next').on('click', () => $('main')[0].scrollTo(0,0));
    function handleSelectCategory(el, id){
      let style_class = {
        active: 'bg-gradient-primary text-white',
        normal: 'bg-light'
      }
      $('.service-category-item > div').removeClass(style_class.active).addClass(style_class.normal);
      el.children('div').removeClass(style_class.normal).addClass(style_class.active);

      $('#category_id').val(id);
    }
    let arr_areas = [];
    function handleSelectArea(el, id){
      if(el.hasClass('bg-gradient-primary')){
        arr_areas = arr_areas.filter(a => a !== id);
        el.removeClass('bg-gradient-primary');
      }else{
        arr_areas.push(id);
        el.addClass('bg-gradient-primary');
      }
      $('#service_area_id').val(JSON.stringify(arr_areas));
    }
    $(function(){
      $('#contact-whatsapp,#contact-phone').mask("(00) 00000-0000");
    });
  </script>
@endsection