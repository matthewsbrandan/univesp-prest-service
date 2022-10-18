const multisteps = {
  progress: {
    el: $('.multisteps-form__progress'),
    btns: (i = null) => i ? 
      $(`.multisteps-form__progress-btn:nth-child(${i})`) :
      $('.multisteps-form__progress-btn'),
    active: () => $('.multisteps-form__progress-btn.js-active')
  },
  form: {
    el: $('.multisteps-form__form'),
    panels: (i = null) => i ? 
      $(`.multisteps-form__panel:nth-child(${i})`) :
      $('.multisteps-form__panel'),
    active: () => $('.multisteps-form__panel.js-active')
  },
  btn_next: $('.js-btn-next'),
  btn_prev: $('.js-btn-prev'),

  clear: () => {
    multisteps.progress.btns().removeClass('js-active');
    multisteps.form.panels().removeClass('js-active');
  }
}

multisteps.progress.btns().on('click', function(){
  let index = $(this).index() + 1;

  multisteps.clear();

  $(this).addClass('js-active');
  multisteps.form.panels(index).addClass('js-active');
});
multisteps.btn_next.on('click', function(){
  let index =  multisteps.form.active().index() + 1; // 1 - n
  let num_panels = multisteps.form.panels().length;

  if(index === num_panels){
    multisteps.form.el.submit();
    return;
  }

  index++; // next index

  multisteps.clear();
  multisteps.progress.btns(index).addClass('js-active');
  multisteps.form.panels(index).addClass('js-active');
});
multisteps.btn_prev.on('click', function(){
  let index =  multisteps.form.active().index(); // 0 - n
  console.log(index);
  if(index === 0) return;

  multisteps.clear();
  multisteps.progress.btns(index).addClass('js-active');
  multisteps.form.panels(index).addClass('js-active');
});