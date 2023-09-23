@extends('layout')
@section('content')
<div class="bg-light">
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
          @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
            <h5 class="card-title text-center">Login</h5>
            <form action="{{route('login.check')}}" method="post">
              @csrf
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="email" class="form-control" name="email"id="username">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>

              <div class="text-center">
              <a href="forgot-password.html" class="btn btn-link">Forgot Password?</a>
                <a href="{{route('register')}}" class="btn btn-secondary">Register</a>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection