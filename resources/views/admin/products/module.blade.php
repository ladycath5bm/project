@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h4 class="text-bold text-lg">Module to export or import products</h4>
@stop

@if(session('information'))
        <div class="alert alert-warning">
            {{ session('information') }}
        </div>
@endif

@section('content')

    <div class="card">
        <div class="card-header">
            <span class="text-bold">Export excel file</span>
        </div>
        <div class="card-body">
            <form id="filter" method="GET" action="{{ route('admin.products.exports.generate') }}" accept-charset="utf-8">
                @csrf
                <div class="row p-2">
                    <div class="card-body border rounded mr-2">
                        <label>Chose the date</label>
                        <br>
                        <input class="rounded mr-4" type="date" name="start_date" id="start_date" max=@php
                                echo date('Y-m-d')
                            @endphp 
                        required/>
                        <input class="rounded" type="date" name="end_date" id="end_date" max=@php
                                echo date('Y-m-d')
                            @endphp
                        required/>
                    </div>
                    <div class="card-body border rounded mr-2">
                        <label>Category</label>
                        <br>
                        <select class="form-select" name="category" id="category" aria-label="Default select example">
                            <option selected value="all">all</option>
                            @foreach ($categories as $category)
                                <option value={{ $category->name }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body border rounded">
                        <label>Status</label>
                        <br>
                        <select class="form-select" name="status" id="status" aria-label="all status">
                            <option selected value="all">all</option>
                            <option value="ENABLED">Enabled</option>
                            <option value="DISABLED">Disabled</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button
                        type="submit"
                        class="btn btn-warning btn-sm mt-2 mr-2"
                        id="filter"
                        form="filter"
                    >Generate</button>
                    <a class="btn btn-success btn-sm mt-2 float-right " href="{{ route('admin.products.exports.list') }}">List of exports</a>
                </div>
                    <a class="mt-2 text-xs" href="{{ route('admin.products.exports.file', $file = null) }}">Download last file generated...</a>
                <div>
                    
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="text-bold">Import excel file</span>
        </div>
        <div class="card-body">
            <form id="import" method="POST" action="{{ route('admin.products.import') }}" accept-charset="utf-8" enctype="multipart/form-data">
                @csrf
                <div class="row p-2">
                    <div class="card-body border rounded mr-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="rounded-md" type="file" name="file" placeholder="file" required/>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <br>
                </div>
                <div>
                    <button
                        type="submit"
                        class="btn btn-warning btn-sm mt-2 mr-2"
                        id="file"
                        form="import"
                    >Import</button>
                    <a class="btn btn-success btn-sm mt-2 float-right " href="{{ route('admin.products.imports.list') }}">List of imports</a>
                </div>
            </form>
        </div>
    </div>

@endsection
