<div>
    <!-- Controls Start -->
    <div class="row mb-2">
        <!-- Search Start -->
        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
            <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                <input type="search" wire:model="search" class="form-control" id="Search_leads" placeholder="Search" />
                <span class="search-magnifier-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-search undefined">
                        <circle cx="9" cy="9" r="7"></circle>
                        <path d="M14 14L17.5 17.5"></path>
                    </svg>
                </span>
                <span class="search-delete-icon d-none">
                    <i data-acorn-icon="close"></i>
                </span>
            </div>
        </div>

        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
            <div class="d-inline-block">
                <!-- Filter Button Start -->
                <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow" type="button" data-bs-toggle="modal" data-bs-target="#leadFilter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-filter undefined"><path d="M15 2H5C4.44772 2 4 2.44772 4 3V6.21639C4 6.44606 4.07906 6.66873 4.22389 6.84698L7.4904 10.8673C7.63523 11.0456 7.71429 11.2682 7.71429 11.4979V16.0963C7.71429 16.475 7.92829 16.8213 8.26707 16.9907L10.8385 18.2764C11.5034 18.6088 12.2857 18.1253 12.2857 17.382V11.4979C12.2857 11.2682 12.3648 11.0456 12.5096 10.8673L15.7761 6.84698C15.9209 6.66873 16 6.44606 16 6.21639V3C16 2.44772 15.5523 2 15 2Z"></path></svg>
                </button>
                <!-- Filter Button Start -->

                <!-- Length Start -->
                <div class="dropdown-as-select d-inline-block" data-childSelector="span">
                    <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
                        <span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-delay="0" title="Item Count">
                            {{ $pageItem }} Items
                        </span>
                    </button>
                    <div class="dropdown-menu shadow dropdown-menu-end">
                        <a class="dropdown-item item-page {{ $pageItem == 5 ? 'active' : '' }}" wire:click="updatePageItem(5)" href="#">5 Items</a>
                        <a class="dropdown-item item-page {{ $pageItem == 10 ? 'active' : '' }}" wire:click="updatePageItem(10)" href="#">10 Items</a>
                        <a class="dropdown-item item-page {{ $pageItem == 20 ? 'active' : '' }}" wire:click="updatePageItem(20)" href="#">20 Items</a>
                    </div>
                </div>
                <!-- Length End -->
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-5">
                <div class="card mb-2 bg-transparent no-shadow d-none d-lg-block">
                    <div class="row g-0 sh-3">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                                <div class="row g-0 h-100 align-content-center">
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">NAME</div>
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">COMPANY</div>
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">PHONE</div>
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">AREA</div>
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">CREATED DATE</div>
                                    <div class="col-lg-2 d-flex align-items-center text-muted text-small">STATUS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="checkboxTable">
                    @if(!$data->isEmpty())
                    @foreach($data as $lead)
                    <div class="card mb-2">
                        <div class="card-body pt-0 pb-0 sh-35 sh-lg-12">
                            <div class="row g-0 h-100 align-content-center">
                                <a href="{{ route('leads.details', ['id' => $lead->id]) }}" class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
                                    <div class="text-muted text-small d-lg-none">Name</div>
                                    <div class="text-alternate">{{ $lead->name }}</div>
                                    <div class="text-small text-muted text-truncate position">{{ $lead->email }}</div>
                                    <!-- <div class="d-block">
		                  <span class="badge bg-outline-primary group">New Lead</span>
		                </div> -->
                                </a>
                                <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-3">
                                    <div class="text-muted text-small d-lg-none">COMPANY</div>
                                    <div class="text-alternate">{{ $lead->company_name }}</div>
                                </div>
                                <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-4">
                                    <div class="text-muted text-small d-lg-none">Phone</div>
                                    <div class="text-alternate">
                                        {{ $lead->phone }}
                                    </div>
                                </div>
                                <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
                                    <div class="text-muted text-small d-lg-none">AREA</div>
                                    <div class="text-alternate">
                                        {{ $lead->location }}
                                    </div>
                                </div>
                                <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
                                    <div class="text-muted text-small d-lg-none">Create Date</div>
                                    <div class="text-alternate">
                                        {{ $lead->created_at->format('d M, Y') }}
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-5">
                                    <div class="text-muted text-small d-lg-none mb-1">Status</div>
                                    <div>
                                        <input type="hidden" id="lead_id" value="{{ $lead->id }}">
                                        <select class="form-select form-select-sm Status">
                                            <option value="{{ \App\Models\admin\Leads::HOT_LEAD }}" {{ $lead->status == 1 ? 'selected' : '' }}>Hot Lead</option>
                                            <option value="{{ \App\Models\admin\Leads::NOT_GOOD_LEAD }}" {{ $lead->status == 2 ? 'selected' : '' }}>Not Good Lead</option>
                                            <option value="{{ \App\Models\admin\Leads::LOST_LEAD }}" {{ $lead->status == 3 ? 'selected' : '' }}>Lost Lead</option>
                                            <option value="{{ \App\Models\admin\Leads::NEW_LEAD }}" {{ $lead->status == 4 ? 'selected' : '' }}>New Lead</option>
                                            <option value="{{ \App\Models\admin\Leads::FOLLOW_UP }}" {{ $lead->status == 5 ? 'selected' : '' }}>Follow Up</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-center mb-0 mt-5 pt-5">{{ _('Data Not Found!')}}</p>
                    @endif

                </div>

            </div>
        </div>
        <!-- Customers List End -->
        @if(!$data->isEmpty())
        <!-- Pagination Start -->
        <div class="d-flex justify-content-center">
            {{ $data->links('layouts.admin.pagination') }}
        </div>
        @endif
    </div>
