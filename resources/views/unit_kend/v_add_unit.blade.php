@extends('Layout.v_template')

@section('title','Unit Kendaraan')
@section('sub_title','Tambah Data Unit Kendaraan')

@section('content')
    <a href="/unit_kend" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/unit_kend/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Unit Kendaraan</label>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="nama_unit" id="" class="form-control @error('nama_unit') is-invalid @enderror" placeholder="Nama Unit Kendaraan" value="{{ old('nama_unit') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_unit')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tipe Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_tipe') is-invalid @enderror" name="id_tipe" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipe_kend as $tipe)
                        <option value='{{ $tipe->id }}' @if (old('id_tipe') == $tipe->id ) selected @endif>{{$tipe->nama_tipe}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_tipe')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jumlah Seats</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="jumlah_seats" id="" class="form-control @error('jumlah_seats') is-invalid @enderror" placeholder="Banyak Kursi" value="{{ old('jumlah_seats') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('jumlah_seats')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer AP</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="no_ap" id="" class="form-control @error('no_ap') is-invalid @enderror" placeholder="No. AP" value="{{ old('no_ap') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('no_ap')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer Rangka</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="no_rangka" id="" class="form-control @error('no_rangka') is-invalid @enderror" placeholder="No. Rangka" value="{{ old('no_rangka') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('no_rangka')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer Plat</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="no_plat" id="" class="form-control @error('no_plat') is-invalid @enderror" placeholder="Plat Nomer" value="{{ old('no_plat') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('no_plat')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer Uji</label>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="no_uji" id="" class="form-control @error('no_uji') is-invalid @enderror" placeholder="No. Uji" value="{{ old('no_uji') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('no_uji')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nomer Lambung</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="no_lambung" id="" class="form-control @error('no_lambung') is-invalid @enderror" placeholder="No. lambung" value="{{ old('no_lambung') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('no_lambung')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Masa Berlaku STNK</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="masa_berlaku_stnk" id="" class="form-control @error('masa_berlaku_stnk') is-invalid @enderror" value="{{ old('masa_berlaku_stnk') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('masa_berlaku_stnk')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Masa Berlaku Pajak</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="masa_berlaku_pajak" id="" class="form-control @error('masa_berlaku_pajak') is-invalid @enderror" value="{{ old('masa_berlaku_pajak') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('masa_berlaku_pajak')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Masa Berlaku KIR</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="masa_berlaku_kir" id="" class="form-control @error('masa_berlaku_kir') is-invalid @enderror" value="{{ old('masa_berlaku_kir') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('masa_berlaku_kir')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kode GPS</label>
                </div>
                <div class="col-sm-3">
                  <input type="text" name="kode_gps" id="" class="form-control @error('kode_gps') is-invalid @enderror" placeholder="Kode GPS" value="{{ old('kode_gps') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('kode_gps')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Supir</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_supir') is-invalid @enderror" name="id_supir" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($supir as $supirData)
                        <option value='{{ $supirData->idSupir }}' @if (old('id_supir') == $supirData->idSupir ) selected @endif>{{$supirData->nama}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_supir')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Helper</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_crew') is-invalid @enderror" name="id_crew" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($crew as $crewData)
                        <option value='{{ $crewData->id }}' @if (old('id_crew') == $crewData->id ) selected @endif>{{$crewData->nama_crew}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_crew')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jarak Perjalanan</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="jarak_perjalanan" id="" class="form-control @error('jarak_perjalanan') is-invalid @enderror" placeholder="Jarak Perjalanan" value="{{ old('jarak_perjalanan') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('jarak_perjalanan')
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
                        <option value="">-- pilih --</option>
                        <option value='Tersedia' @if (old('status') == 'Tersedia' ) selected @endif>Tersedia</option>
                        <option value='Tidak Tersedia' @if (old('status') == 'Tidak Tersedia' ) selected @endif>Tidak Tersedia</option>
                        <option value='Perbaikan' @if (old('status') == 'Perbaikan' ) selected @endif>Perbaikan</option>
                    </select>
                  <div class="text-danger">
                    @error('status')
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
