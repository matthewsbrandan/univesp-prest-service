@php
  use App\Http\Controllers\GalleryController;
  $availableGalleries = GalleryController::availableGalleries();
  $storage = [];

  if(isset($gallery_active) && in_array(
    $gallery_active,
    array_map(function($ag){ return $ag->path; },$availableGalleries->toArray())
  )){
    $dataGallery = (new GalleryController())->get($gallery_active, null, false);
    if($dataGallery->result) $storage = $dataGallery->response->storage;
  }
@endphp
<style>
  #modalGallery .container-buttons [aria-expanded=true]{
    color: #fff !important;
    background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%) !important;
  }
  #modalGallery .container-buttons [aria-expanded=true]:hover{
    color: #fff !important;
    background-color: #344767 !important;
    border-color: #344767 !important;
  }
</style>
<div class="modal fade" id="modalGallery" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Galeria</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="min-height: 70vh;">
        @isset($gallery_add_fn)
          <p class="text-center text-sm">
            Selecione uma imagem da sua galeria ou clique em adicionar nova
          </p>
        @endisset
        <div class="d-flex justify-content-center flex-wrap container-buttons">
          @foreach($availableGalleries as $availableGallery)
            <button 
              class="btn btn-sm px-3 py-2 mb-2 bg-transparent
                {{ isset($gallery_active) && $gallery_active == $availableGallery->path ?
                  '' : ' collapsed '
                }}
              "
              style="min-width: 7rem;"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse_{{ $availableGallery->path }}"
              aria-expanded="{{ isset($gallery_active) && $gallery_active == $availableGallery->path ?
                'true' : 'false'
              }}"
              aria-controls="collapse_{{ $availableGallery->path }}"
              onclick="handleToggleSectionGallery($(this), '{{ $availableGallery->path }}')"
            >{{ $availableGallery->title }}</button>
          @endforeach
        </div>
        <div style="
          height: 50vh;
          overflow-y: auto;
          overflow-x: hidden;
        ">
          @foreach($availableGalleries as $availableGallery)
            @if(isset($gallery_active) && $gallery_active == $availableGallery->path)
              <div class="collapse show" id="collapse_{{ $availableGallery->path }}">
                <div class="card-body">
                  <div class="row container-images loaded">
                    @if(count($storage) == 0)
                      <p class="text-sm text-muted text-center mt-4">
                        Você ainda não possui imagens nesta galeria
                      </p>
                    @endif
                    @foreach($storage as $image)
                      <div class="col-xl-3 col-md-6 mb-4">
                        <div class="
                          shadow-xl border-radius-xl h-100 bg-gradient-dark
                          d-flex flex-column justify-content-center align-items-center p-1
                        " @isset($gallery_fn) onclick="{!! $gallery_fn ?? '' !!}" @endisset>
                          <img 
                            src="{{ $image->src }}"
                            data-short-src="{{ $image->short_src }}"
                            alt="{{ $image->filename }}"
                            class="img-fluid shadow border-radius-xl"
                            style="
                              object-fit: cover;
                              width: 100%;
                              height: 100%;
                              max-height: 9rem;
                            "
                          />
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            @else
              <div class="collapse" id="collapse_{{ $availableGallery->path }}">
                <div class="card-body">
                  <div class="row container-images"></div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
        @isset($gallery_add_fn)
          <div class="text-center">
            <button
              type="button"
              class="btn bg-gradient-light w-100 mb-1 mt-3"
              onclick="{!! $gallery_add_fn !!}"
            >Adicionar nova imagem</button>
          </div>
        @endisset
      </div>
    </div>
  </div>
</div>
<script>
  function handleToggleSectionGallery(el, gallery_name){
    let target = el.attr('data-bs-target');
    let is_expanded = el.attr('aria-expanded') == 'true';

    if(is_expanded){
      $(`#modalGallery .container-buttons [aria-expanded=true]`).each(function(){
        if($(this).attr('data-bs-target') !== target){
          $(this).addClass('collapsed').attr('aria-expanded', 'false');
          $($(this).attr('data-bs-target')).removeClass('show');
        }
      });

      if(!$(`${target} .container-images`).hasClass('loaded')) loadSectionGallery(
        $(`${target} .container-images`),
        gallery_name
      );
    }
  }
  function loadSectionGallery(container, gallery_name){
    const emptyGallery = `
      <p class="text-sm text-muted text-center mt-4">
        Você ainda não possui imagens nesta galeria
      </p>
    `;
    const errorGallery = `
      <p class="text-sm text-muted text-center mt-4">
        Não foi possível carregar essa galeria
      </p>
    `;
    submitLoad();
    let url = `{{ substr(route('gallery.get',['gallery_name' => 0]),0,-1) }}${gallery_name}`
    $.get(url).done((data) => {
      container.addClass('loaded');
      try{
        if(!data.result){
          alertNotify('danger', data.response);
          container.html(errorGallery);
          return; 
        }
        let { count, storage } = data.response;

        container.html(``);
        if(count === 0) container.html(emptyGallery);
        else storage.map(image => container.append(
          renderItemGallery(image)
        ));
      }catch(err){
        console.log(err);
        alertNotify('danger','Houve um erro ao carregar essa galeria');
        container.html(errorGallery);
        stopLoad();
      }
    }).fail((err) => {
      console.log(err);
      alertNotify('danger','Houve um erro ao carregar essa galeria');
      container.html(errorGallery);
    }).always(() => {
      stopLoad();
      container.addClass('loaded');
    });
  }
  function renderItemGallery(image){
    return `
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="
          shadow-xl border-radius-xl h-100 bg-gradient-dark
          d-flex flex-column justify-content-center align-items-center p-1
        " @isset($gallery_fn) onclick="{!! $gallery_fn ?? '' !!}" @endisset>
          <img
            src="${ image.src }"
            data-short-src="${ image.short_src }"
            alt="${ image.filename }"
            class="img-fluid shadow border-radius-xl"
            style="
              object-fit: cover;
              width: 100%;
              height: 100%;
              max-height: 9rem;
            "
          />
        </div>
      </div>
    `;
  }
</script>