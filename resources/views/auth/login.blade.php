@extends('Layout.templateauth')

@section('content')
<div class="logo">
    <h1>Cauta vet</h1>
</div>
<div class="login-box">
    <form method="POST" action="{{ route('login') }}" class="login-form" >
        @csrf
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
        <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control @error('usuario') is-invalid @enderror @error('email') is-invalid @enderror"
                name="email" value="{{ old('email')}}" required autocomplete="usuario" autofocus placeholder="Enter email">

            @error('usuario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password" placeholder="Enter password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i
                    class="fa fa-sign-in fa-lg fa-fw"></i>{{ __('Ingresar') }}</button>
        </div>
    </form>

</div>
@endsection
