@extends('Layout.layout')

@section('titulo')
Check prices
@endsection


@section('title_content')
<h1><i class="fa fa-paw" aria-hidden="true"></i> {{ $productSku->den_produs }}</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('prices.index')}}">Prices</a></li>
<li class="breadcrumb-item"><a href="{{route('prices.check',$productSku->id_produs)}}">Check Prices</a></li>
@endsection

@section('content')

<div class="row my-1">
    <div class="col-md-3">
        <div class="widget-small info coloured-icon">
            <i class="icon fa fa-briefcase fa-3x"></i>
            <div class="info">
                <h4>Price B2B</h4>
                <p><b>{{ $productSku->pret_vanzare }} RON</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 ">
        <div class="widget-small warning coloured-icon">
            <i class="icon fa fa-user fa-3x"></i>
            <div class="info">
                <h4>Price B2C</h4>
                <p><b>@if ($priceB2C)
                    {{ $priceB2C }} RON
                @else
                    Product not available in store
                @endif</b></p>
            </div>
        </div>
    </div>

    @if ($priceWithDiscount)

    <div class="col-md-3 ">
        <div class="widget-small primary coloured-icon">
            <i class="icon fa fa-tags fa-3x"></i>
            <div class="info">
                <h4>Price with discount</h4>
                <p><b>
                    {{ $priceWithDiscount }} RON
                </b></p>
            </div>
        </div>
    </div>

    <div class="col-md-3 ">
        <div class="widget-small danger coloured-icon">
            <i class="icon fa fa-percent fa-3x"></i>
            <div class="info">
                <h4>Percent discount</h4>
                <p><b>
                    {{ $percentDiscount*100 }} %
                </b></p>
            </div>
        </div>
    </div>
    @endif


</div>
<div class="tile">

    <div class="tile-body">

        @if ($stockAvaible)
        <h4 class="text-center"> <i class="fa fa-archive" aria-hidden="true"></i> Stock </h4>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" id="dataTable">
                <thead>
                    <tr>
                        <th>Expiration Date</th>
                        <th>Quantity</th>
                        <th>Adquisition price</th>
                        <th>Margin <small>(pret_vanzare-pret_achizitie)/pret_vanzare</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockAvaible as $stock)
                    <tr>
                        <td>{{ $stock->data_expirare }}</td>
                        <td>{{ $stock->cantitate }}</td>
                        <td>{{ $stock->pret_achizitie }} RON</td>
                        <td>{{round(($productSku->pret_vanzare-$stock->pret_achizitie)/$productSku->pret_vanzare,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <h4 class="text-center"> <i class="fa fa-exclamation" aria-hidden="true"></i> Stock not available </h4>
        @endif




    </div>

</div>
{{-- <h4 class="text-center"> <i class="fa fa-info-circle" aria-hidden="true"></i> Product information </h4> --}}

</div>
@section('custom_javas')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#dataTable').DataTable({
        languaje: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Romanian.json",
        }
    });

</script>


@endsection

@endsection
