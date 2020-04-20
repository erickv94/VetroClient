@extends('Layout.layout') @section('titulo') Bienvenido @endsection @section('title_content')
<h1><i class="fa fa-dashboard"></i>Home</h1>
@endsection @section('breadcrumb')
<li class="breadcrumb-item"><a href="">Home</a></li>
@endsection @section('content')
<div class="tile">
    <div class="tile-body">
        <h3>Welcome {{ Auth::user()->name }} </h3>
    </div>
</div>

@endsection @section('custom_javas') @endsection
