@extends('layouts.admin.app')
@section('content')
@php 
	$full_name = @$user->name.' '.@$user->last_name 
@endphp
<div class="container">
   <!-- Title and Top Buttons Start -->
   <div class="page-title-container">
    <div class="row g-0">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto sw-md-30">
          <a href="{{ route('dashboard.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Dashboard</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">User Info</h1>
        </div>
      </div>
      <!-- Title End -->

      <!-- Top Buttons Start -->
      <div class="w-100 d-md-none"></div>
      <div class="col-auto d-flex align-items-end justify-content-end">
        <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start">
          <i data-acorn-icon="save"></i>
          <span>Save</span>
        </button>
      </div>
      <!-- Top Buttons End -->
    </div>
  </div>
  <!-- Title and Top Buttons End -->
  <div class="row mb-n5">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body">
          <form>
            <div class="mb-3">
              <div id="singleImageUpload">
                <div class="position-relative d-inline-block" id="singleImageUploadExample">
                  <img src="{{ asset('assets/admin/img/profile/profile-11.webp') }}" alt="alternate text"
                    class="rounded-xl border border-separator-light border-4 sw-11 sh-11">
                  <button
                    class="btn btn-sm btn-icon btn-icon-only btn-separator-light rounded-xl position-absolute e-4 b-0"
                    type="button">
                    <i data-acorn-icon="upload"></i>
                  </button>
                  <input class="file-upload" type="file" accept=".png, .jpg, .jpeg">
                </div>
              </div>
            </div>
           
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <div class="mb-5">
        <div class="card mb-2">
          <div class="row g-0 sh-14 sh-md-10">
            <div class="col">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-4 fw-bold text-black">
                    Name
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-black text-md-center">
                    {{ $full_name ?? '' }}
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-primary text-md-end">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#changeNameModal">Change</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="row g-0 sh-14 sh-md-10">
            <div class="col">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-4 fw-bold text-black">
                    Email
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-black text-md-center">
                    {{ $user->email ?? '' }}
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-primary text-md-end">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#changeEmailModal">Update</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="row g-0 sh-14 sh-md-10">
            <div class="col">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-4 fw-bold text-black">
                    Phone
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-black text-md-center">
                    {{ $user->phone ?? '' }}
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-primary text-md-end">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#changePhoneModal">Update</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-2">
          <div class="row g-0 sh-14 sh-md-10">
            <div class="col">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-12 col-md-4 fw-bold text-black">
                    Password
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-black text-md-center">
                    ********************
                  </div>
                  <div class="col-12 col-md-4 fw-bold text-primary text-md-end">
                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('admin.Profile.user_info')
@endsection

@section('script')
  <!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/OverlayScrollbars.min.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/autoComplete.min.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/clamp.min.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-interface.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-commerce.js?time='.@$time) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js?time='.@$time) }}"></script>

  <!-- Vendor Scripts End -->

  <!-- Template Base Scripts Start -->
  <script src="{{ asset('assets/admin/js/base/helpers.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/base/globals.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/base/nav.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/base/search.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/base/settings.js?time='.@$time) }}"></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->

  <script src="{{ asset('assets/admin/js/pages/settings.general.js?time='.@$time) }}"></script>

  <script src="{{ asset('assets/admin/js/common.js?time='.@$time) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.@$time) }}"></script>
  <!-- Page Specific Scripts End -->
</body>

</html>
@endsection