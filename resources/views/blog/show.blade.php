@extends('layouts.app')
@section('title')
  blog - {{$blog->title}}
@endsection
@section('content')
  <div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title">{{$blog->title}}</h1>
        <p class="card-text">
          {{$blog->content}}
        </p>
        <p class="card-text"><small class="text-muted">{{$blog->user->name}}</small></p>
        @if ($user_id == $blog->user_id)
          <a href="#" class="btn btn-primary float-right">eidt</a>
        @endif
      </div>
    </div>
  </div>
@endsection
