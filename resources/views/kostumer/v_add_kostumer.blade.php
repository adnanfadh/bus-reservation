@extends('Layout.v_template')

@section('title','Users')
@section('sub_title','Tambah Data User')

@section('content')
    <a href="/kostumer" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>
    <?php /*
    <form action="/kostumer/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Lengkap</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Alamat</label>
                </div>
                <div class="col-sm-6">
                    <textarea name="alamat" id="" cols="5" rows="4" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>
                  <div class="text-danger">
                    @error('alamat')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Telepon</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="telp" id="" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon" value="{{ old('telp') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('telp')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Email</label>
                </div>
                <div class="col-sm-6">
                  <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('email')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Password</label>
                </div>
                <div class="col-sm-6">
                  <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('password')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Konfirmasi Password</label>
                </div>
                <div class="col-sm-6">
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
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Foto</label>
                </div>
                <div class="col-sm-3">
                  <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" value="{{ old('foto') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('foto')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Keterangan</label>
                </div>
                <div class="col-sm-6">
                  <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ old('keterangan') }}</textarea>
                  <div class="text-danger">
                    @error('keterangan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row">
                <button class="offset-md-3 btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
     */?>
    <form action="/kostumer/insert" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12 mt-5">
          <h2>Registrasi</h2>
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
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Nama Lengkap</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}"aria-describedby="helpId">
                      <div class="text-danger">
                        @error('nama')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Alamat</label>
                    </div>
                    <div class="col-sm-6">
                        <textarea name="alamat" id="" cols="5" rows="4" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>
                      <div class="text-danger">
                        @error('alamat')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Telepon</label>
                    </div>
                    <div class="col-sm-2">
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
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Email</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"aria-describedby="helpId">
                      <div class="text-danger">
                        @error('email')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Password</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}"aria-describedby="helpId" autofocus>
                      <div class="text-danger">
                        @error('password')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Konfirmasi Password</label>
                    </div>
                    <div class="col-sm-6">
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
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Foto</label>
                    </div>
                    <div class="col-sm-3">
                      <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" value="{{ old('foto') }}"aria-describedby="helpId">
                      <div class="text-danger">
                        @error('foto')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Keterangan</label>
                    </div>
                    <div class="col-sm-6">
                      <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ old('keterangan') }}</textarea>
                      <div class="text-danger">
                        @error('keterangan')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <a class="btn btn-primary" onclick="stepper2.previous()">Previous</a>
                <button class="btn btn-success">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection

@section('footer_scripts')
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
@endsection
