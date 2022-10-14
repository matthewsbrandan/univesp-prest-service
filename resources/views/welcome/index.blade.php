@php
  $head_title = 'Home';
  $body_class = 'rental';
@endphp
@extends('layout.app')
@section('head')
  <style>
    .colored-shadow {
      transform: scale(.94);
      top: 3.5%;
      filter: blur(12px);
      position: absolute;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: cover;
      z-index: -1;
    }
  </style>
@endsection
@section('content')
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        @include('layout.navbar',['navbar_options' => (object)[
          'mode' => 'external'
        ]])
      </div>
    </div>
  </div>
  <header>
    <div class="page-header min-vh-50"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/airport.jpg')">
      <span class="mask bg-gradient-dark"></span>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-white text-center">
            <h2 class="text-white">Prest Service</h2>
            <p class="lead">
              Encontre serviços na suas proximidades. Localize seu condomínio ou região e faça parte dessa comunidade
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="position-relative overflow-hidden" style="height:36px;margin-top:-33px;">
      <div class="w-full absolute bottom-0 start-0 end-0"
        style="transform: scale(2);transform-origin: top center;color: #fff;">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
      </div>
    </div>
    <div class="container">
      <div class="row bg-white shadow-lg mt-n6 border-radius-md pb-4 p-3 mx-sm-0 mx-1 position-relative">
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
          <label class="">&nbsp;</label>
          <button type="button" class="btn bg-gradient-dark w-100 mb-0">Search</button>
        </div>
      </div>
    </div>
  </header>  
  <section class="pt-7 pb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/house.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/house.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Entire Apartment • 3 Guests • 2 Beds</p>
              <a href="javascript:;">
                <h5>
                  Lovely and cosy apartment
                </h5>
              </a>
              <p>
                Siri's latest trick is offering a hands-free TV viewing experience, that will allow consumers to turn on
                or off their television, change inputs, fast forward.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/pool.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/pool.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Private Room • 1 Guests • 1 Sofa</p>
              <a href="javascript:;">
                <h5>
                  Single room in the center of the city
                </h5>
              </a>
              <p>
                As Uber works through a huge amount of internal management turmoil, the company is also consolidating and
                rationalizing more of its international business.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/antalya.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/antalya.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Entire Apartment • 4 Guests • 2 Beds</p>
              <a href="javascript:;">
                <h5>
                  Independent house bedroom kitchen
                </h5>
              </a>
              <p>
                Music is something that every person has his or her own specific opinion about. Different people have
                different taste, and various types of music.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/tiny-house.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/tiny-house.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Entire Apartment • 2 Guests • 1 Bed</p>
              <a href="javascript:;">
                <h5>
                  Zen Gateway with pool and garden
                </h5>
              </a>
              <p>
                Fast forward, rewind and more, without having to first invoke a specific skill, or even
                press a button on their remote.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/air-bnb.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/air-bnb.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Entire Flat • 8 Guests • 3 Rooms</p>
              <a href="javascript:;">
                <h5>
                  Cheapest hotels for a luxury vacation
                </h5>
              </a>
              <p>
                Today, the company announced it will be combining its rides-on-demand business and UberEATS.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="card card-blog card-plain">
            <div class="position-relative">
              <a class="d-block blur-shadow-image">
                <img
                  src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/palm-house.jpg"
                  alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
              </a>
              <div class="colored-shadow"
                style="background-image: url(&quot;https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/palm-house.jpg&quot;);">
              </div>
            </div>
            <div class="card-body px-1 pt-3">
              <p class="text-gradient text-dark mb-2 text-sm">Entire Apartment • 2 Guests • 1 Bed</p>
              <a href="javascript:;">
                <h5>
                  Cozy Double Room Near Station
                </h5>
              </a>
              <p>
                Different people have different taste, and various types of music have many ways of leaving an impact on
                someone.
              </p>
              <button type="button" class="btn btn-outline-primary btn-sm">From / Night</button>
            </div>
          </div>
        </div>
        <div class="col-sm-7 ms-auto text-end">
          <ul class="pagination pagination-primary mt-4">
            <li class="page-item ms-auto">
              <a class="page-link" href="javascript:;" aria-label="Previous">
                <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
              </a>
            </li>
            <li class="page-item active">
              <a class="page-link" href="javascript:;">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">4</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;">5</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="javascript:;" aria-label="Next">
                <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="py-7 bg-gradient-dark position-relative overflow-hidden">
    <div class="position-absolute w-100 z-inde-1 top-0 mt-n3">
      <svg width="100%" viewBox="0 -2 1920 157" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>wave-down</title>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g fill="#FFFFFF" fill-rule="nonzero">
            <g>
              <path
                d="M0,60.8320331 C299.333333,115.127115 618.333333,111.165365 959,47.8320321 C1299.66667,-15.5013009 1620.66667,-15.2062179 1920,47.8320331 L1920,156.389409 L0,156.389409 L0,60.8320331 Z"
                transform="translate(960.000000, 78.416017) rotate(180.000000) translate(-960.000000, -78.416017) ">
              </path>
            </g>
          </g>
        </g>
      </svg>
    </div>
    <img src="{{ asset('assets/img/shapes/waves-white-2.svg') }}" class="position-absolute opacity-6 h-100 top-0 d-md-block d-none"
      alt="avatar">
    <div class="container pt-6 pb-5 position-relative z-index-3">
      <div class="row">
        <div class="col-md-6 mx-auto text-center">
          <span class="badge badge-white text-dark mb-2">Testimonials</span>
          <h2 class="text-white mb-3">Some thoughts from our clients</h2>
          <h5 class="text-white font-weight-light">
            If you’re selected for them you’ll also get three tickets, opportunity to access Investor Office Hours and
            Mentor Hours and much more all for free.
          </h5>
        </div>
      </div>
      <div class="row mt-8">
        <div class="col-md-4 mb-md-0 mb-7">
          <div class="card">
            <div class="text-center mt-n5 z-index-1">
              <div class="position-relative">
                <div class="blur-shadow-avatar">
                  <img class="avatar avatar-xxl shadow-lg" src="{{ asset('assets/img/team-2.jpg') }}" alt="avatar">
                </div>
                <div
                  class="colored-shadow start-0 end-0 mx-auto avatar-xxl"
                  style="
                    background-image: url({{ asset('assets/img/team-2.jpg') }});
                    transform: scale(.87);
                    width: 110px;
                    height: 110px;
                  "
                ></div>
              </div>
            </div>
            <div class="card-body text-center pb-0">
              <h4 class="mb-0">Olivia Harper</h4>
              <p>@oliviaharper</p>
              <p class="mt-2">
                The connections you make at Web Summit are unparalleled, we met users all over the world.
              </p>
            </div>
            <div class="card-footer text-center pt-2">
              <div class="mx-auto">
                <svg class="opacity-2" width="60px" height="60px" viewBox="0 0 270 270" version="1.1"
                  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>quote-down</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path
                      d="M107.000381,49.033238 C111.792099,48.01429 115.761022,48.6892564 116.625294,50.9407629 C117.72393,53.8028077 113.174473,58.3219079 107.017635,60.982801 C107.011653,60.9853863 107.00567,60.9879683 106.999688,60.990547 C106.939902,61.0219589 106.879913,61.0439426 106.820031,61.0659514 C106.355389,61.2618887 105.888177,61.4371549 105.421944,61.5929594 C88.3985192,68.1467602 80.3242628,76.9161885 70.3525495,90.6906738 C60.0774843,104.884196 54.9399518,119.643717 54.9399518,134.969238 C54.9399518,138.278158 55.4624127,140.716309 56.5073346,142.283691 C57.2039492,143.328613 57.9876406,143.851074 58.8584088,143.851074 C59.7291771,143.851074 61.0353294,143.241536 62.7768659,142.022461 C68.3497825,138.016927 75.4030052,136.01416 83.9365338,136.01416 C93.8632916,136.01416 102.658051,140.063232 110.320811,148.161377 C117.983572,156.259521 121.814952,165.88151 121.814952,177.027344 C121.814952,188.695638 117.417572,198.970703 108.622813,207.852539 C99.828054,216.734375 89.1611432,221.175293 76.6220807,221.175293 C61.9931745,221.175293 49.3670351,215.166992 38.7436627,203.150391 C28.1202903,191.133789 22.8086041,175.024577 22.8086041,154.822754 C22.8086041,131.312012 30.0359804,110.239421 44.490733,91.6049805 C58.2196377,73.906272 74.3541002,59.8074126 102.443135,50.4450748 C102.615406,50.3748509 102.790055,50.3058192 102.966282,50.2381719 C104.199241,49.7648833 105.420135,49.3936487 106.596148,49.1227802 L107,49 Z M233.000381,49.033238 C237.792099,48.01429 241.761022,48.6892564 242.625294,50.9407629 C243.72393,53.8028077 239.174473,58.3219079 233.017635,60.982801 C233.011653,60.9853863 233.00567,60.9879683 232.999688,60.990547 C232.939902,61.0219589 232.879913,61.0439426 232.820031,61.0659514 C232.355389,61.2618887 231.888177,61.4371549 231.421944,61.5929594 C214.398519,68.1467602 206.324263,76.9161885 196.352549,90.6906738 C186.077484,104.884196 180.939952,119.643717 180.939952,134.969238 C180.939952,138.278158 181.462413,140.716309 182.507335,142.283691 C183.203949,143.328613 183.987641,143.851074 184.858409,143.851074 C185.729177,143.851074 187.035329,143.241536 188.776866,142.022461 C194.349783,138.016927 201.403005,136.01416 209.936534,136.01416 C219.863292,136.01416 228.658051,140.063232 236.320811,148.161377 C243.983572,156.259521 247.814952,165.88151 247.814952,177.027344 C247.814952,188.695638 243.417572,198.970703 234.622813,207.852539 C225.828054,216.734375 215.161143,221.175293 202.622081,221.175293 C187.993174,221.175293 175.367035,215.166992 164.743663,203.150391 C154.12029,191.133789 148.808604,175.024577 148.808604,154.822754 C148.808604,131.312012 156.03598,110.239421 170.490733,91.6049805 C184.219638,73.906272 200.3541,59.8074126 228.443135,50.4450748 C228.615406,50.3748509 228.790055,50.3058192 228.966282,50.2381719 C230.199241,49.7648833 231.420135,49.3936487 232.596148,49.1227802 L233,49 Z"
                      fill="#48484A" fill-rule="nonzero"
                      transform="translate(135.311778, 134.872794) scale(-1, -1) translate(-135.311778, -134.872794) ">
                    </path>
                  </g>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-md-0 mb-7">
          <div class="card">
            <div class="text-center mt-n5 z-index-1">
              <div class="position-relative">
                <div class="blur-shadow-avatar">
                  <img class="avatar avatar-xxl shadow-lg" src="{{ asset('assets/img/team-3.jpg') }}" alt="avatar">
                </div>
                <div class="colored-shadow start-0 end-0 mx-auto avatar-xxl"
                  style="background-image: url({{ asset('assets/img/team-3.jpg') }});"></div>
              </div>
            </div>
            <div class="card-body text-center pb-0">
              <h4 class="mb-0">Simon Lauren</h4>
              <p>@simonlaurent</p>
              <p class="mt-2">
                The networking at Web Summit is like no other European tech conference. Everything is amazing.
              </p>
            </div>
            <div class="card-footer text-center pt-2">
              <div class="mx-auto">
                <svg class="opacity-2" width="60px" height="60px" viewBox="0 0 270 270" version="1.1"
                  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>quote-down</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path
                      d="M107.000381,49.033238 C111.792099,48.01429 115.761022,48.6892564 116.625294,50.9407629 C117.72393,53.8028077 113.174473,58.3219079 107.017635,60.982801 C107.011653,60.9853863 107.00567,60.9879683 106.999688,60.990547 C106.939902,61.0219589 106.879913,61.0439426 106.820031,61.0659514 C106.355389,61.2618887 105.888177,61.4371549 105.421944,61.5929594 C88.3985192,68.1467602 80.3242628,76.9161885 70.3525495,90.6906738 C60.0774843,104.884196 54.9399518,119.643717 54.9399518,134.969238 C54.9399518,138.278158 55.4624127,140.716309 56.5073346,142.283691 C57.2039492,143.328613 57.9876406,143.851074 58.8584088,143.851074 C59.7291771,143.851074 61.0353294,143.241536 62.7768659,142.022461 C68.3497825,138.016927 75.4030052,136.01416 83.9365338,136.01416 C93.8632916,136.01416 102.658051,140.063232 110.320811,148.161377 C117.983572,156.259521 121.814952,165.88151 121.814952,177.027344 C121.814952,188.695638 117.417572,198.970703 108.622813,207.852539 C99.828054,216.734375 89.1611432,221.175293 76.6220807,221.175293 C61.9931745,221.175293 49.3670351,215.166992 38.7436627,203.150391 C28.1202903,191.133789 22.8086041,175.024577 22.8086041,154.822754 C22.8086041,131.312012 30.0359804,110.239421 44.490733,91.6049805 C58.2196377,73.906272 74.3541002,59.8074126 102.443135,50.4450748 C102.615406,50.3748509 102.790055,50.3058192 102.966282,50.2381719 C104.199241,49.7648833 105.420135,49.3936487 106.596148,49.1227802 L107,49 Z M233.000381,49.033238 C237.792099,48.01429 241.761022,48.6892564 242.625294,50.9407629 C243.72393,53.8028077 239.174473,58.3219079 233.017635,60.982801 C233.011653,60.9853863 233.00567,60.9879683 232.999688,60.990547 C232.939902,61.0219589 232.879913,61.0439426 232.820031,61.0659514 C232.355389,61.2618887 231.888177,61.4371549 231.421944,61.5929594 C214.398519,68.1467602 206.324263,76.9161885 196.352549,90.6906738 C186.077484,104.884196 180.939952,119.643717 180.939952,134.969238 C180.939952,138.278158 181.462413,140.716309 182.507335,142.283691 C183.203949,143.328613 183.987641,143.851074 184.858409,143.851074 C185.729177,143.851074 187.035329,143.241536 188.776866,142.022461 C194.349783,138.016927 201.403005,136.01416 209.936534,136.01416 C219.863292,136.01416 228.658051,140.063232 236.320811,148.161377 C243.983572,156.259521 247.814952,165.88151 247.814952,177.027344 C247.814952,188.695638 243.417572,198.970703 234.622813,207.852539 C225.828054,216.734375 215.161143,221.175293 202.622081,221.175293 C187.993174,221.175293 175.367035,215.166992 164.743663,203.150391 C154.12029,191.133789 148.808604,175.024577 148.808604,154.822754 C148.808604,131.312012 156.03598,110.239421 170.490733,91.6049805 C184.219638,73.906272 200.3541,59.8074126 228.443135,50.4450748 C228.615406,50.3748509 228.790055,50.3058192 228.966282,50.2381719 C230.199241,49.7648833 231.420135,49.3936487 232.596148,49.1227802 L233,49 Z"
                      fill="#48484A" fill-rule="nonzero"
                      transform="translate(135.311778, 134.872794) scale(-1, -1) translate(-135.311778, -134.872794) ">
                    </path>
                  </g>
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-md-0 mb-7">
          <div class="card">
            <div class="text-center mt-n5 z-index-1">
              <div class="position-relative">
                <div class="blur-shadow-avatar">
                  <img class="avatar avatar-xxl shadow-lg" src="{{ asset('assets/img/team-4.jpg') }}" alt="avatar">
                </div>
                <div class="colored-shadow start-0 end-0 mx-auto avatar-xxl"
                  style="background-image: url({{ asset('assets/img/team-4.jpg') }});"></div>
              </div>
            </div>
            <div class="card-body text-center pb-0">
              <h4 class="mb-0">Lucian Eurel</h4>
              <p>@luciaeurel</p>
              <p class="mt-2">
                Web Summit will increase your appetite, your inspiration, your motivation and your network.
              </p>
            </div>
            <div class="card-footer text-center pt-2">
              <div class="mx-auto">
                <svg class="opacity-2" width="60px" height="60px" viewBox="0 0 270 270" version="1.1"
                  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>quote-down</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path
                      d="M107.000381,49.033238 C111.792099,48.01429 115.761022,48.6892564 116.625294,50.9407629 C117.72393,53.8028077 113.174473,58.3219079 107.017635,60.982801 C107.011653,60.9853863 107.00567,60.9879683 106.999688,60.990547 C106.939902,61.0219589 106.879913,61.0439426 106.820031,61.0659514 C106.355389,61.2618887 105.888177,61.4371549 105.421944,61.5929594 C88.3985192,68.1467602 80.3242628,76.9161885 70.3525495,90.6906738 C60.0774843,104.884196 54.9399518,119.643717 54.9399518,134.969238 C54.9399518,138.278158 55.4624127,140.716309 56.5073346,142.283691 C57.2039492,143.328613 57.9876406,143.851074 58.8584088,143.851074 C59.7291771,143.851074 61.0353294,143.241536 62.7768659,142.022461 C68.3497825,138.016927 75.4030052,136.01416 83.9365338,136.01416 C93.8632916,136.01416 102.658051,140.063232 110.320811,148.161377 C117.983572,156.259521 121.814952,165.88151 121.814952,177.027344 C121.814952,188.695638 117.417572,198.970703 108.622813,207.852539 C99.828054,216.734375 89.1611432,221.175293 76.6220807,221.175293 C61.9931745,221.175293 49.3670351,215.166992 38.7436627,203.150391 C28.1202903,191.133789 22.8086041,175.024577 22.8086041,154.822754 C22.8086041,131.312012 30.0359804,110.239421 44.490733,91.6049805 C58.2196377,73.906272 74.3541002,59.8074126 102.443135,50.4450748 C102.615406,50.3748509 102.790055,50.3058192 102.966282,50.2381719 C104.199241,49.7648833 105.420135,49.3936487 106.596148,49.1227802 L107,49 Z M233.000381,49.033238 C237.792099,48.01429 241.761022,48.6892564 242.625294,50.9407629 C243.72393,53.8028077 239.174473,58.3219079 233.017635,60.982801 C233.011653,60.9853863 233.00567,60.9879683 232.999688,60.990547 C232.939902,61.0219589 232.879913,61.0439426 232.820031,61.0659514 C232.355389,61.2618887 231.888177,61.4371549 231.421944,61.5929594 C214.398519,68.1467602 206.324263,76.9161885 196.352549,90.6906738 C186.077484,104.884196 180.939952,119.643717 180.939952,134.969238 C180.939952,138.278158 181.462413,140.716309 182.507335,142.283691 C183.203949,143.328613 183.987641,143.851074 184.858409,143.851074 C185.729177,143.851074 187.035329,143.241536 188.776866,142.022461 C194.349783,138.016927 201.403005,136.01416 209.936534,136.01416 C219.863292,136.01416 228.658051,140.063232 236.320811,148.161377 C243.983572,156.259521 247.814952,165.88151 247.814952,177.027344 C247.814952,188.695638 243.417572,198.970703 234.622813,207.852539 C225.828054,216.734375 215.161143,221.175293 202.622081,221.175293 C187.993174,221.175293 175.367035,215.166992 164.743663,203.150391 C154.12029,191.133789 148.808604,175.024577 148.808604,154.822754 C148.808604,131.312012 156.03598,110.239421 170.490733,91.6049805 C184.219638,73.906272 200.3541,59.8074126 228.443135,50.4450748 C228.615406,50.3748509 228.790055,50.3058192 228.966282,50.2381719 C230.199241,49.7648833 231.420135,49.3936487 232.596148,49.1227802 L233,49 Z"
                      fill="#48484A" fill-rule="nonzero"
                      transform="translate(135.311778, 134.872794) scale(-1, -1) translate(-135.311778, -134.872794) ">
                    </path>
                  </g>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="position-absolute w-100 bottom-0">
      <svg width="100%" viewBox="0 -1 1920 166" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>wave-up</title>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(0.000000, 5.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <g transform="translate(0.000000, -5.000000)">
              <path
                d="M0,70 C298.666667,105.333333 618.666667,95 960,39 C1301.33333,-17 1621.33333,-11.3333333 1920,56 L1920,165 L0,165 L0,70 Z">
              </path>
            </g>
          </g>
        </g>
      </svg>
    </div>
  </section>

  <section class="py-5 mt-5">
    <div class="container">
      <div class="row my-5">
        <div class="col-md-6 mx-auto text-center">
          <h2>Frequently Asked Questions</h2>
          <p>A lot of people don’t appreciate the moment until it’s passed. I'm not trying my hardest, and I'm not trying
            to do </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="accordion" id="accordionRental">
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingOne">
                <button class="accordion-button border-bottom font-weight-bold text-start" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                  aria-controls="collapseOne">
                  How do I order?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionRental">
                <div class="accordion-body text-sm opacity-8">
                  We’re not always in the position that we want to be at. We’re constantly growing. We’re constantly
                  making mistakes. We’re constantly trying to express ourselves and actualize our dreams. If you have the
                  opportunity to play this game
                  of life you need to appreciate every moment. A lot of people don’t appreciate the moment until it’s
                  passed.
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingTwo">
                <button class="accordion-button border-bottom font-weight-bold text-start" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                  aria-controls="collapseTwo">
                  How can i make the payment?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionRental">
                <div class="accordion-body text-sm opacity-8">
                  It really matters and then like it really doesn’t matter. What matters is the people who are sparked by
                  it. And the people who are like offended by it, it doesn’t matter. Because it's about motivating the
                  doers. Because I’m here to follow my dreams and inspire other people to follow their dreams, too.
                  <br>
                  We’re not always in the position that we want to be at. We’re constantly growing. We’re constantly
                  making mistakes. We’re constantly trying to express ourselves and actualize our dreams. If you have the
                  opportunity to play this game of life you need to appreciate every moment. A lot of people don’t
                  appreciate the moment until it’s passed.
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingThree">
                <button class="accordion-button border-bottom font-weight-bold text-start" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                  aria-controls="collapseThree">
                  How much time does it take to receive the order?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionRental">
                <div class="accordion-body text-sm opacity-8">
                  The time is now for it to be okay to be great. People in this world shun people for being great. For
                  being a bright color. For standing out. But the time is now to be okay to be the greatest you. Would you
                  believe in what you believe in, if you were the only one who believed it?
                  If everything I did failed - which it doesn't, it actually succeeds - just the fact that I'm willing to
                  fail is an inspiration. People are so scared to lose that they don't even try. Like, one thing people
                  can't say is that I'm not trying, and I'm not trying my hardest, and I'm not trying to do the best way I
                  know how.
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingFour">
                <button class="accordion-button border-bottom font-weight-bold text-start" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                  aria-controls="collapseFour">
                  Can I resell the products?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionRental">
                <div class="accordion-body text-sm opacity-8">
                  I always felt like I could do anything. That’s the main thing people are controlled by! Thoughts- their
                  perception of themselves! They're slowed down by their perception of themselves. If you're taught you
                  can’t do anything, you won’t do anything. I was taught I could do everything.
                  <br><br>
                  If everything I did failed - which it doesn't, it actually succeeds - just the fact that I'm willing to
                  fail is an inspiration. People are so scared to lose that they don't even try. Like, one thing people
                  can't say is that I'm not trying, and I'm not trying my hardest, and I'm not trying to do the best way I
                  know how.
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h5 class="accordion-header" id="headingFifth">
                <button class="accordion-button border-bottom font-weight-bold text-start" type="button"
                  data-bs-toggle="collapse" data-bs-target="#collapseFifth" aria-expanded="false"
                  aria-controls="collapseFifth">
                  Where do I find the shipping details?
                  <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                  <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                </button>
              </h5>
              <div id="collapseFifth" class="accordion-collapse collapse" aria-labelledby="headingFifth"
                data-bs-parent="#accordionRental">
                <div class="accordion-body text-sm opacity-8">
                  There’s nothing I really wanted to do in life that I wasn’t able to get good at. That’s my skill. I’m
                  not really specifically talented at anything except for the ability to learn. That’s what I do. That’s
                  what I’m here for. Don’t be afraid to be wrong because you can’t learn anything from a compliment.
                  I always felt like I could do anything. That’s the main thing people are controlled by! Thoughts- their
                  perception of themselves! They're slowed down by their perception of themselves. If you're taught you
                  can’t do anything, you won’t do anything. I was taught I could do everything.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="page-header min-vh-100">
    <div class="position-absolute fixed-top ms-auto w-50 h-100 rounded-3 z-index-0 d-none d-sm-none d-md-block me-n4"
      style="background-image: url('{{ asset('assets/img/ivancik.jpg') }}'); background-size: cover;">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-7 d-flex justify-content-center flex-column">
          <div class="card card-body d-flex justify-content-center shadow-lg p-sm-5 blur align-items-center">
            <h3 class="text-center">Contact us</h3>
            <form id="contact-form" method="post" autocomplete="off">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <label>First Name</label>
                    <div class="input-group mb-4">
                      <input class="form-control" placeholder="eg. Michael" aria-label="First Name..." type="text"
                        onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  </div>
                  <div class="col-md-6 ps-2">
                    <label>Last Name</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="eg. Prior" aria-label="Last Name..."
                        onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <label>Email Address</label>
                  <div class="input-group">
                    <input type="email" class="form-control" placeholder="eg. soft@design.com" onfocus="focused(this)"
                      onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="form-group mb-4">
                  <label>Your message</label>
                  <textarea name="message" class="form-control" id="message" rows="4"></textarea>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-check form-switch mb-4">
                      <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                      <label class="form-check-label" for="flexSwitchCheckDefault">I agree to the <a href="javascript:;"
                          class="text-dark"><u>Terms and Conditions</u></a>.</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn bg-gradient-dark w-100">Send Message</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  @include('layout.footer',['footer_options' => (object)[
    'class_name' => 'text-dark footer  pb-2 w-100 pt-5',
    'mode' => 'transparent'
  ]])

@endsection
@section('scripts')
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
@endsection