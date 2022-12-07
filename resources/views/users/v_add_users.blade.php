@extends('Layout.v_template')

@section('title','User')
@section('sub_title','Tambah Data User')

@section('content')
    <a href="/users" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/users/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama</label>
                </div>
                <div class="col-sm-6">
                <select class="form-control select2 @error('id_profile') is-invalid @enderror" name="id_profile" id="" style="width: 100%;">
                        <option value="">-- nama --</option>
                        @foreach ($profile as $data)
                        <option value='{{ $data->id }}' @if (old('id_profile') == $data->id ) selected @endif>{{$data->nama}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_profile')
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
                  <label for="">Akses</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('akses') is-invalid @enderror" name="akses" id="" style="width: 100%;">
                        <option value='' >-- Pilih --</option>
                        <option value='Karyawan' @if (old('akses') == 'Karyawan' ) selected @endif>Karyawan</option>
                        <option value='Kostumer' @if (old('akses') == 'Kostumer' ) selected @endif>Kostumer</option>
                    </select>
                  <div class="text-danger">
                    @error('akses')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="offset-md-1 col-sm-2">
                  <label for="">Role</label>
                </div>
                <div class="col-sm-6">
                  @foreach ( $role as $role_list )
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="role[]" value="{{$role_list->id}}" @if (old('level') == $role_list->id) checked @endif>
                        <label class="form-check-label">{{$role_list->role}}</label>
                    </div>
                  @endforeach

                  <div class="text-danger">
                    @error('level')
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
@endsection
