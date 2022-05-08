@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <span class="text-bold text-lg">Found your files generated here!</span>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if($exports->count())
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($exports as $export)
                            <tr>
                                <td>{{ $export->id }}</td>
                                <td>{{ $export->name }}</td>
                                <td>{{ $export->status }}</td>
                                <td>
                                    @if($export->status == 'FINISHED')
                                        <a class="text-sm" href="{{ route('admin.products.exports.file', $export->id) }}">file ready</a>
                                    @elseif ($export->status == 'PROCESSING')
                                        <span class="text-sm text-success">file not ready yet</a>
                                    @else
                                        <span class="text-sm text-warning">download failed</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <h5>Ups!, files not found</h5>
                        @endforelse
                    
                    </tbody>
                </table>
            @else
                <h5>¡Ups! you do not have exports</h5>
            @endif
        </div>
        <div class="card-footer">
            <a class="btn btn-success" href="{{ route('admin.products.module') }}">Back</a>
        </div>
    </div>
@endsection
