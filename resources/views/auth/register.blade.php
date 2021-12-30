@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register</p>

        <form method="POST" action="{{ route('register') }}" id="register" enctype="multipart/form-data">
          @csrf
          <div class="input-group mb-3">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" autocomplete="name"  autofocus placeholder="Full Name">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email"  autocomplete="email" placeholder="Email">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="mobile_number" type="number" class="form-control @error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" name="mobile_number" autocomplete="mobile_number" placeholder="Mobile Number">
            @error('mobile_number')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fa fa-phone" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="form-group radio-group">
            <label class="d-block">Select Gender</label>
            <div class="custom-control custom-radio d-inline-block mr-2">
              <input type="radio" id="male" value="male" name="gender" class="custom-control-input" />
              <label class="custom-control-label" for="male">Male</label>
            </div>
            <div class="custom-control custom-radio d-inline-block mr-2">
              <input type="radio" id="female" value="female" name="gender" class="custom-control-input" />
              <label class="custom-control-label" for="female">Female</label>
            </div>
          </div>
          @error('gender')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          <div class="input-group mb-3">
            <input type="file" name="image" class="form-control"/>
            @error('image')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password"  autocomplete="new-password" placeholder="Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="new-password" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">

            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <a href="{{route('login')}}" class="text-center">I already have a register</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>
@endsection
