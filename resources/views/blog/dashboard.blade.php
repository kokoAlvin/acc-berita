@extends('layouts/app')
 
@section('title')
  My Blog
@endsection
 
@section('content')
  <div class="container">
    <div class="row page-titles mt-4">
      <div class="col-md-6 col-8 align-self-center">
        <h3 class="m-b-0 m-t-0">Dashboard</h3>
      </div>
      <div class="col-md-6 col-4 align-self-center">
        <div class="float-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
            Filter
          </button>               
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="body-card">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Author</th>
              <th>Judul</th>
              <th>Status</th>
              <th>Aktif</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blogs as $blog)    
              <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->user->name}}</td>
                <td>{{$blog->title}}</td>
                <td>
                  @if ($blog->status == 1)
                    <b style="color:rgb(60, 140, 214)">update</b>
                  @elseif($blog->status == 2)
                    <b style="color:rgb(192, 49, 49)">rejected</b>
                  @else
                    <b style="color:rgb(76, 212, 99)">accepted</b>
                  @endif
                </td>
                <td>
                  @if ($blog->flag_active == 1)
                    Ya
                  @else
                    Tidak
                  @endif
                </td>
                <td>
                  <a href="{{route('blog.show',['id' => $blog->id])}}" target="_blank" class="btn btn-primary mr-2">Detail</a>
                  <form action="{{route('blog.reject',['id' => $blog->id])}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger mr-2">Reject</button>
                  </form>
                  <form action="{{route('blog.accept',['id' => $blog->id])}}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success mr-2">Accept</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="mt-5">
      {{ $blogs->links( "pagination::bootstrap-4") }}
    </div>
  </div>
@endsection
