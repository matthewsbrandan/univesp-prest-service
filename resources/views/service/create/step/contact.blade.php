<div class="multisteps-form__panel border-radius-xl bg-white" data-animation="FadeIn">
  <div class="multisteps-form__content">
    <h5 class="font-weight-bolder pt-1">Redes Sociais</h5>
    {{-- BEGIN:: SOCIAL NETWORK --}}
    <div class="row">
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-facebook" class="form-label">Link do facebook (opcional)</label>
          <input
            type="text"
            name="contact[facebook]"
            class="multisteps-form__input form-control"
            id="contact-facebook"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-instagram" class="form-label">Link do instagram (opcional)</label>
          <input
            type="text"
            name="contact[instagram]"
            class="multisteps-form__input form-control"
            id="contact-instagram"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-twitter" class="form-label">Link do twitter (opcional)</label>
          <input
            type="text"
            name="contact[twitter]"
            class="multisteps-form__input form-control"
            id="contact-twitter"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-youtube" class="form-label">Link do youtube (opcional)</label>
          <input
            type="text"
            name="contact[youtube]"
            class="multisteps-form__input form-control"
            id="contact-youtube"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
    </div>
    {{-- END:: SOCIAL NETWORK --}}
    <h5 class="font-weight-bolder pt-1 mt-4">Contatos</h5>
    <div class="row">
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-twitter" class="form-label">Link do whatsapp (opcional)</label>
          <input
            type="text"
            name="contact[whatsapp]"
            id="contact-whatsapp"          
            class="multisteps-form__input form-control"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-twitter" class="form-label">Link do telefone (opcional)</label>
          <input
            type="text"
            name="contact[phone]"
            id="contact-phone"          
            class="multisteps-form__input form-control"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-twitter" class="form-label">Link do email (opcional)</label>
          <input
            type="text"
            name="contact[email]"
            id="contact-email"          
            class="multisteps-form__input form-control"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
      <div class="col-md-6 mt-3">
        <div class="input-group input-group-dynamic">
          <label for="contact-twitter" class="form-label">Link de site (opcional)</label>
          <input
            type="text"
            name="contact[site]"
            id="contact-site"          
            class="multisteps-form__input form-control"
            data-step="#step-3"
            onfocus="focused(this)"
            onfocusout="defocused(this)"
          />
        </div>
      </div>
    </div>

    <div class="input-group input-group-dynamic mt-3">
      <label for="instruction-additional" class="form-label">Informações adicionais</label>
      <textarea
        class="multisteps-form__input form-control"
        onfocus="focused(this)"
        onfocusout="defocused(this)"
        name="instruction[additional]"
        id="instruction-additional"
        rows="4"
      ></textarea>
    </div>
    <div class="button-row d-flex mt-5">
      <button
        class="btn bg-gradient-light mb-0 js-btn-prev"
        type="button" title="Anterior"
      >Anterior</button>
      <button
        class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
        type="button" title="Próximo"
      >Próximo</button>
    </div>
  </div>
</div>