@extends('layouts.admin.app')
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto">
          <a href="{{ route('digitalFiles.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Home</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Digital Files</h1>
        </div>
      </div>
      <!-- Title End -->

    </div>
  </div>
  <!-- Title and Top Buttons End -->



  <!-- Landing Pages List Start -->
  <!-- Pages List Start -->
  <div class="row">
    <div class="col-12 col-md-8">
      <div class="card mb-3">
        <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
	        <form id="landingPageCreate" action="{{ route('digitalFiles.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $data->id }}">
	          <div class="tab-content">
	            <div class="tab-pane fade active show" role="tabpanel">
	              <div class="content-section">
	                <div class="card no-shadow border mb-4">
	                  <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
          		        <div class="mb-3">
          		          <label for="filename" class="form-label">File Name</label>
          		          <input class="form-control" type="text" id="filename" name="file_name"  value="{{ $data->file_name ?? ''}}" required>
          	                @error('file_name')
          		                  <span class="text-danger" role="alert">
          		                      <strong>{{ $message }}</strong>
          		                  </span>
          		            @enderror
          		        </div>
          		        <div class="mb-3">
          		          <label for="formFile" class="form-label">Upload File</label>
          		          <input class="form-control" type="file" id="formFile" name="upload_file" accept=".pdf,.doc,.docx" required>
          		          	@error('upload_file')
          		                  <span class="text-danger" role="alert">
          		                      <strong>{{ $message }}</strong>
          		                  </span>
          		            @enderror
          		        </div>

          		        <div class="mb-3 filled">
          		          @php $file_name = explode('/', $data->upload_file); @endphp
          		          <i data-acorn-icon="link"></i>
          		          <span class="form-control lh-lg">
          		          	<a href="{{ url('/') }}{{ $data->upload_file ?? ''}}"  target="_blank">{{ end($file_name) }}</a>
          		          </span>
          		        </div>
	                  </div>
	                </div>
	              </div>
	              <!-- <hr> -->
	              <div class="row align-items-center">
	                <div class="col-12 col-lg-12">
	                  <button type="submit" class="btn btn-primary">
	                    Save content
	                  </button>
	                  <a href="{{ route('digitalFiles.index') }}" class="btn btn-secondary">
	                    Cancel
	                  </a>
	                </div>
	              </div>
	            </div>
	          </div>
	        </form>
        </div>
      </div>
    </div>
    <!-- <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="input-group mb-3">
            <label for="filename" class="form-label">File</label>
            <iframe src="{{ url($data->upload_file) }}" width="800px" height="600px"></iframe>
          </div>
        </div>
      </div>
    </div> -->
  </div>
  <!-- Landing Pages List End -->
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
  <!-- Page Specific Scripts End -->
  <script type="text/javascript">
  	$(document).ready(function(){
	  	var toastElement = $('.toast')[0];
		var toast = new bootstrap.Toast(toastElement);
		toast.show();
	});
  </script>
</body>

</html>
@endsection