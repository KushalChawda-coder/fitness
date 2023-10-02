@include('layouts.landingPages.header')
<div class="container">
  <div class="row">
    <div class="col-12 col-xxl-6">
      <div class="row">
        <div class="col-4">
          <h1 class="title text-center text-capitalize text-black fw-bold">
            <br> {{ $data->brand_name ?? 'Brand'}}
          </h1>
        </div>
        <div class="col-4">
          <h1 class="title text-center text-capitalize text-black fw-bold">
            <br> {{ $data->service_name ?? 'Services'}}
          </h1>
        </div>
        <div class="col-4">
          <h1 class="title text-center text-capitalize text-black fw-bold">
            <br> {{ $data->app_name ?? 'App'}}
          </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="bg-black p-3 text-center">
            <h2 class="text-white fw-bold">{{ $data->bar_text ?? 'Run your business better with your own Fitness Plan App'}}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="bg-white p-3 text-center">
            <h5>
              {{ $data->sub_text ?? ''}}
            </h5>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="bg-white p-3 text-center">
           <img src="{{ $data->banner_image ?? '' }}" alt="image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    @if(!isset($_GET['lead_id']))
      <div class="col-12 col-xxl-6">
        <form action="{{ route('generate_lead') }}" method="post" enctype="multipart/form-data">
          @csrf
          @if(in_array('name', $column_name))
          <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="name" class="form-control" required>
            @error('name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif
          @if(in_array('email', $column_name))
          <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}" class="form-control" required>
            @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
           @endif
          @if(in_array('phone', $column_name))
          <div class="form-group mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="phone" class="form-control" maxlength="12">
            @error('phone')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif
          @if(in_array('company_name', $column_name))
          <div class="form-group mb-3">
            <label>Company Name</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="company name" class="form-control">
            @error('company_name')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif
          @if(in_array('other', $column_name))
          <div class="form-group mb-3">
            <label>How did you here about us</label>
            <select id="here_about_us" name="here_about_us" class="form-control form-select form-select-lg" >
              <option value="">Select</option>
              <option value="google_search" {{ ( !empty(old('here_about_us')) && 'google_search' == old('here_about_us') ? 'selected' : '') }}>Google Search</option>
              <option value="instagram" {{ ( !empty(old('here_about_us')) && 'instagram' == old('here_about_us') ? 'selected' : '') }} >Instagram</option>
              <option value="facebook" {{ ( !empty(old('here_about_us')) && 'facebook' == old('here_about_us') ? 'selected' : '') }} >Facebook</option>
              <option value="word_of_mouth" {{ ( !empty(old('here_about_us')) && 'word_of_mouth' == old('here_about_us') ? 'selected' : '') }}>word of mouth</option>
              <option value="other" {{ ( !empty(old('here_about_us')) && 'other' == old('here_about_us') ? 'selected' : '') }}>Other</option>
            </select>
            @error('here_about_us')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          <div class="form-group mb-3 {{ $errors->has('here_about_description') ? '' : 'd-none' }}" id="other_description">
            <label>Here about us explain</label>
            <textarea class="form-control" name="here_about_description" id="here_about_description" rows="5"></textarea>
            @error('here_about_description')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>


          @if(in_array('current_website', $column_name))
          <div class="form-group mb-3">
            <label>Current Website</label>
            <input type="text" name="current_website" id="current_website" value="{{ old('current_website') }}" placeholder="current website" class="form-control" >
            @error('current_website')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          @if(in_array('instagram', $column_name))
          <div class="form-group mb-3">
            <label>Instagram</label>
            <input type="text" name="instagram_url" id="instagram_url" value="{{ old('instagram_url') }}" placeholder="instagram url" class="form-control" >
            @error('instagram_url')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          @if(in_array('facebook', $column_name))
          <div class="form-group mb-3">
            <label>Facebook</label>
            <input type="text" name="facebook_url" id="facebook_url" value="{{ old('facebook_url') }}" placeholder="facebook url" class="form-control" >
            @error('facebook_url')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          @if(in_array('other', $column_name))
          <div class="form-group mb-3">
            <label>Other Social Links</label>
            <input type="text" name="other_social_link" id="other_social_link" value="{{ old('other_social_link') }}" placeholder="Other Social Links" class="form-control" >
            @error('other_social_link')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          @if(in_array('provide_additional_info', $column_name))
          <div class="form-group mb-3">
            <label>{{ $data->lead_collection ?? 'Please provide any other additional information you would like us to konw:'}}</label>
            <textarea class="form-control" name="additional_info" value="{{ old('additional_info') }}" id="additional_info" rows="5" ></textarea>
            @error('additional_info')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          @endif

          <div class="form-group mb-3">
            <div class="g-recaptcha" data-callback="recaptcha_callback" data-expired-callback="recaptchaExpired" data-sitekey="{{ config('app.google_site_key') }}"></div>
            @error('g-recaptcha-response')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
            <label class="form-check-label" for="flexCheckDefault">
              By signing up, you agree to receive updates on product availability and more.
            </label>
          </div>
          <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    @else
      <!-- Right Side Start -->
        <div class="col-12 col-xxl-6">
            <div class="sw-lg-50 px-5">
               <div class="mb-5">
                <h2 class="cta-1 mb-0 text-dark">Verify Your Email</h2>
              </div>
              <div class="mb-5">
                <p class="h6">An email with a verification code has been sent to your email</p>
              </div>
              <div>
                <form action="{{ route('lead_email_verify') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $_GET['lead_id'] }}">
                  <input type="hidden" name="page_url" value="{{ url()->current() }}">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="shield"></i>
                    <input class="form-control" placeholder="Enter verfication code" name="verify_code" required/>
                  </div>
                   
                  <div class="mb-3 form-group">
                    <span class="text-dark">Didn't receive a code?</span> 
                    <a class="" href="javascript:;" id="request_again" data-lead-id="{{ $_GET['lead_id'] }}">Request again</a>
                  </div>
                  <button type="submit" class="btn btn-lg btn-dark">Verify Next</button>
                </form>
              </div>
            </div>
        </div>
        <!-- Right Side End -->
    @endif
  </div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@section('js')
<script src="{{ asset('assets/js/sweetalert.js?time='.time()) }}"></script>
<script type="text/javascript">
 var csrfToken = $('meta[name="csrf-token"]').attr('content');
 
  $("#here_about_us").change(function() {
      if ($(this).val() == 'other') {
        $('#other_description').removeClass('d-none');
      } else {
        $('#other_description').addClass('d-none');
      }
  });

  $("#request_again").click(function() {

        var id = $(this).attr('data-lead-id');
        $.ajax({
          type: 'post',
          url: '{{ route('request_email_again') }}',
          data: {id:id},
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
            Swal.fire("Error!", error, "error");
            console.error(error);
          }
        });

  });

  $('#phone').on("keyup", function() {
      var inputValue = $(this).val().replace(/\D/g, "");
      var formattedValue = inputValue.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
      if (inputValue.length > 3 && inputValue.length <= 6) {
          formattedValue = inputValue.replace(/(\d{3})(\d{1,3})/, "$1-$2");
      } else if (inputValue.length > 6) {
          formattedValue = inputValue.replace(/(\d{3})(\d{3})(\d+)$/, "$1-$2-$3");
      }

      $(this).val(formattedValue);
  });

</script>
@endsection
@include('layouts.landingPages.footer')