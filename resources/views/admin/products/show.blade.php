@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Product: </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-dark btn-sm" href="{{ route('admin.products.edit', $product) }}">Edit product</a>
        </div>
        <div class="card-body">
            <div>

                <div class="mb-2">
                    <h2 >
                        <strong>Name: </strong>{{ $product->name }}
                    </h2>
                </div>
                <div class="mb-2">
                    <strong>Id: </strong>{{ $product->id }}
                </div>
                <div class="mb-2">
                    <strong>Price: </strong>${{ $product->price }}
                </div>
                <div class="mb-2">
                    <strong>Stock: </strong>{{ $product->stock }}
                </div>
                <div class="mb-2">
                    @if($product->status == 1)
                        <strong>Status: </strong>Enable    
                    @else
                        <strong>Status: </strong>Dissabe
                    @endif
                    
                </div>
                <div class="mb-2 w-5">
                    <strong>Category: </strong>
                        <div class="inline-block px-4 h-6 bg-green rounded gap-2 mr-2 mb-2">
                            {{ $product->category->name }}
                        </div>
                </div>
                
            </div>
                
        </div>
        <div class="card-header">
            <a class="btn btn-dark btn-sm" href="{{ route('admin.products.index') }}">Back</a>
        </div>
    </div>
@stop
