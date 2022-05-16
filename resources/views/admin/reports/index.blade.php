@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <div class="card py-2">
        <h4 class="text-bold text-center ">Generate your reports</h4>
    </div>
@stop

@section('content')
    @if(session('information'))
        <div class="alert alert-warning">
            {{ session('information') }}
        </div>
    @endif
    <div>
        <div class="row">
            <div class="col-lg-3">
              <div class="card">
                <img class="card-img-top p-2" height="270px" src="{{ asset('images/users.jpg') }}" alt="">
                  <div class="card-footer">
                      <a href="{{ route('admin.reports.users') }}"><strong class=" text-center ">Donwload: the users list</strong></a>
                  </div>
              </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img class="card-img-top p-4" height="270px" src="{{ asset('images/orders.png') }}" alt="">
                    <div class="card-footer">
                        <a href="{{ route('admin.reports.orders') }}"><strong class=" text-center ">Download: orders list</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

