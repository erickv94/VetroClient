@extends('Layout.layout')

@section('titulo')
Logs
@endsection
@section('custom_css')
<link rel="stylesheet" href="/css/custom.css">
@endsection
@section('title_content')
<h1><i class="fa fa-dashboard"></i>Logs</h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('logs.index')}}">Users</a></li>
<li class="breadcrumb-item"><a href="{{url()->current()}}">Log {{$user->name}}</a></li>
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">
                <h3 class="tile-title"><i class="fa fa-user" aria-hidden="true"></i> Logs  {{$user->name}}</h3>
                @if(sizeof($logs) > 0)
                	<div class="table-responsive" >
	                <table class="table text-center">
	                    <thead>
	                        <tr>
	                        	<th>Timestamp</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                       <tbody>
	                       @foreach($logs as $log)
	                        <tr>
	                       	<td>{{$log->created_at}}</td>
	                          <td>{{$log->action}}</td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
              	</div>
              	@else
              		<h4 >there are no logs</h4>
                @endif
              	 <div class="container ">
                  <div class="row justify-content-center">
                     {{ $logs->links() }}
                  </div>
               </div>
              	
          	</div>
    </div>
@endsection
