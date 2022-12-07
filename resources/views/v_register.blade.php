<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRW Trans</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- BS Stepper -->
 <link rel="stylesheet" href="{{asset('template')}}/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>DRW</b> Trans</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Daftar menjadi member baru DRW TRANS</p>

      <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class=" ">
              <div id="stepper2" class="bs-stepper">
                <div class="bs-stepper-header">
                  <div class="step" data-target="#test-nl-1">
                    <button type="button" class="btn step-trigger">
                      <span class="bs-stepper-circle">1</span>
                      <span class="bs-stepper-label">Profile</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#test-nl-2">
                    <div class="btn step-trigger">
                      <span class="bs-stepper-circle">2</span>
                      <span class="bs-stepper-label">Account</span>
                    </div>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#test-nl-3">
                    <button type="button" class="btn step-trigger">
                      <span class="bs-stepper-circle">3</span>
                      <span class="bs-stepper-label">Extra</span>
                    </button>
                  </div>
                </div>
                <div class="bs-stepper-content">
                  <div id="test-nl-1" class="content">
                    <h4 class="text-center">Data Diri</h4>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Nama Lengkap</label>
                          <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}"aria-describedby="helpId">
                          <div class="text-danger">
                            @error('nama')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="" cols="5" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>
                          <div class="text-danger">
                            @error('alamat')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Telepon</label>
                          <input type="text" name="telp" id="" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon" value="{{ old('telp') }}"aria-describedby="helpId">
                          <div class="text-danger">
                            @error('telp')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" onclick="stepper2.next()">Next</a>
                  </div>
                  <div id="test-nl-2" class="content">
                    <h4 class="text-center">Email & Password</h4>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Email</label>
                          <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"aria-describedby="helpId">
                          <div class="text-danger">
                            @error('email')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Password</label>
                          <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}"aria-describedby="helpId" autofocus>
                          <div class="text-danger">
                            @error('password')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Konfirmasi Password</label>
                          <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirmation" autofocus>
                          <div class="text-danger">
                            @error('password_confirmation')
                              {{$message}}
                            @enderror
                        </div>
                        <div class="text-danger">
                            @error('password')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" onclick="stepper2.previous()">Previous</a>
                    <a class="btn btn-primary" onclick="stepper2.next()">Next</a>

                  </div>
                  <div id="test-nl-3" class="content">
                    <h4 class="text-center">Lampiran</h4>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Foto</label>
                          <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" value="{{ old('foto') }}"aria-describedby="helpId">
                          <div class="text-danger">
                            @error('foto')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-12">
                          <label for="">Keterangan</label>
                          <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ old('keterangan') }}</textarea>
                          <div class="text-danger">
                            @error('keterangan')
                              {{$message}}
                            @enderror
                        </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" onclick="stepper2.previous()">Previous</a>
                    <button class="btn btn-success">Daftar</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      <!-- /.social-auth-links -->
      <p class="mb-0">
        <a href="{{ route('login')}}" class="text-center">Kembali ke Login</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
<!-- BS-Stepper -->
<script src="{{asset('template')}}/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<script>
    var stepper1Node = document.querySelector('#stepper2')
    var stepper2 = new Stepper(document.querySelector('#stepper2'))

    stepper1Node.addEventListener('show.bs-stepper', function (event) {
      console.warn('show.bs-stepper', event)
    })
    stepper1Node.addEventListener('shown.bs-stepper', function (event) {
      console.warn('shown.bs-stepper', event)
    })
  </script>
</body>
</html>
