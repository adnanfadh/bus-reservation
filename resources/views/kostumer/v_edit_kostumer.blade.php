@extends('Layout.v_template')

@section('title','Kostumer')
@section('sub_title','Edit Data Kostumer')

@section('content')
    <a href="/kostumer" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>


    <form action="/kostumer/update/{{$kostumer->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group">
                <div class=""></div>
                <div class="offset-md-1 col-sm-2">
                    <label for="" class=''>Nama Lengkap</label>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" aria-describedby="helpId" value="{{ $kostumer->nama }}">
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
                    <textarea rows="4" placeholder="Alamat Tempat Tinggal ..." name="alamat" id="" class="form-control @error('alamat') is-invalid @enderror" aria-describedby="helpId">{{ $kostumer->alamat }}</textarea>
                    <div class="text-danger">
                        @error('alamat')
                        {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                    <label for="">Nomer Telepon</label>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="no_telp" id="" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ $kostumer->no_telp }}"aria-describedby="helpId" autofocus>
                    <div class="text-danger">
                    @error('no_telp')
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
                    <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $kostumer->email }}"aria-describedby="helpId">
                    <div class="text-danger">
                    @error('email')
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
                    <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ $kostumer->keterangan }}</textarea>
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
