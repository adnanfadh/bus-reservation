@extends('Layout.v_template')

@section('title','Tipe Kendaraan')
@section('sub_title','Tambah Data Tipe Kendaraan')

@section('content')
    <a href="/tipe_kend" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/tipe_kend/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Tipe Kendaraan</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama_tipe" id="" class="form-control @error('nama_tipe') is-invalid @enderror" placeholder="Nama Tipe Kendaraan" value="{{ old('nama_tipe') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_tipe')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">merk Tipe Kendaraan</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="merk" id="" class="form-control @error('merk') is-invalid @enderror" placeholder="merk Tipe Kendaraan" value="{{ old('merk') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('merk')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            {{-- <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jumlah Seats</label>
                </div>
                <div class="col-sm-1">
                  <input type="number" name="seats" id="" class="form-control @error('seats') is-invalid @enderror" placeholder="Jumlah Seats" value="{{ old('seats') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('seats')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div> --}}
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Fasilitas</label>
                </div>
                <div class="col-sm-6">
                    <textarea name="fasilitas" id="" cols="6" rows="4" class="form-control @error('fasilitas') is-invalid @enderror" placeholder="Rincian Fasilitas" value="{{ old('fasilitas') }}"aria-describedby="helpId" ></textarea>
                  <div class="text-danger">
                    @error('fasilitas')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Harga Tipe</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="harga_tipe" id="" class="form-control @error('harga_tipe') is-invalid @enderror" placeholder="Harga Tipe" value="{{ old('harga_tipe') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('harga_tipe')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Premi Supir</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="premi_supir" id="" class="form-control @error('premi_supir') is-invalid @enderror" placeholder="Premi Supir" value="{{ old('premi_supir') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('premi_supir')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Premi Kernet</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="premi_kernet" id="" class="form-control @error('premi_kernet') is-invalid @enderror" placeholder="Premi Kernet" value="{{ old('premi_kernet') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('premi_kernet')
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
