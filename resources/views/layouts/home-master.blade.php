<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Home</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/blog-home.css') }}" rel="stylesheet">

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
  <footer class="py-5 bg-dark @if(isset($posts) && (!count($posts) > 0)) fixed-bottom @endif">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy;  Website 2022</p>
    </div>
    <!-- /.container -->
  </footer>

 
  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  @yield('scripts')
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


</body>

</html>