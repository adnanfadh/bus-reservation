@extends('Layout.v_template')

@section('title','Ubah Paket')

@section('content')
    <a href="/paket" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/paket/update/{{$paket->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Paket</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="nama_paket" id="" class="form-control @error('nama_paket') is-invalid @enderror" placeholder="Nama Paket" value="{{ $paket->nama_paket }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_paket')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jadwal</label>
                </div>
                <div class="col-sm-3">
                    <select class="form-control select2 @error('id_penjadwalan') is-invalid @enderror" name="id_penjadwalan" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($jadwal as $data)
                        <option value='{{ $data->id }}' @if ($paket->id_penjadwalan == $data->id ) selected @endif>{{$data->nama_jadwal}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_jadwal')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Nominal Harga</label>
                </div>
                <div class=" col-sm-2">
                  <input type="number" name="nominal_harga" id="" class="form-control @error('nominal_harga') is-invalid @enderror" placeholder="Nominal Harga" value="{{ $paket->nominal_harga }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('nominal_harga')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Keterangan</label>
                </div>
                <div class="col-sm-4">
                  <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ $paket->keterangan }}</textarea>
                  <div class="text-danger">
                    @error('keterangan')
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
                        <option value='Ada' @if ($paket->status == 'Ada' ) selected @endif>Ada</option>
                        <option value='Tidak Ada' @if ($paket->status == 'Tidak Ada' ) selected @endif>Tidak Ada</option>
                        <option value='Pending' @if ($paket->status == 'Pending' ) selected @endif>Pending</option>
                    </select>
                  <div class="text-danger">
                    @error('status')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <!--div id='form-1'></div-->
            <div class="row offset-md-3">
                <!--a class="btn btn btn-outline-info btn-sm" style="margin-right: 10px" id="add-btn">Tambah Form </a-->
                <button type='submit' class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection
