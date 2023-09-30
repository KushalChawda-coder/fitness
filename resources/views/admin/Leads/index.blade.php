@extends('layouts.admin.app')
@section('css')
<style>
  .tags-row{
    height: 85.5px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
  ::-webkit-scrollbar {
    width: 3px;
  }
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  ::-webkit-scrollbar-thumb {
    background: #888;
  }
  ::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
</style>
@endsection
@section('content')
	<div class="container">
	  <!-- Title and Top Buttons Start -->
	  <div class="page-title-container">
	    <div class="row">
	      <!-- Title Start -->
	      <div class="col-auto mb-3 mb-md-0 me-auto">
	        <div class="w-auto sw-md-30">
	          <a href="{{ route('dashboard.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
	            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
	            <span class="text-small align-middle">Dashboard</span>
	          </a>
	          <h1 class="mb-0 pb-0 display-4" id="title">Leads List</h1>
	        </div>
	      </div>
	      <!-- Title End -->

	      <!-- Top Buttons Start -->
	      <div class="col-6 d-flex align-items-end justify-content-end">
	        
	          <a role="button" href="#" data-bs-toggle="modal"
	          data-bs-target="#uploadFromFile"
	          class="btn btn-sm btn-outline-primary btn-icon btn-icon-start ms-1">
	          <i data-acorn-icon="plus"></i>
	          <span>Load</span>
	        </a>
	        <!-- <div class="dropdown d-inline-block">
	          <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	            Load
	          </button>
	          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	            <li><a class="dropdown-item" href="#">Lead Detail</a></li>
	            <li><a class="dropdown-item" href="#">Create Website</a></li>
	            <li><hr class="dropdown-divider"></li>
	            <li><a class="dropdown-item" href="#">Next Get File</a></li>
	          </ul>
	        </div> -->
	        <a role="button" href="{{ route('leads.add') }}"
	          class="btn btn-sm btn-outline-primary btn-icon btn-icon-start ms-1">
	          <i data-acorn-icon="plus"></i>
	          <span>Add Lead</span>
	        </a>
	      </div>
	      <!-- Top Buttons End -->
	    </div>
	  </div>
	  <!-- Title and Top Buttons End -->

   <!-- Title and Top Buttons End -->
		@if(session('import_errors'))
    <div class="row">
      <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
         	<table class="table-danger table-responsive table-sm" style="margin: 2px !important;">
						<tbody>
					  	@foreach (session('import_errors') as $failure)
					    <tr>
					      <th scope="row">{{ $failure[1] }}</th>
					      <td>{{ $failure[2][$failure[1]] }}</td>
					      <td>{{ $failure[0][0] }}</td>
					    </tr>
					    @endforeach
						</tbody>
					</table>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
    </div>
    @endif
      <!-- Stats Start -->

	  <!-- Controls Start -->
	  <div class="row mb-2">
	    <!-- Search Start -->
	    <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
	      <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
	        <input type="search" class="form-control" id="Search_leads" placeholder="Search" />
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
	        <!-- Filter Button Start -->
	        <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow" type="button"
	          data-bs-toggle="modal" data-bs-target="#leadFilter">
	          <i data-acorn-icon="filter"></i>
	        </button>
	        <!-- Filter Button Start -->

	        <!-- Length Start -->
	        <div class="dropdown-as-select d-inline-block" data-childSelector="span">
	          <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
	            aria-expanded="false" data-bs-offset="0,3">
	            <span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip"
	              data-bs-placement="top" data-bs-delay="0" title="Item Count">
	              10 Items
	            </span>
	          </button>
	          <div class="dropdown-menu shadow dropdown-menu-end">
	            <a class="dropdown-item item-page" index="5"  href="#">5 Items</a>
	            <a class="dropdown-item item-page active" index="10" href="#">10 Items</a>
	            <a class="dropdown-item item-page" index="20" href="#">20 Items</a>
	          </div>
	        </div>
	        <!-- Length End -->
	      </div>
	    </div>
	  </div>
	 
	  <!-- Controls End -->

	  <!-- Customers List Start -->
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
		              <a href="{{ route('leads.details', ['id' => $lead->id]) }}"
		                class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
		                <div class="text-muted text-small d-lg-none">Name</div>
		                <div class="text-alternate">{{ $lead->name }}</div>
		                <div class="text-small text-muted text-truncate position">{{ $lead->email }}</div>
		                <!-- <div class="d-block">
		                  <span class="badge bg-outline-primary group">New Lead</span>
		                </div> -->
		              </a>
		              <div
		                class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-3">
		                <div class="text-muted text-small d-lg-none">COMPANY</div>
		                <div class="text-alternate">{{ $lead->company_name }}</div>
		              </div>
		              <div
		                class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-4">
		                <div class="text-muted text-small d-lg-none">Phone</div>
		                <div class="text-alternate">
		                  {{ $lead->phone }}
		                </div>
		              </div>
		              <div
		                class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
		                <div class="text-muted text-small d-lg-none">AREA</div>
		                <div class="text-alternate">
		                  {{ $lead->location }}
		                </div>
		              </div>
		              <div
		                class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
		                <div class="text-muted text-small d-lg-none">Create Date</div>
		                <div class="text-alternate">
		                   {{ $lead->created_at->format('d M, Y') }}
		                </div>
		              </div>
		              <div
		                class="col-12 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-5">
		                <div class="text-muted text-small d-lg-none mb-1">Status</div>
		                <div>
		                	<input type="hidden" id="lead_id" value="{{ $lead->id }}">
		                  <select class="form-select form-select-sm Status">
		                    <option value="{{ \App\Models\admin\Leads::HOT_LEAD }}"  {{ $lead->status == 1 ? 'selected' : '' }}>Hot Lead</option>
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
				@include('layouts.admin.pagination')	    	
		  </div>
	  @endif
	  <!-- Pagination End -->
	</div>
	@include('admin.Leads.lead_filter')
	@include('admin.Leads.upload_file')
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
  <script src="{{ asset('assets/admin/js/vendor/datepicker/bootstrap-datepicker.min.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker/locales/bootstrap-datepicker.es.min.js?time='.time()) }}"></script>
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
  <script src="{{ asset('assets/admin/js/forms/controls.datepicker.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/pages/products.detail.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/plugins/players.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
  <script>
  	$(document).ready(function(){

  		var csrfToken = $('meta[name="csrf-token"]').attr('content');

  		$('#Search_leads').on('input',function() {
  			var Search_text = $(this).val();
  			var page_item_count;
  			$(".item-page").each(function(index) {
  				if($(this).hasClass('active')){
  					page_item_count = $(this).attr('index');
  				}
  			});
  			$.ajax({
  				type: 'post',
  				url: '{{ route('leads.search') }}',
  				data: {Search_text:Search_text,page_item_count},
  				headers: {
  					'X-CSRF-TOKEN': csrfToken
  				},
  				success: function(response) {
  					if(response.status == true){
  						$('#checkboxTable').html(response.lead_html);
  						if (response.pagination_html) {
  							$('#pagination').html(response.pagination_html);
  						}
  						refresh_pagination();
  						updateStatus();
  					} else {
  						Swal.fire("Error!", response.message, "error");
  					}
  				},
  				error: function(error) {
  					console.error(error);
  				}
  			});
  		});

  		function refresh_pagination(){
  			page_item_count = $('.item-page active .active').attr('index');

  				$(".item-page").each(function(index) {
  					if($(this).hasClass('active')){
  						page_item_count = $(this).attr('index');
  					}
  				});

  			var Search_text =	$('#Search_leads').val();
  			var url = "{{ url(route('leads.page')) }}";

  			$('.page').click(function(e){
  				e.preventDefault();
  				var page_index =	parseInt($(this).attr('index'));
  				url = url + '?page=' + page_index;
  				refresh_table(Search_text,page_item_count,url)
  			});

  			$('#prev_page').click(function(e){
  				e.preventDefault();
  				var page_index = parseInt($(this).attr('index'));
  				url = url + '?page=' + page_index;
  				$(this).attr('index',page_index-1);
  				$('.active-item').eq(page_index).addClass('active');
  				refresh_table(Search_text,page_item_count,url)
  			});

  			$('#next_page').click(function(e){
  				e.preventDefault();
  				var page_index = parseInt($(this).attr('index'));
  				url = url + '?page=' + page_index;
  				$(this).attr('index',page_index+1);
  				refresh_table(Search_text,page_item_count,url)
  			});

  		}

  		$('.item-page').click(function(){
  			var page_item_count = parseInt($(this).attr('index'));
  			var Search_text =	$('#Search_leads').val();
  			var page_index;
  			$(".active-item").each(function(index) {
  				if($(this).hasClass('active')){
  					page_index = $(this).children('.page-link').text();
  				}
  			});
  			var url = "{{ url(route('leads.page')) }}";
  			refresh_table(Search_text,page_item_count,url)
  		});

  		function refresh_table(Search_text,page_item_count,url){
  			$.ajax({
  				type: 'get',
  				url: url,
  				data: {Search_text:Search_text,page_item_count},
  				headers: {
  					'X-CSRF-TOKEN': csrfToken
  				},
  				success: function(response) {
  					if(response.status == true){
  						$('#checkboxTable').html(response.lead_html);
  						$('#pagination').html(response.pagination_html);
  						refresh_pagination();
  						updateStatus();
  					} else {
  						Swal.fire("Error!", response.message, "error");
  					}
  				},
  				error: function(error) {
  					console.error(error);
  				}
  			});
  		}

  		updateStatus();
  		function updateStatus(){
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
  		}


  		var today = new Date();
  		$('#this_year').click(function(){
  			var startOfYear = new Date(today.getFullYear(), 0, 1);
  			var endOfYear = new Date(today.getFullYear(), 11, 31);
  			var formattedStartDate = startOfYear.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric' });
  			var formattedEndDate = endOfYear.toLocaleDateString('en-US', { month: '2-digit', day: '2-digit', year: 'numeric' });
  			$('#start-date').val(formattedStartDate);
  			$('#end-date').val(formattedEndDate);
  		});

  		$('#this_week').click(function(){
  			var currentDay = today.getDay();
  			var startDate = new Date(today);
  			startDate.setDate(today.getDate() - currentDay);
  			var endDate = new Date(today);
  			endDate.setDate(today.getDate() + (6 - currentDay));
  			var StartWeekDate = ('0' + (startDate.getMonth() + 1)).slice(-2) + '/' +
  			('0' + startDate.getDate()).slice(-2) + '/' +
  			startDate.getFullYear();
  			var EndWeekDate =  ('0' + (endDate.getMonth() + 1)).slice(-2) + '/' +
  			('0' + endDate.getDate()).slice(-2) + '/' +
  			endDate.getFullYear();
  			$('#start-date').val(StartWeekDate);
  			$('#end-date').val(EndWeekDate);
  		});

  		$('#this_month').click(function(){
  			var startDate = new Date(today.getFullYear(), today.getMonth(), 1);
  			var endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
  			var startMonth = ("0" + (startDate.getMonth() + 1)).slice(-2) + "/" + ("0" + startDate.getDate()).slice(-2) + "/" + startDate.getFullYear();
  			var endMonth = ("0" + (endDate.getMonth() + 1)).slice(-2) + "/" + ("0" + endDate.getDate()).slice(-2) + "/" + endDate.getFullYear();
  			$('#start-date').val(startMonth);
  			$('#end-date').val(endMonth);
  		});

	  	$('#clear_filter').click(function(){
  		  $("input[type='text']").val("");
		    $("input[type='checkbox']").prop("checked", false);
		    $("#area").prop("selectedIndex", 0);
			 });

			$('#openFileBtn').on('click', function() {
        $('#fileInput').click(); 
    	});

  		$('#fileInput').on('change', function() {
  		 		$("#upload-excel").submit();
	    });

  		var toastElement = $('.toast')[0];
  		var toast = new bootstrap.Toast(toastElement);
  		toast.show();
  		
  	});
  </script>
</body>
</html>
@endsection