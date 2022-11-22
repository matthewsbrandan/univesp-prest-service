@php
  $head_title = 'Galeria: ' . $gallery->title;
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['cropper','confirm'];
@endphp
@extends('layout.app')
@section('head')
  <style>
    .gallery-image-box .gallery-image-item{
      object-fit: cover;
      width: 100%;
      height: 100%;
      max-height: 9rem;
    }
    #modalFullScreen .gallery-image-item{
      max-height: initial !important;
    }
    .nav-pills .moving-tab{ display: none; }
  </style>
@endsection
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'profile'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Perfil',
        'href' => route('profile.index')
      ],(object)[
        'href' => route('gallery.index'),
        'name' => 'Galeria'
      ],(object)[
        'href' => '#',
        'name' => $gallery->title
      ]]
    ]])
    <div class="container-fluid px-2 px-md-4 mb-4" style="position:relative;">
      <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>

      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ auth()->user()->profile }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ auth()->user()->name }}
              </h5>
              <p class="mb-0 font-weight-normal text-sm">
                {{ auth()->user()->username }}
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1" href="{{ route('profile.index') }}">
                    <i class="material-icons text-lg position-relative">person</i>
                    <span class="ms-1">Perfil</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 bg-white shadow" href="{{ route('gallery.index') }}">
                    <i class="material-icons text-lg position-relative">image</i>
                    <span class="ms-1">Galeria</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="row">
          <div class="col-md-8 me-auto text-left">
            <h5 class="my-4">
              Galeria de {{ $gallery->title }}<br/>
              @if($gallery->count > 0)
                <span class="text-muted text-xs">
                  Total de {{ $gallery->count }} {{ $gallery->count == 1 ? 'imagem':'imagens' }}
                </span>
              @endif
            </h5>
            <!-- <p>Você possui <b>{{ $gallery->total_size_formatted }}</b> de espaço utilizado nessa galeria.</p> -->
          </div>
        </div>
        <div class="row py-1" id="gallery-{{ $gallery->path }}">
          <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-4">
            <button
              style="position: relative; min-height: 10rem;"
              class="
                shadow-xl border-radius-xl h-100 w-100 border-0 bg-gradient-dark
                d-flex flex-column justify-content-center align-items-center p-1
                gallery-image-content
              "
              onclick="callModalCropper()"
              data-bs-toggle="tooltip"
              data-bs-placement="top"
              data-bs-original-title="Adicionar nova imagem"
            >
              <i class="fa fa-plus"></i>
            </button>
          </div>
          @foreach($gallery->storage as $image)
            <div
              class="col-xl-2 col-lg-3 col-md-4 col-6 mb-4 gallery-image-box"
              data-filename="{{ $image->filename }}.png"
            >
              <div style="position: relative;" class="
                shadow-xl border-radius-xl h-100 bg-gradient-dark
                d-flex flex-column justify-content-center align-items-center p-1
                gallery-image-content
              ">
                <img 
                  src="{{ $image->src }}"
                  alt="{{ $image->filename }}"
                  class="img-fluid shadow border-radius-xl gallery-image-item"
                  onclick="handleCallModalFullScreen($(this), '{{ $image->filename }}.png')"
                />
                <!-- <span
                  class="text-xxs"
                  style="position: absolute; bottom: .1rem;"
                >{{ $image->size_formatted }}</span> -->
              </div>
            </div>
          @endforeach
        </div>
        @include('utils.modals.fullscreen')
        <form
          action="{{ route('gallery.upload') }}"
          method="POST"
          class="d-none"
          enctype="multipart/form-data"
          id="form-upload-image"
          onsubmit="return submitLoad()"
        >
          {{ csrf_field() }}
          <input
            type="hidden"
            name="gallery_name"
            id="gallery_name"
            value="{{ $gallery->path }}"
            required
          />
          <input type="hidden"  name="image_name"   id="image_name"   required/>
          <input type="file"    name="upload_image" id="upload_image" class="d-none"/>
        </form>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'footer bottom-2 py-2 w-100'
      ]])
    </div>
  </main>
