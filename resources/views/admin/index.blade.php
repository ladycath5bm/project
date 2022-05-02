@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Dashboard</h1>
@stop

@section('content')
    <div>
        <p class="text-lg text-gray-500">Welcome!</p>
        <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <img class="card-img-top" height="400px" src="https://republicadominicanalive.com/wp-content/uploads/2020/11/playa-bonita-01.jpg" alt="">
                  <div class="card-footer">
                      <a href="{{ route('admin.users.index') }}"><strong>Users</strong></a>
                  </div>
              </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                  <img class="card-img-top" height="400px" src="https://republicadominicanalive.com/wp-content/uploads/2020/11/playa-bonita-01.jpg" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.categories.index') }}"><strong>Categories</strong></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                  <img class="card-img-top" height="400px" src="https://republicadominicanalive.com/wp-content/uploads/2020/11/playa-bonita-01.jpg" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.products.index') }}"><strong>Products</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
