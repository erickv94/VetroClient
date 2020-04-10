@extends('layout.layout')

@section('titulo')
Listado de Productos
@endsection

@section('title_content')
<h1><i class="fa fa-dashboard"></i>Listado de Productos</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">
              <div class="table-responsive" >
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>categoryId</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                        <tr>
                          <td>{{$product->productId}}</td>
                          <td>{{$product->productName}}</td>
                          <td>{{$product->brand}}</td>
                          <td>{{$product->categoryId}}</td>
                          <td>
                            <a  class="btn btn-info btn-xs" >Edit</a>
                            <form method="POST" style="display:inline" >
                              <button  class="btn btn-danger btn-xs" type="submit">Delete</button>

                            </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
          </div>
</div>



@endsection