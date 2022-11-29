@php
  $head_title = 'Home';
  $body_class = 'g-sidenav-show bg-gray-200';
@endphp
@extends('layout.app')
@section('content')
  @include('layout.aside',['aside_options' => (object)[
    'active' => 'dashboard'
  ]])
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('layout.navbar', ['navbar_options' => (object)[
      'items' => [(object)[
        'name' => 'Home',
        'href' => '#'
      ]]
    ]])
    <div class="container-fluid pb-4" style="position: relative;">
      <div class="mb-6" style="min-height: calc(100vh - 9rem);">
        <div class="d-flex align-items-center justify-content-between flex-wrap mb-3">
          @if(auth()->user()->active_area)
            <span class="me-3">Condomínio: <span class="fw-bold">{{ auth()->user()->active_area->name }}</span></span>
          @endif
          <div>
            <a
              href="{{ route('/') }}"
              class="btn bg-gradient-primary text-ellipsis mb-0"
            >Pesquisar Condomínios</a>
            <a
              href="{{ route('service.index') }}"
              class="btn bg-gradient-light text-ellipsis mb-0"
            >Pesquisar Serviços</a>
          </div>
        </div>
        <!-- BEGIN:: SERVICES -->
        <div class="row">
          <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
              <div class="card-header pb-0">
                <div class="row">
                  <div class="col-lg-6 col-7">
                    <h6>Serviços em Andamento</h6>
                    <p class="text-sm mb-0">
                      <i class="fa fa-spinner text-info" aria-hidden="true"></i>
                      <span class="font-weight-bold ms-1">{{ $requestedInThisMonth }} serviço(s)</span> solicitado(s) esse mês
                    </p>
                  </div>
                </div>
              </div>
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Provedor</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Iniciado em</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($works as $work)
                        <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img
                                  src="{{ $work->service->image }}"
                                  class="avatar avatar-sm me-3"
                                  alt="{{ $work->service->name }}"
                                />
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $work->service->name }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="avatar-group mt-2">
                              <div class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $work->provider->name }}">
                                <img src="{{ $work->provider->profile }}" alt="{{ $work->provider->name }}">
                              </div>
                            </div>
                          </td>
                          <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold">{{ $work->created_at->format('d/m/Y') }}</span>
                          </td>
                          <td class="align-middle">
                            <span class="text-xs font-weight-bold">{{ $work->getStatus() }}</span>
                          </td>
                        </tr>
                      @endforeach
                      @if($works->count() == 0)
                        <tr>
                          <td class="align-middle text-sm text-center py-4" colspan="4">
                            Sem serviços em andamento
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h6>Serviços Finalizados</h6>
                <p class="text-sm mb-0">
                  <i class="fa fa-check text-success" aria-hidden="true"></i>
                  <span class="font-weight-bold ms-1">{{ $finalizedInThisMonth }} serviço(s)</span> finalizado(s) esse mês
                </p>
              </div>
              <div class="card-body p-3 pb-0">
                <div class="timeline timeline-one-side">
                  @foreach($finalizedWorks as $work)
                    <div class="timeline-block mb-3">
                      <span class="timeline-step" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $work->getStatus() }}">
                        @if($work->status == 'canceled_by_applicant') 
                          <i class="material-icons text-danger text-gradient">ended</i>
                        @elseif($work->status == 'canceled_by_provider')
                          <i class="material-icons text-danger text-gradient">block</i>
                        @elseif($work->status == 'ended')
                          <i class="material-icons text-success text-gradient">done</i>
                        @endif
                      </span>
                      <div class="timeline-content">
                        <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $work->name }}</h6>
                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $work->updated_at->format('d/m/Y')}}</p>
                      </div>
                    </div>
                  @endforeach
                  @if($finalizedWorks->count() == 0)
                    <div class="d-flex align-items-center h-100">
                      <div class="timeline-block mb-3 text-center text-sm w-100">
                        Nenhum serviço finalizado
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END:: SERVICES -->
      </div>
      @include('layout.footer')
    </div>
  </main>
  @include('layout.fixed-plugin')
@endsection
@section('scripts')
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["M", "T", "W", "T", "F", "S", "S"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "rgba(255, 255, 255, .8)",
          data: [50, 20, 10, 22, 50, 10, 40],
          maxBarThickness: 6
        }, ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });

    var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

    new Chart(ctx3, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0,
          borderWidth: 0,
          pointRadius: 5,
          pointBackgroundColor: "rgba(255, 255, 255, .8)",
          pointBorderColor: "transparent",
          borderColor: "rgba(255, 255, 255, .8)",
          borderWidth: 4,
          backgroundColor: "transparent",
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5],
              color: 'rgba(255, 255, 255, .2)'
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#f8f9fa',
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#f8f9fa',
              padding: 10,
              font: {
                size: 14,
                weight: 300,
                family: "Roboto",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
@endsection