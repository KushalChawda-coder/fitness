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
              <i data-acorn-icon="check-circle" data-acorn-size="28" class="text-success"></i>
            </div>
            <div class="mb-5">
              <h2 class="cta-1 mb-0 text-success"> Your Email has been successfully verified</h2>
            </div>
            <!-- <div class="mb-5">
              <p class="h6">An email with a verification code has been sent to your email</p>
            </div> -->
            <div>
              <form id="loginForm" class="tooltip-end-bottom" novalidate>
                <a href="{{ route('login') }}" role="submit" class="btn btn-lg btn-dark">Continue & Pay</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Right Side End -->
    </div>
</div>
@endsection