@extends('layouts/app')
 
@section('title')
    Create Blog
@endsection
 
@section('content')
    <div class="container">
        <div class="row page-titles mt-4">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="m-b-0 m-t-0">Create Blog</h3>
            </div>
        </div>
        <div class="row mt-4">
            <div class="card col-12">
                <div class="card-body">
                  <!--
                    Bagian menampilkan error
                  -->
                  @if ($errors->any())
                  <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div>
                  @endif
                  
                  <!--
                    Bagian Form
                  -->
                  <div class="card-body">
                    <form action="{{route('blog.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Konten</label>
                        <div class="col-sm-10">
                        <textarea name="content" cols="50" rows="5">{{old('content')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                        <select name="category_id">
                        <option value="">Select Category</option>
                            @foreach ($category as $key)
                                <option value="{{$key->id}}"> 
                                    {{ $key->category_name }} 
                                </option>
                            @endforeach    
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
