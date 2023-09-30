@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/quill.bubble.css?time='.time()) }}" />
@endsection
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto sw-md-30">
          <a href="{{ route('pagecms.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Pages List</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">View Page</h1>
        </div>
      </div>
    </div>
  </div>
  <!-- Title and Top Buttons End -->

  <div class="card mb-3">
    <div class="card-header border-0 pb-0">
      <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs border-bottom" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#first" role="tab" type="button"
            aria-selected="true">
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
                  {{-- <div class="col-2 col-sm-6">
                    <div class="text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                        <i data-acorn-icon="bin"></i>
                      </button>
                    </div>
                  </div> --}}
                </div>
              </div>
              <form action="{{ route('pagecms.update') }}" method="post" id="page-cms">
              @csrf
              <input type="hidden" name="page_id" value="{{ $page->id }}">
              <input type="hidden" name="page_slug" value="{{ $page->slug }}">
              <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="mb-3">
                      <label class="form-label">Main Heading</label>
                      <input type="text" class="form-control" name="main_heading" placeholder="" value="{{ $page_section->PageContent->MainHeading }}">
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
                      <input type="text" class="form-control" name="menu_text" placeholder="" value="{{ $page_section->PageContent->MenuText }}">
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
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaWeDo">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingWeDo">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseWeDo" aria-expanded="true"
                    aria-controls="collapseWeDo">
                    <span class="cta-2 fw-bold">Feature</span>
                  </button>
               {{--    <div class="sec-action">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-top"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-bottom"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div> --}}
                </div>
                <div id="collapseWeDo" class="accordion-collapse collapse show" aria-labelledby="headingWeDo"
                  data-bs-parent="#accordionaWeDo">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                           {{--  <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Type</label>
                                <div class="dropdown megamenu-li">
                                  <button class="btn w-100 btn-dark dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    Choose Section
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-end megamenu"
                                    aria-labelledby="dropdownMenuButton1">
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Header Banner</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="img/banner/slide1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Plans</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="img/banner/slide1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Full Width Content</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="img/banner/slide1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Images/Videos</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="img/banner/slide1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Contact</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="img/banner/slide1.jpg" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div> --}}
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" name="feature_label" class="form-control" placeholder="" value="{{ $page_section->Section->feature->LabelName }}">
                                @error('feature_label')
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
                    <div class="page-content-section mb-4">
                      <h2 class="small-title">Content</h2>
                      <div class="card no-shadow border mb-4">
                        <div class="card-body py-2 px-2">
                         {{--  <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="text-end">
                                <button type="button"
                                  class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1">
                                  <i data-acorn-icon="bin"></i>
                                </button>
                              </div>
                            </div>
                          </div> --}}
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="choose-content-section">
                                <div class="row">
                                  <div class="col-12 col-sm-6">
                                    <input type="hidden" id="feature_image" name="feature_image" value="{{ $page_section->Section->feature->Content->Image }}">
                                    <div class="mb-3">
                                      <label class="form-label">Feature Image</label>
                                      <div class="position-relative dropzone dropzone-columns position-relative row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                        id="feature_image_dropzone"></div>
                                    </div>
                                    @error('feature_image')
                                      <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-xl-6">
                              <div class="mb-3">
                                <label class="form-label">Feature Heading</label>
                                <input type="text" name="feature_heading" class="form-control"
                                  value="{{ $page_section->Section->feature->Content->Heading }}">
                                @error('feature_heading')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Feature SubHeading</label>
                                <input type="text" name="feature_subHeading" class="form-control" value="{{ $page_section->Section->feature->Content->SubHeading }}">
                                @error('feature_subHeading')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Feature Description</label>
                                <textarea class="form-control" rows="10" name="feature_description">{{ $page_section->Section->feature->Content->Description }}
                                </textarea>
                                @error('feature_description')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Button Link</label>
                                <input type="text" name="feature_btnLink" class="form-control" value="{{ $page_section->Section->feature->Content->ButtonLink }}"
                                  placeholder="Learn More">
                                @error('feature_btnLink')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Call to Action Page</label>
                                <select class="form-select" name="feature_btnAction">
                                  <option value="1" @selected($page_section->Section->feature->Content->ActionPage == 1)>Register</option>
                                </select>
                                @error('feature_btnAction')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                <!-- <a href="javascript:;" class="cta-3 fw-bold">
                                    <span>No More</span>
                                    <i data-acorn-icon="arrow-double-right" data-acorn-size="18"></i>
                                  </a> -->
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
          </div>
          <hr>
          <div class="row align-items-center">
            <div class="col-12 col-lg-12">
              <button type="submit" class="btn btn-primary">
                Save content
              </button>
              <button type="reset" class="btn btn-secondary">
                Cancel
              </button>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="second" role="tabpanel">
            @include('admin.PageCms.meta_tags')
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

  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->

  <script>

    $(document).ready(function(){

      if (document.getElementById('feature_image_dropzone')) {
        new Dropzone('#feature_image_dropzone', {
          url: '{{ route('pagecms.UploadImage') }}',
          thumbnailWidth: 600,
          thumbnailHeight: 430,
          headers: {
           'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
          init: function () {
            this.on('success', function (file, response) {
              $('#feature_image').val(response.file_path)
            });
            this.on('removedfile', function (file) {
              $('#feature_image').val('');
            });

            // If you only have access to the original image sizes on your server,
            // and want to resize them in the browser:
            let mockFile1 = { name: '', size: 249430 };
            this.displayExistingFile(mockFile1, '{{ asset($page_section->Section->feature->Content->Image) }}');

            // Adding dz-started class to remove drop message
            this.element.classList.add('dz-started');
          },
        });
      }


    });

    var toastElement = $('.toast')[0];
    var toast = new bootstrap.Toast(toastElement);
      toast.show();

  </script>
</body>

</html>
@endsection