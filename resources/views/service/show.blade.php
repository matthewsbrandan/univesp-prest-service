@php
  $head_title = 'Serviço: ' . $service->name;
  $body_class = 'g-sidenav-show bg-gray-200';
  $plugins = ['quill', 'confirm'];
  if(!function_exists('handlePlural')){
    function handlePlural($value, $sigular, $plural){
      return $value == 1 ? $sigular : $plural;
    }
  }
@endphp
@extends('layout.app')
@section('head')
  <style>
    [data-bs-toggle="tooltip"]{ cursor: pointer; }
    .content-postservice{ position: relative; }
    .content-postservice.see-more:not(.expanded){
      max-height: 20rem;
      overflow: hidden;

      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      background-image: linear-gradient(to bottom, var(--bs-body-color) 75%, #0022);
    }
    .content-postservice.see-more.expanded{ padding-bottom: 1.4rem; }
    .content-postservice:not(.see-more) .btn-see-more{ display: none; }
    .content-postservice.see-more .btn-see-more{
      position: absolute;
      bottom: .2rem;
      left: 0;
      right: 0;
      width: fit-content;
      margin: auto;
    }
    .explode-publish{
      position: fixed;
      top: 0;
      left: 0;
      right:0;
      bottom: 0;

      overflow-y: auto;
      z-index: 999;

      display: flex;
      justify-content: center;
      align-items: flex-start;

      padding-top: 2%;
      background: #2246;

      transition: .6s;
    }
    .explode-publish .card{
      max-width: 50rem;
    }
    .container-postservice-item .postservice-image,
    #mirror_upload_image img{
      max-height: calc(100vh - 9rem);
      object-fit: cover;
      object-position: center;
    }
  </style>
  <!-- BEGIN:: PREVIEW -->
  <style>
    .container-preview{
      display: flex;
      flex-direction: column;
      border-radius: 1rem;
      border: 1px solid #dde;
      padding: .8rem;
      margin-bottom: 1rem;
      background: #fff2;
      transition: .6s;
      overflow: hidden;
    }
    .container-preview:hover{
      filter: brightness(.8);
      color: inherit !important;
    }
    .container-preview:hover img{
      transform: scale(1.05);
    }
    .container-preview img{
      margin: -.8rem -.8rem .5rem -.8rem;
      width: calc(100% + 1.6rem);
      max-width: calc(100% + 1.6rem);
      object-fit: cover;
      height: 10rem;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
      box-shadow: 0 0 60px #0024;
      transition: .6s;
    }
    .container-preview em{
      font-size: .8rem;
    }
    .container-preview strong{ }
    .container-preview p{
      margin-bottom: 0;
      font-size: .9rem;
    }
    .container-preview a{ display: none; }
  </style>
  <!-- END:: PREVIEW -->
