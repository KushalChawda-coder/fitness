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
        <div class="w-auto">
          <a href="{{ route('landing_pages.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Home</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Landing Pages-Lead Collection</h1>
        </div>
      </div>
      <!-- Title End -->
    </div>
  </div>
  <!-- Landing Pages List Start -->
  <!-- Pages List Start -->
  <div class="row">
    <div class="col-12 col-md-8">
      <div class="card mb-3">
        <div class="card-header border-0 pb-0">
          <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs border-bottom" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#first" role="tab"
                type="button" aria-selected="true">
                Content
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#second" role="tab" type="button"
                aria-selected="false">Meta/SEO</button>
            </li>
          </ul>
        </div>
        <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="first" role="tabpanel">
              <div class="content-section">
                <div class="card no-shadow border mb-4">
                  <div class="card-header py-2 px-2 py-lg-3 px-lg-5">
                    <div class="row">
                      <div class="col-8 col-sm-6">
                        <h2 class="cta-2 fw-bold text-black mb-0">Page Content</h2>
                      </div>
                      <div class="col-2 col-sm-6">
                        <div class="text-end">
                          <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                            <i data-acorn-icon="bin"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form id="LandingPageForm" action="{{ route('landing_pages.update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $LandingPage->id }}">
                  <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
                    <div class="row">
                      <div class="col-12 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Main Heading</label>
                          <input type="text" name="main_heading" class="form-control" placeholder="" value="{{ $LandingPage->main_heading ?? '' }}">
                          @error('main_heading')
    			                  <span class="text-danger" role="alert">
    			                      <strong>{{ $message }}</strong>
    			                  </span>
      			             	@enderror
                        </div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Menu Text </label>
                          <input type="text" class="form-control" name="menu_text" placeholder="" value="{{ $LandingPage->menu_text ?? '' }}">
                      	  @error('menu_text')
      		                  <span class="text-danger" role="alert">
      		                      <strong>{{ $message }}</strong>
      		                  </span>
		             	        @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pagesection mb-4">
                <h2 class="small-title fw-bold">Content</h2>
                <div class="card no-shadow border">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-xl-6">
                        <div class="mb-3">
                          <label class="form-label">Tag Line 1 </label>
                          <input type="text" class="form-control" name="brand_name" placeholder="Your Brand" value="{{ $LandingPage->brand_name ?? '' }}">
                          @error('brand_name')
    			                  <span class="text-danger" role="alert">
    			                      <strong>{{ $message }}</strong>
    			                  </span>
				                  @enderror
                        </div>
                        @if(isset($LandingPage->service_name))
                        <div class="mb-3">
                          <label class="form-label">Tag Line 2 </label>
                          <input type="text" class="form-control" name="service_name" placeholder="Your Services" value="{{ $LandingPage->service_name ?? '' }}">
                          @error('service_name')
    			                  <span class="text-danger" role="alert">
    			                      <strong>{{ $message }}</strong>
    			                  </span>
				                  @enderror
                        </div>
                        @endif
                        @if(isset($LandingPage->app_name))
                        <div class="mb-3">
                          <label class="form-label">Tag Line 3 </label>
                          <input type="text" class="form-control" name="app_name" placeholder="Your App" value="{{ $LandingPage->app_name ?? '' }}">
                          @error('app_name')
    			                  <span class="text-danger" role="alert">
    			                      <strong>{{ $message }}</strong>
    			                  </span>
      				            @enderror
                        </div>
                        @endif
                        <div class="mb-3">
                          <label class="form-label">Image</label>
                          <div class="mb-3 border no-shadow position-relative" id="singleImageUpload">
                            <img src="{{ @$LandingPage->banner_image ?? ''}}" class="card-img-top rounded-3 sh-52"
                              alt="image">
                            <div class="position-absolute me-2 mt-2 b-2 e-2 d-inline-block"
                              id="singleImageUploadExample">
                              <button
                                class="btn btn-sm btn-icon btn-icon-only btn-warning rounded-xl position-absolute e-0 b-0"
                                type="button">
                                <i data-acorn-icon="upload"></i>
                              </button>
                              <input class="file-upload t-0 e-2 s-0" type="file" name="banner_image" accept="image/*">
                            </div>
                          </div>
                        </div>
                      	@error('banner_image')
    		                  <span class="text-danger" role="alert">
    		                      <strong>{{ $message }}</strong>
    		                  </span>
					              @enderror
                      </div>
                     
                      <div class="col-12 col-xl-6">
                      	@if(isset($LandingPage->bar_text))
                        <div class="mb-3">
                          <label class="form-label">Bar Text </label>
                          <input type="text" class="form-control" name="bar_text" placeholder=""
                            value="{{ $LandingPage->bar_text ?? '' }}">
                          	@error('bar_text')
      			                  <span class="text-danger" role="alert">
      			                      <strong>{{ $message }}</strong>
      			                  </span>
          				         	@enderror
                        </div>
                        @endif
                        @if(isset($LandingPage->sub_text))
                        <div class="mb-3">
                          <label class="form-label">Sub Text </label>
                          <input type="text" class="form-control" name="sub_text" placeholder=""
                            value="{{ $LandingPage->sub_text ?? '' }}">
                          	@error('sub_text')
      			                  <span class="text-danger" role="alert">
      			                      <strong>{{ $message }}</strong>
      			                  </span>
          				         	@enderror
                        </div>
                        @endif
                        @if(isset($LandingPage->lead_collection))
                        <div class="mb-3">
                          <label class="form-label">Lead Collection </label>
                          <input type="text" class="form-control" name="lead_collection" placeholder=""
                            value="{{ $LandingPage->lead_collection ?? '' }}">
                          	@error('lead_collection')
      			                  <span class="text-danger" role="alert">
      			                      <strong>{{ $message }}</strong>
      			                  </span>
          				         	@enderror
                        </div>
                        @endif
                        @if(isset($LandingPage->lead_collection_column))
                        <div class="mb-3">
                          <h2 class="small-title fw-bold">Lead Collection</h2>
                          <div class="row">
                            <div class="col-12 col-lg-6">
                            	@if(in_array('name', $lead_collection_column))
	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="name" name="lead_collection_column[]" id="LeadName" {{ in_array('name', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadName">
	                                  Name
	                                </label>
	                            </div>
                              	@endif

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="email" name="lead_collection_column[]" id="LeadEmail" {{ in_array('email', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadEmail">
	                                  Email
	                                </label>
	                            </div>


	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="phone" name="lead_collection_column[]" id="LeadPhone" {{ in_array('phone', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadPhone">
	                                  Phone
	                                </label>
	                            </div>

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="company_name" name="lead_collection_column[]" id="LeadCompanyName" {{ in_array('company_name', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadCompanyName">
	                                  Company Name
	                                </label>
	                            </div>

                            </div>
                            <div class="col-12 col-lg-6">

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="current_website" name="lead_collection_column[]" id="LeadCurrentwebsite" {{ in_array('current_website', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadCurrentwebsite">
	                                  Current website
	                                </label>
	                            </div>

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="instagram" name="lead_collection_column[]"
	                                  id="LeadInstagramwebsite" {{ in_array('instagram', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadInstagramwebsite">
	                                  Instagram
	                                </label>
	                            </div>

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="facebook" name="lead_collection_column[]" id="LeadFacebook" {{ in_array('facebook', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadFacebook">
	                                  Facebook
	                                </label>
	                            </div>

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="other" name="lead_collection_column[]" id="LeadOther" {{ in_array('other', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadOther">
	                                  Other
	                                </label>
	                            </div>

                            </div>
                            <div class="col-12 col-lg-12">

	                            <div class="form-check">
	                                <input class="form-check-input" type="checkbox" value="provide_additional_info" name="lead_collection_column[]" id="LeadAdditionalInfo" {{ in_array('provide_additional_info', $lead_collection_column)  ? 'checked' : '' }}>
	                                <label class="form-check-label" for="LeadAdditionalInfo">
	                                  Provide Additional Info
	                                </label>
	                            </div>
	                             @error('lead_collection_column')
        				                  <span class="text-danger" role="alert">
        				                      <strong>{{ $message }}</strong>
        				                  </span>
          								      @enderror

                            </div>
                          </div>
                        </div>
                        @endif
                        @if(isset($LandingPage->action_button_name))
                        <div class="mb-3">
                          <label class="form-label">Call to action button </label>
                          <input type="text" class="form-control" id="action_button_name" name="action_button_name" placeholder="action button name" value="{{ $LandingPage->action_button_name ?? '' }}" required>
                          @error('action_button_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        @endif
                        @if(isset($LandingPage->digital_files))
                        <div class="mb-3">
                          <label class="form-label">Digital File(s) that will be sent </label>
                          <input id="tagsBodyPart" class="custom-look" name="digital_files" placeholder="Search for body part" value="{{ $LandingPage->digital_files ?? '' }}" data-blacklist="" required>
                          <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1" type="button">
                            <i data-acorn-icon="plus"></i>
                          </button>
                        </div>
                        @endif
                      </div>
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
                  <a href="{{ route('landing_pages.index') }}" class="btn btn-secondary">
                    Cancel
                  </a>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="second" role="tabpanel">
                <div class="row">
                  <div class="col-12 col-lg-6">
                    <div class="mb-3">
                      <label class="form-label">Page Title</label>
                      <input type="text" class="form-control" name="meta_page_title" placeholder="page title" value="{{ $LandingPage->meta_page_title ?? '' }}">
                      	@error('meta_page_title')
		                  <span class="text-danger" role="alert">
		                      <strong>{{ $message }}</strong>
		                  </span>
		         		@enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Friendly URL</label>
                      <input type="url" class="form-control" name="meta_friendly_url" placeholder="friendly url" value="{{ $LandingPage->meta_friendly_url ?? '' }}">
                      	@error('meta_friendly_url')
		                  <span class="text-danger" role="alert">
		                      <strong>{{ $message }}</strong>
		                  </span>
			         	@enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Meta Description</label>
                      <textarea type="text" class="form-control" name="meta_description" 
                        placeholder="description" >{{ $LandingPage->meta_description ?? '' }}</textarea>
                      	@error('meta_description')
		                  <span class="text-danger" role="alert">
		                      <strong>{{ $message }}</strong>
		                  </span>
			         	@enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Tags</label>
                      <input name="tagsBasic" value="{{ $LandingPage->meta_tags ?? '' }}" />
                      	@error('tagsBasic')
		                  <span class="text-danger" role="alert">
		                      <strong>{{ $message }}</strong>
		                  </span>
			         	@enderror
                    </div>
                  </div>
                  <div class="col-12 col-lg-6">
                    <div class="mb-3">
                      <div class="card no-shadow bg-light">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <a href="#" class="text-success">
                            <h4 class="text-success">Fitness Plan App</h4>
                          </a>
                          <a href="{{ url('/') }}/{{ $LandingPage->getDomain->domain_name }}" class="text-blue" target="_blank">
                            <h6 class="text-blue">{{ url('/') }}/{{ $LandingPage->getDomain->domain_name }}</h6>
                          </a>
                          <p>This is a place where user can go and get their website to host their fitness and
                            meal
                            plans.</p>
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
   
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-center mb-3">
            <div class="form-check form-switch ms-2 mb-0">
              <input class="form-check-input" type="checkbox" value="{{ $LandingPage->status ?? '' }}" name="status" role="switch" id="CheckStatus" {{ $LandingPage->status == 1 ? 'checked' : '' }}>
            </div>
           
            <label class="form-check-label" id="LabelStatus" for="CheckStatus">{{ $LandingPage->status == 1 ? 'Published' : 'Draft' }}</label>
          </div>
          @error('status')
          <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
          </span>
			    @enderror
          <div class="input-group mb-3">
            <span class="input-group-text">Landing Page URL</span>
            <input type="text" id="LandingUrl" class="form-control" name="domain_name" value="{{ $LandingPage->getDomain->domain_name }}">
            <input type="hidden" name="domain_id" value="{{ $LandingPage->domain_id ?? '' }}">
            <span class="input-group-text" id="copyBtn">
              <a href="javascript:;" class="d-inline-block text-dark"><i
                  data-acorn-icon="duplicate"></i></a>
            </span>
            <span class="text-danger" role="alert">
              <strong id='UrlErr'></strong>
          </span>
          	@error('domain_name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
	        @enderror
          </div>
          <div class="d-block text-center">
            <!-- Preview Button Start -->
            <a href="{{ url('/') }}/{{ $LandingPage->getDomain->domain_name }}" target="_blank" role="button" class="btn btn-sm btn-icon btn-dark">
              <i data-acorn-icon="eye" data-acorn-size="13"></i>
              Preview Site
            </a>
            <!-- Preview Button End -->
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!-- Landing Pages List End -->
</div>
<!-- Modal -->
<div class="modal fade" id="newLandingModal" tabindex="-1" aria-labelledby="newLandingModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="newLandingModalLabel">New Landing</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <div class="form-group row">
        <div class="col-12 col-md-12">
          <div class="mb-3">
            <label class="form-label">Landing Page Name</label>
            <input type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <div class="mb-3">
            <label class="form-label">Select a Template</label>
            <select class="form-control">
              <option value="0"></option>
              <option value="1">
                Template 1
              </option>
              <option value="2">
                Template 0
              </option>
              <option value="3">
                Template 3
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12 col-md-12">
          <div class="mb-3">
            <label for="formFile" class="form-label">Upload File</label>
            <input class="form-control" type="file" id="formFile">
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer justify-content-center">
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      <a href="Landing.Create.Page.html" role="button" class="btn btn-primary">Next</a>
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
<script src="{{ asset('assets/admin/js/forms/controls.tag.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/pages/products.detail.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/plugins/players.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
<script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
<!-- Page Specific Scripts End -->
<script type="text/javascript">
	$(document).ready(function(){
		var csrfToken = $('meta[name="csrf-token"]').attr('content');
		var LandingPageId = '{{ $LandingPage->id }}';
		$("#CheckStatus").click(function() {
			if ($(this).is(":checked")) {
				var status = 1;
				var label = "Publish";
			} else {
				var status = 0;
				var label = "Draft";
			}
			$(this).val(status);
			$('#LabelStatus').text(label);
			$.ajax({
				type: 'post',
				url: '{{ route('landing_pages.update-status') }}',
				data: { status:status, LandingPageId:LandingPageId },
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
					console.error(error);
				}
			});
		});
		$('#LandingUrl').keyup(function(){
			var url = $(this).val();
			var domain_id = '{{ $LandingPage->getDomain->id }}';
			$.ajax({
				type: 'post',
				url: '{{ route('landing_pages.check-domain') }}',
				data: { url:url, domain_id:domain_id },
				headers: {
					'X-CSRF-TOKEN': csrfToken
				},
				success: function(response) {
					if(response.status == true){
						$('#UrlErr').text('').hide();
					} else {
						$('#UrlErr').text(response.error).show();
					}
				},
				error: function(error) {
					console.error(error);
				}
			});
		});
		
		$("#copyBtn").click(function() {
			var value = $("#LandingUrl").val();
			var tempInput = $("<input>");
			$("body").append(tempInput);
			tempInput.val(value).select();
			document.execCommand("copy");
			tempInput.remove();

      $('#toast-body').text("Link Copied !");
      var toastElement = $('.toast');
      toastElement.show();
      var toast = new bootstrap.Toast(toastElement);
      toastElement.removeClass('.bg-danger');
      toastElement.addClass('.bg-success');
      toast.show();
		});

		var toastElement = $('.toast')[0];
		var toast = new bootstrap.Toast(toastElement);
		toast.show();
	});

</script>
</body>
</html>
@endsection