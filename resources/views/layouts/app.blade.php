<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Fitness Plan App</title>
    <meta name="description" content="Login Page" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon Tags Start -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/img/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/img/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/img/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/img/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('assets/img/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/img/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/img/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/img/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="img/favicon/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="img/favicon/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="img/favicon/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="img/favicon/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="img/favicon/mstile-310x310.png" />
    <!-- Favicon Tags End -->
    <!-- Font Tags Start -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/font/CS-Interface/style.css') }}" />
    <!-- Font Tags End -->
    <!-- Vendor Styles Start -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/OverlayScrollbars.min.css') }}" />

    <!-- Vendor Styles End -->
    <!-- Template Base Styles Start -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <!-- Template Base Styles End -->

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <script src="{{ asset('assets/js/base/loader.js') }}"></script>
    <!-- Scripts -->
    <style>
      .error{
        color: #dc3545!important;
        display: block !important;
      }
      input.error{
        border:1px solid red !important;
      }
    </style>
  </head>
<body class="h-100">
    <div id="root" class="h-100">
      @if(session('success'))
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed;right: 50px;top: 15px; z-index: 111;">
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
      @yield('content')
    </div>
    <!-- Vendor Scripts Start -->
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/OverlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/autoComplete.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/clamp.min.js') }}"></script>

    <script src="{{ asset('assets/icon/acorn-icons.js') }}"></script>
    <script src="{{ asset('assets/icon/acorn-icons-interface.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/jquery.validate/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/jquery.validate/additional-methods.min.js') }}"></script>

    <!-- Vendor Scripts End -->

    <!-- Template Base Scripts Start -->
    <script src="{{ asset('assets/js/base/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/base/globals.js') }}"></script>
    <script src="{{ asset('assets/js/base/nav.js') }}"></script>
    <script src="{{ asset('assets/js/base/search.js') }}"></script>
    <script src="{{ asset('assets/js/base/settings.js') }}"></script>
    <!-- Template Base Scripts End -->
    <!-- Page Specific Scripts Start -->

    <script src="{{ asset('assets/js/pages/auth.login.js') }}"></script>

    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.validate.min.js?time='.time()) }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
    <script>
      $(document).ready(function () {
        $.validator.addMethod("noSpaces", function(value, element) {
                return this.optional(element) || /^[^\s]+$/.test(value);
            }, "Please enter a single word without spaces.");

         $.validator.addMethod("check_password", function(value, element) {
                return this.optional(element) || /^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/.test(value);
            }, "Please enter a single word without spaces.");

        $("#form-validation").validate({
                rules: {
                    domain_name: {
                        noSpaces: true
                    },
                    password: {
                     check_password: true,

                    }

                },
                messages: {
                    domain_name: {
                        noSpaces: "Please enter a single word without spaces."
                    },
                    phone :{
                      minlength : "Please enter at least 10 characters."
                    },
                    password: {
                      check_password: "Password must be a strong at least one upper case and two special char."
                    },
                }
            });
      });
    </script>
    <!-- Page Specific Scripts End -->
    <script>
      $(document).ready(function(){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('.Change-package').change(function(){
          if($(this).val() == 0){
            $('#free-data').text('Free');
          } else {
            $('#price-data').text($(this).val());
          }
        });

        $('#phone').on("input", function() {
            var inputValue = $(this).val().replace(/\D/g, "");
            var formattedValue = inputValue.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
            if (inputValue.length > 3 && inputValue.length <= 6) {
                formattedValue = inputValue.replace(/(\d{3})(\d{1,3})/, "$1-$2");
            } else if (inputValue.length > 6) {
                formattedValue = inputValue.replace(/(\d{3})(\d{3})(\d+)$/, "$1-$2-$3");
            }

            $(this).val(formattedValue);
        });

        $("#request_again").click(function() {

              var email = $(this).attr('data-user-email');
              $.ajax({
                type: 'post',
                url: '{{ route('request_mail_again') }}',
                data: {email:email},
                headers: {
                  'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                  if(response.status == true){
                    Swal.fire("Success!", response.message, "success");
                  } else {
                    Swal.fire("Error!", response.message, "error");
                  }
                },
                error: function(error) {
                  Swal.fire("Error!", error, "error");
                  console.error(error);
                }
              });

        });

      })  

      var toastElement = $('.toast')[0];
      var toast = new bootstrap.Toast(toastElement);
      toast.show();
    </script>
</body>
</html>
