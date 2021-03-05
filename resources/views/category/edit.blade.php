@extends('layouts.app')
@section('title')
  edit - {{$category->category_name}}
@endsection
@section('content')
  <div class="container">
    <div class="row page-titles mt-4">
      <div class="col-md-6 col-8 align-self-center">
        <h3 class="m-b-0 m-t-0">Edit Category</h3>
      </div>
    </div>
    <div class="row mt-4">
      <div class="card col-12">
        <div class="card-body">
          <form method="POST" action="{{route('category.update')}}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              
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
 
            <input type="hidden" name="id" value="{{$category->id}}">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Kategory</label>
              <div class="col-sm-10">
                  <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary float-right">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
