@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/quill.bubble.css?time='.time()) }}" />
@endsection
@section('content')
<div class="container">
   @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
          <h1 class="mb-0 pb-0 display-4" id="title">Add Page</h1>
        </div>
      </div>
      <!-- Title End -->
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
                  <div class="col-2 col-sm-6">
                    <div class="text-end">
                      <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                        <i data-acorn-icon="bin"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <form action="{{ route('pagecms.store') }}" method="post" id="page-cms">
              @csrf
              <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="mb-3">
                      <label class="form-label">Main Heading</label>
                      <input type="text" class="form-control" name="main_heading" placeholder="" value="">
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
                      <input type="text" class="form-control" name="menu_text" placeholder="" value="Home">
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
            <div class="accordion" id="accordionMain">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingMain">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseMain" aria-expanded="true"
                    aria-controls="collapseMain">
                    <span class="cta-2 fw-bold">Header Banner</span>
                  </button>
                  <div class="sec-action">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-top"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-bottom"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div>
                </div>
                <div id="collapseMain" class="accordion-collapse collapse show" aria-labelledby="headingMain"
                  data-bs-parent="#accordionMain">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            {{-- <div class="col-12 col-sm-6">
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
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Plans</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Full Width Content</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Images/Videos</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Contact</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
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
                                <input type="text" class="form-control" name="headerBanner_name" placeholder="" value="Header Banner">
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="headerBanner_status" type="checkbox" id="DonotshowBannerCheckbox" value="true" checked>
                                  <label class="form-check-label" for="DonotshowBannerCheckbox">Do not show label/Section name</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="page-content-section mb-4">
                      <h2 class="small-title">Content</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="headerBanner_title" class="form-control" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Sub Text</label>
                                <input type="text" name="headerBanner_sub_text" class="form-control" placeholder="">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action <small>Button Text</small></label>
                                <input type="text" class="form-control" name="headerBanner_action_btn" placeholder="" value="Sign Up!">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action Page</label>
                                <select class="form-select" name="headerBanner_action_page">
                                  <option value="1" selected>Service</option>
                                  <option value="2">Service 2</option>
                                  <option value="3">Service 3</option>
                                  <option value="4">Service 4</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Images/Video Slider</label>
                            <div
                              class="dropzone dropzone-columns min-h-100 row g-2 row-cols-1 row-cols-md-2 row-cols-xl-4 border-0 p-0"
                              id="HeaderBannerImages"></div>
                            <button type="button" class="btn btn-outline-dark btn-icon btn-icon-start mt-2"
                              id="HeaderBannerImagesBtn">
                              <i data-acorn-icon="plus"></i>
                              <span>Add Files</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaAbout">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingAbout">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="true"
                    aria-controls="collapseAbout">
                    <span class="cta-2 fw-bold">Know More</span>
                  </button>
                  <div class="sec-action">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-top"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-bottom"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div>
                </div>
                <div id="collapseAbout" class="accordion-collapse collapse show" aria-labelledby="headingAbout"
                  data-bs-parent="#accordionaAbout">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            {{-- <div class="col-12 col-sm-6">
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
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Plans</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Full Width Content</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Images/Videos</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Contact</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
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
                                <input type="text" class="form-control" placeholder="" name="knowMore_name" value="">
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="knowMore_status" type="checkbox" id="KnowMoreCheckbox" value="true" checked>
                                  <label class="form-check-label" for="KnowMoreCheckbox">Do not show label/Section name</label>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="page-content-section mb-4">
                      <h2 class="small-title">Content</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Page Content</label>
                                <input type="hidden" id="knowMore_description" name="knowMore_content">
                                <div class="html-editor-bubble sh-19 html-editor" id="knowMoreContent"></div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action <small>Button Text</small></label>
                                <input type="text" class="form-control" name="knowMore_action_btn" placeholder="" value="Sign Up!">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action Page</label>
                                <select class="form-select" name="knowMore_action_page">
                                  <option value="1" selected>Service</option>
                                  <option value="2">Service 2</option>
                                  <option value="3">Service 3</option>
                                  <option value="4">Service 4</option>
                                </select>
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

          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaWeDo">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingWeDo">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseWeDo" aria-expanded="true"
                    aria-controls="collapseWeDo">
                    <span class="cta-2 fw-bold">What We Do</span>
                  </button>
                  <div class="sec-action">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-top"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-bottom"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div>
                </div>
                <div id="collapseWeDo" class="accordion-collapse collapse show" aria-labelledby="headingWeDo"
                  data-bs-parent="#accordionaWeDo">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                         {{--    <div class="col-12 col-sm-6">
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
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Plans</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Full Width Content</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Images/Videos</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Contact</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
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
                                <input type="text" class="form-control" name="whatWeDo_name" placeholder="" value="What We Do">
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" type="checkbox" name="whatWeDo_status" id="whatWeDoCheckbox" value="true" checked>
                                  <label class="form-check-label" for="whatWeDoCheckbox">Do not show label/Section name</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="page-content-section mb-4">
                      <h2 class="small-title">Content</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Description</label>
                                 <input type="hidden" name="WhatWeDo_description" id="WhatWeDo_description_Input" value="">
                                <div class="html-editor-bubble sh-19 html-editor" id="WhatWeDoDescription"></div>
                              </div>
                            </div>
                          </div>
                          <div class="plan-row">
                            <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <h2 class="small-title">Package You Want to Highlight</h2>
                              <div class="card no-shadow mb-3 border">
                                <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                                  <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="alert alert-info" role="alert">
                                        <b>Note :</b>If you want to make changes to the actual plan such as price, description it must be done in the <a href="Product.List.html" class="fw-bold text-info">Package</a> page.
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="text-end">
                                        <button type="button" disabled="true" 
                                          class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1 DeletePlan">
                                          <i data-acorn-icon="bin"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="mb-3">
                                        <label class="form-label">Choose a package from list</label>
                                        <select class="form-select" name="whatWeDo_package_type[]">
                                          <option selected>Select Package</option>
                                          <option value="1">Free</option>
                                          <option value="2">Professtional</option>
                                          <option value="3">Standard</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <h4 class="fw-bold">$128</h4>
                                        <!-- <input type="text" class="form-control" placeholder="" value=""> -->
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="mb-3">
                                        <label class="form-label">Description of Package</label>
                                        <!-- <div class="html-editor-bubble sh-19 html-editor" id="quillEditorBubble"> -->
                                        <p>
                                          Lorem Ipsum is simply dummy text of the printing and typesetting
                                          industry. Lorem Ipsum has been the industry's standard dummy text ever
                                          since the 1500s, when an unknown printer took a galley of type and
                                          scrambled it to make a type specimen book. It has survived not only five
                                          centuries, but also the leap into electronic typesetting, remaining
                                          essentially unchanged. It was popularised in the 1960s with the release
                                          of Letraset sheets containing Lorem Ipsum passages
                                        </p>
                                      </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-lg-6">
                                      <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <div class="card">
                                          <img src="{{ asset('assets/admin/img/product/small/product-10.webp') }}" class="rounded-3 sh-20"
                                            alt="image">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-6">
                              <div class="mb-3">
                                <label class="form-label">Call to Action <small>Button
                                    Text</small></label>
                                <input type="text" class="form-control" name="whatWeDo_action_btn_text[]" placeholder="" value="Sign Up!">
                              </div>
                            </div>
                            <div class="col-12 col-sm-12 col-lg-6">
                              <div class="mb-3">
                                <label class="form-label">Call to Action Page</label>
                                <select class="form-select" name="whatWeDo_action_page[]">
                                  <option value="1" selected>Plans</option>
                                  <option value="2">Plans 2</option>
                                  <option value="3">Plans 3</option>
                                  <option value="4">Plans 4</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div id="plan-container">
                          </div>
                          
                          <div class="row align-items-center mb-4">
                            <div class="col-12 col-lg-12">
                              <button type="button" id="create-plan" class="btn btn-icon btn-outline-primary">
                                <i data-acorn-icon="plus" class="icon"></i>
                                Add a Plan
                              </button>
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

          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionExplore">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingExplore">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseExplore" aria-expanded="true"
                    aria-controls="collapseExplore">
                    <span class="cta-2 fw-bold">Explore</span>
                  </button>
                  <div class="sec-action">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-top"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-dark">
                      <i data-acorn-icon="arrow-bottom"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-outline-danger">
                      <i data-acorn-icon="bin"></i>
                    </button>
                  </div>
                </div>
                <div id="collapseExplore" class="accordion-collapse collapse show"
                  aria-labelledby="headingExplore" data-bs-parent="#accordionExplore">
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
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Plans</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Full Width Content</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Images/Videos</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="p-2 section-slider">
                                        <h4>Contact</h4>
                                        <div class="custom-carousel d-block">
                                          <img src="{{ asset('assets/admin/img/banner/slide1.jpg') }}" class="d-block w-100" alt="...">
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
                                <input type="text" class="form-control" placeholder="" name="explore_name" value="Explore">
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" type="checkbox" name="explore_status" id="ExploreCheckbox" value="true" checked>
                                  <label class="form-check-label" for="ExploreCheckbox">Do not show label/Section name</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Banner Header Text</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Banner Text</label>
                                <input type="text" class="form-control" name="explore_banner_text" placeholder="" value="Web Design">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="page-content-section mb-4">
                      <h2 class="small-title">Gallery</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="dropzone dropzone-columns min-h-100 row g-2 row-cols-1 row-cols-md-2 row-cols-xl-4 border-0 p-0" id="ExploreGallery"></div>
                          <button type="button" class="btn btn-outline-dark btn-icon btn-icon-start mt-2"
                            id="ExploreGalleryBtn">
                            <i data-acorn-icon="plus"></i>
                            <span>Add Files</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row align-items-center mb-4">
         {{--    <div class="col-12 col-lg-6">
              <button type="button" class="btn btn-icon btn-outline-primary">
                <i data-acorn-icon="plus" class="icon"></i>
                Add Section
              </button>
            </div> --}}
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
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Page Title</label>
                  <input type="text" name="page_title" class="form-control" placeholder="Fitness Plan App">
                </div>
                <div class="mb-3">
                  <label class="form-label">Friendly URL</label>
                  <input type="text" name="friendly_url" class="form-control" placeholder="fitnessandmealplans.com">
                </div>
                <div class="mb-3">
                  <label class="form-label">Meta Description</label>
                  <textarea type="text" class="form-control" name="meta_description"
                    placeholder="This is a place where user can go and get their website to host their Fitness Plan App."></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Tags</label>
                  <input name="tagsBasic" value="Meal Plans, Fitness Plan" />
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <div class="card no-shadow bg-light">
                    <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                      <a href="#" class="text-success">
                        <h4 class="text-success">Fitness Plan App</h4>
                      </a>
                      <a href="#" class="text-blue">
                        <h6 class="text-blue">https://smartend.app/demo/fitnessandmealplannercom </h6>
                      </a>
                      <p>This is a place where user can go and get their website to host their fitness and meal
                        plans.</p>
                    </div>
                  </div>
                </div>
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

  <script type="text/javascript">

      new Dropzone('#HeaderBannerImages', {
      url: '{{ route('pagecms.UploadImage') }}',
      thumbnailWidth: 600,
      thumbnailHeight: 430,
      autoProcessQueue:true,
      previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      init: function () {
        this.on('success', function (file, response) {
          var hiddenInputHeaderBanner = $('<input>').attr({
                type: 'hidden',
                name: 'HeaderBannerImages[]',
                index: file.upload.uuid,
                value: response.file_path
            });

          $('#page-cms').append(hiddenInputHeaderBanner)
        });

        this.on('removedfile', function (file) {
          var indexToDelete = file.upload.uuid;
          $('input[index="' + indexToDelete + '"]').remove();
        });


        // let mockFile1 = { name: 'cake.webp', size: 203100 };
        // this.displayExistingFile(mockFile1, 'img/product/small/product-10.webp');

        // let mockFile2 = { name: 'bread.webp', size: 267140 };
        // this.displayExistingFile(mockFile2, 'img/product/small/product-4.webp');

        // let mockFile3 = { name: 'cupcake.jpg', size: 267140 };
        // this.displayExistingFile(mockFile3, 'img/product/small/product-1.webp');

        // let mockFile4 = { name: 'pastry.webp', size: 267140 };
        // this.displayExistingFile(mockFile4, 'img/product/small/product-7.webp');

        // Adding dz-started class to remove drop message
        this.element.classList.add('dz-started');
      },
    });

    if (document.getElementById('HeaderBannerImagesBtn')) {
      document.getElementById('HeaderBannerImagesBtn').addEventListener('click', (event) => {
        document.getElementById('HeaderBannerImages').dispatchEvent(new Event('click'));
      });
    }

    new Dropzone('#ExploreGallery', {
      url: '{{ route('pagecms.UploadImage') }}',
      thumbnailWidth: 600,
      thumbnailHeight: 430,
      autoProcessQueue:true,
      previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      init: function () {
        this.on('success', function (file, response) {

          var hiddenInputHeaderBanner = $('<input>').attr({
                type: 'hidden',
                name: 'ExploreGallery[]',
                index: file.upload.uuid,
                value: response.file_path
            });

          $('#page-cms').append(hiddenInputHeaderBanner)
            
        });

        this.on('removedfile', function (file) {
          var indexToDelete = file.upload.uuid;
          $('input[index="' + indexToDelete + '"]').remove();
        });

        // let mockFile1 = { name: 'cake.webp', size: 203100 };
        // this.displayExistingFile(mockFile1, 'img/product/small/product-10.webp');

        // let mockFile2 = { name: 'bread.webp', size: 267140 };
        // this.displayExistingFile(mockFile2, 'img/product/small/product-4.webp');

        // let mockFile3 = { name: 'cupcake.jpg', size: 267140 };
        // this.displayExistingFile(mockFile3, 'img/product/small/product-1.webp');

        // let mockFile4 = { name: 'pastry.webp', size: 267140 };
        // this.displayExistingFile(mockFile4, 'img/product/small/product-7.webp');

        // Adding dz-started class to remove drop message
        this.element.classList.add('dz-started');
      },
    });

    if (document.getElementById('ExploreGalleryBtn')) {
      document.getElementById('ExploreGalleryBtn').addEventListener('click', (event) => {
        document.getElementById('ExploreGallery').dispatchEvent(new Event('click'));
      });
    }



    const quillBubbleToolbarOptions = [
      ['bold', 'italic', 'underline', 'strike', 'link'],
      [{header: [1, 2, 3, 4, 5, 6, false]}],
      [{list: 'ordered'}, {list: 'bullet'}],
      [{align: []}],
    ];

    if (document.getElementById('knowMoreContent')) {
         quill_1 = new Quill('#knowMoreContent', {
          modules: {
            toolbar: quillBubbleToolbarOptions,
          },
          theme: 'bubble',
        });

      quill_1.on('text-change', function() {
        const editorContent = quill_1.root.innerHTML;
        document.getElementById('knowMore_description').value = editorContent;
      });
    }

    if (document.getElementById('WhatWeDoDescription')) {
         quill_2 = new Quill('#WhatWeDoDescription', {
          modules: {
            toolbar: quillBubbleToolbarOptions,
          },
          theme: 'bubble',
        });

      quill_2.on('text-change', function() {
        const editorContent = quill_2.root.innerHTML;
        document.getElementById('WhatWeDo_description_Input').value = editorContent;
      });
    }

    
  $(document).ready(function(){

    $('.checkbox-status').click(function(){
      if($(this).is(':checked')){
        $(this).val(true);
      } else {
        $(this).val(false);
      }
    });

    $("#create-plan").click(function () {
      var rowToClone = $(".plan-row").last();
      var clonedRow = rowToClone.clone(true);
      clonedRow.find('input[type="text"]').val('');
      clonedRow.find('.DeletePlan').removeAttr('disabled');
      clonedRow.appendTo($("#plan-container"));
    });

    $(".DeletePlan").click(function () {
      $(this).parents('.plan-row').remove();
    });

    $("#page-cms").submit(function(event) {
      $("#plan-container").find("input, select").each(function() {
        $(this).clone().appendTo("#page-cms");
      });
    });

    var toastElement = $('.toast')[0];
    var toast = new bootstrap.Toast(toastElement);
      toast.show();

  }); 
    

  </script>
@endsection