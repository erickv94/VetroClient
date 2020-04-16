@extends('layout.layout')

@section('titulo')
Profile
@endsection


@section('title_content')
<h1><i class="fa fa-dashboard"></i>Profile </h1>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Profile</a></li>
@endsection

@section('content')
     <div class="tile">
            <div class="tile-body">
            @if(session()->has('msj'))
				<div class="alert alert-danger" role="alert">{{session('msj')}}</div>
			@endif
			@if(session()->has('info'))
				<div class="alert alert-success" role="alert">{{session('info')}}</div>
			@endif
              <h3>Profile</h3>
               <form action="{{ route('updateprofile',['id'=>$user->id]) }}" method="POST" >
              {{ method_field('PUT') }}
    			{{ csrf_field() }}
	               <div class="form-group">
		                <div class="row">
		                	<div class="col-6">
		                		<label class="control-label">Name</label>
		                		<input class="form-control" type="text" name="name" value="{{$user->name}}" >
		                	</div>
		                	<div class="col-6">
		                		<label class="control-label">Username</label>
		                		<input class="form-control" type="text" name="username" value="{{$user->username}}" >
		                		 @if ($errors->has('username'))
		                            <span class="help-block text-danger">
		                                <strong>{{ $errors->first('username') }}</strong>
		                            </span>
		                          @endif
		                	</div>
		                </div>
	            	</div>
	            	<div class="form-group">
		                <label class="control-label">Email</label>
		                <input class="form-control" type="email" name="email" value="{{$user->email}}" disabled>
	            	</div>

	            	<div class="form-group">
		                <div class="row">
		                	<div class="col-4">
			                	<label class="control-label">Current Password</label>
			                	<input class="form-control" type="password" name="currentPassword"  placeholder="Enter Current Password ">
			                	 @if ($errors->has('currentPassword'))
		                            <span class="help-block text-danger">
		                                <strong>{{ $errors->first('currentPassword') }}</strong>
		                            </span>
		                          @endif
			                    </div>
			                <div class="col-4">
			                	<label class="control-label">New Password</label>
			                	<input class="form-control" type="password" name="password"  placeholder="Enter New Password " autocomplete="new-password">
			                	 @if ($errors->has('password'))
		                            <span class="help-block text-danger">
		                                <strong>{{ $errors->first('password') }}</strong>
		                            </span>
		                          @endif
			                </div>
			                <div class="col-4">
			                	<label class="control-label">Repeat New password</label>
			                	<input class="form-control" type="password" name="password_confirmation"  placeholder="Enter New Password " autocomplete="password">

			                </div>
		                </div>
	            	</div>
	            	 <button class="btn btn-primary btn-block" type="submit">Update Profile</button>
            	</form>
            </div>
    </div>
@endsection

@section('custom_javas')
@endsection