<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <h5 class="font-weight-bolder mb-0 pt-2">Endereço</h5>
  <div class="multisteps-form__content">
    <div id="container-addresses">    
      <div class="option_radio">
        <div class="card-body px-0 pt-4">
          <ul class="list-group" id="ul-addresses">
            @if(isset($service) && 
              isset($service->instructions) && 
              isset($service->instructions->addresses)
            )
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
                    <button
                      type="button"
                      class="btn btn-link mb-0 ms-2 text-danger shadow"
                      onclick="addresses.remove({{$i}})"
                    ><i class="fas fa-trash"></i></button>
                  </div>
                </li>
              @endforeach
            @endif
          </ul>
          <ul class="list-group">
            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg" id="add-new-addresses">
              <a
                class="mx-auto btn btn-link text-dark text-center px-3 mb-0"
                href="javascript:;"
                onclick="callModalEditAddress(null, false, true)"
              ><i class="fas fa-plus"></i>&nbsp;&nbsp;Adicionar Novo Endereço</a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <input type="hidden" name="addresses" id="addresses"/>

    <div class="button-row d-flex mt-3">
      <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Anterior">Anterior</button>
      <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Próximo">Próximo</button>
    </div>
  </div>
</div>