@extends('layouts.admin.app')
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-12 col-md-7">
        <a class="muted-link pb-2 d-inline-block hidden" href="#">
          <span class="align-middle lh-1 text-small">&nbsp;</span>
        </a>
        <h1 class="mb-0 pb-0 display-4" id="title">Welcome, Zayn!</h1>
      </div>
      <!-- Title End -->
    </div>
  </div>
  <!-- Title and Top Buttons End -->
  <div class="row my-3">
    <div class="col-12">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <a class="alert-link" href="Orders.List.html">
          You have 7 new orders
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <!-- Stats Start -->
  <div class="row">
    <div class="col-12">
      <div class="d-flex">
        <div class="dropdown-as-select me-3" data-setActive="false" data-childSelector="span">
          <a class="pe-0 pt-0 align-top lh-1 dropdown-toggle" href="#" data-bs-toggle="dropdown"
            aria-expanded="false" aria-haspopup="true">
            <span class="small-title"></span>
          </a>
          <div class="dropdown-menu font-standard">
            <div class="nav flex-column" role="tablist">
              <a class="active dropdown-item text-medium" href="#" aria-selected="true" role="tab">Today's</a>
              <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Weekly</a>
              <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Monthly</a>
              <a class="dropdown-item text-medium" href="#" aria-selected="false" role="tab">Yearly</a>
            </div>
          </div>
        </div>
        <h2 class="small-title">Stats</h2>
      </div>
      <div class="mb-5">
        <div class="row g-2">
          <div class="col-6 col-md-4 col-lg-4">
            <a href="Orders.List.html" class="card h-100 hover-scale-up cursor-pointer">
              <div class="card-body d-flex flex-column align-items-center">
                <div
                  class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                  <i data-acorn-icon="cart" class="text-primary"></i>
                </div>
                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">Total Order in past
                  7 days</div>
                <div class="text-primary cta-4">315</div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4">
            <a href="Storefront.Invoice.html" class="card h-100 hover-scale-up cursor-pointer">
              <div class="card-body d-flex flex-column align-items-center">
                <div
                  class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                  <i data-acorn-icon="user" class="text-primary"></i>
                </div>
                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">
                  User Billed With in 5 Days
                </div>
                <div class="text-primary cta-4">16</div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-4 col-lg-4">
            <div class="card h-100 hover-scale-up cursor-pointer">
              <div class="card-body d-flex flex-column align-items-center">
                <div
                  class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                  <i data-acorn-icon="web" class="text-primary"></i>
                </div>
                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">Total visit to
                  website in past 7 days</div>
                <div class="text-primary cta-4">463</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Stats End -->
</div>
@endsection

@section('script')
  <!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/OverlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/autoComplete.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/clamp.min.js') }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons.js') }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-interface.js') }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-commerce.js') }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/Chart.bundle.min.js') }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/chartjs-plugin-rounded-bar.min.js') }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/jquery.barrating.min.js') }}"></script>

  <!-- Vendor Scripts End -->

  <!-- Template Base Scripts Start -->
  <script src="{{ asset('assets/admin/js/base/helpers.js') }}"></script>
  <script src="{{ asset('assets/admin/js/base/globals.js') }}"></script>
  <script src="{{ asset('assets/admin/js/base/nav.js') }}"></script>
  <script src="{{ asset('assets/admin/js/base/search.js') }}"></script>
  <script src="{{ asset('assets/admin/js/base/settings.js') }}"></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->

  <script src="{{ asset('assets/admin/js/cs/charts.extend.js') }}"></script>

  <script src="{{ asset('assets/admin/js/pages/dashboard.js') }}"></script>

  <script src="{{ asset('assets/admin/js/common.js') }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
  <!-- Page Specific Scripts End -->

</body>

</html>
@endsection