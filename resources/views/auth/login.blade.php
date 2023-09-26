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
                  <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/plan-img/logo.svg') }}" alt="logo" class="img-fluid">
                  </a>
                </div>
                <div class="mb-5">
                  <h2 class="cta-1 mb-0 text-dark">Welcome Back!</h2>
                  <!-- <h2 class="cta-1 text-primary">let's get started!</h2> -->
                </div>
                <div class="mb-5">
                  <p class="h6">Please use your credentials to login.</p>
                  <!-- <p class="h6">
                    If you are not a member, please
                    <a href="register.html">register</a>
                    .
                  </p> -->
                </div>
                <div>

                  <form id="loginForm" class="tooltip-end-bottom" method="POST" action="{{ route('login') }}" novalidate>
                     @csrf
                    <div class="mb-3 filled form-group tooltip-end-top">
                      <i data-acorn-icon="email"></i>
                      <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="mb-3 filled form-group tooltip-end-top">
                      <i data-acorn-icon="lock-off"></i>
                      <input id="password" type="password" class="form-control pe-7 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      @if (Route::has('password.request'))
                          <a class="text-small position-absolute t-3 e-3" href="{{ route('password.request') }}">
                              {{ __('Forgot?') }}
                          </a>
                      @endif
 
                    </div>
                    <button type="submit" class="btn btn-lg btn-dark">
                        {{ __('Login') }}
                    </button>
                  </form>

                </div>
              </div>
            </div>
          </div>
          <!-- Right Side End -->
        </div>
      </div>
@endsection
