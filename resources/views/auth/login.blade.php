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

<div class="row">
  <form method="POST" action="/auth/login">
      {!! csrf_field() !!}

      <div class="form-group">
          Email
          <input class="form-control" type="email" name="email" value="{{ old('email') }}">
      </div>

      <div class="form-group">
          Password
          <input class="form-control" type="password" name="password" id="password">
      </div>

      <div>
          <input type="checkbox" name="remember"> Remember Me
      </div>

      <div>
          <button class="btn btn-default" type="submit">Login</button>
      </div>
  </form>
</div>

@endsection
