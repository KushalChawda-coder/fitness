@include('layouts.front.header')
   <section class="main-banner bg-black">
      <div class="container">
         <div class="row">
            <div class="col-12 col-xxl-8 offset-xxl-2">
               <div class="banner-info text-center">
                  <h1 class="text-capitalize text-white fw-bold display-1 mb-3">
                     {{ $HeaderBanner->Title }}
                  </h1>
                  <!-- <h4 class="mt-3 text-white lh-1-5">
                     Connect with your clients and future customers.Yours clients do not just hire you for your fitness
                     plans. They hire you becouse you keep them accoutable and motivated. Organize everything with your
                     own fitness plan app.
                  </h4> -->
               </div>
               <div class="banner-action text-center mt-3 mt-lg-5 mb-3 mb-lg-5">
                  <!-- <a href="membership-plan.html" class="btn btn-xl btn-dark h-auto">Get Started</a> -->
                  <a href="{{ url($HeaderBanner->ActionPage); }}" class="text-primary fs-5">
                     {{ $HeaderBanner->ActionBtn }}
                     <i data-acorn-icon="arrow-double-right" data-acorn-size="18"></i>
                  </a>
               </div>
               <div class="hero-bgimage-wrapper w-100">
                  <figure class="hero-bgimage" style="background-image: url({{ asset($HeaderBanner->file); }});"></figure>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section class="apps-builts bg-white py-3 py-lg-5" id="apps-builts">
      <div class="container">
         <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
               <h3 class="text-black lh-1-5 text-center"> {{ $HeaderBanner->SubText }}
               </h3>
            </div>
         </div>
      </div>
   </section>

   <section class="feature py-3 py-lg-5" id="feature">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title centered has-element">
                  <h1 class="title text-center text-capitalize text-black fw-bold">
                     Features
                  </h1>
                  <div class="lines">
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row align-items-center">
            @foreach($Feature->Content as $feature)
            <div class="col-12 col-lg-6">
               <div class="pt-3 my-3 content-wrapper bg-white text-center large-centered">
                  <div class="copy-wrapper px-3">
                     <h3 class="fs-2 fw-bold text-black">{{ $feature->Heading }}</h3>
                     <h5 class="fs-5 text-black">{{ $feature->SubHeading }}</h5>
                  </div>
                  <div class="copy-action mt-3 mb-3">
                     <a href="{{ url($feature->ActionPage)  }}" class="lh-1-25 fs-5 mb-0 text-primary">
                        <span>{{ $feature->ButtonLink }}</span>
                        <i data-acorn-icon="arrow-double-right" data-acorn-size="18"></i>
                     </a>
                  </div>
                  <div class="image-wrapper">
                     <figure class="acmi-image" style="background-image: url({{asset($feature->Image)}});"></figure>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>

   <section class="live-preview bg-light py-3 py-lg-5" id="live-feature">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title centered has-element">
                  <h1 class="title text-center text-capitalize text-black fw-bold">
                     Live Preview
                  </h1>
                  <div class="lines">
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row row-cols-1 row-cols-sm-1 row-cols-md-3 row-cols-lg-4 justify-content-center g-4">
            @foreach($LivePreview->Content as $LivePreview)
            <div class="col">
               <div class="card mt-2 mt-lg-5">
                  <a href="{{ url($LivePreview->ActionPage) }}">
                     <img src="{{ asset($LivePreview->Image) }}" class="card-img-top sh-25" alt="card image">
                  </a>
                  <div class="card-body">
                     <h4 class="card-title fw-bold">{{ $LivePreview->Title }}</h4>
                     <p class="card-text">{{ $LivePreview->Description }}</p>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </section>
  
   <section class="our-price py-3 py-lg-5" id="price">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title centered has-element">
                  <h1 class="title text-center text-capitalize text-black fw-bold">
                     Our Price
                  </h1>
                  <div class="lines">
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div
            class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-3 row-cols-xxl-4 justify-content-center g-4">
            @for($j = 0; $j < 2; $j++)
            <div class="col">
               <div class="card border-2 border-light bg-white my-2 my-lg-4">
                  <div class="card-body">
                     <h5 class="title font-weight-bold text-uppercase text-black mb-0">
                     {{ $j == 0 ? "free" : "coach" }}</h5>
                     <!-- <p class="small">for every number</p> -->
                     <div class="text-center mx-auto d-block my-4">
                        <div class="d-flex justify-content-center align-items-center mb-4">
                           <span class="h5 text-dark mb-0 mt-2">$</span>
                           <span id="{{ $j == 1 ? "price-data" : "" }}" class="price h3 mb-0">
                              {{ $Pricing[$j]->Price }}</span>
                           <span class="h5 text-muted align-self-end mb-1">/mo</span>
                        </div>
                     </div>
                     <div class="form-group">
                        @if($j == 0)
                        <h5>{{ $Pricing[$j]->UpToClients }} Client {{ $Pricing[$j]->Storage }} GB Storage</h5>
                        @else
                         <select class="form-select form-select-lg Change-package">
                           @foreach($Pricing as $i => $package)
                           @if($package->PackageType != 'free')
                              <option value="0" price="{{ $package->Price }}" {{ ($package->UpToClients == 25) ? 'selected' : ''}} >Up to {{ $package->UpToClients }} Client and {{ $package->Storage }} GB Storage
                              </option>
                           @endif
                           @endforeach
                         </select>
                        @endif
                     </div>
                     <div class="form-group text-center">
                        <a href="{{ route('register') }}" class="btn w-100 btn-success btn-radius mt-3 px-lg-4">
                           Sign Up
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            @endfor
         </div>
      </div>
   </section>
   <section class="our-article bg-light py-3 py-lg-5" id="article">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title centered has-element">
                  <h1 class="title text-center text-capitalize text-black fw-bold">
                     Exercises
                  </h1>
                  <div class="lines">
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container mt-3 mt-lg-5">
         <div
            class="row g-4 row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-2 justify-content-center">
            <div class="col">
               <div class="card w-100 sh-30 hover-img-scale-up">
                  <img src="{{ @$Exercises->Image }}" class="card-img h-100 scale" alt="card image">
                  <div class="card-img-overlay d-flex flex-column justify-content-between">
                     <div class="d-flex flex-column h-100 justify-content-between align-items-start">
                        <div class="cta-1 mb-5 text-white">{{ @$Exercises->Heading }}</div>
                        <a href="{{ url(@$Exercises->Pages) }}"
                           class="btn btn-icon btn-icon-start btn-dark mt-3 stretched-link">
                           <i data-acorn-icon="chevron-right"></i>
                           <span>View</span>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </section>

   <section class="our-article bg-light py-3 py-lg-5" id="article">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="section-title centered has-element">
                  <h1 class="title text-center text-capitalize text-black fw-bold">
                     Articles
                  </h1>
                  <div class="lines">
                     <span></span>
                     <span></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4 g-4">
            <div class="col">
               <div class="card mt-3 mt-lg-5">
                  <a href="article-details.html">
                     <img src="{{ asset('assets/plan-img/exercise-image1.jpg') }}" class="card-img-top sh-25" alt="card image">
                  </a>
                  <div class="card-body">
                     <div class="text-muted text-small mb-2">FITNESS</div>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <div class="text-muted text-small">By Your Fitness Plan App</div>
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card mt-3 mt-lg-5">
                  <a href="article-details.html">
                     <img src="{{ asset('assets/plan-img/exercise-image2.jpg') }}" class="card-img-top sh-25" alt="card image">
                  </a>
                  <div class="card-body">
                     <div class="text-muted text-small mb-2">NURITION</div>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <div class="text-muted text-small">By Your Fitness Plan App</div>
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card mt-3 mt-lg-5">
                  <a href="article-details.html">
                     <img src="{{ asset('assets/plan-img/exercise-image3.jpg') }}" class="card-img-top sh-25" alt="card image">
                  </a>
                  <div class="card-body">
                     <div class="text-muted text-small mb-2">BUSINESS OF FITNESS AND NUTRITION</div>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <div class="text-muted text-small">By Your Fitness Plan App</div>
                  </div>
               </div>
            </div>
            <div class="col">
               <div class="card mt-3 mt-lg-5">
                  <a href="article-details.html">
                     <img src="{{ asset('assets/plan-img/exercise-image2.jpg') }}" class="card-img-top sh-25" alt="card image">
                  </a>
                  <div class="card-body">
                     <div class="text-muted text-small mb-2">BUSINESS OF FITNESS AND NUTRITION</div>
                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                     <div class="text-muted text-small">By Your Fitness Plan App</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mt-3 mt-lg-5">
            <div class="col-12 col-xl-12 text-end">
               <a href="article-category.html" class="cta-3 fw-bold">
                  <span>More Topics</span>
                  <i data-acorn-icon="arrow-double-right" data-acorn-size="18"></i>
               </a>
            </div>
         </div>
      </div>
   </section>
   
   <section class="subscribe my-3 my-lg-5">
      <div class="container">
         <div class="card w-100 sh-35 sh-sm-25 p-4" style="background-image: url('plan-img/cta-wide-4.jpg');">
            <!-- <img src="plan-img/cta-wide-4.jpg" class="card-img h-100" alt="card image"> -->
            <div class="d-flex flex-column justify-content-between bg-transparent">
               <div class="row">
                  <div class="col-12 col-lg-10">
                     <div class="cta-3 text-black position-relative z-index-1000 mb-2">Please subscribe below to stay
                        updated on communication.</div>
                     <div class="row gx-2">
                        <div class="col-8 col-sm-8">
                           <div class="d-flex flex-column justify-content-start position-relative z-index-1000">
                              <div class="text-muted mb-2 mb-sm-0">
                                 <input type="text" class="form-control" placeholder="Email">
                              </div>
                           </div>
                           <div class="form-group row mt-2">
                              <div class="col-12">
                                 <div class="form-check position-relative z-index-1000">
                                    <input class="form-check-input" type="checkbox" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">Checking this box you are
                                       agreeing
                                       to receive updatein the form of notification of the
                                       the prodcuts realse dates and news letters for Fitness Plan App</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-auto">
                           <a href="verify-email3.html"
                              class="btn btn-icon btn-icon-start btn-primary stretched-link position-relative z-index-1000">
                              <i data-acorn-icon="chevron-right"></i>
                              <span>Subscribe</span>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
@include('layouts.front.footer')
<script>
   $(document).ready(function(){
    
      $('.Change-package').change(function(){
         var price = $('option:selected', this).attr('price');
         $('#price-data').text(price)
      });

   });

  
</script>