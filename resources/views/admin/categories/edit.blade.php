@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Edit category</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'PUT']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name of category']) !!}
                @error('name')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>

            {!! Form::submit('Update', ['class' => 'btn btn-success btn-sm']) !!}

        {!! Form::close() !!}
    </div>
</div>
@stop

