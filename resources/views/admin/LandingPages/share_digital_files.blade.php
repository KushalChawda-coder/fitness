<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto">
          <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Home</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Landing Pages - Share Digital File</h1>
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
          <form id="landingPageCreate" action="{{ route('landing_pages.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                    <div class="card-body py-2 px-2 py-lg-3 px-lg-5">
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="mb-3">
                            <label class="form-label">Main Heading</label>
                              <input type="text" class="form-control" name="main_heading" placeholder="main heading" value="{{ old('main_heading') }}" required>
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
                            <input type="text" class="form-control" name="menu_text" placeholder="menu text" value="{{ old('menu_text') }}" required>
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
                            <input type="text" class="form-control" name="brand_name" placeholder="Get Your Free Ebook" value="{{ old('brand_name') }}" required>
                              @error('brand_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                          
                          <div class="mb-3">
                            <label class="form-label">Image</label>
                            <div class="mb-3 border no-shadow position-relative" id="singleImageUpload">
                              <img src="{{ asset('assets/admin/plan-img/free-ebook.jpg') }}" class="card-img-top rounded-3 sh-52" alt="image">
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
                        
                          <div class="mb-3">
                            <h2 class="small-title fw-bold">Lead Collection</h2>
                            <div class="row">
                              <div class="col-12 col-lg-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="name" name="lead_collection_column[]" id="LeadName">
                                  <label class="form-check-label" for="LeadName">
                                    Name
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="email" name="lead_collection_column[]" id="LeadEmail">
                                  <label class="form-check-label" for="LeadEmail">
                                    Email
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="phone" name="lead_collection_column[]" id="LeadPhone">
                                  <label class="form-check-label" for="LeadPhone">
                                    Phone
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="company_name" name="lead_collection_column[]" id="LeadCompanyName">
                                  <label class="form-check-label" for="LeadCompanyName">
                                    Company Name
                                  </label>
                                </div>
                              </div>
                              <div class="col-12 col-lg-6">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="current_website" name="lead_collection_column[]" id="LeadCurrentwebsite">
                                  <label class="form-check-label" for="LeadCurrentwebsite">
                                    Current website
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="instagram" name="lead_collection_column[]" id="LeadInstagramwebsite">
                                  <label class="form-check-label" for="LeadInstagramwebsite">
                                    Instagram website
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="facebook" name="lead_collection_column[]" id="LeadFacebook">
                                  <label class="form-check-label" for="LeadFacebook">
                                    Facebook
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="other" name="lead_collection_column[]" id="LeadOther">
                                  <label class="form-check-label" for="LeadOther">
                                    Other
                                  </label>
                                </div>
                              </div>
                              <div class="col-12 col-lg-12">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="provide_additional_info" name="lead_collection_column[]" id="LeadAdditionalInfo">
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
                          <div class="mb-3">
                            <label class="form-label">Call to action button </label>
                            <input type="text" class="form-control" id="action_button_name" name="action_button_name" placeholder="action button name" value="{{ old('action_button_name') }}" required>
                            @error('action_button_name')
                              <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Digital File(s) that will be sent </label>
                            <input id="digitalBodyPart" class="custom-look" name="digital_files" data-blacklist="" required>
                            <button class="btn btn-icon btn-icon-only btn-outline-primary mb-1" type="button">
                              <i data-acorn-icon="plus"></i>
                            </button>
                          </div>

                          <!-- <div class="mb-3">
                            <label class="form-label">Digital File(s) that will be sent </label>
                            <select class="form-control" id="js-basic-multiple" name="digital_files[]" multiple="multiple">
                              <option value="AL">Alabama</option>
                              <option value="WY">Wyoming</option>
                            </select>
                          </div> -->
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
                <form>
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">Page Title</label>
                        <input type="text" class="form-control" name="meta_page_title" value="{{ old('meta_page_title') }}" placeholder="page title">
                        @error('meta_page_title')
                          <span class="text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Friendly URL</label>
                        <input type="url" class="form-control" name="meta_friendly_url" value="{{ old('meta_friendly_url') }}" placeholder="friendly url">
                        @error('meta_friendly_url')
                          <span class="text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea type="text" class="form-control" name="meta_description" value="{{ old('meta_description') }}" placeholder="description"></textarea>
                        @error('meta_description')
                          <span class="text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <input  name="tagsBasic" value="{{ old('tagsBasic') }}"/>
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
                            <input type="hidden" id="domain_name" name="domain_name" value="">
                            <input type="hidden" id="page_status" name="status" value="1">
                            <input type="hidden" name="landing_page_type" value="{{ \App\Models\admin\LandingPage::SHARE_DEGITAL_FILES }}">
                            <a href="#" class="text-success">
                              <h4 class="text-success">Fitness Plan App</h4>
                            </a>
                            <a href="#" class="text-blue">
                              <h6 class="text-blue" id="live_url">{{ url('/') }}/</h6>
                            </a>
                            <p>This is a place where user can go and get their website to host their fitness and
                              meal
                              plans.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-center mb-3">
            <label class="form-check-label" for="flexSwitchCheckDraft">Published</label>
            <div class="form-check form-switch ms-2 mb-0">
              <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDraft" checked>
            </div>
            <label class="form-check-label" for="flexSwitchCheckDraft">Draft</label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Landing Page URL</span>
            <input type="text" id="landingUrl" class="form-control" >
            <span class="input-group-text" id="copyBtn">
              <a href="javascript:;" class="d-inline-block text-dark"><i data-acorn-icon="duplicate"></i></a>
            </span>
            @error('domain_name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            <span class="text-danger" role="alert">
              <strong id='UrlErr'></strong>
            </span>
          </div>
          <div class="d-block text-center">
            <!-- Preview Button Start -->
            <a href="{{ url('/') }}" role="button" target="_blank" class="btn btn-sm btn-icon btn-dark">
              <i data-acorn-icon="eye" data-acorn-size="13"></i>
              Preview Site
            </a>
            <!-- Preview Button End -->
          </div>
        </div>
      </div>
    </div>
  </div>
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