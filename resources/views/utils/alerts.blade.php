<script>
  const classesAlerts = {
    primary: "alert alert-primary border-0 text-white",
    secondary: "alert alert-secondary border-0 text-white",
    success: "alert alert-success border-0 text-white",
    danger: "alert alert-danger border-0 text-white",
    warning: "alert alert-warning border-0 text-white",
    info: "alert alert-info border-0 text-white",
    light: "alert alert-light border-0",
    dark: "alert alert-dark border-0 text-white",
  };
  function alertNotify(type, text, timeout = 6000){
    let notify_id = `${type}_${$('#container-alerts .alert').length}`;
    $('#container-alerts').prepend(`
      <div
        class="${classesAlerts[type]}"
        role="alert"
        id="${notify_id}"
        style="display: none; min-width: 8rem; max-width: 90vw;"
        onclick="$(this).hide('slow');"
      >${text}</div>
    `);
    $(`#${notify_id}`).show('slow');

    if(timeout) setTimeout(() => { $(`#${notify_id}`).hide('slow'); }, timeout);
  }
  $(function(){
    $('body').prepend(`
      <div class="d-flex flex-column justify-content-end" style="
        position: fixed;
        top: 0;
        right: 0;
        padding: 1rem;
        z-index: 9999;
      " id="container-alerts"></div>
    `);
  });
</script>