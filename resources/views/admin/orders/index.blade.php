@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">List of orders</h1>
@stop

@section('content')
    @if(session('information'))
        <div class="alert alert-warning">
            {{ session('information') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            @livewire('admin.order-index')
        </div>
    </div>
@endsection



