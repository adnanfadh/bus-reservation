@extends('Layout.v_template')

@section('title','Karyawan')
@section('sub_title','Tambah Data Karyawan')

@section('content')
    <a href="/karyawan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/karyawan/insert" method="post" enctype="multipart/form-data">
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
                        <option value='{{ $data->id }}' @if (old('id_users') == $data->id ) selected @endif>{{$data->nama}}</option>
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
                  <label for="">Jabatan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan" style="width: 100%;">
                        <option value='' >-- Pilih --</option>
                        <option value='Administrator' @if (old('jabatan') == 'Administrator' ) selected @endif>Administrator</option>
                        <option value='Admin Office' @if (old('jabatan') == 'Admin Office' ) selected @endif>Admin Office</option>
                        @role('Administrator')
                        <option value='Admin Keuangan' @if (old('jabatan') == 'Admin Keuangan' ) selected @endif>Admin Keuangan</option>
                        @endrole
                        <option value='Admin Pool' @if (old('jabatan') == 'Admin Pool' ) selected @endif>Admin Pool</option>
                        <option value='Marketing' @if (old('jabatan') == 'Marketing' ) selected @endif>Marketing</option>
                        <option value='Supir' @if (old('jabatan') == 'Supir' ) selected @endif>Supir</option>
                    </select>
                  <div class="text-danger">
                    @error('jabatan')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div id="tipeUnit">
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
                  <label for="">Status</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="" style="width: 100%;">
                        <option value='' >-- Pilih --</option>
                        <option value='Aktif' @if (old('status') == 'Aktif' ) selected @endif>Aktif</option>
                        <option value='Non-Aktif' @if (old('status') == 'Non-Aktif' ) selected @endif>Non-Aktif</option>
                        <option value='Dinas' @if (old('status') == 'Dinas' ) selected @endif>Dinas</option>
                        <option value='Izin' @if (old('status') == 'Izin' ) selected @endif>Izin</option>
                        <option value='Sakit' @if (old('status') == 'Sakit' ) selected @endif>Sakit</option>
                        <option value='Cuti' @if (old('status') == 'Cuti' ) selected @endif>Cuti</option>
                        <option value='Libur' @if (old('status') == 'Libur' ) selected @endif>Libur</option>
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

@section('footer_scripts')
<script>

    $(function() {
        $('#tipeUnit').hide();
        //$('#unitKend').hide();
        $('#jabatan').change(function(){
            if ($('#jabatan').val() == "Supir") {
                $('#tipeUnit').show();
                //$('#unitKend').show();
            }
            //$('#' + $(this).val()).show();
        });
        $('#jabatan').change(function(){
            if ($('#jabatan').val() != "Supir") {
                $('#tipeUnit').hide();
                //$('#unitKend').show();
            }
            //$('#' + $(this).val()).show();
        });
    });

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
