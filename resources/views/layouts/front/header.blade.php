<!DOCTYPE html>
<html lang="en" data-footer="true">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
   <title>Fitness Plan App</title>
   <meta name="description" content="Fitness Plan App" />
   <!-- Favicon Tags Start -->
   <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/img/favicon/apple-touch-icon-57x57.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/img/favicon/apple-touch-icon-114x114.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/img/favicon/apple-touch-icon-72x72.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/img/favicon/apple-touch-icon-144x144.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('assets/img/favicon/apple-touch-icon-60x60.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/img/favicon/apple-touch-icon-120x120.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/img/favicon/apple-touch-icon-76x76.png') }}" />
   <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/img/favicon/apple-touch-icon-152x152.png') }}" />
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-196x196.png" sizes="196x196') }}" />
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-96x96.png" sizes="96x96') }}" />
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png" sizes="32x32') }}" />
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-16x16.png" sizes="16x16') }}" />
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-128.png" sizes="128x128') }}" />
   <meta name="Fitness Plan App" content="&nbsp;" />
   <meta name="msapplication-TileColor" content="#FFFFFF" />
   <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
   <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
   <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
   <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
   <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
   @php $time = time(); @endphp
   <!-- Favicon Tags End -->
   <!-- Font Tags Start -->
   <link rel="preconnect" href="https://fonts.gstatic.com" />
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('assets/font/CS-Interface/style.css?time='.@$time) }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap4.min.css?time='.@$time) }}">
   <!-- Font Tags End -->
   <!-- Vendor Styles Start -->
   <link rel="stylesheet" href="{{ asset('assets/font/CS-Interface/style.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/OverlayScrollbars.min.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/glide.core.min.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/vendor/baguetteBox.min.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/styles.css?time='.@$time) }}">
   <link rel="stylesheet" href="{{ asset('assets/css/main.css?time='.@$time) }}">
   <script src="{{ asset('assets/js/base/loader.js?time='.@$time) }}"></script>

   <!-- Vendor Styles End -->

   <!-- Template Base Styles Start -->
   <link rel="stylesheet" href="{{ asset('assets/css/plans.css?time='.@$time) }}" />

   @if(config('app.env') == 'production')
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-QQ1L49QP4Q"></script>
   <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'G-QQ1L49QP4Q');
   </script>
   <!-- End Google tag -->
   @endif

</head>

<body class="pb-0">
   <header class="main-header">
      <nav class="navbar navbar-expand-lg bg-white fixed-top">
         <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
               <img src="{{ asset('assets/plan-img/logo.svg') }}" alt="logo" class="img-fluid">
            </a>
            <button class="navbar-toggler btn-sm btn-foreground h-auto collapsed" type="button"
               data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
               aria-expanded="false" aria-label="Toggle navigation">
               <!-- <i data-acorn-icon="menu" data-acorn-size="18"></i> -->
               <span class="icon-bar top-bar"></span>
               <span class="icon-bar middle-bar"></span>
               <span class="icon-bar bottom-bar"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#feature">Features</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#price">Price</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="article-category.html">Articles</a>
                  </li>
                  <!-- <li class="nav-item">
                     <a class="nav-link" href="javascript:;">5 MIN/30 DAYS</a>
                  </li> -->
                  <li class="nav-item">
                     <a class="nav-link" href="contact.html">Contact</a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('login') }}" class="btn btn-sm btn-outline-dark h-auto">Login</a>
                  </li>
                  <li class="nav-item">
                     <a href="{{ route('register') }}" class="btn btn-sm btn-dark h-auto">Sign up</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
   </header>