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
                            <th>brand</th>
                            <th>Specificație</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                        <tr>
                          <td>{{$product->productId}}</td>
                          <td>{{$product->productName}}</td>
                          <td>{{$product->brand}}</td>
                          <td>
                            @foreach($product->Specificație as $spec)
                              <li>{{$spec}}</li>
                            @endforeach
                          </td>
                          <td>
                            <a  class="btn btn-info btn-xs text-light" ><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a  class="btn btn-primary btn-xs text-light" ><i class="fa fa-eye" aria-hidden="true"></i>See</a>
                            <!--<form method="POST" style="display:inline" >
                              <button  class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
                            </form>-->
                          </td>
                        </tr>
                        @endforeach
                        <nav aria-label="Page navigation example" center>
                          <ul class="pagination">
                            @if($totalPages > 1 )
                              @if($current_page >1)
                                <li class="page-item"><a class="page-link" href="{{route('products.index',['page' => $current_page-1])}}">Previous</a></li>
                              @endif
                              @if($current_page != $totalPages)
                                <li class="page-item"><a class="page-link" href="{{route('products.index',['page' => $current_page+1] )}}">Next</a></li>
                              @endif
                            @endif
                          </ul>
                        </nav>
                    </tbody>
                </table>
            </div>
            </div>
          </div>
</div>



@endsection