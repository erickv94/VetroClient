@extends('Layout.layout')

@section('titulo')
Products
@endsection
@section('custom_css')
<link rel="stylesheet" href="/css/custom.css">

<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('title_content')
<h1><i class="fa fa-dashboard"></i>Prices</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('prices.index')}}">Prices</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">

              <div class="table-responsive" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Price B2C</th>
                        <th>Price B2B</th>
                        <th>Managed</th>
                        <th>Actions</th>

                      </tr>
                    </thead>

                  </table>


            </div>
            </div>
          </div>
</div>

@section('custom_javas')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>

    $(document).ready(function() {
      $('#dataTable').DataTable({
        "ajax":"{{route('prices.load_data')}}",
        "processing":true,
        "language":
            {

                "url":"https://cdn.datatables.net/plug-ins/1.10.20/i18n/Romanian.json",

        },
        "columnDefs": [ {
            "targets": -1,
            "data": "download_link",
            "render": function ( data, type, full, meta ) {
                    return '<a class="btn btn-info btn-xs text-light" href="/prices/'+data.id_produs+'"><i class="fa fa-eye" aria-hidden="true"></i> Check Prices</a>';     }
        }
        ],
        "columns":[
            {"data":"den_produs"},
            {"data":"pret_vanzare_tva"},
            {"data":"pret_vanzare"},
            {"data":"den_gestiune"},
            {"data":null,}
        ]
      });
    });


</script>

@endsection

@endsection
