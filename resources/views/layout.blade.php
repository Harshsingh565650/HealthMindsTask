<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <title>Content Management System</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Content Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      @if(Auth::user())
      <li class="nav-item active">
        <a class="nav-link" href="{{route('view.post')}}">My-Post<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('user.Dashboard')}}">Create-Post<span class="sr-only">(current)</span></a>
      </li>
      @if(Auth::user()->role === 'admin')
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.viewAll')}}">All-Post<span class="sr-only">(current)</span></a>
      </li>
      @endif
      @endif
    </ul>
    @if(Auth::user())
    <li class="nav-item active nav-link ml-auto" style="color : white;">
      @if(Auth::check())
        <p><strong>Welcome, {{ Auth::user()->name }}</strong></p>
      @endif
      </li>
    <a href="{{route('logout')}}" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
    @else
    <a href="{{route('login')}}" class="btn btn-outline-success my-2 my-sm-0 ml-auto">Login</a>
  </div>
  @endif
</nav>
@yield('content')
@stack('footer-script')
</body>
</html>