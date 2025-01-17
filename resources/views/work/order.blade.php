@php
  $head_title = 'Pedidos';
  $body_class = 'g-sidenav-show  bg-gray-200';
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
    'active' => 'work.order'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Pedidos',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid py-4">
      <div style="min-height: calc(100vh - 11rem);">
        <div class="row">
          {{-- BEGIN:: REQUESTED --}}
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Pedidos Solicitados</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0 table-hover">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descrição</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Última Atualização</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($workRequested as $work)
                        <tr onclick="window.location.href= '{{ route('work.show',['order' => $work->order]) }}'">
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img
                                  src="{{ $work->service->image }}"
                                  class="avatar avatar-sm me-3 border-radius-lg"
                                  alt="{{ $work->service->name }}"
                                  style="object-fit: cover;"
                                />
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $work->service->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $work->provider->name }}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0">{{ $work->description }}</p>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span
                              class="badge badge-sm {{ $work->status == 'accepted' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}"
                            >{{$work->getStatus()}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $work->updated_at->format('d/m/Y H:i')}}</span>
                          </td>
                        </tr>
                      @endforeach
                      @if($workRequested->count() == 0)
                        <tr><td colspan="4" class="text-sm text-center">Nenhum pedido solicitado</td></tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- END:: REQUESTED | BEGIN:: ACCEPTED --}}
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Pedidos Aceitos</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0 table-hover">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descrição</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Última Atualização</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($workAccepted as $work)
                        <tr onclick="window.location.href= '{{ route('work.show',['order' => $work->order]) }}'">
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img
                                  src="{{ $work->service->image }}"
                                  class="avatar avatar-sm me-3 border-radius-lg"
                                  alt="{{ $work->service->name }}"
                                  style="object-fit: cover;"
                                />
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $work->service->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $work->provider->name }}</p>
                              </div>
                            </div>
                          </td>
                          <td>
                            <p class="text-xs text-secondary mb-0">{{ $work->description }}</p>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span
                              class="badge badge-sm {{ $work->status == 'accepted' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}"
                            >{{$work->getStatus()}}</span>
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $work->updated_at->format('d/m/Y H:i')}}</span>
                          </td>
                        </tr>
                      @endforeach
                      @if($workAccepted->count() == 0)
                        <tr><td colspan="4" class="text-sm text-center">Nenhum pedido aceito</td></tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>        
        <div class="row">
          {{-- BEGIN:: WORK FINISHED --}}
          <div class="col-md-6">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Pedidos Finalizados</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Avaliação</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($workFinished as $work)
                        <tr>
                          <td>
                            <div class="d-flex px-2">
                              <div>
                                <img
                                  src="{{ $work->service->image }}"
                                  class="avatar avatar-sm rounded-circle me-2"
                                  alt="{{ $work->provider->name }}"
                                >
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm">{{ $work->service->name }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold">{{ $work->getStatus() }}</span>
                          </td>
                          <td class="align-middle text-center">
                            @php
                              $percent = (object)[
                                'value' => '60',
                                'color' => 'bg-gradient-info' // bg-gradient-success, bg-gradient-danger, bg-gradient-warning
                              ];
                            @endphp
                            <div class="d-flex align-items-center justify-content-center">
                              <span class="me-2 text-xs font-weight-bold">{{ $percent->value }}%</span>
                              <div>
                                <div class="progress">
                                  <div
                                    class="progress-bar {{ $percent->color }}"
                                    role="progressbar"
                                    aria-valuenow="{{ $percent->value }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: {{ $percent->value }}%;"
                                  ></div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <button class="btn btn-link text-secondary mb-0">
                              <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                          </td>
                        </tr>
                      @endforeach
                      @if($workFinished->count() == 0)
                        <tr><td colspan="4" class="text-sm text-center">Nenhum pedido finalizado</td></tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- END:: WORK FINISHED | BEGIN:: WORK CANCELED --}}
          <div class="col-md-6">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3">Pedidos Cancelados</h6>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Avaliação</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($workCanceled as $work)
                        <tr>
                          <td>
                            <div class="d-flex px-2">
                              <div>
                                <img
                                  src="{{ $work->service->image }}"
                                  class="avatar avatar-sm rounded-circle me-2"
                                  alt="{{ $work->provider->name }}"
                                >
                              </div>
                              <div class="my-auto">
                                <h6 class="mb-0 text-sm">{{ $work->service->name }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <span class="text-xs font-weight-bold">{{ $work->getStatus() }}</span>
                          </td>
                          <td class="align-middle text-center">
                            @php
                              $percent = (object)[
                                'value' => '60',
                                'color' => 'bg-gradient-info' // bg-gradient-success, bg-gradient-danger, bg-gradient-warning
                              ];
                            @endphp
                            <div class="d-flex align-items-center justify-content-center">
                              <span class="me-2 text-xs font-weight-bold">{{ $percent->value }}%</span>
                              <div>
                                <div class="progress">
                                  <div
                                    class="progress-bar {{ $percent->color }}"
                                    role="progressbar"
                                    aria-valuenow="{{ $percent->value }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                    style="width: {{ $percent->value }}%;"
                                  ></div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="align-middle">
                            <button class="btn btn-link text-secondary mb-0">
                              <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                          </td>
                        </tr>
                      @endforeach
                      @if($workCanceled->count() == 0)
                        <tr><td colspan="4" class="text-sm text-center">Nenhum pedido cancelado</td></tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          {{-- END:: WORK CANCELED --}}
        </div>
      </div>
      @include('layout.footer',['footer_options' => (object)[
        'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
        'mode' => 'transparent'
      ]])
    </div>
  </main>
@endsection