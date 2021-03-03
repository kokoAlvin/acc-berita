@extends('layouts/app')
 
@section('title')
    My Blog
@endsection
 
@section('content')
  <div class="container">
      <div class="row page-titles mt-4">
          <div class="col-md-6 col-8 align-self-center">
              <h3 class="m-b-0 m-t-0">My Blog</h3>
          </div>
          <div class="col-md-6 col-4 align-self-center">
              <div class="float-right">
                  <a class="ml-2" href="{{route('blog.create')}}">
                      <button class="btn btn-md btn-success pull-right">
                          <i class="fas fa-plus-circle">
                          </i>
                            Add Blog
                      </button>
                  </a>                
              </div>
          </div>
      </div>
      <div class="row mt-4">
          @foreach ($blogs as $blog)    
            <div class="col-6 mt-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    {{$blog->title}}
                  </h5>
                  <div class="row float-right">
                    <a href="{{route('blog.show',['id' => $blog->id])}}" class="btn btn-primary mr-2" target="_blank">
                    Detail
                    </a>
                    <a href="
                    {{route('blog.edit',['id' => $blog->id])}}
                    " class="btn btn-success mr-2">
                    edit
                    </a>
                    <form action="{{route('blog.delete')}}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('delete') }}
                      <input type="hidden" name="id" value="{{$blog->id}}">
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
          @endforeach
      </div>
      <div class="mt-5">
          {{ $blogs->links( "pagination::bootstrap-4") }}
      </div>
  </div>
@endsection
