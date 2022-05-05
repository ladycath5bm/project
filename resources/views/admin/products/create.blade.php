@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Create new product</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.products.store', 'files' => true]) !!}

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
                        {!! Form::radio('status', 'DISABLED', true) !!}
                        Disabled
                    </label>
                    <label class="mr-2">
                        {!! Form::radio('status', 'ENABLED', true) !!}
                        Enabled
                    </label>
                </div>
                <div class="row mb-2">
                    <div class="col mt-2 mb-2">
                        <img id ="image" width="400px" src="{{ asset('images/image.jpg') }}" alt="">
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('file', 'Image for product') !!}
                            {!! Form::file('file', ['class' => 'form-control-file']) !!}
                        </div>
                    </div>
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
        document.getElementById("file").addEventListener('change', changeImage);

        function changeImage(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("image").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection