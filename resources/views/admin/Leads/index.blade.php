@extends('layouts.admin.app')
@section('css')
<style>
    .tags-row {
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

                <a role="button" href="#" data-bs-toggle="modal" data-bs-target="#uploadFromFile" class="btn btn-sm btn-outline-primary btn-icon btn-icon-start ms-1">
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
                <a role="button" href="{{ route('leads.add') }}" class="btn btn-sm btn-outline-primary btn-icon btn-icon-start ms-1">
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

</div>

<!-- Controls End -->

<!-- Customers List Start -->

<livewire:livewire-leads />
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
    $(document).ready(function() {
        

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

  	
  		 function updateStatus(){
            //await asyncFunction();
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
        updateStatus();	
   
        var today = new Date();
        $('#this_year').click(function() {
            var startOfYear = new Date(today.getFullYear(), 0, 1);
            var endOfYear = new Date(today.getFullYear(), 11, 31);
            var formattedStartDate = startOfYear.toLocaleDateString('en-US', {
                month: '2-digit'
                , day: '2-digit'
                , year: 'numeric'
            });
            var formattedEndDate = endOfYear.toLocaleDateString('en-US', {
                month: '2-digit'
                , day: '2-digit'
                , year: 'numeric'
            });
            $('#start-date').val(formattedStartDate);
            $('#end-date').val(formattedEndDate);
        });

        $('#this_week').click(function() {
            var currentDay = today.getDay();
            var startDate = new Date(today);
            startDate.setDate(today.getDate() - currentDay);
            var endDate = new Date(today);
            endDate.setDate(today.getDate() + (6 - currentDay));
            var StartWeekDate = ('0' + (startDate.getMonth() + 1)).slice(-2) + '/' +
                ('0' + startDate.getDate()).slice(-2) + '/' +
                startDate.getFullYear();
            var EndWeekDate = ('0' + (endDate.getMonth() + 1)).slice(-2) + '/' +
                ('0' + endDate.getDate()).slice(-2) + '/' +
                endDate.getFullYear();
            $('#start-date').val(StartWeekDate);
            $('#end-date').val(EndWeekDate);
        });

        $('#this_month').click(function() {
            var startDate = new Date(today.getFullYear(), today.getMonth(), 1);
            var endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            var startMonth = ("0" + (startDate.getMonth() + 1)).slice(-2) + "/" + ("0" + startDate.getDate()).slice(-2) + "/" + startDate.getFullYear();
            var endMonth = ("0" + (endDate.getMonth() + 1)).slice(-2) + "/" + ("0" + endDate.getDate()).slice(-2) + "/" + endDate.getFullYear();
            $('#start-date').val(startMonth);
            $('#end-date').val(endMonth);
        });

        $('#clear_filter').click(function() {
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
