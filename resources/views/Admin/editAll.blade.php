@extends('layout')
@section('content')
<div class="container mt-5 col-6 mx-auto pt-5">
    <div class="text-center">
        <img src="https://res.cloudinary.com/zenbusiness/q_auto/v1/logaster/logaster-2019-02-0175-h-paperless-post-logo-17.png" class="img-fluid" style="height:200px" alt="">
    </div>
    <form action="{{route('update.Allpost',$post->id)}}" method="post">
        @csrf
        <h2 class=" mb-4">Edit Post</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text"  name="title" value="{{$post->title}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleTextarea" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="exampleTextarea" rows="4" required>{{$post->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-secondary btn-block">Update</button>
    </form>
</div>
@endsection