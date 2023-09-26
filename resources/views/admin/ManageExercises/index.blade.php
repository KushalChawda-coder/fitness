@extends('layouts.admin.app')
@section('content')
<div class="container">
  <!-- Title and Top Buttons Start -->
  <div class="page-title-container">
    <div class="row">
      <!-- Title Start -->
      <div class="col-auto mb-3 mb-md-0 me-auto">
        <div class="w-auto sw-md-30">
          <a href="Dashboard.html" class="muted-link pb-1 d-inline-block breadcrumb-back">
            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
            <span class="text-small align-middle">Dashboard</span>
          </a>
          <h1 class="mb-0 pb-0 display-4" id="title">Exercises List</h1>
        </div>
      </div>
      <!-- Title End -->

      <!-- Top Buttons Start -->
      <div class="col-3 d-flex align-items-end justify-content-end">
        <a href="{{ route('manageExercises.add') }}" role="button" class="btn btn-sm btn-icon btn-outline-primary">
          <i data-acorn-icon="plus" data-acorn-size="13"></i>
          New Exercises
        </a>
      </div>
      <!-- Top Buttons End -->
    </div>
  </div>
  <!-- Title and Top Buttons End -->
  <!-- Controls Start -->
  <div class="row mb-2">
    <!-- Search Start -->
    <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
      <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
        <input type="search" class="form-control" placeholder="Search" id="Search" />
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

        <a href="#" role="button" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="modal" data-bs-target="#DownloadExcelFile">
          <i data-acorn-icon="download" data-acorn-size="13"></i>
          Download Excel File
        </a>

        <a href="{{ route('manageExercises.logs') }}" role="button" class="btn btn-sm btn-icon btn-dark">
          <i data-acorn-icon="eye" data-acorn-size="13"></i>
          See Logs
        </a>
        <!-- Upload From File Button Start -->
        <a href="#" role="button" class="btn btn-sm btn-icon btn-dark" data-bs-toggle="modal"
          data-bs-target="#uploadFromFile">
          <i data-acorn-icon="upload" data-acorn-size="13"></i>
          Upload From File
        </a>
        <!-- Upload From File Button End -->
      </div>
    </div>
  </div>
  <!-- Controls End -->


  @if(!$data->isEmpty())
  <!-- Pages List Start -->
  <div class="row">
    <div class="col-12 mb-5">
      <div class="card mb-2 bg-transparent no-shadow d-none d-md-block">
        <div class="card-body pt-0 pb-0 sh-3">
          <div class="row g-0 h-100 align-content-center">
            <div class="col-md-2 d-flex align-items-center text-muted text-small">ID</div>
            <div class="col-md-4 d-flex align-items-center text-muted text-small">NAME</div>
            <div class="col-md-4 d-flex align-items-center text-muted text-small">STATUS</div>
            <div class="col-md-2 d-flex align-items-center text-muted text-small">ACTION</div>
          </div>
        </div>
      </div>
      <div id="manageExerciseTable">
        @foreach($data as $exercise)
        <div class="card mb-2">
          <div class="card-body pt-md-0 pb-md-0 sh-md-8">
            <div class="row g-0 h-100 align-content-center">
              <div class="col-4 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 h-lg-100 position-relative">
                <div class="text-muted text-small d-lg-none">Id</div>
                <a href="{{ route('manageExercises.edit',['id' => $exercise->id]) }}"
                  class="text-truncate h-100 d-flex align-items-center">{{ $exercise->id }}</a>
              </div>
              <div class="col-8 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Name</div>
                <div class="text-alternate">
                  <a href="{{ route('manageExercises.edit',['id' => $exercise->id]) }}">{{ ucfirst($exercise->exercise_name) }}</a>
                </div>
              </div>
              <div class="col-4 col-md-4 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Status</div>
                <div class="text-alternate">
                  <span class="badge rounded-pill bg-outline-primary">{{ $exercise->status ? 'PUBLISH' : 'DRAFT' }}</span>
                </div>
              </div>
              <div class="col-8 col-md-2 d-flex flex-column justify-content-center mb-2 mb-md-0">
                <div class="text-muted text-small d-md-none">Action</div>
                <div class="text-alternate">
                  <!-- Dropdown Button Start -->
                  <div class="ms-1">
                    <button type="button" class="btn btn-sm btn-icon btn-icon-only btn-light" data-bs-offset="0,3"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-submenu>
                      <i data-acorn-icon="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="{{ route('manageExercises.delete',['id' => $exercise->id]) }}" class="dropdown-item">Delete</a>
                    </div>
                  </div>
                  <!-- Dropdown Button End -->
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @else
          <p class="text-center mb-0 mt-5 pt-5">{{ _('Pages Not Found!')}}</p>
        @endif
      </div>
    </div>
  </div>
  <!-- Pages List End -->

  <!-- Pagination Start -->
    @if(!$data->isEmpty())
      <div class="d-flex justify-content-center">
        @include('layouts.admin.pagination')        
      </div>
     @endif
  <!-- Pagination End -->
</div>

