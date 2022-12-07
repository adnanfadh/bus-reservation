@extends('Layout.v_template')

@section('title','Crew')
@section('sub_title','Ubah Data Crew')

@section('content')
    <a href="/crew" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/crew/update/{{$crew->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Crew</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama_crew" id="" class="form-control @error('nama_crew') is-invalid @enderror" placeholder="Nama Crew" value="{{ $crew->nama_crew }}" aria-describedby="helpId">
                  <div class="text-danger">
                    @error('nama_crew')
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
