@extends('layout')
@section('content')
<div class="container mt-4">
  <div class="row">
    @foreach($post as $posts)
    <div class="col-md-4">
      <div class="card text-white bg-dark mb-3">
        <div class="card-header">Author: {{$posts->Username->name}}</div>
        <div class="card-body">
          <h5 class="card-title">{{$posts->title}}</h5>
          <p class="card-text">{{$posts->description}}</p>
          <!-- <p class="ml-auto">Created on : {{$posts->updated_at}}</p> -->
        </div>
      </div>
    </div>
@endforeach  
  </div>
</div>
@endsection