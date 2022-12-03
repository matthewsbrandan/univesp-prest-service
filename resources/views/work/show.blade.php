@php
  $head_title = 'Pedido';
  $body_class = 'g-sidenav-show  bg-gray-200';
  $is_provider = $work->isProvider();
@endphp
@extends('layout.app')
@section('head')
  <style>
    .card.card-blog .card-image {
      box-shadow: 0 .3125rem .625rem 0 rgba(0, 0, 0, .12)
    }
    .card.card-blog .card-image .img {
      width: 100%
    }
    .card.card-blog .card-title a {
      color: #344767
    }
  </style>
@endsection
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => $is_provider ? 'work.order' : 'work'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Pedido',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div style="min-height: calc(100vh - 11rem);">
        <div class="row">
          <div class="col-12">
            <div class="page-header min-height-300 border-radius-xl mt-2" style="background-image: url('{{ $work->service->image }}');">
              <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <a href="{{ route('service.show',['slug' => $work->service->slug]) }}">
                    <h5 class="mb-1">Serviço: {{ $work->service->name }}</h5>
                  </a>
                  <p class="mb-2 font-weight-normal text-sm" style="max-width: 27rem">
                    <span class="text-dark" style="font-weight: 500;">Usuário que solicitou: </span>{{ $work->user->name }}<br/>
                    <span class="text-dark" style="font-weight: 500;">Prestador do serviço: </span>{{ $work->provider->name }}<br/>
                    <span class="text-dark" style="font-weight: 500;">Descrição: </span>{{ $work->description }}
                  </p>
                  @include('components.service-contact-box',[
                    'service' => $work->service
                  ])
                </div>
                <div class="d-flex flex-column">
                  <button
                    type="button"
                    class="btn bg-gradient-dark mb-2"
                  >Chat</button>
                  @if($work->isFinished())
                    <button
                      type="button"
                      class="btn bg-gradient-light mb-2"
                    >Avaliar {{ $is_provider ? 'Cliente' : 'Serviço' }}</button>
                  @endif
                </div>
              </div>
              <div class="alert alert-{{ $work->status == 'ended' ? 'success' : (
                $work->isCanceled() ? 'danger' : 'primary'
              ) }} text-white" role="alert">
                <strong>Status do Serviço: {{ $work->getStatus() }}.</strong> 
                @switch($work->status)
                  @case('requested') Aguardando resposta do prestador, ou finalização de negociação do serviço. @break
                  @case('accepted') Serviço confirmando, e em andamento. @break
                  @case('canceled_by_applicant') Serviço cancelado pelo cliente. @break
                  @case('canceled_by_provider') Serviço cancelado pelo prestador. @break
                  @case('ended') Serviço finalizado! @break
                @endswitch
              </div>
              <div class="text-center">
                @if($work->status == 'accepted')
                  <button
                    type="button"
                    class="btn bg-gradient-success mb-0"
                    onclick="handleEndWork()"
                  >Finalizar Serviço</button>
                @endif
                @if($is_provider)
                 @switch($work->status)
                   @case('requested')
                      <button
                        type="button"
                        class="btn bg-gradient-success mb-0"
                        onclick="handleAcceptWork()"
                      >Aceitar Serviço</button>
                      <button
                        type="button"
                        class="btn bg-gradient-danger mb-0"
                        onclick="handleCancelWork()"
                      >Rejeitar Serviço</button>
                      @break
                    @case('accepted')
                      <button
                        type="button"
                        class="btn bg-gradient-danger mb-0"
                        onclick="handleCancelWork()"
                      >Cancelar Serviço</button>
                      @break
                 @endswitch
                @else
                  @if(!$work->isFinished())
                    <button
                      type="button"
                      class="btn bg-gradient-danger mb-0"
                      onclick="handleCancelWork()"
                    >Cancelar Serviço</button>
                  @endif
                @endif
              </div>
            </div>
            <div class="d-flex flex-wrap mt-5" style="gap: 1rem;">
              <div>
                <strong class="text-dark d-block mb-2">PRESTADOR</strong>
                @include('components.card.user-info',[
                  'user' => $work->provider
                ])
              </div>
              <div>
                <strong class="text-dark d-block mb-2">CLIENTE</strong>
                @include('components.card.user-info',[
                  'user' => $work->user
                ])
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
        'mode' => 'transparent'
      ]])
    </div>
  </main>
@endsection
@section('scripts')
  <script>
    @if($is_provider && $work->status == 'requested')
      function handleAcceptWork(){
        let data = {
          service_id: `{{ $work->service_id }}`,
          work_id: `{{ $work->id }}`
        };
        submitLoad();
        $.post('{{ route('work.accept') }}', data).done(data => {
          if(!data.result){
            alertNotify('danger', data.response);
            return;
          }

          alertNotify('success', data.response);
          alertNotify('info', 'A página irá atualizar em alguns segundos');
          setTimeout(() => window.location.reload(), 3000);
        }).fail(err => {
          alertNotify('danger','Houve um erro inesperado ao tentar executar essa ação');
          console.error(err);
        }).always(() => stopLoad());

      }
    @endif
    @if(!$work->isFinished())
      function handleCancelWork(){
        let data = {
          service_id: `{{ $work->service_id }}`,
          work_id: `{{ $work->id }}`
        };
        submitLoad();
        $.post('{{ route('work.cancel') }}', data).done(data => {
          if(!data.result){
            alertNotify('danger', data.response);
            return;
          }

          alertNotify('success', data.response);
          alertNotify('info', 'A página irá atualizar em alguns segundos');
          setTimeout(() => window.location.reload(), 3000);
        }).fail(err => {
          alertNotify('danger','Houve um erro inesperado ao tentar executar essa ação');
          console.error(err);
        }).always(() => stopLoad());

      }
    @endif
    @if($work->status == 'accepted')
      function handleEndWork(){
        let data = {
          service_id: `{{ $work->service_id }}`,
          work_id: `{{ $work->id }}`
        };
        submitLoad();
        $.post('{{ route('work.finish') }}', data).done(data => {
          if(!data.result){
            alertNotify('danger', data.response);
            return;
          }

          alertNotify('success', data.response);
          alertNotify('info', 'A página irá atualizar em alguns segundos');
          setTimeout(() => window.location.reload(), 3000);
        }).fail(err => {
          alertNotify('danger','Houve um erro inesperado ao tentar executar essa ação');
          console.error(err);
        }).always(() => stopLoad());

      }
    @endif
  </script>
@endsection