@endsection('head')
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
        {{-- BEGIN:: HEADER --}}
        <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('{{ $service->image }}');">
          <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-0 1">
              Serviço: {{ $service->name }}
            </h5>
            @if($resume = $service->getResumeWorks())
              <div class="ms-2">
                <span
                  class="badge badge-white border text-dark"
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Trabalhos Finalizados"
                >{{ $resume->finished .' '. handlePlural(
                  $resume->finished,
                  'finalizado',
                  'finalizados'
                ) }}</span>
                <span
                  class="badge badge-white border text-dark"
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Trabalhos em Andamento"
                >{{ $resume->processing .' em andamento' }}</span>
                <span
                  class="badge badge-white border text-dark"
                  data-bs-toggle="tooltip"
                  data-bs-placement="top"
                  title="Trabalhos Cancelados"
                >{{ $resume->canceled .' '. handlePlural(
                  $resume->canceled,
                  'cancelado',
                  'cancelados'
                ) }}</span>
              </div>
            @endif
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-0 font-weight-normal text-sm" style="max-width: 27rem">
                {{ $service->description }}
              </p>
              @if(isset($service->contacts->additional))
                <p class="mb-0 font-weight-normal text-sm" style="max-width: 27rem">
                  {{ $service->contacts->additional }}
                </p>
              @endif
              <div class="d-flex align-items-center mt-2" style="gap: 1rem;">
                @if(isset($service->contacts->facebook) && $service->contacts->facebook)
                  <a href="{{ $service->contacts->facebook }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->instagram) && $service->contacts->instagram)
                  <a href="{{ $service->contacts->instagram }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                      <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->twitter) && $service->contacts->twitter)
                  <a href="{{ $service->contacts->twitter }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                      <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->youtube) && $service->contacts->youtube)
                  <a href="{{ $service->contacts->youtube }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                      <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->whatsapp) && $service->contacts->whatsapp)
                  <a href="tel:{{ $service->contacts->whatsapp }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                      <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->phone) && $service->contacts->phone)
                  <a href="tel:{{ $service->contacts->phone }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                      <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->email) && $service->contacts->email)
                  <a href="{{ $service->contacts->email }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                      <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                      <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                    </svg>
                  </a>
                @endif
                @if(isset($service->contacts->site) && $service->contacts->site)
                  <a href="{{ $service->contacts->site }}" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe2" viewBox="0 0 16 16">
                      <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855-.143.268-.276.56-.395.872.705.157 1.472.257 2.282.287V1.077zM4.249 3.539c.142-.384.304-.744.481-1.078a6.7 6.7 0 0 1 .597-.933A7.01 7.01 0 0 0 3.051 3.05c.362.184.763.349 1.198.49zM3.509 7.5c.036-1.07.188-2.087.436-3.008a9.124 9.124 0 0 1-1.565-.667A6.964 6.964 0 0 0 1.018 7.5h2.49zm1.4-2.741a12.344 12.344 0 0 0-.4 2.741H7.5V5.091c-.91-.03-1.783-.145-2.591-.332zM8.5 5.09V7.5h2.99a12.342 12.342 0 0 0-.399-2.741c-.808.187-1.681.301-2.591.332zM4.51 8.5c.035.987.176 1.914.399 2.741A13.612 13.612 0 0 1 7.5 10.91V8.5H4.51zm3.99 0v2.409c.91.03 1.783.145 2.591.332.223-.827.364-1.754.4-2.741H8.5zm-3.282 3.696c.12.312.252.604.395.872.552 1.035 1.218 1.65 1.887 1.855V11.91c-.81.03-1.577.13-2.282.287zm.11 2.276a6.696 6.696 0 0 1-.598-.933 8.853 8.853 0 0 1-.481-1.079 8.38 8.38 0 0 0-1.198.49 7.01 7.01 0 0 0 2.276 1.522zm-1.383-2.964A13.36 13.36 0 0 1 3.508 8.5h-2.49a6.963 6.963 0 0 0 1.362 3.675c.47-.258.995-.482 1.565-.667zm6.728 2.964a7.009 7.009 0 0 0 2.275-1.521 8.376 8.376 0 0 0-1.197-.49 8.853 8.853 0 0 1-.481 1.078 6.688 6.688 0 0 1-.597.933zM8.5 11.909v3.014c.67-.204 1.335-.82 1.887-1.855.143-.268.276-.56.395-.872A12.63 12.63 0 0 0 8.5 11.91zm3.555-.401c.57.185 1.095.409 1.565.667A6.963 6.963 0 0 0 14.982 8.5h-2.49a13.36 13.36 0 0 1-.437 3.008zM14.982 7.5a6.963 6.963 0 0 0-1.362-3.675c-.47.258-.995.482-1.565.667.248.92.4 1.938.437 3.008h2.49zM11.27 2.461c.177.334.339.694.482 1.078a8.368 8.368 0 0 0 1.196-.49 7.01 7.01 0 0 0-2.275-1.52c.218.283.418.597.597.932zm-.488 1.343a7.765 7.765 0 0 0-.395-.872C9.835 1.897 9.17 1.282 8.5 1.077V4.09c.81-.03 1.577-.13 2.282-.287z"/>
                    </svg>
                  </a>
                @endif
              </div>
            </div>
            <button
              type="button"
              class="btn bg-gradient-primary mb-0 ms-2 mt-2"
              onclick="handleToHire()"
            >Contratar</button>
          </div>
        </div>
        {{-- END:: HEADER --}}

        <div class="row">
          {{-- BEGIN:: CONTAINER POSTS --}}
          <div class="col-md-8 mb-md-0 mb-4">
            {{-- BEGIN:: WHAT DO YOU THINK ? --}}
            @if(auth()->user()->id == $service->user_id)
              <div id="card-publish">
                <div class="card mb-3 mt-4">
                  <div class="card-header" style="padding-bottom: 0;">
                    <div id="div-what-do-you-think">
                      <div class="d-flex align-items-center justify-content-between border rounded-3">
                        <p
                          class="text-muted mb-0 p-3"
                          onclick="handleToggleWhatDoYouThink()"
                          style="flex: 1;"
                        >No que está pensando?</p>
                        <div class="p-3">
                          <label
                            class="px-1 m-0 button-image-postservice" style="font-size: 1rem;"
                            onclick="handleSelectOrRemoveImage()"
                          >
                            <i class="ni ni-image" style="vertical-align: middle;"></i>
                          </label>
                          <label
                            class="px-1 m-0 button-video-postservice" style="font-size: 1rem;"
                            onclick="handleShowInputVideo()"
                          >
                            <i class="fa fa-film" style="vertical-align: middle;"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body" style="padding-top: 0;">
                    <form
                      method="post"
                      action="{{ route('post_service.store') }}"
                      enctype="multipart/form-data"
                      class="collapse-postservice"
                      onsubmit="return submitLoad();"
                      style="display: none;"
                      id="form-postservice"
                    >
                      {{ csrf_field() }}
                      <input type="hidden" name="id" id="postservice-id"/>
                      <input type="hidden" name="service_id" value="{{ $service->id }}"/>
                      <input type="hidden" name="content" id="postservice-content"/>
                      <div class="row">
                        <div class="col-12 mb-5 mt-2">
                          <div id="editor"></div>
                        </div>
                        <div class="col-12" id="mirror_upload_image" style="display: none;">
                          <img
                            src=""
                            class="img-fluid border-radius-lg shadow-lg w-100"
                            onclick="callModalFullScreen($(this)[0].outerHTML)"
                            data-bs-toggle="tooltip" data-bs-placement="top" 
                            data-bs-original-title="Clique para expandir"
                          />
                        </div>
                        <div class="col-12" id="mirror_video" style="display: none;">
                          <iframe 
                            width="100%"
                            style="min-height: 15rem;"
                            src=""
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="d-block shadow-xl border-radius-xl"
                          ></iframe>
                          <input type="hidden" name="video_url"/>
                        </div>
                      </div>
                      <div class="button-row d-flex justify-content-between mt-4">
                        <input
                          type="file"
                          accept="image/*"
                          name="image"
                          id="upload_image"
                          style="display:none"
                          onchange="handlePublicationImage(event)"
                        />
                        <input type="hidden" name="image_name" id="upload_image_name"/>
                        <div>
                          <button
                            class="btn bg-gradient-light mb-0"
                            type="button"
                            title="Cancelar"
                            onclick="handleCancelPublication()"
                          >Cancelar</button>
                          <button class="btn bg-gradient-primary mb-0" type="submit" title="Publicar">Publicar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endif
            {{-- END:: WHAT DO YOU THINK ? --}}
            <div class="my-4">
              @foreach($posts as $post)
                <div class="card mb-3 container-postservice-item" id="post-{{ $post->slug }}">
                  <div class="card-header d-flex align-items-center border-bottom py-3">
                    <div class="d-flex align-items-center" style="flex: 1;">
                      <a href="javascript:;">
                        <img
                          src="{{ $post->service->image }}"
                          class="avatar"
                          alt="profile-image"
                          style="object-fit: cover;"
                        >
                      </a>
                      <div class="mx-3 d-flex align-items-center justify-content-between" style="flex: 1;">
                        <div>
                          <a href="javascript:;" class="text-dark font-weight-600 text-sm">
                            {{ $post->service->name }}
                          </a>
                          
                          @if($date_completed = $post->date_completed)
                            <small class="d-block text-muted" style="cursor: pointer;">
                              <span
                                data-bs-toggle="tooltip" data-bs-placement="top" 
                                data-bs-original-title="{{ $date_completed->complete }}"
                              >{{ $date_completed->smart }}</span>
                              @if($date_completed->edited)
                                <span
                                  class="me-2" style="font-weight: 600;"
                                  data-bs-toggle="tooltip" data-bs-placement="top" 
                                  data-bs-original-title="{{ $date_completed->edited }}"
                                >#editado</span>
                              @endif
                            </small>
                          @endif
                        </div>
                        @if(auth()->user()->id == $service->user_id)
                          <div class="ms-auto" style="margin-right: -1rem;">
                            <div class="dropdown">
                              <button class="btn btn-link text-secondary ps-0 pe-2 mb-0" id="dropdown-post-{{$post->id}}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-lg"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end me-sm-n4 me-n3" aria-labelledby="dropdown-post-{{$post->id}}">
                                <a
                                  class="dropdown-item"
                                  href="#form-postservice"
                                  onclick='handleUpdatePublication({{ $post->toJson() }})'
                                >Editar</a>
                                <button
                                  class="dropdown-item"
                                  type="button"
                                  onclick="callModalConfirm('Tem certeza que deseja excluir esta publicação?','{{ route('post_service.delete',['id' => $post->id]) }}')"
                                >Excluir</button>
                              </div>
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    @if($post->link_preview) {!! $post->link_preview !!} @endif
                    @if($post->content)
                      <div class="content-postservice">
                        {!! $post->getContentWithLinks() !!}
                        <button
                          type="button"
                          class="btn btn-sm text-xxs py-1 px-3 bg-gradient-secondary btn-see-more"
                          onclick="handleToggleSeeMorePublication($(this))"
                        >ver mais</button>
                      </div>
                    @endif
                    @if($post->image_formatted)
                      <img
                        alt="Image placeholder"
                        src="{{ $post->image_formatted }}"
                        class="img-fluid border-radius-lg shadow-lg w-100 postservice-image"
                        onclick="callModalFullScreen($(this)[0].outerHTML)"
                        data-bs-toggle="tooltip" data-bs-placement="top" 
                        data-bs-original-title="Clique para expandir"
                      >
                    @endif
                    @if($post->video)
                      <iframe 
                        width="100%"
                        style="min-height: 20rem;"
                        src="{{ $post->video }}"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="d-block shadow-xl border-radius-xl"
                      ></iframe>
                    @endif
                  </div>
                </div>
              @endforeach
              @if($posts->count() == 0)
                <div class="card card-body mt-4 pt-4">
                  <p class="text-muted text-center text-sm">
                    @if(auth()->user()->id == $service->user_id)
                      Você ainda não possui nenhuma publicação
                    @else {{ $service->name }} não possui nenhuma publicação @endif
                  </p>
                </div>
              @endif
            </div>
          </div>
          {{-- END:: CONTAINER POSTS | BEGIN:: ASIDE RIGHT --}}
          <div class="col-md-4 my-4">
            <div class="mb-3">
              <div class="card">
                <div class="card-header pb-0">    
                  <h6 class="mb-0">Endereço(s)</h6>
                </div>
                <div class="card-body pt-0">
                  @if(isset($service) && 
                    isset($service->instructions) && 
                    isset($service->instructions->addresses)
                  )
                    <ul class="list-group" id="ul-addresses">
                      @foreach($service->instructions->addresses as $i => $address)
                        <li class="list-group-item border-0 d-flex p-4 pe-3 mb-2 mt-3 bg-gray-100 border-radius-lg">
                          <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-flex flex-column">
                              @if($address->destiny)
                                <h6 class="mb-3 text-sm">{{ $address->destiny }}</h6>
                              @endif
                              <span class="mb-2 text-xs">Endereço: <span class="text-dark ms-sm-2 font-weight-bold">{!! $service->getAddress($address) !!}</span></span>
                              <span class="text-xs">CEP: <span class="text-dark ms-sm-2 font-weight-bold">{{ $address->code }}</span></span>
                            </div>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>
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
          {{-- END:: ASIDE RIGHT --}}
        </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'footer bottom-2 py-2 w-100'
      ]])
      @include('utils.modals.fullscreen')
      @if(auth()->user()->id == $service->user_id)
        @include('utils.modals.gallery',[
          'gallery_active' => 'publications',
          'gallery_add_fn' => 'handleAddNewImage()',
          'gallery_fn' => 'selectItemGallery($(this))'
        ])
      @endif
    </div>
  </main>
