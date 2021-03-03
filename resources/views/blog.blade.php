@extends('layouts/app')

@section('title')
    Blog
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$blog->title}}</h5>
                                <a href="{{route('blog.show',['id' => $blog->id])}}" class="card-subtitle mb-2 text-muted">{{$blog->user->name}}</a>
                                <!-- <h6 class="card-subtitle mb-2 text-muted">{{$blog->user->name}}</h6> -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $blogs->links("pagination::bootstrap-4") }}
            </div>
            <!-- <h1 class="display-4">Halaman Blog</h1>
            <p class="lead">efefefefewfwefwfewfewf</p> -->
        </div>
    </div>
@endsection