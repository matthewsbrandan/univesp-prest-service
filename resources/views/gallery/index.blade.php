@php
  $head_title = 'Galeria';
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['cropper'];
@endphp
@extends('layout.app')
@section('head')
  <style>
    .gallery-image-box .gallery-image-item{
      object-fit: cover;
      width: 100%;
      height: 100%;
      max-height: 15rem;
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
        'name' => 'Galeria',
        'href' => '#'
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
              <img src="{{ auth()->user()->getProfile() }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
          <div class="col-md-8 me-auto text-left mb-4">
            @if($show_limits)
              <div
                class="progress-wrapper mb-2" style="max-width: 20rem;"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-original-title="{{ $total_galleries_size_formatted }}"
              >
                <div class="progress-info">
                  <div class="progress-percentage">
                    <span class="text-sm font-weight-bold">{{ number_format($limit_porcentage,2) }}%</span>
                  </div>
                </div>
                <div class="progress">
                  <div
                    class="progress-bar {{
                      $limit_porcentage < 80 ? 'bg-gradient-info' : (
                        $limit_porcentage < 90 ? 'bg-gradient-warning' : 'bg-gradient-danger'
                      )
                    }}"
                    role="progressbar"
                    aria-valuenow="{{ $limit_porcentage }}"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style="width: {{ $limit_porcentage }}%;"
                  ></div>
                </div>
              </div>
              <p class="text-sm">
                {{
                  $limit_porcentage > 100 ? 
                  'Você atingiu o limite de armazenamento.' : 
                  'Você está com o armazenamento quase cheio.'
                }}
              </p>
            @endif
          </div>
        </div>
        <div class="row">
          @foreach($galleries as $gallery)
            <div class="col-md-6 pb-4">
              <div class="card h-100">
                <div class="card-header pb-0 p-3">
                  <a
                    href="{{ route('gallery.show',['gallery_name' => $gallery->path]) }}"
                    class="d-flex align-items-center nav-link active p-0"
                  >
                    <div class="my-auto w-100">
                      <h6 class="mb-0">{{ $gallery->title }}</h6>
                      @if($show_limits)
                        <div
                          class="progress-wrapper my-2"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          data-bs-original-title="{{ $gallery->total_size_formatted }} ({{ number_format($gallery->limit_porcentage,2) }}%)"
                        >
                          <div class="progress">
                            <div
                              class="progress-bar {{
                                $gallery->limit_porcentage < 30 ? 'bg-gradient-info' : (
                                  $gallery->limit_porcentage < 60 ? 'bg-gradient-warning' : 'bg-gradient-danger'
                                )
                              }}"
                              role="progressbar"
                              aria-valuenow="{{ $gallery->limit_porcentage }}"
                              aria-valuemin="0"
                              aria-valuemax="100"
                              style="width: {{ $gallery->limit_porcentage }}%;"
                            ></div>
                          </div>
                        </div>
                      @endif
                    </div>
                  </a>
                </div>
                <div class="card-body px-3 py-2">
                  <div class="row py-1 h-100" id="gallery-{{ $gallery->path }}">
                    <div class="col-xl-3 col-md-4 col-6 mb-4">
                      <button
                        style="position: relative; min-height: 5rem;"
                        class="
                          shadow-xl border-radius-xl h-100 w-100 border-0 bg-gradient-dark
                          d-flex flex-column justify-content-center align-items-center p-1
                          gallery-image-content
                        "
                        onclick="callModalCropper('{{ $gallery->path }}')"
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        data-bs-original-title="Adicionar nova imagem"
                      >
                        <i class="fa fa-plus text-white"></i>
                      </button>
                    </div>
                    @foreach($gallery->storage as $image)
                      <div class="col-xl-3 col-md-4 col-6 mb-4 gallery-image-box">
                        <div style="position: relative;" class="
                          shadow-xl border-radius-xl h-100 bg-gradient-dark
                          d-flex flex-column justify-content-center align-items-center p-1
                          gallery-image-content
                        ">
                          <img 
                            src="{{ $image->src }}"
                            alt="{{ $image->filename }}"
                            class="img-fluid shadow border-radius-xl gallery-image-item"
                            onclick="handleCallModalFullScreen($(this))"
                          />
                          <!-- <span
                            class="text-xxs"
                            style="position: absolute; bottom: .1rem;"
                          >{{ $image->size_formatted }}</span> -->
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
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
          <input type="hidden"  name="gallery_name" id="gallery_name" required/>
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
    function callModalCropper(gallery_name){
      $('#gallery_name').val(gallery_name);
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

    function handleCallModalFullScreen(el){
      callModalFullScreen(`
        ${el[0].outerHTML}
        <p class="text-sm text-light text-center mt-2 opacity-7">
          Para excluir acesse a galeria da imagem
        </p>
      `);
    }
  </script>
@endsection