<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- CSRF token -->
    <meta name="csrf-token" content="rz6qhQjJTeHld1ChnQOlVAUoT0MKqIehWHUkxGRl">

    <title>Mark Evans - Laravel Developer</title>

    <!-- JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons https://favicon.io/-->
    <link rel="apple-touch-icon" sizes="180x180" href="https://laravel.com/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://laravel.com/img/favicon/favicon-16x16.png">
 
    <!-- icons -->
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js" integrity="sha384-xBXmu0dk1bEoiwd71wOonQLyH+VpgR1XcDH3rtxrLww5ajNTuMvBdL5SOiFZnNdp" crossorigin="anonymous"></script>
    
    <style>

      @media screen and (min-width: 768px) {
          .mobileshow {display: none;}
      }   
      @media screen and (max-width: 767px) {
          .mobilehide {display: none;}
      } 

      td {
        vertical-align: baseline;
      }
  
    </style>

  </head>
  <body>
    
    @include('frontend.nav')

    <main>
      @yield('content')
    </main>

    @include('frontend.footer')

    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>

</html>
