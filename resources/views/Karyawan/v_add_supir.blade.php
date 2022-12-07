@extends('Layout.v_template')

@section('title','Karyawan')
@section('sub_title','Tambah Data Karyawan')

@section('content')
    <a href="/karyawan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/karyawan/insertSupir" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Nama</label>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" value="{{ old('nama') }}"aria-describedby="helpId">
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
                    <textarea name="alamat" id="" cols="5" rows="4" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>
                  <div class="text-danger">
                    @error('alamat')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Telepon</label>
                </div>
                <div class="col-sm-2">
                  <input type="text" name="telp" id="" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon" value="{{ old('telp') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('telp')
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
                  <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('email')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Password</label>
                </div>
                <div class="col-sm-6">
                  <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="{{ old('password') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('password')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Konfirmasi Password</label>
                </div>
                <div class="col-sm-6">
                  <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirmation" autofocus>
                  <div class="text-danger">
                    @error('password_confirmation')
                      {{$message}}
                    @enderror
                </div>
                <div class="text-danger">
                    @error('password')
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
                    <input type="text" name="nip" id="" class="form-control @error('nip') is-invalid @enderror" placeholder="Nomor Induk Pegawai" value="{{ old('nip') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('nip')
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
                  <input type="file" name="foto" id="" class="form-control @error('foto') is-invalid @enderror" placeholder="Foto" value="{{ old('foto') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('foto')
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
                    <select class="form-control select2" name="" id="tipe_unit" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipe as $data)
                        <option value='{{ $data->id }}' @if (old('id_unit') == $data->id ) selected @endif>{{$data->nama_tipe}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group" id='Booking Service' >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Unit Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2" name="id_unit" id="unit_kend" style="width: 100%;" placeholder='-- Pilih Unit --'>
                    </select>
                </div>
            </div>
            <div class="row">
                <button class="offset-md-3 btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
<script>

    $(document).ready(function () {
        $('#tipe_unit').on('change', function () {
            let id = $(this).val();
            $('#unit_kend').empty();
            $('#unit_kend').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: 'GetTipeUnitKendaraan/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#unit_kend').empty();
                $('#unit_kend').append(`<option value="0" disabled selected>-- Pilih Unit --</option>`);
                response.forEach(element => {
                    $('#unit_kend').append(`<option value="${element['id']}">${element['nama_unit']}</option>`);
                    });
                }
            });
        });
    });

</script>
@endsection
