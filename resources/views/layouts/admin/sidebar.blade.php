<div id="nav" class="nav-container d-flex">
  <div class="nav-content d-flex">
    <!-- Logo Start -->
    <div class="logo position-relative">
      <a href="Dashboard.html">
        <img class="profile" alt="profile" src="{{ asset('assets/admin/img/logo/logo-white.svg') }}" />
      </a>
    </div>
    <!-- Logo End -->

    <!-- User Menu Start -->
    <div class="user-container d-flex">
      <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <div class="d-inline-block position-relative">
          <img class="profile" alt="profile" src="{{ asset('assets/admin/img/profile/profile-1.webp') }}" />
        <i class="p-1 border border-1 border-foreground bg-danger position-absolute rounded-xl e-0 b-0 mt-1 mb-1 me-1"></i>
        </div>
        <div class="name">E. W</div>
      </a>
      <div class="dropdown-menu dropdown-menu-end user-menu wide">
        <div class="row mb-3 ms-0 me-0">
          <div class="col-12 ps-1 mb-2">
            <div class="text-extra-small text-primary">ACCOUNT</div>
          </div>
          <div class="col-12 ps-1 pe-1">
            <ul class="list-unstyled">
              <li>
                <a href="{{ route('userinfo.index') }}">User Info</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row mb-3 ms-0 me-0">
          <div class="col-12 ps-1 mb-2">
            <div class="text-extra-small text-primary">SETTINGS</div>
          </div>
          <div class="col-12 ps-1 pe-1">
            <ul class="list-unstyled">
              <li>
                <a href="Notification.Settings.html">Notification Settings</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row mb-1 ms-0 me-0">
          <div class="col-12 p-1 mb-3 pt-3">
            <div class="separator-light"></div>
          </div>
          <div class="col-6 pe-1 ps-1">
            <ul class="list-unstyled">
              <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                    <span class="align-middle">Logout</span>
                  </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                        @csrf
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- User Menu End -->
    
     <!-- Icons Menu Start -->
     <ul class="list-unstyled list-inline text-center menu-icons">
      <li class="list-inline-item">
        <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true"
          aria-expanded="false" class="notification-button">
          <div class="position-relative d-inline-flex">
            <i data-acorn-icon="bell" data-acorn-size="18"></i>
            <span class="position-absolute notification-dot rounded-xl"></span>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end wide notification-dropdown scroll-out" id="notifications">
          <div class="scroll">
            <ul class="list-unstyled border-last-none">
              <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                <img src="{{ asset('assets/admin/img/profile/profile-1.webp') }}" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                  alt="..." />
                <div class="align-self-center">
                  <a href="Orders.List.html">
                    <div class="text-extra-small text-primary text-primary text-ellipsis--1">New Order Placed by client</div>
                    <div class="text-dark text-primary text-ellipsis--2">You have 5 new orders</div>
                  </a>
                </div>
              </li>
              <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                <img src="{{ asset('assets/admin/img/profile/profile-2.webp') }}" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                  alt="..." />
                <div class="align-self-center">
                  <a href="Customers.Detail.html">
                    <div class="text-extra-small text-primary text-primary text-ellipsis--1">Client has just completed a fitness plan</div>
                    <div class="text-dark text-primary text-ellipsis--2">Client Mary Baker has just completed a fitness plan</div>
                  </a>
                </div>
              </li>
              <li class="mb-3 pb-3 border-bottom border-separator-light d-flex">
                <img src="{{ asset('assets/admin/img/profile/profile-3.webp') }}" class="me-3 sw-4 sh-4 rounded-xl align-self-center"
                  alt="..." />
                <div class="align-self-center">
                  <a href="Customers.Detail.html">
                    <div class="text-extra-small text-primary text-ellipsis--1">Client has not made any progress on fitness plan or has attended a class in 10 days</div>
                    <div class="text-dark text-ellipsis--2">Client Joe Young has not been active in 10 days logging results or attending a class. Follow up with him?</div>
                  </a>
                </div>
              </li>
             
            </ul>
          </div>
        </div>
      </li>
      <!-- <li class="list-inline-item">
        <a href="#">
          <div class="position-relative d-inline-flex">
            <i data-acorn-icon="gear" data-acorn-size="18"></i>
          </div>
        </a>
      </li> -->
    </ul>
     <!-- Icons Menu End -->
     <a href="#" id="pinButton" class="pin-button h-auto btn btn-sm btn-light">
      <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="16" title="hide-sidebar"></i>
      <i data-acorn-icon="lock-off" class="pin" data-acorn-size="16" title="show-sidebar"></i>
    </a>
    <!-- Menu Start -->
    <div class="menu-container flex-grow-1">
      <ul id="menu" class="menu">
        <li>
          <a href="{{ route('dashboard.index') }}" class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
            <i data-acorn-icon="shop" class="icon" data-acorn-size="18"></i>
            <span class="label">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#cms" data-href="javascript:;" class="{{ (request()->is('admin/landingPages*','admin/pagecms*')) ? 'active' : '' }}">
            <i data-acorn-icon="web-page" class="icon" data-acorn-size="18"></i>
            <span class="label">CMS</span>
          </a>
          <ul id="cms">
            <li>
              <a href="{{ route('pagecms.index') }}" class="{{ (request()->is('admin/pagecms*')) ? 'active' : '' }}">
                <span class="label">Pages</span>
              </a>
            </li>
            <li>
              <a href="{{ route('landing_pages.index') }}" class="{{ (request()->is('admin/landingPages*')) ? 'active' : '' }}">
                <span class="label">Landing Pages</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('leads.index') }}" class="{{ (request()->is('admin/leads*')) ? 'active' : '' }}">
            <i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
            <span class="label">Leads</span>
          </a>
        </li>
        <li>
          <a href="Pages.PWA.html">
            <i data-acorn-icon="mobile" class="icon" data-acorn-size="18"></i>
            <span class="label">PWA</span>
          </a>
        </li>
        <li>
          <a href="{{ route('digitalFiles.index') }}" class="{{ (request()->is('admin/digitalFiles*')) ? 'active' : '' }}">
            <i data-acorn-icon="file-image" class="icon" data-acorn-size="18"></i>
            <span class="label">Digital Files</span>
          </a>
        </li>
        <li>
          <a href="Appearance.Theme.html">
            <i data-acorn-icon="colors" class="icon" data-acorn-size="18"></i>
            <span class="label">Appearance</span>
          </a>
        </li>
        <li>
          <a href="{{ route('manageExercises.index') }}" class="{{ (request()->is('admin/manageExercises*')) ? 'active' : '' }}">
            <i data-acorn-icon="watch" class="icon" data-acorn-size="18"></i>
            <span class="label">Manage Exercises</span>
          </a>
        </li>
        <!-- <li>
          <a href="Manage.Food.Items.html">
            <i data-acorn-icon="main-course" class="icon" data-acorn-size="18"></i>
            <span class="label">Manage Food Items</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="https://000stagehtmlcss.s3.amazonaws.com/FitnessandMealPlans/103-v4/src/Dashboard.html">
            <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
            <span class="label">For Demo</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="#fordemo" data-href="javascript:;">
            <i data-acorn-icon="home" class="icon" data-acorn-size="18"></i>
            <span class="label">For Demo</span>
          </a>
          <ul id="fordemo">
            <li>
              <a href="MealPlans.Sheduled.html">
                <span class="label">Fitness Plan Builder</span>
              </a>
            </li>
            <li>
              <a href="Demo.Site.Pages.html">
                <span class="label">Demo Site Pages</span>
              </a>
            </li>
            <li>
              <a href="Product.List.html">
                <span class="label">Product List</span>
              </a>
            </li>
            <li>
              <a href="Appearance.ThemeColor.html">
                <span class="label">Appearance</span>
              </a>
            </li>
            <li>
              <a href="End.Client.html">
                <span class="label">End Client</span>
              </a>
            </li>
          </ul>
        </li> -->
        <li>
          <a href="Platform.Administration.html">
            <i data-acorn-icon="crown" class="icon" data-acorn-size="18"></i>
            <span class="label">Platform Administration</span>
          </a>
        </li>
        <li>
          <a href="Orders.List.html">
            <i data-acorn-icon="cart" class="icon" data-acorn-size="18"></i>
            <span class="label">Orders</span>
          </a>
        </li>
        <li>
          <a href="Customers.List.html">
            <i data-acorn-icon="user" class="icon" data-acorn-size="18"></i>
            <span class="label">Customers</span>
          </a>
        </li>
        <li>
          <a href="#blog" data-href="javascript:;">
            <i data-acorn-icon="web-page" class="icon" data-acorn-size="18"></i>
            <span class="label">Blogs</span>
          </a>
          <ul id="blog">
            <li>
              <a href="Blog.Article.html">
                <span class="label">Blog Article</span>
              </a>
            </li>
            <li>
              <a href="Blog.Category.html">
                <span class="label">Blog Category</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#payments" data-href="javascript:;">
            <i data-acorn-icon="wallet" class="icon" data-acorn-size="18"></i>
            <span class="label">Payments</span>
          </a>
          <ul id="payments">
            <li>
              <a href="ReceivingMoney.html">
                <span class="label">Receiving Money</span>
              </a>
            </li>
            <li>
              <a href="Billing.html">
                <span class="label">Billing</span>
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#help" data-href="javascript:;">
            <i data-acorn-icon="question-circle" class="icon" data-acorn-size="18"></i>
            <span class="label">Help</span>
          </a>
          <ul id="help">
            <li>
              <a href="Support.KnowledgeBase.html">
                <span class="label">Knowledge Base</span>
              </a>
            </li>
            <li>
              <a href="Support.Tickets.html">
                <span class="label">Tickets</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Menu End -->

    <!-- Mobile Buttons Start -->
    <div class="mobile-buttons-container">
      <!-- Menu Button Start -->
      <a href="#" id="mobileMenuButton" class="menu-button">
        <i data-acorn-icon="menu"></i>
      </a>
      <!-- Menu Button End -->
    </div>
    <!-- Mobile Buttons End -->
  </div>
  <div class="nav-shadow"></div>
</div>