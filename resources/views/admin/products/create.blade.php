@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Crate new product</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.products.store']) !!}

                {!! Form::hidden('user_id', auth()->user()->id) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of product']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('code', 'Code') !!}
                    {!! Form::number('code', null, ['class' => 'form-control', 'placeholder' => 'Code of product']) !!}
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('stock', 'Stock') !!}
                    {!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Stock of product']) !!}
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description of product']) !!}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    
                </div>

                <div class="form-group">
                    {!! Form::label('price', 'Price') !!}
                    {!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Price of product']) !!}
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>    
                    @enderror
                </div>

                <div class="form-group">
                    <p class="font-weight-bold">Status</p>

                    <label class="mr-2">
                        {!! Form::radio('status', 0, true) !!}
                        Disable
                    </label>
                    <label class="mr-2">
                        {!! Form::radio('status', 1, true) !!}
                        Enabled
                    </label>
                    
                </div>

                {!! Form::submit('Create', ['class' => 'btn btn-success btn-sm']) !!}

            {!! Form::close() !!}
        </div>
        <div class="card-header">
            <a class="btn btn-dark btn-sm" href="{{ route('admin.products.index') }}">Back</a>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection