@extends('Layout.v_template')

@section('title','Pengajuan Dana')
@section('sub_title','Tambah Data Pengajuan Dana')

@section('content')
    <a href="/pengajuan_dana" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/pengajuan_dana/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tanggal Pengajuan Dana</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="tgl_pengajuan" id="" class="form-control @error('tgl_pengajuan') is-invalid @enderror" value="{{ date("Y-m-d") }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('tgl_pengajuan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jenis Pengajuan Dana</label>
                </div>
                <div class="col-sm-2">
                    <select name="jenis_pengajuan" id="" class="form-control select2 @error('jenis_pengajuan') is-invalid @enderror" >
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="Perjalanan" @if (old('jenis_pengajuan') == 'Perjalanan' ) selected @endif>Perjalanan</option>
                        <option value="Perbaikan" @if (old('jenis_pengajuan') == 'Perbaikan' ) selected @endif>Perbaikan</option>
                        <option value="Umum" @if (old('jenis_pengajuan') == 'Umum' ) selected @endif>Umum</option>
                    </select>
                  <div class="text-danger">
                    @error('jenis_pengajuan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Pengajuan Dana</label>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="nama_pengajuan" id="" class="form-control @error('nama_pengajuan') is-invalid @enderror" placeholder="Nama Pengajuan Nomer" value="{{ old('nama_pengajuan') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('nama_pengajuan')
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
                  <textarea rows="4" placeholder="Keterangan ..." name="rincian_pengajuan" id="" class="form-control @error('rincian_pengajuan') is-invalid @enderror" aria-describedby="helpId">{{ old('rincian_pengajuan') }}</textarea>
                  <div class="text-danger">
                    @error('rincian_pengajuan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nominal Pengajuan Dana</label>
                </div>
                <div class="col-sm-6">
                    <input type="number" name="nominal" id="" class="form-control @error('nominal') is-invalid @enderror" placeholder="Nominal Pengajuan Nomer" value="{{ old('nominal') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('nominal')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Status</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="" style="width: 100%;">
                        <option value='Pending' @if (old('status') == 'Pending' ) selected @endif>Pending</option>
                        <option value='Tidak Disetujui' @if (old('status') == 'Tidak Disetujui' ) selected @endif>Tidak Disetujui</option>
                        <option value='Disetujui' @if (old('status') == 'Disetujui' ) selected @endif>Disetujui</option>
                        <option value='Perbaiki' @if (old('status') == 'Perbaiki' ) selected @endif>Perbaiki</option>
                    </select>
                  <div class="text-danger">
                    @error('status')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">User Pengajuan</label>
                </div>
                <div class="col-sm-2">
                    @foreach ($info_user as $data)
                        @if ($data->idUsers == Auth::user()->id)
                        <input type="hidden" name="id_karyawan" value="{{ $data->idKaryawan }}" >
                        <input type="text" name="" id="" class="form-control" value="{{ $data->nama }}"aria-describedby="helpId" readonly>
                        @endif
                    @endforeach
                  <div class="text-danger">
                    @error('id_karyawan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tanggal Konfirmasi Pengajuan Dana</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="tgl_konfirmasi" id="" class="form-control @error('tgl_konfirmasi') is-invalid @enderror" value="{{ old('tgl_konfirmasi') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('tgl_konfirmasi')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">User Konfirmasi Pengajuan</label>
                </div>
                <div class="col-sm-2">
                    <input type="hidden" name="id_user_konfir" value="{{ Auth::user()->id }}" >
                    <input type="text" name="" id="" class="form-control"  value="{{ Auth::user()->name }}"aria-describedby="helpId" readonly>
                    <div class="text-danger">
                        @error('id_user_konfir')
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