@endsection
@section('scripts')
  <!-- BEGIN:: INITIALIZATION -->
  <script>
    if (document.getElementById('editor')) {
      var quill = new Quill('#editor', {
        theme: 'snow', // Specify theme in configuration
      });

      quill.on('text-change', function(delta, oldDelta, source) {
        $('#postservice-content').val(quill.container.firstChild.innerHTML);
      });
    }
    if (document.getElementById('modal-advertisement-type')) {
      var element = document.getElementById('modal-advertisement-type');
      const affiliateChoices = new Choices(element, {
        searchEnabled: false,
        ...choicesTextTranslated
      });
    };

    $(function(){
      $('.ql-toolbar').append(`
        <span
          class="ql-formats button-video-postservice" style="color: #444; float: right;"
          onclick="handleShowInputVideo()"
        ><i class="fa fa-film" style="vertical-align: middle;"></i></span>
        <span
          class="ql-formats button-image-postservice" style="color: #444; float: right;"
          onclick="handleSelectOrRemoveImage()"
        ><i class="ni ni-image" style="vertical-align: middle;"></i></span>
      `);
      $('.ql-toolbar .ql-link').remove();
    });

    $('#form-postservice').on('submit', function(e){
      if($('#postservice-id').val().length > 0){
        if(!$('#card-publish').hasClass('explode-publish')) $('#postservice-id').val('');
      }
      return submitLoad();
    });
  </script>
  <!-- END:: INITIALIZATION | BEGIN:: HANDLE IMAGE -->
  <script>
    function handleAddNewImage(){
      $('#modalGallery').modal('hide');
      $('#upload_image').click();
    }
    function selectItemGallery(el){
      $('#modalGallery').modal('hide');
      let name = el.children('img').attr('data-short-src');
      let src = el.children('img').attr('src');
      $('#upload_image_name').val(name);
      $('#mirror_upload_image').show('slow').children('img').attr('src', src);
      handleToggleWhatDoYouThink(true);

      $('#mirror_video').hide('slow');
      $('#mirror_video iframe').attr('src', '');
      $('#mirror_video input[name=video_url]').val('');
      handleButtonRemoveVideo(false);

      handleButtonRemoveImage();
    }
    function handlePublicationImage(event){
      let files = event.target.files;
      let src = '';
      if(files){
        for(let index = 0; index < files.length; index++){
          var file = new FileReader();
          file.onload = function(e) {
            src = e.target.result;
            $('#upload_image_name').val(src);
            $('#mirror_upload_image').show('slow').children('img').attr('src', src);
            handleToggleWhatDoYouThink(true);

            $('#mirror_video').hide('slow');
            $('#mirror_video iframe').attr('src', '');
            $('#mirror_video input[name=video_url]').val('');
            handleButtonRemoveVideo(false);

            handleButtonRemoveImage();
          };       
          file.readAsDataURL(files[index]);
        }
      }
    }
  </script>
  <!-- END:: HANDLE IMAGE | BEGIN:: HANDLE PUBLICATIONS -->
  <script>
    $(function(){
      $('.content-postservice').each(function(){
        if($(this).css('height')){
          let parseHeight = $(this).css('height').replace('px','');
          let height = Number(parseHeight);

          if(height > 320){
            $(this).addClass('see-more');
          }
        }
      });

      handleVerifyHashPost();
    });
    function handleVerifyHashPost(){
      if(window.location.href.includes('#')){
        let url = window.location.href.split('#');
        if(url.length < 2) return;
        let id = url[1];
        if(!$(`#${id}`)[0]) return;

        let class_hightlight = 'shadow-lg border border-secondary';
        $(`#${id}`).addClass(class_hightlight);
        setTimeout(() => $(`#${id}`).removeClass(class_hightlight), 5000);
      } 
    }
    function handleToggleSeeMorePublication(elem){
      let                             target = elem.parent();
      if(target.hasClass('expanded')) elem.html('ver mais');
      else elem.html('ver menos');
      
      target.toggleClass('expanded')
    }
    function handleUpdatePublication(postservice){
      handleCancelPublication();
      $('#card-publish').addClass("explode-publish");

      let submit = $('#form-postservice button[type=submit]');
      submit.html('Salvar').attr('title', 'Salvar').prev().show('slow');

      $('#postservice-id').val(postservice.id);
      if(postservice.content){
        $('#postservice-content').val(postservice.content);
        quill.container.firstChild.innerHTML = postservice.content;
      }
      if(postservice.image && postservice.image_formatted){
        $('#upload_image_name').val(postservice.image);
        $('#mirror_upload_image').show('slow').children('img').attr('src', postservice.image_formatted);
        handleButtonRemoveImage();
      }
      if(postservice.video){
        $('#mirror_video iframe').attr('src', postservice.video);
        $('#mirror_video input[name=video_url]').val(postservice.video);
        $('#mirror_video').show('slow');
        handleButtonRemoveVideo();
      }
      handleToggleWhatDoYouThink(true);
    }
    function handleCancelPublication(){
      $('#card-publish').removeClass("explode-publish");
      let submit = $('#form-postservice button[type=submit]');
      submit.html('Publicar').attr('title', 'Publicar');
      $('#form-postservice')[0].reset();
      $('#mirror_upload_image').hide('slow').children('img').attr('src', '');
      $('#mirror_video iframe').attr('src', '').parent().hide('slow');
      handleButtonRemoveImage(false);
      handleButtonRemoveVideo(false);
      quill.container.firstChild.innerHTML = "";
      $('#postservice-id').val('');
      handleToggleWhatDoYouThink(false);
    }
    function handleSelectOrRemoveImage(image_filled = ''){
      let target = $('.button-image-postservice').children();
      if(target.hasClass('ni-image')) $('#modalGallery').modal('show');
      else{
        $('#upload_image_name').val('');
        $('#mirror_upload_image').hide('slow').children('img').attr('src', '');
        handleButtonRemoveImage(false);
      }
    }
    function handleButtonRemoveImage(remove = true){
      let target = $('.button-image-postservice').children();
      if(remove) target.addClass('ni-fat-remove').removeClass('ni-image');
      else target.addClass('ni-image').removeClass('ni-fat-remove');
    }
  </script>
  <!-- END:: HANDLE PUBLICATIONS | BEGIN:: HANDLE SHOW INPUT VIDEO -->
  <script>
    function handleShowInputVideo(){
      let target = $('.button-video-postservice').children();
      if(target.hasClass('fa-close')){
        $('#mirror_video iframe').attr('src', '');
        $('#mirror_video input[name=video_url]').val('');
        $('#mirror_video').hide('slow');
        handleButtonRemoveVideo(false);
        return;
      }
      showMessage(`
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="url">URL do Youtube</label>
              <input
                type="text" name="url" id="url"
                class="form-control" maxlength="190" onkeyup="handleVerifyIfIsYoutubeUrl($(this))"
                placeholder="Digite a URL do Vídeo"
                required
              />
              <div class="invalid-feedback">
                Link do Youtube inválido
              </div>
            </div>
            <label>Preview do Vídeo</label>
            <iframe 
              id="embed"
              width="100%"
              style="min-height: 12rem;"
              src="https://www.youtube.com/embed/"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
              class="d-block shadow-xl border-radius-xl"
            ></iframe>
          </div>        
        </div>
        <button
          type="button"
          class="btn bg-gradient-primary w-100 mt-3 mb-1"
          onclick="handleMirrorVideo()"
        >Adicionar</button>
      `, false, 'Adicionar vídeo');
    }
    function handleButtonRemoveVideo(remove = true){
      let target = $('.button-video-postservice').children();
      if(remove) target.addClass('fa-close').removeClass('fa-film');
      else target.addClass('fa-film').removeClass('fa-close');
    }

    function isYoutubeVideo(url) {
      var v = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
      return (url.match(v)) ? RegExp.$1 : false;
    }
    function handleVerifyIfIsYoutubeUrl(el){
      let youtube_id = isYoutubeVideo(el.val());
      if(!youtube_id) el.addClass('is-invalid');
      else el.removeClass('is-invalid');

      handleYoutubeEmbed(youtube_id);
      
      return !!youtube_id;
    }
    function handleYoutubeEmbed(id){
      if(!id){
        $('#embed').attr('src',``);
        return;
      }

      let url = `https://www.youtube.com/embed/${id}`;
      if(url !== $('#url').val()) $('#url').val(url);

      $('#embed').attr('src', url);
    }
    function handleMirrorVideo(){
      if($('#modalMessage #url').val().length == 0){
        alertNotify('danger', 'Preencha o URL do video para adicioná-lo');
        $('#modalMessage #url').focus();
        return;
      }

      if(!handleVerifyIfIsYoutubeUrl($('#modalMessage #url'))){
        alertNotify('danger','Link do youtube inválido');
        $('#modalMessage #url').focus();
        return;
      }

      let src = $('#modalMessage #embed').attr('src')
      $('#modalMessage').modal('hide');

      handleToggleWhatDoYouThink(true);
      $('#mirror_video iframe').attr('src', src);
      $('#mirror_video input[name=video_url]').val(src);
      $('#mirror_video').show('slow');
      handleButtonRemoveVideo();

      // BEGIN:: HANDLE IMAGE IF IS OPEN
      $('#upload_image_name').val('');
      $('#mirror_upload_image').hide('slow').children('img').attr('src', '');
      handleButtonRemoveImage(false);
      // END:: HANDLE IMAGE IF IS OPEN
    }
    function handleToggleWhatDoYouThink(postservice = null){
      if(postservice === null)  $('#div-what-do-you-think, .collapse-postservice').toggle('slow');
      if(postservice === true){
        $('.collapse-postservice').show('slow');
        $('#div-what-do-you-think').hide('slow');
      }
      if(postservice === false){
        $('.collapse-postservice').hide('slow');
        $('#div-what-do-you-think').show('slow');
      }
      if(postservice !== false) quill.focus();
    }
  </script>
  <!-- END:: HANDLE SHOW INPUT VIDEO -->
  <script>
    const whatsapp = @if(isset($service->contacts->whatsapp) && $service->contacts->whatsapp)
      '{{ $service->getWhatsappUnformatted($service->contacts->whatsapp) }}'
    @else null @endif;

    function handleToHire(){      
      showMessage(`
        <div class="text-start" style="margin-top: -1rem;">
          <p class="text-sm mb-4 pb-2">Descreva o serviços que você deseja solicitar.</p>
          <div class="input-group input-group-dynamic is-filled">
            <label for="service-description" class="form-label">Solicitação</label>
            <textarea
              class="multisteps-form__input form-control"
              onfocus="focused(this)"
              onfocusout="defocused(this)"
              id="service-request"
              rows="4"
            ></textarea>
          </div>
          <button
            type="button"
            class="btn bg-gradient-primary w-100 mb-0 mt-4"
            onclick="handleRequestWork()"
          >Solicitar</button>
        </div>
      `, 'Contratar {{ $service->name }}');    
    }
    function handleRequestWork(){
      let request = $('#service-request').val();
      if(request.length == 0){
        alertNotify('danger','É obrigatório descrever sua solicitação')
        return;
      }

      submitLoad();
      let data = {
        service_id: {{ $service->id }},
        description: request
      }
      $.post('{{ route('work.request') }}', data).done(data => {
        if(!data.result){
          alertNotify('danger', data.response);
          return;
        }

        alertNotify('success','Solicitação de serviço enviada com sucesso');
        if(whatsapp){
          let text = encodeURIComponent(
            `${request}\n\n{{ substr(route('work.show',['order' => 0]),0,-1) }}${data.response}`
          );
          showMessage(`
            <p>Para agilizar o processo você pode entrar em contato direto com o provedor do serviço clicando no botão abaixo.</p>
            <a
              target="_blank"
              href="https://api.whatsapp.com/send?phone=${whatsapp}&text=${text}"
              class="btn bg-gradient-primary mb-0 mt-3 w-100"
            >Entrar em Contato</a>
          `,'Agilize o processo');
        }
        else showMessage(`
          <p>Acompanhe as atualizações de status da sua solicitação</p>
          <a
            href="{{ substr(route('work.show',['order' => 0]),0,-1) }}${data.response}"
            class="btn bg-gradient-primary mb-0 mt-3 w-100"
          >Ver Solicitação</a>
        `, 'Acompanhar Solicitação');
      }).fail(err => {
        alertNotify('danger', 'Houve um erro inesperado ao solicitar o trabalho');
        console.error(err);
      }).always(() => stopLoad());
    }
  </script>
@endsection