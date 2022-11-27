<div class="modal fade" id="modalEditAddress" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Endereço</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form
          role="form"
          method="POST"
          id="form-modal-edit-address"
        >
          {{ csrf_field() }}
          <input type="hidden" name="id" id="address_id"/>
          <!-- NAME | EMAIL -->
          <div class="row mx-0">
            <div class="col-md-12 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-destiny" class="form-label">Nome Adicional (opcional)</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-destiny"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="191"
                  id="local-destiny"
                />
              </div>
            </div>
            <div class="col-md-4 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-code" class="form-label">CEP</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-code"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="9"
                  data-is-valid="false"
                  data-error="Preencha o CEP"
                />
              </div>
            </div>
            <div class="col-md-6 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-street" class="form-label">Rua</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-street"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="191"
                  data-error="Preencha o nome da rua"
                />
              </div>
            </div>
            <div class="col-md-2 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-number" class="form-label">Número</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-number"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="10"
                  data-error="Digite o número"
                />
              </div>
            </div>
          </div>
          <!-- ADRESS | CONTINUATION -->
          <div class="row mx-0">
            <div class="col-md-5 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-district" class="form-label">Bairro</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-district"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="191"
                  data-error="Preencha o nome do bairro"
                />
              </div>
            </div>
            <div class="col-md-5 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-city" class="form-label">Cidade</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-city"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="191"
                  data-error="Preencha o nome da cidade"
                />
              </div>
            </div>
            <div class="col-md-2 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-state" class="form-label">Estado</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  name="name"
                  id="service-address-state"
                  onfocus="focused(this)"
                  onfocusout="defocused(this)"
                  maxlength="2"
                  data-error="Preencha o nome do estado"
                />
              </div>
            </div>
          </div>
          <div class="row mx-0">
            <div class="col-md-12 px-1">
              <div class="input-group input-group-dynamic mt-3">
                <label for="service-address-complement" class="form-label">Complemento</label>
                <input
                  class="multisteps-form__input form-control"
                  type="text"
                  id="service-address-complement"
                  onfocus="focused(this id"
                  onfocusout="defocused(this)"
                  maxlength="191"
                />
              </div>
            </div>
          </div>
          <div class="ms-auto mt-3" style="
            width: fit-content;
            max-width: 100%;
          "><button type="submit" class="btn bg-gradient-primary mb-0">SALVAR</button></div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function callModalEditAddress(address = null, main = false, ommitLocalAndDestiny = false){
    $('#modalEditAddress form')[0].reset();

    $('#service-address-district').attr('readonly',null);
    $('#service-address-city').attr('readonly',null);
    $('#service-address-state').attr('readonly',null);

    if(main || ommitLocalAndDestiny){
      $('#local-destiny').parent().parent().hide();
    }else{
      $('#local-destiny').val(address ? address.local : null).parent().parent().show();
    }

    if(address){
      $('#modalEditAddress .modal-title').html(main ? 'Endereço Principal': 'Endereço');
  
      $('#service-address-address_id').val(main ? null : address.id);
      $('#service-address-code').val(address.code);
      $('#service-address-street').val(address.street);
      $('#service-address-number').val(address.number);
      $('#service-address-district').val(address.district).attr('readonly','readonly');
      if(address.district) $('#service-address-district').attr('readonly','readonly');
      $('#service-address-city').val(address.city).attr('readonly','readonly');
      if(address.city) $('#service-address-city').attr('readonly','readonly');
      $('#service-address-state').val(address.state).attr('readonly','readonly');
      if(address.state) $('#service-address-state').attr('readonly','readonly');
      $('#service-address-complement').val(address.complement);
    }
    else $('#modalEditAddress .modal-title').html('Novo Endereço');

    $('#modalEditAddress').modal('show');
  }
  var lastZipCodeShowError = null;
  function completeAddress(){
    let code = $('#service-address-code').attr('data-is-valid', 'false').val();
    code = code.replace('-','');

    $('#service-address-district').attr('readonly',null);
    $('#service-address-city').attr('readonly',null);
    $('#service-address-state').attr('readonly',null);

    if(code.length == 8){
      submitLoad();

      delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
      try{
        $.ajax({
          url:`https://viacep.com.br/ws/${code}/json/`,
          method:'GET',
          success:function(data){
            stopLoad();
  
            if(data.erro === true || !data.cep){
              if(!lastZipCodeShowError ||
                lastZipCodeShowError !== code
              ){
                lastZipCodeShowError = code;
                alertNotify('danger','CEP Inválido');
              }
              return;
            }
            
            if(data.bairro) $('#service-address-district').val(data.bairro).attr('readonly','readonly').focus();
            if(data.cep) $('#service-address-code').val(data.cep).attr('data-is-valid', 'true').focus();
            if(data.complemento) $('#service-address-complement').val(data.complemento).focus();
            if(data.localidade) $('#service-address-city').val(data.localidade).attr('readonly','readonly').focus();
            if(data.logradouro) $('#service-address-street').val(data.logradouro).focus();
            if(data.uf) $('#service-address-state').val(data.uf).attr('readonly','readonly').focus();
            if(data.cep && data.logradouro) $('#service-address-number').focus();
          },
        });
      }catch(e){
        console.log(e);
        stopLoad();
      }
      $.ajaxSettings.headers['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
    }
  }
  var addresses = {
    data: [],
    container_id: '#ul-addresses',
    render: (address,i) => {
      let addr = `
        ${ address.street }, ${ address.number } - ${ address.district }.<br/>
        ${ address.city }, ${ address.state }.<br/>
        ${ address.complement ? `<br/>Complemento: ".${ address.complement }`:''}
      `;
      let html = `
        <li class="list-group-item border-0 d-flex p-4 pe-3 mb-2 mt-3 bg-gray-100 border-radius-lg">
          <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex flex-column">
              ${ address.destiny ? `<h6 class="mb-3 text-sm">${ address.destiny }</h6>`:'' }
              <span class="mb-2 text-xs">Endereço: <span class="text-dark ms-sm-2 font-weight-bold">${ addr }</span></span>
              <span class="text-xs">CEP: <span class="text-dark ms-sm-2 font-weight-bold">${ address.code }</span></span>
            </div>
            <button
              type="button"
              class="btn btn-link mb-0 ms-2 text-danger shadow"
              onclick="addresses.remove(${i})"
            ><i class="fas fa-trash"></i></button>
          </div>
        </li>
      `;
      $(addresses.container_id).append(html);
    },
    add: (address) => {
      addresses.data.push(address);

      $('#addresses').val(JSON.stringify(addresses.data));
      
      addresses.render(address, addresses.length - 1);
      return true;
    },
    remove: (index) => {
      if(index >= addresses.data.length){
        alertNotify('danger','Endereço não localizado');
        return false;
      }
      
      addresses.data.splice(index, 1);
      $(addresses.container_id).html('');

      addresses.data.forEach((addr,i) => addresses.render(addr, i));
      return true;
    }
  };
  $('#form-modal-edit-address').on('submit', function(e){
    e.preventDefault();
      
    const alertAndFocusError = (el) => {
      let errorMessage = el.attr('data-error');
      if(errorMessage) alertNotify('danger', errorMessage);
      el.focus();
    };

    let next = false;
    if(!$('#service-address-code').val()) alertAndFocusError($('#service-address-code'));
    else if(!$('#service-address-street').val()) alertAndFocusError($('#service-address-street'));
    else if(!$('#service-address-number').val()) alertAndFocusError($('#service-address-number'));
    else if(!$('#service-address-district').val()) alertAndFocusError($('#service-address-district'));
    else if(!$('#service-address-city').val()) alertAndFocusError($('#service-address-city'));
    else if(!$('#service-address-state').val()) alertAndFocusError($('#service-address-state'));
    else next = true;

    if(!next) return;

    let address = {
      district: $('#service-address-district').val(),
      code: $('#service-address-code').val(),
      complement: $('#service-address-complement').val(),
      city: $('#service-address-city').val(),
      street: $('#service-address-street').val(),
      state: $('#service-address-state').val(),
      number: $('#service-address-number').val(),
      destiny: $('#service-address-destiny').val()
    };

    addresses.add(address);

    $('#modalEditAddress form')[0].reset();
    $('#modalEditAddress').modal('hide');
  });

  $(function(){
    $("#service-address-code").mask("00000-000");
    $("#service-address-code").on("keyup", () => completeAddress());
  });
</script>