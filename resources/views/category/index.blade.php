@extends('layouts/app')
 
@section('title')
    My Category
@endsection
 
@section('content')
  <div class="container">
      <div class="row page-titles mt-4">
          <div class="col-md-6 col-8 align-self-center">
              <h3 class="m-b-0 m-t-0">Category</h3>
          </div>
          <div class="col-md-6 col-4 align-self-center">
              <div class="float-right">
                  <a class="ml-2" href="{{route('category.create')}}">
                      <button class="btn btn-md btn-success pull-right">
                          <i class="fas fa-plus-circle">
                          </i>
                            Add
                      </button>
                  </a>                
              </div>
          </div>
      </div>
      <div class="row mt-4">
          @foreach ($category as $c)    
            <div class="col-6 mt-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">
                    {{$c->category_name}}
                  </h5>
                  <div class="row float-right">
                    <a href="
                    {{route('category.edit',['id' => $c->id])}}
                    " class="btn btn-success mr-2">
                    edit
                    </a>
                </div>
                </div>
              </div>
            </div>
          @endforeach
      </div>
  </div>
@endsection
