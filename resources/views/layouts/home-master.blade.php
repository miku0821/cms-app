<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Skyblog</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ secure_asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  {{-- fontawesome --}}
  <script src="https://kit.fontawesome.com/1eaebda83d.js" crossorigin="anonymous"></script>
  {{-- Google font --}}
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">
  <style>
    a{color: rgb(14, 46, 87);}
    a:hover{color:rgb(102, 174, 236);}
    .nav-link:hover, .navbar-brand:hover{color: whitesmoke;}
    .btn:hover{background-color: rgb(14, 46, 87) !important;}
  </style>

</head>

<body>

  <!-- Navigation -->
  @include('includes.home-nav')

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        @yield('content')

      </div>

      <!-- Sidebar Widgets Column -->
      @include('includes.front-sidebar')

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 @if(isset($posts) && (!count($posts) > 0)) fixed-bottom @endif" style="background-color: rgb(102, 174, 236)">
    <div class="container" >
      <p class="m-0 text-center" style="color: rgb(14, 46, 87)">Copyright &copy;  Website 2022</p>
    </div>
    <!-- /.container -->
  </footer>

 
  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  @yield('scripts')
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


</body>

</html>