@extends('adminlte::page')

@section('title', 'Ecom')

@section('content_header')
    <h1 class="text-bold text-lg text-gray-800">Options</h1>
@stop

@section('content')
  
<div>
    <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <img class="card-img-top p-2" height="300px" src="https://thumbs.dreamstime.com/b/para-hacer-el-icono-de-la-lista-122371373.jpg" alt="">
              <div class="card-footer">
                  <a href="{{ route('admin.products.list') }}"><strong class=" text-center ">See your products here!</strong></a>
              </div>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top p-4" height="300px" src="https://image.freepik.com/free-icon/no-translate-detected_318-10042.jpg" alt="">
                <div class="card-footer">
                    <a href="{{ route('admin.products.module') }}"><strong class=" text-center ">Import or export products</strong></a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top p-4" height="300px" src="https://cdn-icons-png.flaticon.com/512/175/175297.png" alt="">
                <div class="card-footer">
                    <a href="{{ route('admin.products.reports') }}"><strong class=" text-center ">Generate reports</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
