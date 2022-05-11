@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <span class="text-bold text-lg">Found your files imported here!</span>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if($imports->count())
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Qty. registers</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($imports as $import)
                            <tr>
                                <td>{{ $import->id }}</td>
                                <td>{{ $import->name }}</td>
                                <td>{{ $import->records }}</td>
                                <td>{{ $import->status }}</td>
                            </tr>
                        @empty
                            <h5>Ups!, imports not found</h5>
                        @endforelse
                    
                    </tbody>
                </table>
            @else
                <h5>¡Ups! you do not have imports</h5>
            @endif
        </div>
        <div class="card-footer">
            <a class="btn btn-success" href="{{ route('admin.products.module') }}">Back</a>
        </div>
    </div>
@endsection
