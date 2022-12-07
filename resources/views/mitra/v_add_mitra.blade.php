@extends('Layout.v_template')

@section('title','Mitra')
@section('sub_title','Tambah Data Mitra')

@section('content')
    <a href="/mitra" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/mitra/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group">
                <div class="offset-md-1 col-sm-2">
                  <label for="" class=''>Nama Mitra</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama_mitra" id="" class="form-control @error('nama_mitra') is-invalid @enderror" placeholder="Nama Mitra" aria-describedby="helpId" value="{{ old('nama_mitra') }}">
                  <div class="text-danger">
                      @error('nama_mitra')
                        {{$message}}
                      @enderror
                  </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="offset-md-1 col-sm-2">
                  <label for="" class=''>Penanggung Jawab</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="penanggung_jawab" id="" class="form-control @error('penanggung_jawab') is-invalid @enderror" placeholder="Penanggung Jawab" aria-describedby="helpId" value="{{ old('penanggung_jawab') }}">
                  <div class="text-danger">
                      @error('penanggung_jawab')
                        {{$message}}
                      @enderror
                  </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Alamat Mitra</label>
                </div>
                <div class="col-sm-6">

                  <textarea rows="4" placeholder="Alamat Mitra ..." name="alamat_mitra" id="" class="form-control @error('alamat_mitra') is-invalid @enderror" aria-describedby="helpId">{{ old('alamat_mitra') }}</textarea>
                  <div class="text-danger">
                    @error('alamat_mitra')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer Telepon Mitra</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="no_telp_mitra" id="" class="form-control @error('no_telp_mitra') is-invalid @enderror" placeholder="Nomor Telepon Mitra" value="{{ old('no_telp_mitra') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('no_telp_mitra')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Email Mitra</label>
                </div>
                <div class="col-sm-6">
                  <input type="email" name="email_mitra" id="" class="form-control @error('email_mitra') is-invalid @enderror" placeholder="Email Mitra" value="{{ old('email_mitra') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('email_mitra')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kemitraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('kemitraan') is-invalid @enderror" name="kemitraan" id="" style="width: 100%;">
                        <option value='' >-- Pilih --</option>
                        <option value='Pool Bis' @if (old('kemitraan') == 'Pool Bis' ) selected @endif>Pool Bis</option>
                        <option value='Travel Agent' @if (old('kemitraan') == 'Travel Agent' ) selected @endif>Travel Agent</option>
                        <option value='Owner' @if (old('kemitraan') == 'Owner' ) selected @endif>Owner</option>
                    </select>
                  <div class="text-danger">
                    @error('kemitraan')
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
@endsection
