@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/quill.bubble.css?time='.time()) }}" />
<style>
    .error{
      color: #dc3545!important;
      display: block !important;
    }

    br{
      clear:both
    }

    input.error{
      border:1px solid red
    }

    .invisible{
      height:0;
    }
</style>
@endsection
@section('content')
<div class="container">
  <form action="{{ route('pagecms.update') }}" method="post" id="page-cms">
  @csrf
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-6 mb-3 mb-md-0 me-auto">
        <div class="w-auto sw-md-30">
          <a href="{{ route('pagecms.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Pages List</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">View Page</h1>
        </div>
      </div>
      <!-- Title End -->
      <!-- Top Buttons Start -->
      <div class="col-3 d-flex align-items-end justify-content-end">
        <div class="d-flex align-items-center">
          <label class="form-check-label" for="flexSwitchCheckDraft">Page Redirect</label>
          <div class="form-check form-switch ms-2 mb-0">
            <input class="form-check-input checkbox-status"  type="checkbox" role="switch" id="redirect-status" value="true" {{ ($page->is_redirect) ? "checked" : '' }}>
          </div>
          <label class="form-check-label" for="flexSwitchCheckDraft"></label>
        </div>
      </div>
      <div class="col-3 d-flex align-items-end justify-content-end">
        <select class="form-select" id="redirect-page" {{ ($page->is_redirect) ? '' : 'disabled' }}>
          @foreach($domains as $domain)
          <option value="{{ $domain->domain_name }}" @selected($page->redirect_at == $domain->domain_name) >{{ $domain->domain_name }}</option>
          @endforeach
        </select>
      </div>
      <!-- Top Buttons End -->
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
                </div>
              </div>
              <input type="hidden" id="page_id" name="page_id" value="{{ $page->id }}">
              <input type="hidden" name="page_slug" value="{{ $page->slug }}">
             
              <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="mb-3">
                      <label class="form-label">Main Heading</label>
                      <input type="text" name="main_heading" class="form-control" placeholder=""
                       value="{{ $page_section->PageContent->MainHeading }}" required>
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
                      <input type="text" name="menu_text" class="form-control" placeholder="" value="{{ $page_section->PageContent->MainHeading }}" required>
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
                </div>
                <div id="collapseMain" class="accordion-collapse collapse show" aria-labelledby="headingMain"
                  data-bs-parent="#accordionMain">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" class="form-control" name="headerBanner_name" placeholder="" value="{{ $page_section->Section->HeaderBanner->LabelName }}" required>
                                @error('headerBanner_name')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="headerBanner_status" type="checkbox" id="BannerCheckbox" value="{{ $page_section->Section->HeaderBanner->Status }}" @checked($page_section->Section->HeaderBanner->Status == true) required>
                                @error('headerBanner_status')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                  <label class="form-check-label" for="BannerCheckbox">Do not show
                                    label/Section name</label>
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
                                <input type="text" class="form-control" name="headerBanner_title" placeholder="Create you own fitness plan app" value="{{ $page_section->Section->HeaderBanner->Title }}" required>
                                @error('headerBanner_title')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12">
                              <div class="mb-3">
                                <label class="form-label">Sub Text</label>
                                <input type="text" class="form-control" name="headerBanner_sub_text" placeholder="" value="{{ $page_section->Section->HeaderBanner->SubText }}">
                                @error('headerBanner_sub_text')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action <small>Button Text</small></label>
                                <input type="text" class="form-control" name="headerBanner_action_btn" placeholder="" value="{{ $page_section->Section->HeaderBanner->ActionBtn }}" required>
                                @error('headerBanner_action_btn')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                              <div class="mb-3">
                                <label class="form-label">Call to Action Page</label>
                                <select class="form-select" name="headerBanner_action_page" required>
                                  <option value="register" @selected($page_section->Section->HeaderBanner->ActionBtn == "register")>Sign up</option>
                                  <option value="login" @selected($page_section->Section->HeaderBanner->ActionBtn == "login")>login</option>
                                </select>
                                @error('headerBanner_action_page')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Images/Video Slider</label>
                            <div class="dropzone dropzone-columns position-relative row g-2 row-cols-1 row-cols-md-12 border-0 p-0" id="HeaderBannerImage"></div>
                          </div>
                          <input type="text" class="invisible p-0" id="BannerImage" value="{{ $page_section->Section->HeaderBanner->file }}" name="HeaderBannerImage" required>
                          @error('HeaderBannerImage')
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
            </div>
          </div>
          
          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaFeature">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingFeature">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseFeature" aria-expanded="true"
                    aria-controls="collapseFeature">
                    <span class="cta-2 fw-bold">Feature</span>
                  </button>
                 {{--  <div class="sec-action">
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
                <div id="collapseFeature" class="accordion-collapse collapse show"
                  aria-labelledby="headingFeature" data-bs-parent="#accordionaFeature">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" class="form-control" placeholder="" name="feature_label" value="{{ $page_section->Section->Feature->LabelName }}" required>
                                @error('feature_label')
                                  <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="feature_status" type="checkbox" id="DonotshowBannerCheckbox" value="{{ $page_section->Section->Feature->Status }}" @checked($page_section->Section->Feature->Status) required>
                                  <label class="form-check-label" for="DonotshowBannerCheckbox">Do not show label/Section name</label>
                                </div>
                                @error('feature_status')
                                  <span class="text-danger d-block" role="alert">
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
                        <div class="feature-container">
                          @foreach($page_section->Section->Feature->Content as $i => $feature)
                          <div class="card-body py-2 px-2 feature-row" index="{{ $i }}">
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-12">
                                <div class="text-end">
                                  <button type="button" tabname="feature" 
                                    class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1    DeleteSection" @if($i == 0) {{ 'disabled="true"' }} @endif>
                                    <i data-acorn-icon="bin"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-12">
                                <div class="choose-content-section">
                                  <div class="row">
                                    <div class="col-12 col-sm-6">
                                      <div class="mb-1 feature-image">
                                        <label class="form-label">Feature Image</label>
                                        <div id="feature_image_{{ $i }}" class="position-relative dropzone dropzone-columns position-relative row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                          ></div>
                                      </div>
                                      <input type="text" class="feature_image_value feature_images invisible p-0" name="feature_images[{{ $i }}]" value="{{ $feature->Image }}" required>
                                      @error('feature_images.' . $i)
                                        <span class="text-danger mb-5">{{ $message }}</span>
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
                                  <input type="text" name="feature_heading[{{ $i }}]" class="form-control feature_heading" value="{{ $feature->Heading }}" required>
                                  @error('feature_heading.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Feature SubHeading</label>
                                  <input type="text" name="feature_subHeading[{{ $i }}]" class="form-control feature_subHeading" value="{{ $feature->SubHeading }}" required>
                                  @error('feature_subHeading.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                
                                <div class="mb-3">
                                  <label class="form-label">Button Link</label>
                                  <input type="text" name="feature_btnLink[{{ $i }}]" class="form-control feature_btnLink" value="{{ $feature->ButtonLink }}"
                                    placeholder="" required>
                                  @error('feature_subHeading.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="mb-3">
                                  <label class="form-label">Call to Action Page</label>
                                  <select class="form-select select-value feature_btnAction" id="feature_btnAction_{{ $i }}" name="feature_btnAction[{{ $i }}]" required>
                                    <option value="1" @selected($feature->ActionPage == "1")>Client Management</option>
                                    <option value="2" @selected($feature->ActionPage == "2")>Personalize Your Brand</option>
                                    <option value="3" @selected($feature->ActionPage == "3")>Seamless Payment Integration</option>
                                    <option value="4" @selected($feature->ActionPage == "4")>Versatile Workout Library</option>
                                  </select>
                                  @error('feature_subHeading.' . $i)
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                              </div>

                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    <button type="button" id="create-feature" class="btn btn-outline-dark btn-icon btn-icon-start mt-2">
                      <i data-acorn-icon="plus"></i>
                      <span>Create Feature</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaLivePreview">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingLivePreview">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseLivePreview" aria-expanded="true"
                    aria-controls="collapseLivePreview">
                    <span class="cta-2 fw-bold">Live Preview</span>
                  </button>
                 {{--  <div class="sec-action">
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
                <div id="collapseLivePreview" class="accordion-collapse collapse show"
                  aria-labelledby="headingLivePreview" data-bs-parent="#accordionaLivePreview">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" class="form-control" name="livePreview_label" placeholder="" value="{{ $page_section->Section->LivePreview->LabelName }}" required>
                                @error('livePreview_label')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" 
                                  name="livePreview_labelStatus" type="checkbox" id="livePreview_labelStatus" value="{{ $page_section->Section->LivePreview->Status }}" @checked($page_section->Section->LivePreview->Status == true) required>
                                  <label class="form-check-label" for="livePreview_labelStatus">Do not show
                                    label/Section name</label>
                                </div>
                                @error('livePreview_labelStatus')
                                    <span class="text-danger d-block">{{ $message }}</span>
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
                        <div class="livePreview-container">
                          @foreach($page_section->Section->LivePreview->Content as  $i => $livePreview)
                          <div class="card-body py-2 px-2 livePreview-row" index="{{ $i }}">
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-12">
                              </div>
                              <div class="col-12 col-sm-12 col-lg-12">
                                <div class="text-end">
                                  <button type="button" tabname="livePreview"
                                    class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1 DeleteSection" @if($i == 0) {{ 'disabled="true"' }} @endif>
                                    <i data-acorn-icon="bin"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-xl-6">
                                <div class="mb-3">
                                  <label class="form-label">Title</label>
                                  <input type="text" class="form-control livePreview_title" name="livePreview_title[{{ $i }}]" value="{{ $livePreview->Title }}" required>
                                  @error('livePreview_title.' . $i)
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                                </div>
                                <div class="mb-1">
                                  <label class="form-label">Description</label>
                                  <div id="livePreviewEditor_{{ $i }}" class="html-editor-bubble sh-19 html-editor livePreviewEditor">{{ strip_tags($livePreview->Description) }}
                                  </div>
                                </div>
                                <input type="text" id="livePreview_description_{{ $i }}" class="livePreview_description invisible p-0" name="livePreview_description[{{ $i }}]"  value="{{ $livePreview->Description }}" required>
                                @error('livePreview_description.' . $i)
                                  <span class="text-danger mb-5 pb-5">{{ $message }}</span>
                                @enderror

                                <div class="mb-3 preview_image">
                                  <label class="form-label">Preview Image</label>
                                  <div class="dropzone dropzone-columns position-relative row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                    id="preview_image_{{$i}}"></div>
                                </div>
                                <input type="text" class="preview_image_value livePreview_images invisible p-0" name="livePreview_images[{{ $i }}]" value="{{ $livePreview->Image }}" required>
                                @error('livePreview_images.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="row">
                                  <div class="col-12 col-sm-12 col-lg-12">
                                    <div class="mb-3">
                                      <label class="form-label">Call to Action Page</label>
                                      <select class="form-select livePreview_actionPage" id="livePreview_actionPage_{{ $i }}" name="livePreview_actionPage[{{ $i }}]" required>
                                        <option value="1" @selected($livePreview->ActionPage == 1)>Coach Live Preview Page</option>
                                        <option value="2" @selected($livePreview->ActionPage == 2)>Coach Admin Portal</option>
                                        <option value="3" @selected($livePreview->ActionPage == 3)>Client Portal</option>
                                      </select>
                                      @error('livePreview_actionPage.' . $i)
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                      <button type="button" id="create-livePreview" class="btn btn-outline-dark btn-icon btn-icon-start mt-2">
                        <i data-acorn-icon="plus"></i>
                        <span>Add Live Preview</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaPricing">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingPricing">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapsePricing" aria-expanded="true"
                    aria-controls="collapsePricing">
                    <span class="cta-2 fw-bold">Pricing</span>
                  </button>
                 {{--  <div class="sec-action">
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
                <div id="collapsePricing" class="accordion-collapse collapse show"
                  aria-labelledby="headingPricing" data-bs-parent="#accordionaPricing">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">

                    <div class="page-content-section mb-4">
                      <div id="package-container">
                       @foreach($page_section->Section->Pricing as $i => $package)
                        <div class="row package-row" index="{{ $i }}">
                          <div class="col-12 col-lg-6">
                            <h2 class="small-title">Package Type</h2>
                            <div class="card no-shadow border mb-4">
                              <div class="card-body py-2 px-2">
                                <div class="row">
                                  <div class="col-12 col-xl-12">
                                    <div class="text-end position-absolute e-2 t-2">
                                      <button type="button" tabname="package"
                                        class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1 DeleteSection" @if($i == 0) {{ 'disabled="true"' }} @endif>
                                        <i data-acorn-icon="bin"></i>
                                      </button>
                                    </div>
                                    <div class="mb-1">
                                      <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                          <input class="form-check-input package_type" type="radio" name="package_type[{{ $i }}]" value="free" @checked($package->PackageType === "free")>
                                           Free 
                                         </label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                          <input class="form-check-input package_type" type="radio" name="package_type[{{ $i }}]" value="coach{{ $i }}" @checked($package->PackageType == "coach".$i)>
                                          Coach
                                        </label>
                                      </div>
                                    </div>
                                    @error('package_type.' . $i)
                                        <span class="text-danger d-block mb-5">{{ $message }}</span>
                                    @enderror
                                    
                                    <div class="mb-3">
                                      <label class="form-label d-block">Price</label>
                                      <div class="row">
                                        <div class="col">
                                          <input type="number" name="package_price[{{ $i }}]" class="form-control package_price" value="{{ $package->Price }}" required>
                                          @error('package_price.' . $i)
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                        </div>
                                        <div class="col">
                                          <select class="form-select package_duration" id="package_duration_{{ $i }}" name="package_duration[{{ $i }}]" required>
                                            <option value="Month" @selected($package->Duration === "Month")>Month</option>
                                          </select>
                                          @error('package_duration.' . $i)
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                        </div>
                                      </div>
                                    </div>
                                    <div class="mb-3">
                                      <div class="row">
                                        <div class="col">
                                          <label class="form-label d-block">Up to clients</label>
                                          <select class="form-select package_clients" id="package_clients_{{ $i }}" name="package_clients[{{ $i }}]" required>
                                            <option value="1"  @selected($package->UpToClients == 1)>1</option>
                                            <option value="25"  @selected($package->UpToClients == 25)>25</option>
                                            <option value="50" @selected($package->UpToClients == 50)>50</option>
                                            <option value="100" @selected($package->UpToClients == 100)>100</option>
                                            <option value="200" @selected($package->UpToClients == 200)>200</option>
                                            <option value="250" @selected($package->UpToClients == 250)>250</option>
                                          </select>
                                          @error('package_clients.' . $i)
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                        </div>
                                        <div class="col">
                                          <label class="form-label d-block">Storage</label>
                                          <select class="form-select package_storage" id="package_storage_{{ $i }}" name="package_storage[{{ $i }}]" required>
                                            <option value="5"  @selected($package->Storage == 5)>5 GB</option>
                                            <option value="100"  @selected($package->Storage == 100)>100 GB</option>
                                            <option value="150" @selected($package->Storage == 150)>150 GB</option>
                                            <option value="250" @selected($package->Storage == 250)>250 GB</option>
                                            <option value="500" @selected($package->Storage == 500)>500 GB</option>
                                            <option value="700" @selected($package->Storage == 700)>700 GB</option>
                                          </select>
                                          @error('package_storage.' . $i)
                                              <span class="text-danger">{{ $message }}</span>
                                          @enderror
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>

                      <button type="button" id="create-package" class="btn btn-outline-dark btn-icon btn-icon-start mt-2">
                        <i data-acorn-icon="plus"></i>
                        <span>Add Package</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="pagesection mb-4">
            <h2 class="small-title fw-bold">Section</h2>
            <div class="accordion" id="accordionaResources">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingResources">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseResources" aria-expanded="true"
                    aria-controls="collapseResources">
                    <span class="cta-2 fw-bold">Exercises</span>
                  </button>
                 {{--  <div class="sec-action">
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
                <div id="collapseResources" class="accordion-collapse collapse show"
                  aria-labelledby="headingResources" data-bs-parent="#accordionaResources">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" class="form-control" name="exercises_label" placeholder="" value="{{ $page_section->Section->Exercises->LabelName }}" required>
                                @error('exercises_label')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="exercises_labelStatus" type="checkbox" id="exercises_labelStatus" value="true" @checked($page_section->Section->Exercises->Status == true) required>
                                  <label class="form-check-label" for="exercises_labelStatus">Do not show
                                    label/Section name</label>
                                </div>
                                @error('exercises_labelStatus')
                                    <span class="text-danger d-block">{{ $message }}</span>
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
                          <div class="row">
                            <div class="col-12 col-xl-6">
                              <div class="mb">
                                <label class="form-label">Image</label>
                                <div
                                  class="dropzone dropzone-columns position-relative row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                  id="exercise_image_dropzone"></div>
                              </div>
                              <input type="text" id="exercise_image" class="invisible p-0" value="{{ $page_section->Section->Exercises->Image }}" name="exercise_image" required>
                              @error('exercise_image')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                              <div class="mb-3">
                                <label class="form-label">Exercise Heading</label>
                                <input type="text" name="exercise_heading" class="form-control"
                                 value="{{ $page_section->Section->Exercises->Heading }}" required>
                                @error('exercise_heading')
                                    <span class="text-danger mb-5">{{ $message }}</span>
                                @enderror
                              </div>
                             
                              <div class="mb-3">
                                <label class="form-label">Pages</label>
                                <select class="form-select" name="exercise_pages" required>
                                  <option value="">Select</option>
                                  <option value="1" @selected($page_section->Section->Exercises->Pages == 1)>Exercise</option>
                                </select>
                                @error('exercise_pages')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
            <div class="accordion" id="accordionArticles">
              <div class="accordion-item">
                <div class="accordion-header position-relative" id="headingArticles">
                  <button class="accordion-button py-2 px-2 py-lg-2 px-lg-4" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseArticles" aria-expanded="true"
                    aria-controls="collapseArticles">
                    <span class="cta-2 fw-bold">Articles</span>
                  </button>
                  {{-- <div class="sec-action">
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
                <div id="collapseArticles" class="accordion-collapse collapse show"
                  aria-labelledby="headingArticles" data-bs-parent="#accordionArticles">
                  <div class="accordion-body py-2 px-2 py-lg-2 px-lg-4">
                    <div class="choose-content-section mb-4">
                      <h2 class="small-title">Choose Content Section</h2>
                      <div class="card no-shadow border">
                        <div class="card-body py-2 px-2 py-lg-2 px-lg-4">
                          <div class="row">
                            <div class="col-12 col-sm-6">
                              <div class="mb-3">
                                <label class="form-label">Label Name</label>
                                <input type="text" class="form-control" name="articles_label" placeholder="" value="{{ $page_section->Section->Articles->LabelName }}" required>
                                @error('articles_label')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-check form-check-inline mt-2">
                                  <input class="form-check-input checkbox-status" name="articles_labelStatus" type="checkbox" id="articles_labelStatus" value="{{ $page_section->Section->Articles->Status }}" @checked($page_section->Section->Articles->Status == true) required>
                                  <label class="form-check-label" for="articles_labelStatus">Do not show
                                    label/Section name</label>
                                </div>
                                @error('articles_labelStatus')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                          <div class="alert alert-info" role="alert">
                            <b>Note :</b> Articles will come from the article node for the live ones that are
                            published.
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
        </div>
      </div>
    </div>
  </div>
  </form>
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
   <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>

  <!-- Page Validation JS -->
  <script src="{{ asset('assets/admin/js/jquery.validate.min.js?time='.time()) }}"></script>
  <script>
    $(document).ready(function () {
      $("#page-cms").validate();
    });
  </script>
  <!-- End Page Validation JS -->


  @foreach($page_section->Section->Feature->Content as $i => $feature)
  <script>
    new Dropzone('#feature_image_{{ $i }}', {
      url: '{{ route('pagecms.UploadImage') }}',
      thumbnailWidth: 600,
      thumbnailHeight: 430,
      headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
      init: function () {
          this.on('success', function (file, response) {
              $('#feature_image_{{ $i }}').parent('.feature-image').siblings('.feature_image_value').val(response.file_path);
          });

          this.on('removedfile', function (file) {

            $('#feature_image_{{ $i }}').parent('.feature-image').siblings('.feature_image_value').val('');
          });

          let mockFile1 = { name: '', size: 249430 };
          this.displayExistingFile(mockFile1, '{{ asset($feature->Image) }}');
          this.element.classList.add('dz-started');
      },
    });
  </script> 
  @endforeach

  @foreach($page_section->Section->LivePreview->Content as $i => $livePreview)
  <script>
      new Dropzone('#preview_image_{{ $i }}', {
          url: '{{ route('pagecms.UploadImage') }}',
          thumbnailWidth: 600,
          thumbnailHeight: 430,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
          init: function () {
              this.on('success', function (file, response) {
                $('#preview_image_{{ $i }}').parent('.preview_image').siblings('.preview_image_value').val(response.file_path);
              });

              this.on('removedfile', function (file) {
                $('#preview_image_{{ $i }}').parent('.preview_image').siblings('.preview_image_value').val('');
              });

              let mockFile1 = { name: '', size: 249430 };
              this.displayExistingFile(mockFile1, '{{ asset($livePreview->Image) }}');

              this.element.classList.add('dz-started');
          },
      });
  </script>
  @endforeach

  <script>

    $(document).ready(function(){
     var arrayCount = "{{ count($page_section->Section->Pricing) }}";

    if (document.getElementById('HeaderBannerImage')) {
      new Dropzone('#HeaderBannerImage', {
        url: '{{ route('pagecms.UploadImage') }}',
        thumbnailWidth: 600,
        thumbnailHeight: 430,
        headers: {
         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
        init: function () {
          this.on('success', function (file, response) {
            $('#BannerImage').val(response.file_path)
          });

          this.on('removedfile', function (file) {
            $('#BannerImage').val('');
          });

          let mockFile1 = { name: '', size: 249430 };
          this.displayExistingFile(mockFile1, '{{ asset($page_section->Section->HeaderBanner->file) }}');

          this.element.classList.add('dz-started');
        },
      });
    }

    if (document.getElementById('exercise_image_dropzone')) {
      new Dropzone('#exercise_image_dropzone', {
        url: '{{ route('pagecms.UploadImage') }}',
        thumbnailWidth: 600,
        thumbnailHeight: 430,
        headers: {
         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
        init: function () {
          this.on('success', function (file, response) {
            $('#exercise_image').val(response.file_path)
          });

          this.on('removedfile', function (file) {
            $('#exercise_image').val('');
          });

          let mockFile1 = { name: '', size: 249430 };
          this.displayExistingFile(mockFile1, '{{ asset($page_section->Section->Exercises->Image) }}');

          this.element.classList.add('dz-started');
        },
      });
    }

      var page_id = $('#page_id').val();
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $("#create-feature").click(function () {
          var rowToClone = $(".feature-row").last();
          var clonedRow = rowToClone.clone(true);
          var feature_last_index = parseInt(clonedRow.attr('index'))+1;

          // Reset all input values within the cloned row
          clonedRow.find('input').each(function() {
            $(this).val('');
          });

          // Remove the selected option from all select elements within the cloned row
          clonedRow.find('select').each(function() {
            $(this).find('option:selected').removeAttr('selected');
          });

          clonedRow.attr('index',feature_last_index)
          clonedRow.find('.feature_images').attr('name','feature_images['+ feature_last_index +']');
          clonedRow.find('.feature_heading').attr('name','feature_heading['+ feature_last_index +']');
          clonedRow.find('.feature_subHeading').attr('name','feature_subHeading['+ feature_last_index +']');
          clonedRow.find('.feature_btnLink').attr('name','feature_btnLink['+ feature_last_index +']');
          clonedRow.find('.feature_btnAction').attr('name','feature_btnAction['+ feature_last_index +']').attr('id','feature_btnAction_'+ feature_last_index);
          clonedRow.find('.feature_btnAction').addClass('select-value');
          clonedRow.find('.DeleteSection').removeAttr('disabled');
          clonedRow.find('.dropzone').attr('id', 'feature_image_' + feature_last_index);
          clonedRow.find('.dropzone').empty();
          clonedRow.appendTo($(".feature-container"));
          refresh_featureDropzone(clonedRow);
      });

      $("#create-livePreview").click(function() {
        var rowToClone = $(".livePreview-row").last();
        var livePreviewRowLen= $(".livePreview-row").length;
        var clonedRow = rowToClone.clone(true);
        var livePreview_last_index = parseInt(clonedRow.attr('index'))+1;

        // Reset all input values within the cloned row
        clonedRow.find('input').each(function() {
          $(this).val('');
        });

        // Remove the selected option from all select elements within the cloned row
        clonedRow.find('select').each(function() {
          $(this).find('option:selected').removeAttr('selected');
        });

        clonedRow.attr('index',livePreview_last_index)
 
        clonedRow.find('.livePreview_title').attr('name','livePreview_title['+ livePreview_last_index +']');
        clonedRow.find('.livePreview_description').attr('name','livePreview_description['+ livePreview_last_index +']');
        clonedRow.find('.livePreview_images').attr('name','livePreview_images['+ livePreview_last_index +']');
        clonedRow.find('.livePreview_actionPage').attr('name','livePreview_actionPage['+ livePreview_last_index +']').attr('id','livePreview_actionPage_'+ livePreview_last_index);
        clonedRow.find('.livePreview_actionPage').addClass('select-value');
        clonedRow.find('.DeleteSection').removeAttr('disabled');
        clonedRow.find('.livePreviewEditor ').attr('id','livePreviewEditor_' + livePreview_last_index);
        clonedRow.find('.livePreview_description ').attr('id','livePreview_description_' + livePreview_last_index);
        clonedRow.find('.dropzone').attr('id', 'preview_image_' + livePreview_last_index);
        clonedRow.find('.dropzone').empty();
        clonedRow.find('.livePreviewEditor').empty();

        clonedRow.appendTo($(".livePreview-container"));
        initializeLivePreviewEditors();
        refresh_previewDropzone(clonedRow);
      });


      $("#create-package").click(function() {

        var rowToClone = $(".package-row").last();
        var clonedRow = rowToClone.clone(true);
        var package_last_index = parseInt(clonedRow.attr('index'))+1;

        // Reset all input values within the cloned row
        clonedRow.find('input').each(function() {
          $(this).val('');
        });

        // Remove the selected option from all select elements within the cloned row
        clonedRow.find('select').each(function() {
          $(this).find('option:selected').removeAttr('selected');
        });

        clonedRow.attr('index',package_last_index)
        clonedRow.find('.package_type').attr('name','package_type['+package_last_index+']').attr('value','coach'+package_last_index)

        clonedRow.find('.package_price').attr('name','package_price['+ package_last_index +']')
        clonedRow.find('.package_duration').attr('name','package_duration['+ package_last_index +']').attr('id','package_duration_'+package_last_index)
        clonedRow.find('.package_clients').attr('name','package_clients['+ package_last_index +']').attr('id','package_clients_'+package_last_index)
        clonedRow.find('.package_storage').attr('name','package_storage['+ package_last_index +']').attr('id','package_storage_'+package_last_index)
        clonedRow.find('.package_duration, .package_clients, .package_storage').addClass('select-value');
        clonedRow.find('input[type="number"], select').val('');
        clonedRow.find('.DeleteSection').removeAttr('disabled');
        clonedRow.appendTo($("#package-container"));
      });


      $(document).on('change', '.select-value', function(){
        var check = $(this).val();
        var id = $(this).attr('id');
        $('#'+id+' option[value="' + check + '"]').attr("selected", "selected");

      });


      $('.DeleteSection').click(function(){
        var section = $(this).attr('tabname');
        var row = $(this);
          
        if(section == "feature"){
          row.parents('.feature-row').remove();
        } else if(section == "livePreview"){
          row.parents('.livePreview-row').remove();
        } else if(section == "package"){
          row.parents('.package-row').remove();
        }

      });


      $('.checkbox-status').click(function(){
        if($(this).is(':checked')){
          $(this).val(true);
        } else {
          $(this).val(false);
        }
      });


      $('#redirect-status').click(function(){
        var page_id = $('#page_id').val();

        if($(this).is(':checked')){
          $(this).val(true);
          $('#redirect-page').removeAttr('disabled');
          var status = 1;
          setRedirect(page_id, status);
        } else {
          $(this).val(false);
          $('#redirect-page').attr('disabled',true);
          var status = 0;
          setRedirect(page_id, status);
        }

      });

       function setRedirect(page_id, status, page_name = null){

        $.ajax({
          type: 'post',
          url: '{{ route('pagecms.set-redirect') }}',
          data: {page_id:page_id, status:status, page_name:page_name},
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
      }

      $('#redirect-page').change(function(){
        
        var page_id = $('#page_id').val();
        var page_name = $(this).val();
        if(page_name == '') {
          return false;
        }
        var status = 1;
        setRedirect(page_id,status,page_name)
       
      });
    });

    var quillBubbleToolbarOptions = [
        ['bold', 'italic', 'underline', 'strike', 'link'],
        [{header: [1, 2, 3, 4, 5, 6, false]}],
        [{list: 'ordered'}, {list: 'bullet'}],
        [{align: []}],
      ];

    function initializeLivePreviewEditors() {  
      $('.livePreview-row').each(function() {
        var row = $(this);
        var editorId = row.find('.livePreviewEditor').attr('id');
        var quill = new Quill('#' + editorId, {
          modules: {
            toolbar: quillBubbleToolbarOptions, 
          },
          theme: 'bubble',
        });

        quill.on('text-change', function() {
          var editorContent = quill.root.innerHTML;
          var strippedContent = editorContent.replace(/<[^>]*>/g, '');
          row.find('.livePreview_description').val(strippedContent);
        });
      });
    }

    initializeLivePreviewEditors();

    function refresh_featureDropzone(row) {
      var dropzoneId = row.find('.dropzone').attr('id');
      row.find('.feature_image_value').val('assets/admin/plan-img/coach-portal-105.jpg')
      new Dropzone("#" + dropzoneId, {
          url: '{{ route('pagecms.UploadImage') }}',
          thumbnailWidth: 600,
          thumbnailHeight: 430,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
          init: function () {
              this.on('success', function (file, response) {
                  row.find('.feature_image_value').val(response.file_path).attr('index',file.upload.uuid)
              });

              this.on('removedfile', function (file) {
                if (file.upload && file.upload.uuid) {
                  var indexToDelete = file.upload.uuid;
                  $('input[index="' + indexToDelete + '"]').val('');
                } else {
                  row.find('.feature_image_value').val('');
                }
              });

              let mockFile1 = { name: '', size: 249430 };
              this.displayExistingFile(mockFile1, '{{ asset('assets/admin/plan-img/coach-portal-105.jpg') }}');

              this.element.classList.add('dz-started');
          },
      });
    }

    function refresh_previewDropzone(row) {
        var dropzoneId = row.find('.dropzone').attr('id');
        row.find('.preview_image_value').val('assets/admin/plan-img/coach-portal-105.jpg')
        new Dropzone("#" + dropzoneId, {
            url: '{{ route('pagecms.UploadImage') }}',
            thumbnailWidth: 600,
            thumbnailHeight: 430,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
            init: function () {
                this.on('success', function (file, response) {
                    row.find('.preview_image_value').val(response.file_path).attr('index',file.upload.uuid)
                });

                this.on('removedfile', function (file) {
                  if (file.upload && file.upload.uuid) {
                    var indexToDelete = file.upload.uuid;
                    $('input[index="' + indexToDelete + '"]').val('');
                  } else {
                    row.find('.preview_image_value').val('');
                  }
                });

                let mockFile1 = { name: '', size: 249430 };
                this.displayExistingFile(mockFile1, '{{ asset('assets/admin/plan-img/coach-portal-105.jpg') }}');

                this.element.classList.add('dz-started');
            },
        });
    }

  var toastElement = $('.toast')[0];
  var toast = new bootstrap.Toast(toastElement);
    toast.show();

  </script>
</body>

</html>
@endsection