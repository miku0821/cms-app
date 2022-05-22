  <nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(102, 174, 236)">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><i class="fa-solid fa-camera-retro"></i>Skyblog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

          @if (Auth::check())
            <div class="nav-item">
              <a class="nav-link" href="{{ route('admin.index') }}">Admin</a>
            </div>
              
          @else

            <div class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </div>   
            {{-- <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>    --}}
          @endif
    </div>
  </nav>