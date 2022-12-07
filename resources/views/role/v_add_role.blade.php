@extends('Layout.v_template')

@section('title','Role Akses')
@section('sub_title','Tambah Role Akses')

@section('content')
    <a href="/role" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/role/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama Role</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="role" id="" class="form-control @error('role') is-invalid @enderror" placeholder="Nama Role" value="{{ old('role') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('role')
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
