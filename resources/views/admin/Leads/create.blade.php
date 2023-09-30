@extends('layouts.admin.app')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
@endsection
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto">
          <a href="{{ route('leads.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Leads</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Add New Lead</h1>
        </div>
      </div>
      <!-- Title End -->
    </div>
  </div>
  <!-- Title and Top Buttons End -->
  <div class="row">
    <div class="col-12 col-md-4">
      <div class="card mb-3">
        <div class="card-body py-2 px-2 py-lg-3 px-lg-3 text-center">
        <form action="{{ route('leads.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="position-relative d-inline-block" id="singleImageUploadExample">
            <img src="{{ asset('assets/admin/img/profile/profile-11.webp') }}" alt="alternate text"
              class="rounded-100 border border-separator-light border-4 sw-16 sh-16">
            <button
              class="btn btn-sm btn-icon btn-icon-only btn-separator-light rounded-xl position-absolute e-0 b-0"
              type="button">
              <i data-acorn-icon="upload"></i>
            </button>
            <input class="file-upload d-none" type="file" name="profile_image" accept="image/*">
            
          </div>
          <div class="mt-3">
            <h4>Upload Profile Image</h4>
             @error('profile_image')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
             @enderror
          </div>
          <div class="mt-3 mt-lg-5">
            <select class="form-select" name="status">
              <option value="{{ \App\Models\admin\Leads::HOT_LEAD }}" selected>Hot Lead</option>
              <option value="{{ \App\Models\admin\Leads::NOT_GOOD_LEAD }}">Not Good Lead</option>
              <option value="{{ \App\Models\admin\Leads::LOST_LEAD }}">Lost Lead</option>
              <option value="{{ \App\Models\admin\Leads::NEW_LEAD }}">New Lead</option>
              <option value="{{ \App\Models\admin\Leads::FOLLOW_UP }}">Follow Up</option>
            </select>
              @error('status')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-8">
      <div class="card mb-5">
        <div class="card-body">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Name</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="text" class="form-control" value="{{ old('name') }}" name="name">
                @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            {{-- <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">URL's</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="text" class="form-control" value="{{ old('url') }}" name="url">
                @error('url')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div> --}}

            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">URL's</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input name="tagsBasic" value="{{ old('tagsBasic') }}"/>
                @error('tagsBasic')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div> 

            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Company</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="text" class="form-control" value="{{ old('company_name') }}" name="company_name">
                @error('company_name')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Location</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="text" class="form-control" value="{{ old('location') }}" name="location">
                 @error('location')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Address</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <textarea class="form-control" rows="3" name="address">{{ old('address') }}</textarea>
                @error('address')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="email" class="form-control" value="{{ old('email') }}" name="email">
                @error('email')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-3 col-sm-4 col-form-label">Phone</label>
              <div class="col-sm-8 col-md-9 col-lg-10">
                <input type="text" class="form-control" value="{{ old('phone') }}" name="phone">
                 @error('phone')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
            </div>
            
            <div class="mb-3 row mt-5">
              <div class="col-sm-8 col-md-9 col-lg-10 ms-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  <!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/OverlayScrollbars.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/autoComplete.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/clamp.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-interface.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-commerce.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/dropzone.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/singleimageupload.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/imask.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/quill.min.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/quill.active.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/select2.full.min.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/tagify.min.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/vendor/dropzone.min.js?time='.time()) }}"></script>

  <!-- Vendor Scripts End -->

  <!-- Template Base Scripts Start -->
  <script src="{{ asset('assets/admin/js/base/helpers.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/globals.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/nav.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/search.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/settings.js?time='.time()) }}"></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->

  <script src="{{ asset('assets/admin/js/cs/dropzone.templates.js?time='.time()) }}"></script>

  <script src="{{ asset('assets/admin/js/pages/products.detail.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/forms/controls.dropzone.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/cs/dropzone.templates.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  <script>

    $(document).ready(function () {
      $("input[name$='columnslayoutradio']").click(function () {
        var column = $(this).val();
        $("div.column-hide").hide();
        $("#Column" + column).show();
      });
    });

  </script>
</body>

</html>
@endsection