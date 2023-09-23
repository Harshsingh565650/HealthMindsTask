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
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <h5 class="card-title text-center">Forget Password</h5>
            <form action="{{route('reset.passwordstore')}}" method="post">
              @csrf
              <input type="text" name="token" hidden value="{{$token}}">
              <p>We will send a link to your email, use that link to reset password</p>
              <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="email" class="form-control" name="email"id="username">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Enter New Password</label>
                <input type="password" class="form-control" name="password"id="username">
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation"id="username">
              </div>
              <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection