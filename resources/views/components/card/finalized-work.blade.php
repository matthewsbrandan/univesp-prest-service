{{-- 
  $finalizedInThisMonth : integer
  $finalizedWorks : Work[]
  --}}
<div class="card h-100">
  <div class="card-header pb-0">
    <h6>Serviços Encerrados</h6>
    <p class="text-sm mb-0">
      <i class="fa fa-check text-success" aria-hidden="true"></i>
      <span class="font-weight-bold ms-1">{{ $finalizedInThisMonth }} serviço(s)</span> encerrado(s) esse mês
    </p>
  </div>
  <div class="card-body p-3 pb-0">
    <div class="timeline timeline-one-side">
      @foreach($finalizedWorks as $work)
        <div class="timeline-block mb-3">
          <span class="timeline-step" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $work->getStatus() }}">
            @if($work->status == 'canceled_by_applicant') 
              <i class="material-icons text-danger text-gradient">close</i>
            @elseif($work->status == 'canceled_by_provider')
              <i class="material-icons text-danger text-gradient">block</i>
            @elseif($work->status == 'ended')
              <i class="material-icons text-success text-gradient">done</i>
            @endif
          </span>
          <div class="timeline-content">
            <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $work->service->name }}</h6>
            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $work->updated_at->format('d/m/Y')}}</p>
          </div>
        </div>
      @endforeach
    </div>
    @if($finalizedWorks->count() == 0)
      <div class="d-flex align-items-center h-100">
        <div class="mb-3 text-center text-sm w-100">
          Nenhum serviço finalizado
        </div>
      </div>
    @endif
  </div>
</div>