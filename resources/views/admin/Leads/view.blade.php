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
          <a href="{{ route('leads.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Leads</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Leads Detail</h1>
        </div>
      </div>
      <!-- Title End -->
      <!-- Top Buttons Start -->
      <div class="col-3 d-flex align-items-end justify-content-end">
        <a role="button" href="{{ route('leads.edit',['id' => $data->id]) }}"
          class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto">
          <i data-acorn-icon="edit"></i>
          <span>Edit Lead</span>
        </a>
      </div>
      <!-- Top Buttons End -->
    </div>
  </div>

  <!-- Title and Top Buttons End -->
  <div class="row gx-4 gy-5">
    <!-- Customer Start -->
    <div class="col-12 col-xl-4 col-xxl-3">
      <div class="card">
        <div class="card-body mb-n5">
          <div class="d-flex align-items-center flex-column">
            <div class="mb-5 d-flex align-items-center flex-column">
              <div
                class="sw-6 sh-6 mb-3 d-inline-block bg-primary d-flex justify-content-center align-items-center rounded-xl">
                <div class="text-white">{{ $char }}</div>
              </div>
              <div class="h5 mb-1">{{ ucwords($data->name) }}</div>
              <div class="text-muted">
                <span class="align-middle">{{ ucwords($data->company_name) }}</span>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <input type="hidden" id="lead_id" value="{{ $data->id }}">
            <select  class="form-select Status">
              <option value="{{ \App\Models\admin\Leads::HOT_LEAD }}"  {{ $data->status == 1 ? 'selected' : '' }}>Hot Lead</option>
              <option value="{{ \App\Models\admin\Leads::NOT_GOOD_LEAD }}" {{ $data->status == 2 ? 'selected' : '' }}>Not Good Lead</option>
              <option value="{{ \App\Models\admin\Leads::LOST_LEAD }}" {{ $data->status == 3 ? 'selected' : '' }}>Lost Lead</option>
              <option value="{{ \App\Models\admin\Leads::NEW_LEAD }}" {{ $data->status == 4 ? 'selected' : '' }}>New Lead</option>
              <option value="{{ \App\Models\admin\Leads::FOLLOW_UP }}" {{ $data->status == 5 ? 'selected' : '' }}>Follow Up</option>
            </select>
          </div>
          <div class="mb-5">
            <div>
              <p class="text-small text-muted mb-2">Leads Info</p>
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="user" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate align-middle">{{ ucwords($data->name) }}</div>
              </div>
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="phone" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->phone }}</div>
              </div>
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="pin" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->address }}</div>
              </div>
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="email" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->email }}</div>
              </div>
              @foreach($urls as $url)
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="web" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $url }}</div>
              </div>
              @endforeach
              @if($data->other_social_link)
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="web" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->other_social_link }}</div>
              </div>
              @endif
              @if($data->instagram_url)
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="instagram" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->instagram_url }}</div>
              </div>
              @endif
              @if($data->facebook_url)
              <div class="row g-0 mb-2">
                <div class="col-auto">
                  <div class="sw-3 me-1">
                    <i data-acorn-icon="facebook" class="text-primary" data-acorn-size="17"></i>
                  </div>
                </div>
                <div class="col text-alternate">{{ $data->facebook_url }}</div>
              </div>
              @endif
            </div>
          </div>
          @if($data->additional_info)
            <div class="mb-5">
              <p class="text-small text-muted mb-2">Additional Info</p>
              <div class="row g-0 mb-2">
                <div class="col text-alternate">{{ $data->additional_info }}</div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
    <!-- Customer End -->
    <div class="col-12 col-xl-8 col-xxl-9">
      <div class="mb-5">
        <div class="card mb-3">
          <div class="card-header border-0 pb-0">
            <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('tab') === 'activity' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#first" role="tab"
                type="button" aria-selected="{{ session('tab') === 'activity' ? 'active' : '' }}">
                Activity
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('tab') === 'notes' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#second" role="tab" type="button"
                aria-selected="{{ session('tab') === 'notes' ? 'true' : 'false' }}">Notes</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link {{ session('tab') === 'brand_page' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#third" role="tab" type="button"
                aria-selected="{{ session('tab') === 'brand_page' ? 'true' : 'false' }}">Brand Page</button>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade {{ session('tab') === 'activity' ? 'active show' : '' }}" id="first" role="tabpanel">
                <h2 class="small-title">Activity History</h2>
                <div class="card shadow-none border sh-35">
                  <div class="card-body scroll-out h-100">
                    <div class="scroll h-100">
                      @foreach($leadsActivity as $activity)
                      <div class="row g-0 mb-2">
                        <div class="col-auto">
                          <div class="sw-3 d-inline-block d-flex justify-content-start align-items-center h-100">
                            <div class="sh-3">
                              @if ($activity->status == \App\Models\admin\leadsActivity::LEAD_ADDED_LANDING)
                               <i data-acorn-icon="square" class="text-success align-top"></i>
                              @endif
                              @if ($activity->status == \App\Models\admin\leadsActivity::ACCOUNT_CREATED)
                               <i data-acorn-icon="square" class="text-success align-top"></i>
                              @endif
                              @if ($activity->status == \App\Models\admin\leadsActivity::CLICKED_ACCOUNT)
                               <i data-acorn-icon="square" class="text-danger align-top"></i>
                              @endif
                              @if ($activity->status == \App\Models\admin\leadsActivity::CONVERTED_ACCOUNT)
                                <i data-acorn-icon="hexagon" class="text-tertiary align-top"></i>
                              @endif
                              @if ($activity->status == \App\Models\admin\leadsActivity::DEACTIVATED_ACCOUNT)
                               <i data-acorn-icon="triangle" class="text-warning align-top"></i>
                              @endif
                              @if ($activity->status == \App\Models\admin\leadsActivity::REQUEST_E_BOOK)
                               <i data-acorn-icon="square" class="text-success align-top"></i>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col">
                          <div
                            class="card-body d-flex flex-column pt-0 pb-0 ps-3 pe-4 h-100 justify-content-center">
                            <div class="d-flex flex-column">
                              <div class="text-alternate mt-n1 lh-1-25">
                                @if ($activity->status == \App\Models\admin\leadsActivity::LEAD_ADDED_LANDING)
                                 {{ 'Lead added to DB from landing page' }}
                                @endif
                                @if ($activity->status == \App\Models\admin\leadsActivity::ACCOUNT_CREATED)
                                 {{ 'Demo account created' }} 
                                @endif
                                @if ($activity->status == \App\Models\admin\leadsActivity::CLICKED_ACCOUNT)
                                 {{ 'Clicked on demo account' }}
                                @endif
                                @if ($activity->status == \App\Models\admin\leadsActivity::CONVERTED_ACCOUNT)
                                 {{ 'Converted to a customer account' }}
                                @endif
                                @if ($activity->status == \App\Models\admin\leadsActivity::DEACTIVATED_ACCOUNT)
                                 {{ 'Deactivated Demo account' }}
                                @endif
                                @if ($activity->status == \App\Models\admin\leadsActivity::REQUEST_E_BOOK)
                                 {{ 'Request for ebook' }}
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="d-inline-block d-flex justify-content-end align-items-center h-100">
                            <div class="text-muted ms-2 mt-n1 lh-1-25">{{ $activity->created_at->format('d M') }}</div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade {{ session('tab') === 'notes' ? 'active show' : '' }}" id="second" role="tabpanel">
                <h2 class="small-title">Notes</h2>
                <div class="card shadow-none border mb-3">
                  <form action="{{ route('leads.add-notes') }}"  method="post">
                    @csrf
                    <input type="hidden" id="lead_id" name="lead_id" value="{{ $data->id }}"/>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" rows="4" name="note">{{ old('note') }}</textarea>
                        @error('note')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Tags</label>
                        <input name="tagsBasic" value="{{ old('tagsBasic') }}" id="tags" />
                        @error('tagsBasic')
                        <span class="text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-danger" id="clear_input">Cancel</button>
                    </div>
                  </form>
                </div>
                @if($lead_notes->isEmpty())
                <p class="text-center mb-0 mt-5 pt-5">{{ _('Data Not Found!')}}</p>
                @else
                @foreach($lead_notes as $value)
                <div class="card shadow-none border mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <div class="d-flex justify-content-between">
                          <div class="">
                            <a href="#">{{ ucwords($data->name) }}</a>
                            <div class="text-muted text-small mb-2">Development Lead</div>
                          </div>
                          <div class="text-muted">
                            Last Edit : {{ $value->created_at->diffForHumans(); }}
                          </div>
                        </div>
                        <div class="text-medium text-alternate mb-1 clamp-line" data-line="2">{{ $value->note }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
              <div class="tab-pane fade {{ session('tab') === 'brand_page' ? 'active show' : '' }}" id="third" role="tabpanel">
                <div class="row">
                  <div class="col-auto mb-3 mb-md-0 me-auto">
                    <h5>Website</h5>
                  </div>
                  <div class="col-5 d-flex align-items-end justify-content-end">
                    <!-- <div class="d-flex align-items-center me-3">
                      <label class="form-check-label" for="flexSwitchCheckDraft">Published</label>
                      <div class="form-check form-switch ms-2 mb-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDraft"
                        checked>
                      </div>
                      <label class="form-check-label" for="flexSwitchCheckDraft">Draft</label>
                    </div> -->
                    <!-- Preview Button Start -->
                    <a href="https://000stagehtmlcss.s3.amazonaws.com/FitnessandMealPlans/LEAD-DEMO-101/src/index.html"
                      role="button" class="btn btn-sm btn-icon btn-dark">
                      <i data-acorn-icon="eye" data-acorn-size="13"></i>
                      <span class="d-none d-md-inline-block">Go to Site</span>
                    </a>
                    <!-- Preview Button End -->
                  </div>
                </div>
                <ul class="nav nav-tabs nav-tabs-line card-header-tabs responsive-tabs mt-2 mb-3" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#brandfirst" role="tab"
                    type="button" aria-selected="true">
                    General
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#brandsecond" role="tab"
                    type="button" aria-selected="false">Main Page</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#brandthird" role="tab"
                    type="button" aria-selected="false">Plans</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#brandfourth" role="tab"
                    type="button" aria-selected="false">Classes</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#brandfifth" role="tab"
                    type="button" aria-selected="false">Contact</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#brandsixth" role="tab"
                    type="button" aria-selected="false">Flyer</button>
                  </li>
                </ul>
                <form method="post" action="{{ route('leads.update-website'); }}" enctype="multipart/form-data" class="dropzone" id="websiteUpdate">
                  @csrf
                  <input type="hidden" name="id" value="{{ $leadWeb->id  }}">
                  <input type="hidden" name="domain_id" value="{{ $leadWeb->domain_id }}">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="brandfirst" role="tabpanel">
                      <h2 class="small-title fw-bold">General Contact</h2>
                      <div class="card shadow-none border">
                        <div class="card-body">
                          <div class="row form-group mb-3">
                            <div class="col-12 col-lg-8 col-xl-6">
                              <div class="mb-3 position-relative d-inline-block">
                                <div class="logo-image" id="logoImage" style="background:{{ $leadWeb->brand_bg_color  }}">
                                  <img src="{{ asset('assets/admin/plan-img/logo-edit-removebg.png') }}" alt="image" class="img-fluid">
                                </div>
                                <div class="edit-color position-absolute d-inline-block t-0 e-n5">
                                  <input type="color" id="ChangeColor" class="form-control form-control-color sw-8" name="brand_bg_color" value="{{ $leadWeb->brand_bg_color }}" title="Choose your color">
                                </div>
                              </div>
                            </div>
                            <div class="col-12 col-lg-6">
                              <div class="d-block">
                                <label class="form-label">Customer can use to claim site</label>
                              </div>
                              <div
                                class="d-inline-block border border-dashed rounded-3 px-3 py-2 fw-bold text-dark" id="claim_text">{{ $leadWeb->customer_claim_code }}
                              </div>
                              <input type="hidden" id="claim_code" name="customer_claim_code" value="{{ $leadWeb->customer_claim_code }}">
                              <a id="ClaimCodeBtn" style="cursor: pointer;user-select: none;" class="ms-3 d-inline-block fw-bold text-primary">
                                Generate
                              </a>
                              @error('customer_claim_code')
                              <div class="row col-md-12">
                                 <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              </div>
                              @enderror
                            </div>
                            
                          </div>
                          <div class="row form-group mb-3">
                            <div class="col-12 col-lg-8 col-xl-6">
                              <div class="mb-3">
                                <label class="form-label">Business or Website Name</label>
                                <input type="text" class="form-control" name="brand_name" value="{{ $leadWeb->brand_name }}"/>
                                @error('brand_name')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="row form-group mb-3">
                            <div class="col-12 col-lg-12">
                              <div class="row">
                                <div class="col-12 col-sm-6">
                                  <div class="mb-3 filled form-group tooltip-end-top">
                                    <i data-acorn-icon="web"></i>
                                    <input class="form-control" name="websiteName" type="text"
                                    placeholder="coachrab" value="fitnessplanapp.com/" readonly>
                                  </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                  <div class="mb-3 form-group">
                                    <input class="form-control domain" name="pageLink" type="text" placeholder="Create Page Link" value="{{ $leadWeb->getDomain->domain_name }}" required />
                                    @error('pageLink')
                                      <div class="row col-md-12">
                                         <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                      </div>
                                    @enderror
                                    <div class="invalid-feedback UrlErr">
                                      <i data-acorn-icon="info-circle" data-acorn-size="14"></i>
                                      <span class="Appandetext"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="brandsecond" role="tabpanel">
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Header</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Heading</label>
                                <input class="form-control" name="Heading" value="{{ $page_data->Header->Heading ?? null }}">
                                @error('Heading')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Sub Text</label>
                                <input class="form-control" name="SubText" value="{{ $page_data->Header->SubText ?? null }}">
                                @error('SubText')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Header Image</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-12 col-xl-6">
                                <label class="form-label">Image</label>
                                <div class="mb-3 border no-shadow position-relative" id="singleImageUpload">
                                  <img src="{{ asset($page_data->Header->HeaderImage) }}" class="card-img-top rounded-3 sh-52"
                                  alt="image">
                                  <div class="position-absolute me-2 mt-2 b-2 e-2 d-inline-block"
                                    id="singleImageUploadExample">
                                    <button
                                    class="btn btn-sm btn-icon btn-icon-only btn-warning rounded-xl position-absolute e-0 b-0"
                                    type="button">
                                    <i data-acorn-icon="upload"></i>
                                    </button>
                                    <input class="file-upload t-0 e-2 s-0" type="file" name="header_image" value="" accept="image/*">
                                  </div>
                                  @error('header_image')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                                <!-- <div
                                  class="dropzone dropzone-columns min-h-100 row g-2 row-cols-1 row-cols-md-2 row-cols-xl-4 border-0 p-0"
                                id="dropzoneProductGallery2"></div>
                                <button type="button" class="btn btn-outline-dark btn-icon btn-icon-start mt-2"
                                id="dropzoneProductGalleryButton2">
                                <i data-acorn-icon="plus"></i>
                                <span>Add Files</span>
                                </button> -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Plan Heighlight</h2>
                        @foreach ($page_data->PlanTypes as $plan)
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="alert alert-info" role="alert">
                                  <b>Note :</b>If you want to make changes to the actual plan such as price, description it must be done in the Package page.<a href="Product.List.html"
                                  class="fw-bold text-info">Package</a>
                                  page.
                                </div>
                              </div>
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="text-end">
                                  <button type="button"
                                  class="btn btn-sm btn-icon btn-icon-only btn-outline-danger mb-1">
                                  <i data-acorn-icon="bin"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label">Choose a package from list</label>
                                  <select class="form-select" name="package_type">
                                    <option value="" selected>Select Package</option>
                                    <option value="1" {{ $page_data->PlanTypes[0] == 1 ? 'selected':'' }}>1-2-1 PERSONAL TRAINING</option>
                                    <option value="2" {{ $page_data->PlanTypes[0] == 2 ? 'selected':'' }}>SMALL GROUP PERSONAL TRAINING</option>
                                    <option value="3" {{ $page_data->PlanTypes[0] == 3 ? 'selected':'' }}>1-2-1 PERSONAL TRAINING</option>
                                    <option value="4" {{ $page_data->PlanTypes[0] == 4 ? 'selected':'' }}>SMALL GROUP PERSONAL TRAINING</option>
                                  </select>
                                  @error('package_type')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label">Price</label>
                                  <h4 class="fw-bold">$315.20</h4>
                                  <!-- <input type="text" class="form-control" placeholder="" value=""> -->
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label">Description of Package</label>
                                  <!-- <div class="html-editor-bubble sh-19 html-editor" id="quillEditorBubble"> -->
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
                                </div>
                              </div>
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="mb-3">
                                  <label class="form-label">Image</label>
                                  <div class="card">
                                    <img src="{{ asset('assets/img/product/small/product-10.webp') }}" class="rounded-3 sh-20"
                                    alt="image">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        <div class="row align-items-center mt-4">
                          <div class="col-12 col-lg-12">
                            <button type="button" class="btn btn-icon btn-outline-primary">
                            <i data-acorn-icon="plus" class="icon"></i>
                            Add a Plan
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">About</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-12 col-xl-12">
                                <label class="form-label"></label>
                                <textarea class="form-control" rows="5" name="About">{{ $page_data->About }}</textarea>
                                @error('About')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Explore</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-12 col-xl-12">
                                <label class="form-label">Images</label>
                                <div class="dropzone dropzone-columns min-h-100 row g-2 row-cols-1 row-cols-md-2 row-cols-xl-4 border-0 p-0"
                                id="explore_dropzone"></div>
                                <button type="button" class="btn btn-outline-dark btn-icon btn-icon-start mt-2" id="explore_dropzone">
                                <i data-acorn-icon="plus"></i>
                                <span>Add Files</span>
                                </button>
                              </div>
                              <script>
                             
                              </script>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection">
                        <h2 class="small-title fw-bold">Video</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <button type="button" class="btn btn-block btn-bold py-4 btn-light btn-sm btn-file">
                                <i data-acorn-icon="video" data-acorn-size="32"></i>
                                <input type="file" name="page_video" value="{{ $page_data->Video[0] }}">
                                <span class="d-block">
                                  Upload Videos
                                </span>
                                </button>
                              </div>
                              @error('page_video')
                                <div class="row col-md-12">
                                   <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                </div>
                              @enderror
                            </div>
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <div class="form-row">
                                  <div class="col-12">
                                    <label>Instruction Video URL</label>
                                  </div>
                                </div>
                                <div class="form-group form-row">
                                  <div class="col-12">
                                    <div class="mb-3">
                                      <input type="text" class="form-control" name="video_link_1" value="{{ $page_data->Video[1] }}" placeholder="Enter your video link i.e. youtube.com">
                                      @error('video_link_1')
                                        <div class="row col-md-12">
                                           <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        </div>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group form-row">
                                  <div class="col-12">
                                    <div class="mb-3">
                                      <input type="text" class="form-control"
                                      placeholder="Enter your video link i.e. youtube.com" name="video_link_2" value="{{ $page_data->Video[2] }}">
                                      @error('video_link_2')
                                        <div class="row col-md-12">
                                           <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        </div>
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
                    <div class="tab-pane fade" id="brandthird" role="tabpanel">
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Content</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                  <label class="form-label">Background Image</label>
                                  <div
                                    class="dropzone dropzone-columns row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                  id="imagedropzone"></div>
                                </div>
                              </div>
                            </div>
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea class="form-control" name="plan_description" rows="5">{{ $leadWeb->plan_description }}</textarea>
                                  @error('plan_description')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="alert alert-info" role="alert">
                                <b>Note :</b>{{ $leadWeb->plan_note }}</div>
                                <input type="hidden" name="plan_note" value="{{ $leadWeb->plan_note }}">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="brandfourth" role="tabpanel">
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Content</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                  <label class="form-label">Background Image</label>
                                  <div
                                    class="dropzone dropzone-columns row g-2 row-cols-1 row-cols-md-1 border-0 p-0"
                                  id="bg_image_dropzone"></div>
                                </div>
                              </div>
                            </div>
                            <div class="row mb-2">
                              <div class="col-12 col-lg-6 col-xl-6">
                                <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea class="form-control" name="class_description" rows="5">{{ $leadWeb->class_description }}</textarea>
                                  @error('class_description')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12 col-sm-12 col-lg-6">
                                <div class="alert alert-info" role="alert">
                                  <b>Note :</b>{{ $leadWeb->class_note }}
                                  <input type="hidden" name="class_note" value="{{ $leadWeb->class_note }}">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="brandfifth" role="tabpanel">
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">General Contact</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" value="{{ $generalInfo->GeneralContact->Email }}"  placeholder="">
                                @error('email')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                @enderror
                              </div>
                            </div>
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Phone</label>
                                <input class="form-control" name="phone" value="{{ $generalInfo->GeneralContact->Phone }}" placeholder="">
                                @error('phone')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Social Media</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Facebook Link</label>
                                <input class="form-control" name="facebook_link" value="{{ $generalInfo->SocialMedia->FacebookLink }}" placeholder="">
                                @error('facebook_link')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Twitter Link</label>
                                <input class="form-control" name="twitter_link" value="{{ $generalInfo->SocialMedia->TwitterLink }}" placeholder="">
                                @error('twitter_link')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <label class="form-label">Instagram Link</label>
                                <input class="form-control" name="instagram_link" value="{{ $generalInfo->SocialMedia->InstagramLink }}"  placeholder="">
                                @error('instagram_link')
                                  <div class="row col-md-12">
                                     <span class="text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  </div>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="brandsixth" role="tabpanel">
                      <div class="row">
                        <div class="col-12 col-lg-6">
                          <h5 class="mb-3">Create Flyer for Lead</h5>
                        </div>
                        <div class="col-12 col-lg-6">
                          <div class="input-group mb-3">
                            <span class="input-group-text">Flyer URL</span>
                            <input type="text" class="form-control domain" id="FlyerURL" name="flyer_URL" main-url="{{ request()->getScheme() . '://' .request()->getHost(). '/' .$flyerData->FlyerURL }}" value="{{ $flyerData->FlyerURL }}">
                            <span id="copyBtn" class="input-group-text">
                              <a href="javascript:;" class="d-inline-block text-dark"><i
                              data-acorn-icon="duplicate"></i></a>
                            </span>
                            @error('flyer_URL')
                              <div class="row col-md-12">
                                 <span class="text-danger" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                              </div>
                             @enderror
                            <div class="invalid-feedback UrlErr">
                              <i data-acorn-icon="info-circle" data-acorn-size="14"></i>
                              <span class="Appandetext"></span>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <div class="row">
                          <div class="col-12 col-lg-6">
                            <div class="mb-3 form-group">
                              <label class="form-label">Choose Flyer</label>
                              <select class="form-select" name="flyer_type">
                                <option value="Flyer 1" {{ $flyerData->FlyerType == "Flyer 1" ? 'selected':'' }}>Flyer 1</option>
                                <option value="Flyer 2" {{ $flyerData->FlyerType == "Flyer 2" ? 'selected':'' }}>Flyer 2</option>
                                <option value="Flyer 3" {{ $flyerData->FlyerType == "Flyer 3" ? 'selected':'' }}>Flyer 3</option>
                                <option value="Flyer 4" {{ $flyerData->FlyerType == "Flyer 4" ? 'selected':'' }}>Flyer 4</option>
                              </select>
                              @error('flyer_type')
                                <div class="row col-md-12">
                                   <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                </div>
                              @enderror
                            </div>
                            <div class="row">
                              <div class="col-12 col-lg-12">
                                <div class="mb-2 row form-group">
                                  <label class="col-12 col-lg-8 form-label">Choose Header Image</label>
                                  <div class="col-12 col-lg-4">
                                    <div class="border no-shadow position-relative" id="singleImageUpload">
                                      <img src="{{ asset($flyerData->HeaderImage) }}" class="card-img-top rounded-3 sh-10"
                                      alt="image">
                                      <div class="position-absolute me-2 mt-2 b-2 e-2 d-inline-block"
                                        id="singleImageUploadExample">
                                        <button
                                        class="btn btn-sm btn-icon btn-icon-only btn-warning rounded-xl position-absolute e-0 b-0"
                                        type="button">
                                        <i data-acorn-icon="upload"></i>
                                        </button>
                                        <input class="file-upload t-0 e-2 s-0" type="file" accept="image/*" name="flyer_header_img" value="{{ $flyerData->HeaderImage }}">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row form-group">
                                  <label class="col-12 col-lg-8 form-label">Choose Flyer Image 2</label>
                                  <div class="col-12 col-lg-4">
                                    <div class="border no-shadow position-relative" id="singleImageUpload">
                                      <img src="{{ asset($flyerData->FlyerImage2) }}" class="card-img-top rounded-3 sh-10"
                                      alt="image">
                                      <div class="position-absolute me-2 mt-2 b-2 e-2 d-inline-block"
                                        id="singleImageUploadExample">
                                        <button
                                        class="btn btn-sm btn-icon btn-icon-only btn-warning rounded-xl position-absolute e-0 b-0"
                                        type="button">
                                        <i data-acorn-icon="upload"></i>
                                        </button>
                                        <input class="file-upload t-0 e-2 s-0" type="file" accept="image/*" name="flyer_image_2" value="{{ $flyerData->FlyerImage2 }}">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row form-group">
                                  <label class="col-12 col-lg-8 form-label">Choose Flyer Image 3</label>
                                  <div class="col-12 col-lg-4">
                                    <div class="border no-shadow position-relative" id="singleImageUpload">
                                      <img src="{{ asset($flyerData->FlyerImage3) }}" class="card-img-top rounded-3 sh-10"
                                      alt="image">
                                      <div class="position-absolute me-2 mt-2 b-2 e-2 d-inline-block"
                                        id="singleImageUploadExample">
                                        <button
                                        class="btn btn-sm btn-icon btn-icon-only btn-warning rounded-xl position-absolute e-0 b-0"
                                        type="button">
                                        <i data-acorn-icon="upload"></i>
                                        </button>
                                        <input class="file-upload t-0 e-2 s-0" type="file" accept="image/*" name="flyer_image_3" value="{{ $flyerData->FlyerImage3 }}">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row form-group">
                                  <div class="col-12 col-lg-12">
                                    <div class="edit-color">
                                      <label for="exampleColorInput" class="form-label">Color picker</label>
                                      <input type="color" id="exampleColorInput" class="form-control form-control-color sw-20" name="flyer_color" value="{{ $flyerData->color }}" title="Choose your color">
                                      @error('flyer_color')
                                        <div class="row col-md-12">
                                           <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        </div>
                                      @enderror
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row form-group">
                                  <div class="col-12 col-lg-12">
                                    <label class="form-label">Phone</label>
                                    <input class="form-control" type="text" placeholder="" name="flyer_phone" value="{{ $flyerData->Phone }}">
                                    @error('flyer_phone')
                                      <div class="row col-md-12">
                                         <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                      </div>
                                    @enderror
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-lg-6">
                            <div class="row">
                              <div class="col-12 mb-3 text-center">
                                <a href="https://000stagehtmlcss.s3.amazonaws.com/FitnessandMealPlans/LEAD-DEMO-101/src/flyer.html"
                                  role="button" class="btn btn-sm btn-icon btn-warning h-auto">
                                  <!-- <i data-acorn-icon="eye" data-acorn-size="13"></i> -->
                                  Go to Flyer
                                </a>
                              </div>
                            </div>
                            <div class="mb-3 flyerimage">
                              <img src="{{ asset('assets/admin/plan-img/flyer.jpg') }}" alt="flyer" class="img-fluid">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Call to Action Messages:</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row form-group mb-3">
                              <div class="col-12 col-lg-8 col-xl-6">
                                <div class="mb-3 form-group">
                                  <label class="form-label">Lead Name</label>
                                  <input class="form-control" name="lead_name" type="text" placeholder="" name="lead_name" value="{{ $flyerData->LeadName }}">
                                  @error('lead_name')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Welcome</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 col-lg-12">
                                <div class="form-group">
                                  <textarea  class="form-control" rows="5" name="flyer_message">{{ $flyerData->WelcomeMessage }}</textarea>
                                  @error('flyer_message')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">Branded Site</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 col-lg-12">
                                <div class="form-group">
                                  <textarea class="form-control" name="branded_site" rows="5">{{ $flyerData->BrandedSite }}
                                  </textarea>
                                  @error('branded_site')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="pagesection mb-4">
                        <h2 class="small-title fw-bold">APP</h2>
                        <div class="card shadow-none border">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12 col-lg-12">
                                <div class="form-group">
                                  <textarea class="form-control" name="app" rows="5">{{ $flyerData->APP }}
                                  </textarea>
                                  @error('app')
                                    <div class="row col-md-12">
                                       <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" id="lead-website-btn" class="btn btn-primary m-3 float-end">Save Changes</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Recent Orders End -->
    </div>
  </div>
</div>
@include('admin.Leads.lead_details')
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
    new Dropzone('#imagedropzone', {
      url: "{{ route('leads.upload-planBgImage') }}",
      thumbnailWidth: 600,
      thumbnailHeight: 430,
      maxFiles: 1,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      params: {
        id: {{ $leadWeb->id  }} 
      },
      previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
      init: function () {
        this.on('success', function (file, responseText) {
          console.log(responseText);
        });

        // If you only have access to the original image sizes on your server,
        // and want to resize them in the browser:
        let mockFile1 = { name: '', size: 249430 };
        this.displayExistingFile(mockFile1, '{{ asset($leadWeb->plan_background_image) }}');

        // Adding dz-started class to remove drop message
        this.element.classList.add('dz-started');
      },
    });

  new Dropzone('#bg_image_dropzone', {
    url: "{{ route('leads.upload-classBgImage') }}",
    thumbnailWidth: 600,
    thumbnailHeight: 430,
    maxFiles: 1,
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    params: {
      id: {{ $leadWeb->id  }} 
    },
    previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
    init: function () {
      this.on('success', function (file, responseText) {
        console.log(responseText);
      });

      // If you only have access to the original image sizes on your server,
      // and want to resize them in the browser:
      let mockFile1 = { name: '', size: 249430 };
      this.displayExistingFile(mockFile1, '{{ asset($leadWeb->class_background_image) }}' );

      // Adding dz-started class to remove drop message
      this.element.classList.add('dz-started');
    },
  });

    var explore_image = <?php echo json_encode($explore_image); ?>;
    new Dropzone('#explore_dropzone', {
      url: "{{ route('leads.upload-exploreImage') }}",
      thumbnailWidth: 600,
      thumbnailHeight: 430,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      params: {
        id: {{ $leadWeb->id  }} 
      },
      previewTemplate: DropzoneTemplates.columnPreviewImageTemplate,
      init: function () {
        this.on('success', function (file, responseText) {
          console.log(responseText);
        });

        this.on('removedfile', function (file) {
          $.ajax({
            url: "{{ route('leads.delete-exploreImage') }}",
            method: "POST",
            data: { id: file.name },
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
              console.log("Image deleted successfully");
            },
            error: function (error) {
              console.error("Failed to delete image: " + error.statusText);
            }
          });
        });

        var asset_url = '{{ url('/'); }}';
        for (let i = 0; i < explore_image.length; i++) {
          const image = explore_image[i].explore_images;
          this.displayExistingFile({ name: explore_image[i].id, size: 203100 }, asset_url+image);
        }

        // Adding dz-started class to remove drop message
        this.element.classList.add('dz-started');
      },
    });



  $(document).ready(function(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $('.Status').change(function() {
      var status = $(this).val();
      var lead_id = $(this).siblings('#lead_id').val();
      $.ajax({
        type: 'post',
        url: '{{ route('leads.status') }}',
        data: {status:status,lead_id:lead_id},
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
    $("#ChangeColor").on("input", function() {
      var selectedColor = $(this).val();
      $("#logoImage").css("background-color", selectedColor);
    });
    function generateRandomText() {
      var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      var randomLetters = "";
      for (var i = 0; i < 3; i++) {
        randomLetters += letters.charAt(Math.floor(Math.random() * letters.length));
      }
      var randomText = randomLetters + "-" + generateRandomNumber(1000, 9999) + "-" + generateRandomNumber(1000, 9999);
      return randomText;
    }
    function generateRandomNumber(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
  
    $('#ClaimCodeBtn').click(function(){
      var randomText = generateRandomText();
      getText = randomText;
      $("#claim_text").text(getText);
      $("#claim_code").val(getText);
    });

    $('.domain').keyup(function(){
      var url = $(this).val();
      var $this = $(this);
      var domain_id = '{{ $leadWeb->domain_id }}';
      $.ajax({
        type: 'post',
        url: '{{ route('landing_pages.check-domain') }}',
        data: { url:url, domain_id:domain_id },
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
          if(response.status == true){
            $this.siblings('.UrlErr').hide();
            $this.removeClass('is-invalid');
            $this.siblings('.UrlErr').children('.Appandetext').text('');
            $('#lead-website-btn').prop('disabled', false);
          } else {
            if (url != 'flyerdemo'){
              $this.siblings('.UrlErr').show();
              $this.addClass('is-invalid');
              $this.siblings('.UrlErr').children('.Appandetext').text(response.error).show();
              $('#lead-website-btn').prop('disabled', true);
            }
          }
        },
        error: function(error) {
          console.error(error);
        }
      });
    });

    $("#copyBtn").click(function() {
      var value = $("#FlyerURL").attr('main-url');
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

    var tagifyInstance = new Tagify(document.querySelector('#tags'));
    $('#clear_input').click(function(){
      tagifyInstance.removeAllTags();
    });

    var toastElement = $('.toast')[0];
    var toast = new bootstrap.Toast(toastElement);
    toast.show();
  })
</script>
</body>
</html>
@endsection