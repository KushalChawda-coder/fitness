@extends('layouts.admin.app')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/tagify.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/dropzone.min.css?time='.time()) }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendor/plyr.css?time='.time()) }}">
@endsection
@section('content')
	@if($landing_type == \App\Models\admin\LandingPage::LEAD_CAPTURE)
		@include('admin.LandingPages.lead_capture')
	@else
		@include('admin.LandingPages.share_digital_files')
	@endif
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
<script src="{{ asset('assets/admin/js/forms/controls.tag.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/pages/products.detail.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/plugins/players.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/common.js?time='.time()) }}"></script>
<script src="{{ asset('assets/admin/js/scripts.js?time='.time()) }}"></script>
<script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
<!-- Page Specific Scripts End -->
<script type="text/javascript">
$(document).ready(function(){
	var csrfToken = $('meta[name="csrf-token"]').attr('content');

	$('#landingUrl').keyup(function(){
		var url = $(this).val();
		var base_url = "<?php echo url('/'); ?>";
		var live_url = base_url+'/'+url;
		$.ajax({
			type: 'post',
			url: '{{ route('landing_pages.check-domain') }}',
			data: { url:url},
			headers: {
				'X-CSRF-TOKEN': csrfToken
			},
			success: function(response) {
				if(response.status == true){
					$('#UrlErr').text('').hide();
					$('#live_url').text(live_url);
					$('#domain_name').val(url);
				} else {
					$('#UrlErr').text(response.error).show();
					$('#live_url').text(base_url);
					$('#domain_name').val('');
				}
			},
			error: function(error) {
				console.error(error);
			}
		});
	});
	
	$("#copyBtn").click(function() {
		var value = $("#landingUrl").val();
		var tempInput = $("<input>");
		$("body").append(tempInput);
		tempInput.val(value).select();
		document.execCommand("copy");
		tempInput.remove();
	});


	$("#flexSwitchCheckDraft").click(function() {
		var isChecked = $(this).prop("checked");
		if (isChecked) {
            $("#page_status").val(1);
        } else {
            $("#page_status").val(0);
        }	
	});


	// Digital File(s) multi selector js

	if (document.querySelector('#digitalBodyPart')) {
	  var randomStringsArr = [];

	  // Make sure the AJAX call is within a function and is executed when needed
	  function fetchData() {
	    $.ajax({
	      type: 'get',
	      url: '{{ route('landing_pages.digital_file') }}',
	      success: function(response) {
	        if (response.status == true) {
	          console.log('data', response.data);
	          $.each(response.data, function(index, value) {
	            randomStringsArr.push(value);
	          });
	          initializeTagify();
	        } else {
	          console.log('no');
	        }
	      },
	      error: function(error) {
	        console.error(error);
	      }
	    });
	  }

	  // Call the function to fetch data
	  fetchData();

	  function initializeTagify() {
	    var input = document.querySelector('#digitalBodyPart');
	    var tagifyBodyPart = new Tagify(input, {
	      whitelist: randomStringsArr,
	      callbacks: {
	        invalid: onInvalidTag,
	      },
	      dropdown: {
	        position: 'text',
	        enabled: 1,
	      },
	    });

	    var button = input.nextElementSibling; // "add new tag" action-button
	    button.addEventListener('click', onAddButtonClick);

	    function onAddButtonClick() {
	      tagifyBodyPart.addEmptyTag();
	    }

	    function onInvalidTag(e) {
	      // Handle invalid tags here
	    }
	  }
	}

    // $(document).ready(function() {
    //     $('#js-basic-multiple').select2();
    // });

	var toastElement = $('.toast')[0];
	var toast = new bootstrap.Toast(toastElement);
	toast.show();
});

</script>
</body>
</html>
@endsection