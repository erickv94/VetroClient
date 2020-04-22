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
                        <th>Margin <small>(pret_b2c-pret_achizitie)/pret_b2c</small></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockAvaible as $stock)
                    <tr>
                        <td>{{ $stock->data_expirare }}</td>
                        <td>{{ $stock->cantitate }}</td>
                        <td>{{ $stock->pret_achizitie }} RON</td>
                        <td>{{round(($priceB2C-$stock->pret_achizitie)/$priceB2C,2)}}
                        </td>
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
<div class="row justify-content-center mb-3">
    <button class="btn btn-primary icon-btn" id="displayModalPrice" ><i
        class="fa fa-pencil"></i> Edit Product Price</button>
</div>
<div class="row">

    @if ($priceB2C)

    <div class="col-md-6">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Price From PetMart</h3>
                <p><button class="btn btn-primary icon-btn" id="petmart" data-site='petmart'><i
                            class="fa fa-pencil"></i>Add/Edit URL</button></p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="col-6">
                        <div class="widget-small info coloured-icon">
                            <i class="icon fa fa-briefcase  fa-3x"></i>
                            <div class="info">
                                <h4>Our Price</h4>
                                <p><b>
                                    {{ $priceB2C }} RON
                                </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="widget-small danger coloured-icon">
                            <i class="icon fa fa-briefcase fa-3x"></i>
                            <div class="info" id='petmart-id'>
                                <h4>Competition price</h4>
                                @if ($pricePetmart)
                                    <p><b>
                                        {{ $pricePetmart }}
                                    </b></p>
                                @else
                                <p><b>
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>URL not available or broken please edit
                                </b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Price From EMAG</h3>
                <p><button class="btn btn-primary icon-btn" id="emag" data-site='emag'><i
                            class="fa fa-pencil"></i>Add/Edit URL</button></p>
            </div>
            <div class="tile-body">

                    <div class="row">
                        <div class="col-6">
                            <div class="widget-small info coloured-icon">
                                <i class="icon fa fa-briefcase  fa-3x"></i>
                                <div class="info">
                                    <h4>Our Price</h4>
                                    <p><b>
                                        {{ $priceB2C }} RON
                                    </b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="widget-small danger coloured-icon">
                                <i class="icon fa fa-briefcase fa-3x"></i>
                                <div class="info" id='emag-id'>
                                    <h4>Competition price</h4>
                                    @if ($priceEmag)
                                        <p><b>
                                            {{ $priceEmag }}
                                        </b></p>
                                    @else
                                    <p><b>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>URL not available or broken please edit
                                    </b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

            </div>
        </div>


    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Price From Pentruanimale</h3>
                <p><button class="btn btn-primary icon-btn" id="pentruanimale" data-site='pentruanimale'><i
                            class="fa fa-pencil"></i>Add/Edit URL</button></p>
            </div>
            <div class="tile-body">
                <div class="row">
                    <div class="col-6">
                        <div class="widget-small info coloured-icon">
                            <i class="icon fa fa-briefcase  fa-3x"></i>
                            <div class="info">
                                <h4>Our Price</h4>
                                <p><b>
                                    {{ $priceB2C }} RON
                                </b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="widget-small danger coloured-icon">
                            <i class="icon fa fa-briefcase fa-3x"></i>
                            <div class="info" id='pentruanimale-id'>
                                <h4>Competition price</h4>
                                @if ($pricePetru)
                                    <p><b>
                                        {{ $pricePetru }}
                                    </b></p>
                                @else
                                <p><b>
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>URL not available or broken please edit
                                </b></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">

        <div class="tile">
            <div class="tile-title-w-btn">
                <h3 class="title">Price From Zooplus</h3>
                <p><button class="btn btn-primary icon-btn"><i class="fa fa-pencil"></i>Add/Edit URL</button></p>
            </div>
            <div class="tile-body">
                <h3 class="text-center"> <i class="fa fa-info-circle" aria-hidden="true"></i> Functionality not available yet</h3>
            </div>
        </div>
    </div>
</div>


@endif

