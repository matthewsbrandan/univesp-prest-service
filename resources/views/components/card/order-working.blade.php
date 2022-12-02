{{-- 
  $requestedInThisMonth : integer
  $works : Work[]
  (optional) $hide_columns : ['service','provider']
  --}}
@php if(!isset($hide_columns)) $hide_columns = []; @endphp
<div class="card bg-gradient-dark h-100">
  <div class="card-header pb-0 bg-transparent">
    <h6 class="text-white">Pedidos em Andamento</h6>
    <p class="text-sm mb-0">
      <i class="fa fa-spinner text-danger" aria-hidden="true"></i>
      <span class="font-weight-bold ms-1">{{ $requestedInThisMonth }} serviço(s)</span> solicitado(s) esse mês
    </p>
  </div>
  <div class="card-body px-0 pb-2">
    <div class="table-responsive">
      <table class="table align-items-center mb-0 table-hover">
        <thead>
          <tr>
            @if(!in_array('client', $hide_columns))
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
            @endif
            @if(!in_array('service', $hide_columns))
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Serviço</th>
            @endif
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Iniciado em</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($works as $work)
            <tr onclick="window.location.href= '{{ route('work.show',['order' => $work->order]) }}'">
              @if(!in_array('service', $hide_columns))
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img
                        src="{{ $work->user->profile }}"
                        class="avatar avatar-sm me-3"
                        alt="{{ $work->user->name }}"
                        style="object-fit: cover;"
                      />
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white opacity-7">{{ $work->user->name }}</h6>
                    </div>
                  </div>
                </td>
              @endif
              @if(!in_array('provider', $hide_columns))
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img
                        src="{{ $work->service->image }}"
                        alt="{{ $work->service->name }}"
                        class="avatar avatar-sm me-3"
                        style="object-fit: cover;"
                      >
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm text-white opacity-7">{{ $work->service->name }}</h6>
                    </div>
                  </div>
                </td>
              @endif
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
              <td class="align-middle text-sm text-center py-4" colspan="{{ 4 - count($hide_columns) }}">
                Sem serviços em andamento
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>