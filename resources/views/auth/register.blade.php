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
      <div
        class="sw-lg-75 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-70 px-5">
          <div class="sh-4">
            <a href="index.html">
              <img src="{{ asset('assets/plan-img/logo.svg') }}" alt="logo" class="img-fluid">
            </a>
          </div>
          <div class="sh-6">
            <label class="form-label fw-bold text-black">Continue signing up with your selected plan below</label>
          </div>
          <div>
            <form method="POST" id="form-validation" action="{{ route('register') }}">
              @csrf
              <div class="mb-5">
                <div class="row">
                  <div class="col-12 col-sm-12">
                    <div class="mb-3 form-group">
                      <h5 class="fw-bold text-black">$25/mo</h5>
                      <select class="form-select form-select-lg">
                        @foreach($packages as $i => $package)
                            <option value="0" price="{{ $package->Price }}" {{ ($i == 0) ? 'selected' : ''}} >
                              {{ ($i == 0) ? 'free' : 'Up to '.$package->UpToClients.' Client and '.$package->Storage.' GB Storage'}}
                            </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="user"></i>
                    <input class="form-control @error('name') is-invalid @enderror" placeholder="First Name" id="name" name="name" value="{{ old('name') }}" required autofocus/>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="user"></i>
                    <input class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" id="last_name" name="last_name" value="{{ old('last_name') }}" required/>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="email"></i>
                    <input class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="phone"></i>
                    <input class="form-control @error('phone') is-invalid @enderror" minlength="12" maxlength="12" id="phone" placeholder="Phone" name="phone" value="{{ old('phone') }}" required/>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input class="form-control @error('password') is-invalid @enderror" minlength="6" name="password" id="password" type="password" placeholder="Password" required/>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="mb-3 filled form-group tooltip-end-top">
                    <i data-acorn-icon="lock-off"></i>
                    <input class="form-control" name="password_confirmation" id="password-confirm" minlength="6" type="password" placeholder="Confirm Password" required autocomplete="new-password"/>
                  </div>
                </div>
              </div>
             
              <div class="mb-3 position-relative form-group">
                <div class="form-check">
                  <label class="form-check-label" for="registerCheck">
                    I have read and accept the
                    <a href="#" target="_blank">terms and conditions.</a>
                  </label>
                  <input type="checkbox" class="form-check-input" id="registerCheck" name="registerCheck"  required />
                </div>
              </div>

              <div class="my-3 my-lg-4">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="mb-3 filled form-group tooltip-end-top">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="acorn-icons acorn-icons-web undefined"><circle cx="10" cy="10" r="8"></circle><path d="M7.5 17.5C6.49999 12 6.5 8 7.50001 2.5M12 17.5C13 12 13 8 12 2.5"></path><path d="M17 13.5C11.5 12.5 8.5 12.5 3 13.5M3 6.5C8.5 7.50001 11.5 7.5 17 6.5"></path></svg>
                        <input class="form-control" type="text" placeholder="coachrab" value="{{ url('/') }}/" readonly="">
                  </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="mb-3 form-group">
                        <input class="form-control" id="domain_name" name="domain_name" type="text" pattern="[^' ']+"  placeholder="Create Page Link" value="{{ old('domain_name') }}" required="">
                  </div>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-lg btn-dark">
                {{ __('Signup') }}
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
