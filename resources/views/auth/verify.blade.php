@extends('layouts.app')
@section('content')
<!-- Background Start -->
<div class="fixed-background"></div>
<!-- Background End -->

<div class="container-fluid p-0 h-100 position-relative">
  <div class="row g-0 h-100">
    <!-- Left Side Start -->
    <div class="offset-0 col-12 d-none d-lg-flex offset-md-1 col-lg h-lg-100">
      <div class="min-h-100 d-flex align-items-center">
        <div class="w-100 w-lg-75 w-xxl-50">
         
        </div>
      </div>
    </div>
    <!-- Left Side End -->
    <!-- Right Side Start -->
    <div class="col-12 col-lg-auto h-100 pb-4 px-4 pt-0 p-lg-0">
      <div class="sw-lg-70 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
          <div class="sh-11">
            <a href="index.html">
              <img src="{{ asset('assets/plan-img/logo.svg') }}" alt="logo" class="img-fluid">
            </a>
          </div>
          <div class="mb-5">
            <h2 class="cta-1 mb-0 text-dark">Verify Your Email</h2>
          </div>
          <div class="mb-5">
            <p class="h6">An email with a verification code has been sent to your email</p>
          </div>
          <div>
            <form action="{{ route('register-verify-email') }}" method="post" id="form-validation"  class="tooltip-end-bottom">
              @csrf
              <input type="hidden" name="email" value="{{ $email }}">
              <div class="mb-3 filled form-group tooltip-end-top">
                <i data-acorn-icon="shield"></i>
                <input type="number" class="form-control" minlength="6" maxlength="6" placeholder="Enter verfication code" name="verfication_code" required/>
                @error('verfication_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
               
              <div class="mb-3 form-group">
                <span class="text-dark">Didn't receive a code?</span> 
                <a class="" href="javascript:;" id="request_again" data-user-email="{{ $email }}">Request again</a>
              </div>
              <button type="submit" class="btn btn-lg btn-dark">Verify Next</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Right Side End -->
  </div>
</div>
@endsection
