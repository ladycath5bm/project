@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-g text-gray-800">Add a role</h1>
@stop

@section('content')
  
    <div class="card">
        <div class="card-body">
            <p class="h5">Name: </p>
            <p class="form-control">{{ $user->name }}</p>
            <p class="h5">Rols:</p>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
                @foreach ($roles as $role)
                    <div>
                        <label>
                            {!! Form::radio('role', $role->id, null , ['class' => 'mr-1']) !!}
                            
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                {!! Form::submit('Assign', ['class' => 'btn btn-success mt-2']) !!}
                @error('role')
                        <span class="text-danger">{{ $message }}</span>    
                @enderror
            {!! Form::close() !!}
        </div>
    </div>

@endsection
