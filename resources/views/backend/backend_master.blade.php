<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mark Evans</title>

    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://laravel.com/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://laravel.com/img/favicon/favicon-16x16.png">

    <!-- Custom CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="/admintheme/assets/extra-libs/multicheck/multicheck.css"
    />
    <link
      href="/admintheme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
      rel="stylesheet"
    />
    <link href="/admintheme/dist/css/style.min.css" rel="stylesheet" />

    <!-- Icons -->
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
    
    <!-- JQuery-->
    <script src="/admintheme/assets/libs/jquery/dist/jquery.min.js"></script>

    @if(Route::currentRouteName() == 'calendar')
      <!-- Calendar dependencies-->
      <!--
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    @endif

  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >

      @include('backend.nav')

      <main>
        @yield('content')
      </main>

      @include('backend.footer')

      </div>
    </div>

    @yield('scripts')

    <!-- Bootstrap tether Core JavaScript -->
    <script src="/admintheme/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/admintheme/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="/admintheme/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="/admintheme/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/admintheme/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="/admintheme/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="/admintheme/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="/admintheme/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="/admintheme/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
      $("#zero_config").DataTable();
    </script>
  </body>
</html>