@endsection
@section('scripts')
  <!-- BEGIN:: CROPPIE -->
  <script>
    const defaultConfigCroppie = {
      init_croppie: {
        viewport: {
          width: 380,
          height: 380
        },
        boundary: {
          width: 440,
          height: 440
        },
        mouseWheelZoom: true
      },
      commit_croppie: {
        type: 'rawcanvas',
        size: { width: 800, height: 800 },
        format: 'png'
      } 
    };
    const galleryDefaultSettings = {
      areas: defaultConfigCroppie,
      services: defaultConfigCroppie,
      publications: defaultConfigCroppie,
      message_images: defaultConfigCroppie,
      user_profile: {
        init_croppie: {
          viewport: {
            width: 150,
            height: 150
          },
          boundary: {
            width: 300,
            height: 300
          },
          mouseWheelZoom: true
        },
        commit_croppie: {
          type: 'rawcanvas',
          size: { width: 300, height: 300 },
          format: 'png'
        }
      }
    };
    function callModalCropper(){
      $('#upload_image').click();
    }
    $(document).ready(function(){
      var $modal = $('#modal');

      $('#upload_image').change(function(event){
        var files = event.target.files;

        var done = function(url){
          $('#sample_image').attr('src',url)
          $modal.modal('show');
        };

        if(files && files.length > 0){
          reader = new FileReader();
          reader.onload = function(event){
            done(reader.result);
          };
          reader.readAsDataURL(files[0]);
        }
      });
      
      $modal.on('shown.bs.modal', function() {
        let settings = galleryDefaultSettings[$('#gallery_name').val()];
        if(!settings){
          alertNotify('danger','Houve um erro ao lidar com as configurações dessa galeria');
          return;
        }
        $('#sample_image').croppie(settings.init_croppie);
      }).on('hidden.bs.modal', function(){
        $('#modal .modal-body').html(`
          <img id="sample_image" src=""/>
        `);
        $('#upload_image').val('');
      });

      $('.js-main-image').on('click', function (ev) {
        let settings = galleryDefaultSettings[$('#gallery_name').val()];
        if(!settings){
          alertNotify('danger','Houve um erro ao lidar com as configurações dessa galeria');
          return;
        }

        $('#sample_image').croppie(
          'result', settings.commit_croppie
        ).then(function (canvas) {
          let base64data = canvas.toDataURL();

          $('#image_name').val(base64data);
          $modal.modal('hide');
          $('#uploaded_image').attr('src', base64data);
          $('#upload_image').val('');
          $('#form-upload-image').submit();
        });
      });
    });

    function handleJustifyImages(){
      let width = $('.gallery-image-box .gallery-image-item').width();
      $('.gallery-image-box .gallery-image-item').css(
        'max-height', 
        `${width}px`
      );
      $('.gallery-image-content').css(
        'max-height',
        `calc(${width}px + .5rem)`
      );
    }    
    $(function(){ handleJustifyImages() });
    $(window).resize(function(){ handleJustifyImages() });
  </script>
  <!-- END:: CROPPIE -->
  <script>
    function handleCallModalFullScreen(el, filename){
      callModalFullScreen(`
        ${el[0].outerHTML}
        <div class="text-center">
          <button
            type="button"
            class="btn bg-gradient-danger mt-3"
            onclick="handleDeleteImage('${filename}')"
          ><i class="far fa-trash-alt"></i></button>
        </div>
      `);
    }
    function handleDeleteImage(image_name){
      callModalConfirm(
        "Tem certeza que deseja excluir essa imagem?<br/>Se ele estiver sendo usada em algum lugar, ela não poderá mais ser visualizada.",
        `javascript: deleteImage('${image_name}');`
      );
    }
    function deleteImage(image_name){
      submitLoad();
      $('#modalConfirm').modal('hide');

      let data = {
        gallery_name: `{{ $gallery->path }}`,
        image_name
      };
      $.post(`{{ route('gallery.delete') }}`, data).done((data) => {
        if(!data.result){
          alertNotify('danger',data.response);
          return;
        }
        
        $(`.gallery-image-box[data-filename="${image_name}"]`).remove();
        $('#modalFullScreen').modal('hide');
        alertNotify('success', 'Imagem excluída com sucesso');
      }).fail((err) => {
        console.log(err);
        alertNotify('danger','Houve um erro ao tentar excluir a imagem');
      }).always(() => stopLoad());
    }
  </script>
@endsection