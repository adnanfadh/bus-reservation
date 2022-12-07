@extends('Layout.v_template')

@section('title','Item Operasional')
@section('sub_title','Tambah Data Item Operasional')

@section('content')
    <a href="/item_opr" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/item_opr/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Item Operasional</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama_item" id="" class="form-control @error('nama_item') is-invalid @enderror" placeholder="Nama Item Operasional" value="{{ old('nama_item') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_item')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tipe Item Operasional</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="tipe_item" id="" class="form-control @error('tipe_item') is-invalid @enderror" placeholder="Tipe Item Operasional" value="{{ old('tipe_item') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('tipe_item')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">SKU</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="sku" id="" class="form-control @error('sku') is-invalid @enderror" placeholder="Stock keeping unit" value="{{ old('sku') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('sku')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Harga Satuan</label>
                </div>
                <div class="col-sm-6">
                  <input type="number" name="harga_satuan" id="" class="form-control @error('harga_satuan') is-invalid @enderror" placeholder="Harga Satuan" value="{{ old('harga_satuan') }}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('harga_satuan')
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
