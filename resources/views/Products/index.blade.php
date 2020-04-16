@extends('Layout.layout')

@section('titulo')
Products
@endsection
@section('custom_css')
<link rel="stylesheet" href="/css/custom.css">
@endsection
@section('title_content')
<h1><i class="fa fa-dashboard"></i>Products</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">
                <form class="row mb-2 justify-content-center">
                    <div class="col-sm-5 ">
                        <input name='search' class="form-control" type="text" placeholder="Search" aria-label="Search" value="{{request('search')}}">
                    </div>
                    <div class="col-sm-2">
                        <input class="form-control btn btn-info" type="submit" placeholder="Search" aria-label="Search" value='Search'>
                    </div>
                </form>

              <div class="table-responsive" >
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>brand</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($products as $product)
                        <tr>
                          <td>
                            <img class='rounded-image' src="{{ $product->items[0]->images[0]->imageUrl }}" alt="" srcset="">
                          </td>
                          <td>{{$product->productId}}</td>
                          <td>{{$product->productName}}</td>
                          <td>{{$product->brand}}</td>

                          <td>
                          <a  class="btn btn-info btn-xs text-light" href="{{ route('products.edit', ['id'=>$product->productId]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            {{-- <a  class="btn btn-primary btn-xs text-light" ><i class="fa fa-eye" aria-hidden="true"></i>See</a> --}}
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" center>
                    <ul class="pagination justify-content-end">
                      @if($totalPages > 1 )
                        @if($current_page >1)
                          <li class="page-item"><a class="page-link" href="{{route('products.index',['search' => request('search'),'page' => $current_page-1])}}">Previous</a></li>
                        @endif
                        @if($current_page != $totalPages)
                          <li class="page-item"><a class="page-link" href="{{route('products.index',['search' => request('search') ,'page' => $current_page+1] )}}">Next</a></li>
                        @endif
                      @endif
                    </ul>
                  </nav>

            </div>
            </div>
          </div>
</div>



@endsection
