@extends('Layout.layout')

@section('titulo')
Check prices
@endsection


@section('title_content')
<h1><i class="fa fa-dashboard"></i>Check Prices</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('prices.index')}}">Prices</a></li>
<li class="breadcrumb-item"><a href="{{route('prices.check',$data->id_produs)}}">Check Prices</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">

                {{ $data->den_produs }}

            </div>
            </div>
          </div>
</div>


@endsection