<div class="modal fade" id="DownloadExcelFile" tabindex="-1" aria-labelledby="DownloadExcelFileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="export-excel" action="{{ route('manageExercises.export-excel') }}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadExcelFileLabel">Download File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="action_data_export" id="exercise_details_export" value="exercise_details" checked>
                <label class="form-check-label" for="exercise_details_export">
                  Exercise Details
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="action_data_export" id="benifits_directions_export" value="benifits_directions">
                <label class="form-check-label" for="benifits_directions_export">
                  Exercise Benifits and Directions
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="action_data_export" id="meta_export" value="meta">
                <label class="form-check-label" for="meta_export">
                  SEOInformation
                </label>
              </div>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="exportFileBtn" class="btn btn-dark" data-bs-dismiss="modal">Export File</button>
        </div>
      </div>
   </form>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadFromFile" tabindex="-1" aria-labelledby="uploadFromFileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadFromFileLabel">Upload From File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="action_btn" id="create" value="create" checked="">
            <label class="form-check-label" for="create">Create</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="action_btn" id="update" value="update">
            <label class="form-check-label" for="update">Update</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="action_btn" id="delete" value="delete">
            <label class="form-check-label" for="delete">Delete</label>
          </div>
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="action_data" id="exercise_details" value="exercise_details" checked>
            <label class="form-check-label" for="exercise_details">
              Exercise Details
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="action_data" id="benifits_directions" value="benifits_directions">
            <label class="form-check-label" for="benifits_directions">
              Exercise Benifits and Directions
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="action_data" id="meta" value="meta">
            <label class="form-check-label" for="meta">
              SEOInformation
            </label>
          </div>
        </div>
        <form id="upload-excel" action="{{ route('manageExercises.import-excel') }}" method="post" enctype="multipart/form-data">
         @csrf
         <input type="file" id="fileInput" value="" name="excel_file" style="display:none;">
         <input type="hidden" name="action_input" value="" id="action_input">
         <input type="hidden" name="action_data_input" value="" id="action_data_input">
         <input type="submit" style="display:none;">
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" id="openFileBtn" class="btn btn-dark" data-bs-dismiss="modal">Choose File</button>
      </div>
    </div>
  </div>
</div>
<!-- END Modal -->
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

  <!-- Template Base Scripts Start -->
  <script src="{{ asset('assets/admin/js/base/helpers.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/globals.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/nav.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/search.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/base/settings.js?time='.time()) }}"></script>
  <!-- Template Base Scripts End -->
  <!-- Page Specific Scripts Start -->
  <script src="{{ asset('assets/admin/js/cs/checkall.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/pages/orders.list.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
  <script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
  <!-- Page Specific Scripts End -->
  <script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
  <script>
    $(document).ready(function(){

      var csrfToken = $('meta[name="csrf-token"]').attr('content');
      

      $('#Search').on('input',function() {
        var search_text = $(this).val();
        $.ajax({
          type: 'post',
          url: '{{ route('manageExercises.search') }}',
          data: {search_text:search_text},
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          success: function(response) {
            console.log(response);
            if(response.status == true){
              $('#manageExerciseTable').html(response.table);
              if (response.pagination) {
                $('#pagination').html(response.pagination);
              }
              refresh_pagination()
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
        var url = "{{ url(route('manageExercises.get-page')) }}";
        var search_text = $('#Search').val();
        $('.page').click(function(e){
          e.preventDefault();
          page_index = parseInt($(this).attr('index'));
          url = url + '?page=' + page_index;
          refresh_table(search_text, url)
        });

        $('#prev_page').click(function(e){
          e.preventDefault();
          var page_index = parseInt($(this).attr('index'));
          url = url + '?page=' + page_index;
          $(this).attr('index',page_index-1);
          $('.active-item').eq(page_index).addClass('active');
          refresh_table(search_text, url)
        });

        $('#next_page').click(function(e){
          e.preventDefault();
          var page_index = parseInt($(this).attr('index'));
          url = url + '?page=' + page_index;
          $(this).attr('index',page_index+1);
          refresh_table(search_text, url)
        });
      }

      function refresh_table(search_text, url){
        $.ajax({
          type: 'get',
          url: url,
          data: {search_text:search_text},
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          success: function(response) {
            if(response.status == true){
              $('#manageExerciseTable').html(response.html);
              $('#pagination').html(response.pagination);
              refresh_pagination();
            } else {
              Swal.fire("Error!", response.message, "error");
            }
          },
          error: function(error) {
            console.error(error);
          }
        });
      }

      $('#openFileBtn').on('click', function() {
        $('#fileInput').click(); 
      });

      $('#fileInput').on('change', function() {
        $("#action_input").val($('input[name="action_btn"]:checked').val());
        $("#action_data_input").val($('input[name="action_data"]:checked').val());
        $("#upload-excel").submit();
      });

      $('#exportFileBtn').on('click', function() {
        $('#export-excel').submit(); 
      });

     

        

    var toastElement = $('.toast')[0];
    var toast = new bootstrap.Toast(toastElement);
    toast.show();
      
    });
  </script>
 </body>
</html>
@endsection