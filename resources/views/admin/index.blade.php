@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Dashboard</h1>
@stop

@section('content')
    <div>
        <p class="text-lg text-gray-500">You can manage your products, here!</p>
        <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <img class="card-img-top" height="400px" src="https://republicadominicanalive.com/wp-content/uploads/2020/11/playa-bonita-01.jpg" alt="">
                  <div class="card-footer">
                      <a href="{{ route('admin.categories.index') }}"><strong>Categories</strong></a>
                  </div>
              </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                  <img class="card-img-top" height="400px" src="http://2.bp.blogspot.com/-VYLtIPZylS0/UR668BqVYxI/AAAAAAAA28E/n1YpNLfoD78/s1600/Hermoso-Atardecer-en-la-Playa-y-palmeras-HDR_Paisajes-de-Playas-en-HDR.jpg" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.products.index') }}"><strong>Products</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
