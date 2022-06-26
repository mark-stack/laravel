<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="/images/mark_logo.png" style="width:30px;">
        </a>
  
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/#examples" class="nav-link px-2" style="color:white">Live Samples</a></li>
          <li><a href="/#hire" class="nav-link px-2" style="color:white">Hire Me</a></li>
        </ul>
  
        <div class="text-end">
          @if (auth()->check())
            @if(Auth::user()->isAdmin())
              <button type="button" onclick="location.href='/admin';"  class="btn btn-outline-light me-2">Admin</button>
            @else 
              <button type="button" onclick="location.href='/user';"  class="btn btn-outline-light me-2">Dashboard</button>
            @endif
          @else 
            <button type="button" onclick="location.href='/auth/redirect/google';" class="btn btn-primary" style="background-color:#4285F4;"><i class="fa-brands fa-google"></i> Google</button>
            <button type="button" onclick="location.href='/auth/redirect/linkedin';" class="btn btn-primary" style="background-color:#0a66c2;padding-top: 3px;padding-bottom: 4px;"><span style="font-size:20px"><i class="fa-brands fa-linkedin"></i></span> Linkedin</button>
          @endif
  
        </div>
      </div>
    </div>
  </header>
      