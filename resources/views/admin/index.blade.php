@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <div class="card py-3">
        <h3 class="text-bold text-center ">Administration panel</h3>
    </div>
@stop

@section('content')
    <div>   
        <div class="row">
            <div class="col-lg-3">
              <div class="card">
                <img class="card-img-top" height="250px" src="{{ asset('images/usuarios.jpg') }}" alt="">
                
                  <div class="card-footer">
                      <a href="{{ route('admin.users.index') }}"><strong>Users</strong></a>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                  <img class="card-img-top" height="250px" src="{{ asset('images/producto.png') }}" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.products.index') }}"><strong>Products</strong></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                  <img class="card-img-top" height="250px" src="{{ asset('images/categories.jpg') }}" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.categories.index') }}"><strong>Categories</strong></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                  <img class="card-img-top" height="250px" src="{{ asset('images/orders.png') }}" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.orders.index') }}"><strong>Orders</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