<div id="Modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 id='site' class="text-center"><i class="fa fa-globe" aria-hidden="true"></i></h3>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id='hiden-data'>
                                <label for="">URL</label>
                                <input type="text" name="" id="url" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id='save-id'><i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Save</button>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    {{-- modal price --}}

    <div id="modalPrice" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 id='site' class="text-center"><i class="fa fa-refresh" aria-hidden="true"></i>Edit Price</h3>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" id='hiden-data'>
                                    <label for="">Price</label>
                                    <input type="number"
                                           step="0.01"
                                           name=""
                                           id="price-to-change"
                                           class="form-control"
                                           value={{ $priceB2C }} required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" id='sendPrice' data-vtex-id='{{$vtexId}}'><i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
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
    // needed for routes on app
    const id = "{{$id}}";
    const get_url = '/prices/geturl';
    const post_url = '/prices/posturl';
    // elements needed
    const siteElement = document.getElementById('site');
    const urlElement = document.getElementById('url');
    // crsf
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;



    document.getElementById('petmart').addEventListener('click', function (e) {
        const site = e.target.getAttribute('data-site');
        siteElement.textContent = 'PetMart';
        document.getElementById("hiden-data").value=site;

        fetch(`${get_url}/${id}?site=${site}`)
            .then(res => res.json())
            .then(data => {
                    urlElement.value = data;
                    $('#Modal').modal('show');
            })
            .catch(error => {
                    toastr.error('Something is wrong');
            });

    });

    document.getElementById('emag').addEventListener('click', function (e) {

        const site = e.target.getAttribute('data-site');
        siteElement.textContent = 'EMAG';
        document.getElementById("hiden-data").value=site;

        fetch(`${get_url}/${id}?site=${site}`)
            .then(res => res.json())
            .then(data => {
                    urlElement.value = data;
                    $('#Modal').modal('show');
            })
            .catch(error => {
                    toastr.error('Something is wrong');
            });
    })

    document.getElementById('pentruanimale').addEventListener('click', function (e) {
        const site = e.target.getAttribute('data-site');
        siteElement.textContent = 'PentruAnimale';
        document.getElementById("hiden-data").value=site;

        fetch(`${get_url}/${id}?site=${site}`)
            .then(res => res.json())
            .then(data => {
                    urlElement.value = data;
                    $('#Modal').modal('show');
            })
            .catch(error => {
                    toastr.error('Something is wrong');
            })

    });



    //save modals
    const btnSave= document.getElementById('save-id');
    btnSave.addEventListener('click', function(event){
        const site=document.getElementById("hiden-data").value;
        const url=document.getElementById('url').value;


        const setting= {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            },
            credentials: "same-origin",
            body: JSON.stringify({
                url,
                site
            })
        };

        fetch(`${post_url}/${id}`, setting)
            .then(res=> res.json())
            .then(data=> {
                toastr.success(data.message);
                let text=`<p><b>
                            <i class="fa fa-info-circle" aria-hidden="true"></i>URL not available or broken please edit
                        </b></p>`;
                if(data.priceCompetition){
                    text =`<h4>Competition price</h4><p><b> ${data.priceCompetition}</b></p>`;
                    document.getElementById(`${data.site}-id`).innerHTML=text;
                }
                else{
                    document.getElementById(`${data.site}-id`).innerHTML=text;
                }
                $('#Modal').modal('hide');
            })
            .catch(error=>{
                toastr.error('Something is wrong');
            });
    })

// change prices
document.getElementById('displayModalPrice').addEventListener('click',function(e){
    $('#modalPrice').modal('show');
});

document.getElementById('sendPrice').addEventListener('click',function(e){
    if(!confirm('Are you sure about change product price?')){
        return;
    }

    let id =e.target.getAttribute('data-vtex-id');

    // in case id doesn't exist we need to access from the child to the parent
    if(!id){
        id=e.target.parentElement.getAttribute('data-vtex-id');
    }

    const price= document.getElementById('price-to-change').value;

    const setting= {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            },
            credentials: "same-origin",
            body: JSON.stringify({
                id,
                price
            })
        };


    fetch(`/prices/changePrice`, setting)
        .then(res=> res.json())
        .then(data=> {
            toastr.success('Changes will take affect in a certain time.')
            toastr.success("Price is going to be updated on VTEX.");

            $('#modalPrice').modal('hide');
        })
        .catch(error=>{
            toastr.error('Something is wrong');
        });

});


</script>


@endsection

@endsection
