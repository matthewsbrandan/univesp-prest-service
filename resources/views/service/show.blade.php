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
              @include('components.service-contact-box')
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