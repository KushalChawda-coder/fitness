<!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/OverlayScrollbars.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/autoComplete.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/clamp.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/icon/acorn-icons.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/icon/acorn-icons-interface.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/cs/scrollspy.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/glide.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/vendor/baguetteBox.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/base/helpers.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/base/globals.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/base/nav.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/base/search.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/base/settings.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/cs/glide.custom.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/plugins/carousels.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/blog.detail.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  @yield('js')
  <script>
    $(document).ready(function(){
      var toastElement = $('.toast')[0];
      var toast = new bootstrap.Toast(toastElement);
      toast.show();
    });
  </script>
</body>
</html>