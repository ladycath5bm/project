@extends('adminlte::page')

@section('title', 'Blogkt')

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
                
                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'slug of category']) !!}
                </div>

                {!! Form::submit('Create', ['class' => 'btn btn-primary btn-sm']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop
