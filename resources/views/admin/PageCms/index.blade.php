@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/plyr.css?time='.time()) }}">
@endsection
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto sw-md-30">
          <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Home</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Pages (CMS)</h1>
        </div>
      </div>
      <!-- Title End -->

      <!-- Top Buttons Start -->
      <div class="col-3 d-flex align-items-end justify-content-end d-none">
        <a href="{{ route('pagecms.create') }}" role="button" class="btn btn-sm btn-icon btn-outline-primary">
          <i data-acorn-icon="plus" data-acorn-size="13"></i>
          New Site Page
        </a>
      </div>
      <!-- Top Buttons End -->
    </div>
  </div>
  <!-- Title and Top Buttons End -->

  <!-- Controls Start -->
  <div class="row mb-2">
    <!-- Search Start -->
    <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
      <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
        <input type="search" id="Search" class="form-control" placeholder="Search" />
        <span class="search-magnifier-icon">
          <i data-acorn-icon="search"></i>
        </span>
        <span class="search-delete-icon d-none">
          <i data-acorn-icon="close"></i>
        </span>
      </div>
    </div>
    <!-- Search End -->

    <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
      <div class="d-inline-block">
        <!-- Preview Button Start -->
        <a href="{{ route('home') }}" target="_blank" role="button" class="btn btn-sm btn-icon btn-dark">
          <i data-acorn-icon="eye" data-acorn-size="13"></i>
          Preview Site
        </a>
        <!-- Preview Button End -->
      </div>
    </div>
  </div>
  <!-- Controls End -->

  <!-- Pages List Start -->
  <div class="row">
    <div class="col-12 mb-5">
      <div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
        <div class="card-body pt-0 pb-0 sh-3">
          <div class="row g-0 h-100 align-content-center">
            <!-- <div class="col-md-2 d-flex align-items-center mb-2 mb-md-0 text-muted text-small">ID</div> -->
            <div class="col-md-4 d-flex align-items-center text-muted text-small">NAME</div>

            <div class="col-md-4 d-flex align-items-center text-muted text-small">STATUS</div>
            <div class="col-md-4 d-flex align-items-center text-muted text-small">ACTION</div>
          </div>
        </div>
      </div>
      <div id="pageCmsTable">
        @if(!$data->isEmpty())
        @foreach($data as $page)
        @if($page->name == 'Home')
        <div class="card mb-2">
          <div class="card-body pt-md-0 pb-md-0 sh-md-8">
            <div class="row g-0 h-100 align-content-center">
              <div
                class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Name</div>
                <div class="text-alternate">
                  <a href="{{ route('pagecms.edit',['id' => $page->id ]) }}">{{ $page->name }}</a>
                </div>
              </div>
              <div
                class="col-3 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Status</div>
                <div class="text-alternate">
                  <span class="badge rounded-pill bg-outline-primary">{{ $page->status == 1 ? 'PUBLISH' : 'DRAFT' }}</span>
                </div>
              </div>
              <div
                class="col-2 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Action</div>
                <div class="text-alternate">
                  <!-- Dropdown Button Start -->
                  <div class="ms-1">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light"
                      data-bs-offset="0,3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                      data-submenu>
                      <i data-acorn-icon="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end d-none">
                      <button class="dropdown-item" type="button">Copy</button>
                      <button class="dropdown-item" type="button">Delete</button>
                    </div>
                  </div>
                  <!-- Dropdown Button End -->
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @else
          <p class="text-center mb-0 mt-5 pt-5">{{ _('Pages Not Found!')}}</p>
        @endif
        
      </div>
    </div>
  </div>
  <!-- Pages List End -->

  <!-- Pagination Start -->
    @if(!$data->isEmpty())
      <div class="d-flex justify-content-center">
        @include('layouts.admin.pagination')        
      </div>
    @endif
  <!-- Pagination End -->
</div>
@endsection
@section('script')
<!-- Vendor Scripts Start -->
  <script src="{{ asset('assets/admin/js/vendor/jquery-3.5.1.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/bootstrap.bundle.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/OverlayScrollbars.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/plyr.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/autoComplete.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/clamp.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-interface.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/icon/acorn-icons-commerce.js?time='.time()) }}"></script>

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
  <script src="{{ asset('assets/admin/js/plugins/players.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  <script>
  	$(document).ready(function(){

  		var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $('#Search').on('input',function() {
        var Search_text = $(this).val();
        $.ajax({
          type: 'post',
          url: '{{ route('pagecms.search') }}',
          data: {Search_text:Search_text},
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          success: function(response) {
            if(response.status == true){
              $('#pageCmsTable').html(response.pageCms_html);
              if (response.pagination_html) {
                $('#pagination').html(response.pagination_html);
              }
            } else {
              Swal.fire("Error!", response.message, "error");
            }
          },
          error: function(error) {
            console.error(error);
          }
        });
      });

		var toastElement = $('.toast')[0];
		var toast = new bootstrap.Toast(toastElement);
		toast.show();
  		
  	});
  </script>
</body>
</html>
@endsection