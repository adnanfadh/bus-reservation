@extends('Layout.v_template')

@section('title','Users Profile')
@section('sub_title','Tambah Data Users Profile')

@section('content')
    <a href="/users_profile" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/users_profile/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama</label>
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

            <div class="row">
                <button class="offset-md-3 btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection
