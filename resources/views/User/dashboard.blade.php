@extends('layout')
@section('content')
<div class="container mt-5 col-6 mx-auto pt-5">
    <div class="text-center">
    @if(Auth::check())
        <p><strong>Welcome, {{ Auth::user()->name }}</strong></p>
    @else
        <p>You are not logged in.</p>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
        <img src="https://res.cloudinary.com/zenbusiness/q_auto/v1/logaster/logaster-2019-02-0175-h-paperless-post-logo-17.png" class="img-fluid" style="height:200px" alt="">
    </div>
    <form action="{{route('post.store')}}" method="post">
    @csrf
    <h2 class=" mb-4">Create New Post</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleTextarea" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-secondary btn-block">Submit</button>
    </form>
</div>
@endsection