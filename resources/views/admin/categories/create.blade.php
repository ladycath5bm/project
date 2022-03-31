@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Create new category</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.categories.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name of category']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>

                {!! Form::submit('Create', ['class' => 'btn btn-success btn-sm']) !!}
                
            {!! Form::close() !!}
            <a class="btn btn-dark btn-sm float-left mt-2" href="{{ route('admin.categories.index') }}">Back</a>
            
        </div>
        
    </div>
    
@stop
