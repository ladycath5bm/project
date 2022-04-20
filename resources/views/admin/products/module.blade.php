@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h4 class="text-bold text-lg">Module to export or import products</h4>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <span class="text-bold">Export excel file</span>
        </div>
        <div class="card-body">
            <form id="filter" method="GET" action="{{ route('admin.products.export') }}" accept-charset="utf-8">
                @csrf
                <div class="row p-2">
                    <div class="card-body border rounded mr-2">
                        <label>Chose the date</label>
                        <br>
                        <input class="rounded mr-4" type="date" name="date1" id="date1" required/>
                        <input class="rounded" type="date" name="date2" id="date2" required/>
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
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button
                        type="submit"
                        class="btn btn-primary btn-md mt-2"
                        id="filter"
                        form="filter"
                    >Export</button>
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
                        class="btn btn-primary btn-md"
                        id="file"
                        form="import"
                    >Import</button>
                </div>
            </form>
        </div>
    </div>

@endsection
