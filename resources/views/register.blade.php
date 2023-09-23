@extends('layout')
@section('content')
<div class="bg-light">
  <div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-md-4">
        <div class="card text-white bg-dark">
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form action="{{route('register.store')}}" method="POST">
                @csrf
              <div class="mb-3">
                <label for="username" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="username" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="username" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection