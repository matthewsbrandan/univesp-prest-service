<div class="{{
  isset($search_area_options) && isset($search_area_options->class_name) ?   $search_area_options->class_name : 'row bg-white shadow-lg mt-n6 border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative'
}}">
  <div class="col-lg-5 mt-lg-n2 mt-2">
    <div class="form-group">
      <label for="search-area">Condomínio/Região</label>
      <input
        type="text"
        id="search-area"
        class="form-control"
        placeholder="Condomínio ou região"
        required
      >
    </div>
  </div>
  <div class="col-lg-4 mt-lg-n2 mt-2">
    <div class="form-group">
      <label for="search-area">CEP</label>
      <input
        type="text"
        id="search-area"
        class="form-control"
        placeholder="Digite o CEP"
        required
      >
    </div>
  </div>
  <div class="col-lg-3 mt-lg-n2 mt-2">
    <label>&nbsp;</label>
    <button type="button" class="btn bg-gradient-dark w-100 mb-0">Pesquisar</button>
  </div>
</div>