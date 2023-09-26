@extends('layouts.admin.app')
@section('content')
<div class="container">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container">
      <div class="row">
        <!-- Title Start -->
        <div class="col-auto mb-3 mb-md-0 me-auto">
          <div class="w-auto">
            <a href="{{ route('manageExercises.index') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
              <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
              <span class="text-small align-middle">Exercises List</span>
            </a>
            <h1 class="mb-0 pb-0 display-4" id="title">Manage Exercises Logs</h1>
          </div>
        </div>
        <!-- Title End -->
      </div>
    </div>
    <!-- Title and Top Buttons End -->

    <!-- Error Alert Start -->
    @if ($successLogsCount > 0 || !$errorLogs->isEmpty() || $deleteLogsCount > 0)
    @if($successLogsCount > 0)
    <div class="alert alert-success" role="alert">{{ $successLogsCount }} Exercise loaded correctly</div>
    @endif
    @if($deleteLogsCount > 0)
    <div class="alert alert-warning" role="alert">{{ $deleteLogsCount }} Exercise deleted successfully</div>
    @endif
    @foreach ($errorLogs as $log)
    <div class="alert alert-danger" role="alert">
      <div class="error-list">
        Row - <b>{{ !empty($log->row) ? $log->row : "null" }}</b> 
        ID - <b>{{ !empty($log->exercise_id) ? $log->exercise_id : "null" }}</b>
        Exercise Type - <b>{{ !empty($log->exercise_type) ? $log->exercise_type : "null" }}</b>
        Category - <b>{{ !empty($log->category) ? $log->category : "null" }}</b>
        Equipment - <b>{{ !empty($log->equipments) ? $log->equipments : "null" }}</b>
        Log - <b>{{ !empty($log->response_reason) ? $log->response_reason : "null" }}</b>
      </div>
    </div>  
    @endforeach
    @else
    <p class="text-center mb-0 mt-5 pt-5">{{ _('Logs Not Found!')}}</p>
    @endif
    <!-- Error Alert End -->

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

 </body>
</html>
@endsection