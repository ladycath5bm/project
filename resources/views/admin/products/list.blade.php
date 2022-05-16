@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <div class="card py-2">
        <h4 class="text-bold text-center ">List of products</h4>
    </div>
@stop

@section('content')
    @if(session('information'))
        <div class="alert alert-warning">
            {{ session('information') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            @livewire('admin.product-index')
        </div>
    </div>

@endsection
