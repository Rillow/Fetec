@extends('main')
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<body class="hold-transition login-page">
<div class="login-box">
 <div class="login-logo">
    <b>F</b>etec
 </div>        
<div class="login-box-body">
<div class="row">
  <form method="POST" action="/auth/login">
      {!! csrf_field() !!}

      <div class="form-group has-feedback">
          
          <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" >
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
          
          <input class="form-control" type="password" name="password" id="password" placeholder="Senha">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
            <label class="custom-control custom-checkbox">
  <input type="checkbox" class="custom-control-input" name="remember" >
  <span class="custom-control-indicator"></span>
  <span class="custom-control-description">Lembre-se</span>
</label>
        </div>

      <div class="col-xs-4">
          <button class="btn btn-primary btn-block btn-flat" type="submit">Login</button>
      </div>
      </div>
  </form>
  <div class="social-auth-links text-center">
  </div>
</div>
</body>
@endsection
