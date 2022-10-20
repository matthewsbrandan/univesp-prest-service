<?php
  /* OPTIONS
    $cropper_options = (object)[
      'viewport' => (object)['w' => 380, 'h' => 253],
      'boundary' => (object)['w' => 440, 'h' => 294],
      'size' => (object)['w'=> 800, 'h'=> 533]
    ];
  */
  if(!isset($cropper_options)) $cropper_options = (object)[];
  if(!isset($cropper_options->viewport)) $cropper_options->viewport = (object)[
    'w' => 380, 'h' => 253
  ];
  if(!isset($cropper_options->boundary)) $cropper_options->boundary = (object)[
    'w' => 440, 'h' => 294
  ];
  if(!isset($cropper_options->size)) $cropper_options->size = (object)[
    'w'=> 800, 'h'=> 533
  ];
?>
<script>
  function handleAddNewImage(){
    $('#modalGallery').modal('hide');
    $('#upload_image').click();
  }
  function selectItemGallery(el){
    $('#modalGallery').modal('hide');
    let name = el.children('img').attr('data-short-src');
    let src = el.children('img').attr('src');
    $('#image_name').val(name);
    $('#uploaded_image').attr('src', src);
    $('#upload_image').val('');
  }
  $(document).ready(function(){
    var $modal = $('#modal');
    
    $('#upload_image').change(function(event){
      var files = event.target.files;

      var done = function(url){
        $('#sample_image').attr('src',url)
        $modal.modal('show');
      };

      if(files && files.length > 0){
        reader = new FileReader();
        reader.onload = function(event){
          done(reader.result);
        };
        reader.readAsDataURL(files[0]);
      }
    });

    $modal.on('shown.bs.modal', function() {
      $('#sample_image').croppie({
        viewport: {
          width: {{ $cropper_options->viewport->w }},
          height: {{ $cropper_options->viewport->h }}
        },
        boundary: {
          width: {{ $cropper_options->boundary->w }},
          height: {{ $cropper_options->boundary->h }}
        },
        mouseWheelZoom: true
      });
    }).on('hidden.bs.modal', function(){
      $('#modal .modal-body').html(`
        <img id="sample_image" src=""/>
      `);
      $('#upload_image').val('');
    });

    $('.js-main-image').on('click', function (ev) {
      $('#sample_image').croppie('result', {
        type: 'rawcanvas',
        size: {
          width: {{ $cropper_options->size->w }},
          height: {{ $cropper_options->size->h }}
        },
        format: 'png'
      }).then(function (canvas) {
        let base64data = canvas.toDataURL();

        $('#image_name').val(base64data);
        $modal.modal('hide');
        $('#uploaded_image').attr('src', base64data);
        $('#upload_image').val('');
      });
    });
  });
</script>