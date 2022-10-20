@php
  $mode = 'transparent';
  if(isset($footer_options) && isset($footer_options->mode)) $mode = $footer_options->mode;
@endphp
@if($mode == 'transparent')
  <footer class="{{ 
    isset($footer_options) && isset($footer_options->class_name) ?
      $footer_options->class_name : 'footer position-absolute bottom-2 py-2 w-100'
  }}" style="left: 0; right: 0;">
    <div class="container">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-12 col-md-6 my-auto">
          <div class="copyright text-center text-sm {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }} text-lg-start">
            © 2022, projeto integrador III - <a 
              href="https://univesp.br"
              class="font-weight-bold {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }}"
              target="_blank"
            >UNIVESP</a>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://codewriters.space" class="nav-link {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }}" target="_blank">Codewriters</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }}" target="_blank">Sobre</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/blog" class="nav-link {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }}" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/license" class="nav-link pe-0 {{ isset($footer_options) && isset($footer_options->is_text_white) ? 'text-white':'' }}" target="_blank">License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
@endif