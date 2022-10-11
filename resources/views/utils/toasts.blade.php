<div class="position-fixed bottom-1 end-1 pb-3" id="container-toasts" style="z-index: 9999;"></div>
<script>
  function toastNotify(
    type,
    body = '',
    title = '{{ config('app.name') }}',
    time = '',
    icon = 'ni ni-notification-70',
    onclick = null
  ){
    if(title == 'null' || title == null) title = '{{ config('app.name') }}';
    if(time == 'null' || time == null) time = '';
    if(icon == 'null' || icon == null) icon = 'ni ni-notification-70';
    if(onclick == 'null') onclick = null;

    let index = $('.toast-notify-item').length;
    let text_color = `text-${type}`;
    let icon_class = `${icon} me-2 toast-icon ${text_color}`;

    $('#container-toasts').prepend(`
      <button 
        class="d-none toast-btn"
        type="button"
        data-target="notify-toast-${index}"
        id="call-notify-toast-${index}"
      ></button>
      <div 
        class="toast fade hide p-2 mt-2 ${type == 'light' ? 'bg-gradient-secondary text-light' : 'bg-white'} toast-notify-item"
        role="alert" 
        aria-live="assertive" 
        id="notify-toast-${index}"
        aria-atomic="true"
      >
        <div class="toast-header border-0 bg-transparent">
          <i class="${icon_class}"></i>
          <span
            class="me-auto ${['secondary','light'].includes(type) ? '':'text-gradient'} ${text_color} font-weight-bold toast-title"
            ${ onclick ? 'onclick="$(this).parent().next().next().click();"':'' }
          >${title}</span>
          <small class="text-body toast-time">${time}</small>
          <i class="fas fa-times ${type == 'light' ? 'text-white' : 'text-md'} ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body" ${ onclick ? `onclick='${onclick}'` : '' }>
          ${body}
        </div>
      </div>
    `);

    var option = {
      animation:	true,
      autohide:	true,
      delay:	5000
    };

    let toastEl = $(`#notify-toast-${index}`)[0];
    let myToast = new bootstrap.Toast(toastEl, option);
    myToast.show();
  }
</script>