@extends('Layout.v_template')

@section('title','Karyawan')
@section('sub_title','Edit Data Karyawan')

@section('content')
    <a href="/karyawan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>


    <form action="/karyawan/update/{{$karyawan->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama</label>
                </div>
                <div class="col-sm-3">
                <select class="form-control select2 @error('id_users') is-invalid @enderror" name="id_users" id="" style="width: 100%;">
                        <option value="">-- nama --</option>
                        @foreach ($users as $data)
                        <option value='{{ $data->id }}' @if ($karyawan->id_users == $data->id ) selected @endif>{{$data->nama}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_users')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">NIP</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="nip" id="" class="form-control @error('nip') is-invalid @enderror" placeholder="Nomor Induk Pegawai" value="{{ $karyawan->nip }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('nip')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jabatan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" id="" style="width: 100%;">
                        <option value='' >-- Pilih --</option>
                        <option value='Administrator' @if ($karyawan->jabatan == 'Administrator' ) selected @endif>Administrator</option>
                        <option value='Admin Office' @if ($karyawan->jabatan == 'Admin Office' ) selected @endif>Admin Office</option>
                        <option value='Admin Pool' @if ($karyawan->jabatan == 'Admin Pool' ) selected @endif>Admin Pool</option>
                        <option value='Marketing' @if ($karyawan->jabatan == 'Marketing' ) selected @endif>Marketing</option>
                        <option value='Supir' @if ($karyawan->jabatan == 'Supir' ) selected @endif>Supir</option>
                    </select>
                  <div class="text-danger">
                    @error('jabatan')
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
                  <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" value="{{ $karyawan->foto }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('foto')
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
                        <option value='' >-- Pilih --</option>
                        <option value='Aktif' @if ($karyawan->status == 'Aktif' ) selected @endif>Aktif</option>
                        <option value='Non-Aktif' @if ($karyawan->status == 'Non-Aktif' ) selected @endif>Non-Aktif</option>
                        <option value='Dinas' @if ($karyawan->status == 'Dinas' ) selected @endif>Dinas</option>
                        <option value='Izin' @if ($karyawan->status == 'Izin' ) selected @endif>Izin</option>
                        <option value='Sakit' @if ($karyawan->status == 'Sakit' ) selected @endif>Sakit</option>
                        <option value='Cuti' @if ($karyawan->status == 'Cuti' ) selected @endif>Cuti</option>
                        <option value='Libur' @if ($karyawan->status == 'Libur' ) selected @endif>Libur</option>
                    </select>
                  <div class="text-danger">
                    @error('akses')
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
