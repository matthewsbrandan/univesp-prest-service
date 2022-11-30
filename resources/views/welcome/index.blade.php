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
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        @include('layout.navbar',['navbar_options' => (object)[
          'mode' => 'external'
        ]])
      </div>
    </div>
  </div>
  <header>
    <div class="page-header min-vh-50"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/airport.jpg')">
      <span class="mask bg-gradient-dark"></span>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-white text-center">
            <h2 class="text-white">Prest Service</h2>
            <p class="lead">
              Encontre serviços na suas proximidades. Localize seu condomínio ou região e faça parte dessa comunidade
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="position-relative overflow-hidden" style="height:36px;margin-top:-33px;">
      <div class="w-full absolute bottom-0 start-0 end-0"
        style="transform: scale(2);transform-origin: top center;color: #fff;">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
      </div>
    </div>
    <div class="container">
      @include('components.search.area')
    </div>
  </header>  
  <section class="pt-7 pb-0">
    <div class="container">
      <div class="row">
        @foreach($areas as $area)
          @include('components.card.area')
        @endforeach        
      </div>
    </div>
  </section>
  
  <div class="page-header min-vh-100 mt-5">
    <div class="position-absolute fixed-top ms-auto w-50 h-100 rounded-3 z-index-0 d-none d-sm-none d-md-block me-n4"
      style="background-image: url('{{ asset('assets/img/ivancik.jpg') }}'); background-size: cover;">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 d-flex justify-content-center flex-column">
          <div class="card card-body d-flex justify-content-center shadow-lg p-sm-5 blur align-items-center">
            <h3 class="text-center">Quer cadastrar seu condomínio?</h3>
            <p>Se você deseja que seu condomínio esteja em nossa plataforma, entre em contato conosco para validarmos os dados e te ajudar a conhecer esse lado da plataforma.</p>
            <form id="form-contact" autocomplete="off">
              <div class="card-body">
                <div class="mb-4">
                  <label for="contact-email">Email</label>
                  <div class="input-group">
                    <input
                      type="email"
                      id="contact-email"
                      class="form-control"
                      placeholder="..."
                      onfocus="focused(this)" onfocusout="defocused(this)"
                      required
                    />
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label for="contact-message">Mensagem</label>
                  <textarea
                    name="message"
                    class="form-control"
                    id="contact-message"
                    rows="4"
                    required
                  ></textarea>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-check form-switch mb-4">
                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="" required>
                      <label class="form-check-label" for="flexSwitchCheckDefault">
                        Eu aceito os <a
                          href="javascript:;"
                          class="text-dark"
                        ><u>Termos e Condições</u></a>.
                      </label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-dark w-100">Enviar Mensagem</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  @include('layout.footer',['footer_options' => (object)[
    'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
    'mode' => 'transparent'
  ]])

@endsection
@section('scripts')
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  {{-- BEGIN:: HANDLE AREA FILTER --}}
  <script>
    $('#form-search-area').on('submit', function(e){
      e.preventDefault();

      handleFilterAreas();
    });
    function handleFilterAreas(){
      let name = $('#search-area').val().toLowerCase();
      let code = $('#search-area-code').val();

      if(name || code) $('.card-area-item').each(function(){
        hide = false;
        if(name) if(
          !$(this).attr('data-slug').toLowerCase().includes(name) &&
          !$(this).attr('data-name').toLowerCase().includes(name)
        ) hide = true;
        if(code) if(!$(this).attr('data-code').includes(code)) hide = true;
        
        if(hide) $(this).hide('slow').addClass('hided');
        else $(this).show('slow').removeClass('hided');
      });
      else $('.card-area-item').show('slow').removeClass('hided');
    }
    $('#search-area, #search-area-code').on('keyup', () => handleFilterAreas());
  </script>
  {{-- END:: HANDLE AREA FILTER | BEGIN:: HANDLE SEND CONTACT --}}
  <script>
    $(function(){
      $('#form-contact').on('submit', function(e){
        e.preventDefault();
  
        let email = $('#contact-email').val();
        let message = $('#contact-message').val();
  
        let phone = '5519995446606';
        
        let text = `_Contato através do site {{ config('app.name') }}_\n`;
        text+= `*Email:* ${email}\n\n`;
        text+= `[Quero cadastrar meu condomínio]\n${message}`;
        text = encodeURIComponent(text);

        window.location.href = `https://api.whatsapp.com/send?phone=${phone}&text=${text}`;
  
        $('#form-contact')[0].reset();
      })
    })
  </script>
  {{-- END:: HANDLE SEND CONTACT --}}
@endsection