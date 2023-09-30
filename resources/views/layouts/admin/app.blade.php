<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"color": "light-blue" }}'>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Fitness Plan App </title>
  <meta name="description" content="Fitness Plan App" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @php $time = time(); @endphp
  <!-- Favicon Tags Start -->
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-57x57.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-114x114.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-72x72.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-144x144.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-60x60.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-120x120.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-76x76.png') }}" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/admin/img/favicon/apple-touch-icon-152x152.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon/favicon-196x196.png') }}" sizes="196x196" />
  <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon/favicon-96x96.png') }}" sizes="96x96" />
  <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
  <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
  <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon/favicon-128.png') }}" sizes="128x128" />
  <meta name="Fitness Plan App" content="&nbsp;" />
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="{{ asset('assets/admin/img/favicon/mstile-144x144.png') }}" />
  <meta name="msapplication-square70x70logo" content="{{ asset('assets/admin/img/favicon/mstile-70x70.png') }}" />
  <meta name="msapplication-square150x150logo" content="{{ asset('assets/admin/img/favicon/mstile-150x150.png') }}" />
  <meta name="msapplication-wide310x150logo" content="{{ asset('assets/admin/img/favicon/mstile-310x150.png') }}" />
  <meta name="msapplication-square310x310logo" content="{{ asset('assets/admin/img/favicon/mstile-310x310.png') }}" />
  <!-- Favicon Tags End -->
  <!-- Font Tags Start -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/admin/font/CS-Interface/style.css?time='.@$time) }}" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <!-- Font Tags End -->
  <!-- Vendor Styles Start -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/bootstrap.min.css?time='.@$time) }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/OverlayScrollbars.min.css?time='.@$time) }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2.min.css?time='.@$time) }}" />

  <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/select2-bootstrap4.min.css?time='.@$time) }}" />
  @yield('css')
  <!-- Vendor Styles End -->
  <!-- Template Base Styles Start -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.css?time='.@$time) }}" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css?time='.@$time) }}" />
  

  <!-- Template Base Styles End -->

  <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css?time='.@$time) }}" />
  <script src="{{ asset('assets/admin/js/base/loader.js?time='.@$time) }}"></script>
</head>

<body>
  <div id="root">
    @include('layouts.admin.sidebar')
    <main>
      @if(session('success'))
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed;right: 50px; z-index: 111;">
          <div class="d-flex">
            <div class="toast-body text-white">
              {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @elseif(session('error'))
        <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed;right: 50px; z-index: 111;">
          <div class="d-flex">
            <div class="toast-body text-white">
              {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endif

      <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed;right: 50px; z-index: 111; display: none;">
          <div class="d-flex">
            <div class="toast-body text-white" id="toast-body">
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
      </div>

      @yield('content')
    </main>
  </div>
  @include('layouts.admin.footer')