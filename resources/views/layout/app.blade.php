<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    {{ (isset($head_title) ? $head_title . ' | ':'') . config('app.name') }}
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet" />
  <link href="{{ asset('css/global.css') }}" rel="stylesheet"/>

  @isset($plugins)
    @if(in_array('quill', $plugins))
      <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css"/>
    @endif
    @if(in_array('choices', $plugins))
      <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"
      />
    @endif
    @if(in_array('multisteps-form', $plugins))
      <link rel="stylesheet" href="{{ asset('css/multisteps-form.css') }}"/>
    @endif
    @if(in_array('cropper', $plugins))
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif
  @endisset

  @yield('head')
</head>
<body class="{{ $body_class ?? '' }}">
  @yield('content')
  <!-- BEGIN:: HANDLE THEME -->
  <!--   Core JS Files   -->
  <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  @include('utils.loading')
  @include('utils.modals.message')
  @include('utils.alerts')
  @include('utils.toasts')
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if(win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.4') }}"></script>
  <!-- END:: HANDLE THEME | BEGIN:: HANDLE NOTIFY -->
  <script>
    $(function(){
      @if(session()->has('message'))
        showMessage(
          `{!! session()->get('message') !!}`,
          `{{ session()->get('message-title') ?? config('app.name') }}`,
          true
        );
      @endif
      @if(session()->has('open_modal'))
        @if(session()->has('message'))
          setTimeout(() => $('{{ session()->get('open_modal') }}').modal('show'), 3000);
        @else $('{{ session()->get('open_modal') }}').modal('show'); @endif
      @endif
      @if(session()->has('notify'))
        alertNotify('{{ session()->get('notify-type') ?? 'success' }}', `{!! session()->get('notify') !!}`);
      @endif
      @if(session()->has('toast'))
        toastNotify(
          '{{ session()->get('toast-type') ?? 'success' }}',
          `{!! session()->get('toast') !!}`,
          {{ session()->has('toast-title') ?'`' . session()->get('toast-title') . '`' : 'null' }},
          {{ session()->has('toast-time') ? '`' . session()->get('toast-time') . '`' : 'null' }},
          {{ session()->has('toast-icon') ? '`' . session()->get('toast-icon') . '`' : 'null' }},
          {!! session()->has('toast-onclick') ? '`' . session()->get('toast-onclick') . '`' : 'null' !!}
        );
      @endif
      @if(session()->has('sweet'))
        showMessage(
          `{!! session()->get('sweet') !!}`,
          {!! session()->has('sweet-title') ?'`' . session()->get('sweet-title') . '`' : 'null' !!}
        );
      @endif
    });
    if(document.querySelectorAll('textarea.form-control').length != 0) {
      var allTextareas = document.querySelectorAll('textarea.form-control');
      allTextareas.forEach(el => setAttributes(el, {
        "onfocus": "focused(this)",
        "onfocusout": "defocused(this)"
      }));

      $(function(){
        var textareas = document.querySelectorAll('textarea');
  
        for (var i = 0; i < textareas.length; i++) {
          textareas[i].addEventListener('focus', function(e) {
            this.parentElement.classList.add('is-focused');
          }, false);
      
          textareas[i].onkeyup = function(e) {
            if (this.value != "") {
              this.parentElement.classList.add('is-filled');
            } else {
              this.parentElement.classList.remove('is-filled');
            }
          };
      
          textareas[i].addEventListener('focusout', function(e) {
            if (this.value != "") {
              this.parentElement.classList.add('is-filled');
            }
            this.parentElement.classList.remove('is-focused');
          }, false);
        }
      })
    }
  </script>
  <!-- END:: HANDLE NOTIFY -->
  @isset($plugins)
    @if(in_array('quill', $plugins))
      <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
    @endif
    @if(in_array('choices', $plugins))
      <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
      <script>
        const choicesTextTranslated = {
          loadingText: 'Carregando...',
          noResultsText: 'Nenhum resultado encontrado',
          noChoicesText: 'Sem opções para escolher',
          itemSelectText: 'Selecione',
          addItemText: (value) => {
            return `Pressione enter para adicionar <b>"${value}"</b>`;
          },
          maxItemText: (maxItemCount) => {
            return `Somente valores ${maxItemCount} podem ser adicionados`;
          }
        };
      </script>
    @endif
    @if(in_array('jquery-mask', $plugins))
      <script src="{{ asset('js/jquery-mask-plugin-1.14.16.min.js') }}"></script>
    @endif
    @if(in_array('multisteps-form', $plugins))
      <script src="{{ asset('js/multisteps-form.js') }}"></script>
    @endif
    @if(in_array('cropper', $plugins))
      @include('utils.modals.cropper')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endif
    @if(in_array('confirm', $plugins)) @include('utils.modals.confirm') @endif
  @endisset

  @yield('scripts')

  <?php
    if(session()->has('unset-session') && is_array(session()->get('unset-session'))){
      foreach(session()->get('unset-session') as $session_name){
        if(session()->has($session_name)) session()->forget($session_name);
      }
      session()->forget('unset-session');
    }
  ?>
</body>
</html>