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
@endsection

@section('content')
    <div class="tile">
            <div class="tile-body">
                <h3 class="tile-title"><i class="fa fa-paw" aria-hidden="true"></i> Logs</h3>

              <div class="table-responsive" >
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <tbody>
                       @foreach($users as $user)
                        <tr>
                          <td>{{$user->name}}</td>
                          <td>{{$user->username}}</td>
                          <td>
                          <a  class="btn btn-info btn-xs text-light"  href="{{ route('logs.show',['id'=>$user->id] )}}"><i class="fa fa-pencil" aria-hidden="true"></i> See Logs</a>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
               <div class="container ">
                  <div class="row justify-content-center">
                     {{ $users->links() }}
                  </div>
               </div>
          </div>
    </div>
@endsection
