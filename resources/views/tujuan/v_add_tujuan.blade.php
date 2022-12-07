@extends('Layout.v_template')

@section('title','Tujuan')
@section('sub_title','Tambah Data Tujuan')

@section('content')
    <a href="/tujuan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/tujuan/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Tujuan</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama_tujuan" id="" class="form-control @error('nama_tujuan') is-invalid @enderror" placeholder="Nama Tujuan" value="{{ old('nama_tujuan') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_tujuan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kode Tujuan</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="kode_tujuan" id="" class="form-control @error('kode_tujuan') is-invalid @enderror" placeholder="Kode Nama Tujuan" value="{{ old('kode_tujuan') }}"aria-describedby="helpId" style="text-transform:uppercase" maxlength="5">
                  <div class="text-danger">
                    @error('kode_tujuan')
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
