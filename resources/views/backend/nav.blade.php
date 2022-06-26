<header class="topbar" data-navbarbg="skin5">
  <nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header" data-logobg="skin5">
      <!-- Logo -->
      <a class="navbar-brand" href="/">
        <!-- Logo icon -->
        <b class="logo-icon ps-2">
          <!-- Dark Logo icon -->
          <img
            src="/images/mark_logo.png"
            alt="homepage"
            class="light-logo"
            width="35"
          />
        </b>

        <!-- Logo text -->
        <span class="logo-text ms-2">
          <!-- dark Logo text -->
          <span style="position:relative;top:5px;font-size:25px"><i><strong>{{ ucfirst(Auth()->user()->first_name) }}</strong></i></span>
        </span>
      </a>

      <!-- Toggle which is visible on mobile only -->
      <a
        class="nav-toggler waves-effect waves-light d-block d-md-none"
        href="javascript:void(0)"
        ><i class="ti-menu ti-close"></i
      ></a>
    </div>

    <div
      class="navbar-collapse collapse"
      id="navbarSupportedContent"
      data-navbarbg="skin5"
    >
      <!-- toggle and nav items -->
      <ul class="navbar-nav float-start me-auto">
        <li class="nav-item d-none d-lg-block">
          <a
            class="nav-link sidebartoggler waves-effect waves-light"
            href="javascript:void(0)"
            data-sidebartype="mini-sidebar"
            ><i class="mdi mdi-menu font-24"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<aside class="left-sidebar" data-sidebarbg="skin5">
  <!-- Sidebar scroll-->
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="sidebarnav" class="pt-4">

        <!-- Admin Menu -->
        @if(Auth()->user()->isAdmin())
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/admin" aria-expanded="false">
              <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Admin Dashboard</span>
            </a>
          </li>
          <br><br>
        @endif
      
        <!-- User Menu -->
        {{-- 
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user" aria-expanded="false">
            <i class="fa-solid fa-home" style="font-size: 18px;margin-left:11px;margin-right:5px"></i><span class="hide-menu">Dashboard</span>
          </a>
        </li>
        --}}
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/stripe" aria-expanded="false">
            <i class="fa-brands fa-cc-stripe" style="font-size: 20px;margin-left:10px;margin-right:5px"></i><span class="hide-menu"> Stripe example</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/calendar" aria-expanded="false">
            <i class="fa-solid fa-calendar-days" style="font-size: 20px;margin-left: 11px;margin-right: 10px;"></i><span class="hide-menu"> Calendar example</span>
          </a>
        </li>
        {{-- 
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/graphql" aria-expanded="false">
            <i class="fa-solid fa-code" style="font-size: 20px;margin-left:7px;margin-right:5px"></i><span class="hide-menu"> GraphQL example</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/mobile" aria-expanded="false">
            <i class="fa-solid fa-mobile-screen-button" style="font-size: 20px;margin-left: 11px;margin-right: 12px;"></i><span class="hide-menu"> Mobile Verification example</span>
          </a>
        </li>
        --}}
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/user/socials" aria-expanded="false">
            <i class="fa-brands fa-google" style="font-size: 20px;margin-left: 11px;margin-right: 12px;"></i><span class="hide-menu"> Social login example</span>
          </a>
        </li>
        <!-- Logout button -->
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/logout" aria-expanded="false">
            <i class="mdi mdi-power" style="margin-left:2px;margin-right:2px"></i><span class="hide-menu">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>