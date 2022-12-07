@extends('Layout.v_template')

@section('title','Penjadwalan')
@section('sub_title','Tambah Data Penjadwalan')

@section('content')
    <a href="/penjadwalan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/penjadwalan/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Penjadwalan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jenis_jadwal') is-invalid @enderror" name="jenis_jadwal" id="jenis_jadwal" style="width: 100%;" readonly>
                        <!--option value='Booking' @if (old('jenis_jadwal') == 'Booking' ) selected @endif>Booking</option-->
                        <option value='Service' selected >Service</option>
                    </select>
                    <div class="text-danger">
                        @error('status')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>


            <div id="Booking">
                <div class="row form-group">
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Booking</label>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control select2 @error('id_booking') is-invalid @enderror" name="id_booking" id="" style="width: 100%;">
                            <option value="">-- pilih --</option>
                            @foreach ($booking as $data)
                            <option value='{{ $data->idbooking }}' @if (old('id_booking') == $data->idbooking ) selected @endif>{{$data->tgl_booking}} /
                            @if ($data->jenis_booking == "Mitra")
                            {{$data->jenis_booking}} - {{$data->nama_mitra}}
                            @else
                                {{$data->nama_kostumer}}
                            @endif </option>
                            @endforeach
                        </select>
                      <div class="text-danger">
                        @error('id_booking')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" id='Booking Service' >
                    <div class="offset-md-1 col-sm-2">
                      <label for="">Unit Kendaraan</label>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control select2 @error('id_unit') is-invalid @enderror" name="id_unit" id="unit_supir" style="width: 100%;">
                            <option value="">-- pilih --</option>
                            @foreach ($unit as $data)
                            <option value='{{ $data->id }}' @if (old('id_unit') == $data->id ) selected @endif>{{$data->nama_unit}} - {{$data->no_lambung}} ({{$data->jumlah_seats}})</option>
                            @endforeach
                        </select>
                      <div class="text-danger">
                        @error('id_unit')
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
                        <select class="form-control select2 " name="id_supir" id="supir" style="width: 100%;" placeholder='-- Pilih Unit --'>
                        </select>
                    <div class="text-danger">
                        @error('id_unit')
                        {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
            </div>

            <div id='Service'>

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tipe Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_unit') is-invalid @enderror" name="" id="tipe_unit" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipe as $data)
                        <option value='{{ $data->id }}' @if (old('id_unit') == $data->id ) selected @endif>{{$data->nama_tipe}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_unit')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Unit Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_unit') is-invalid @enderror" name="id_unit" id="unit_kend" style="width: 100%;" placeholder='-- Pilih Unit --'>
                    </select>
                  <div class="text-danger">
                    @error('id_unit')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jenis Operasional</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jenis_opr') is-invalid @enderror" name="jenis_opr" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        <option value='Service' @if (old('jenis_opr') == 'Service' ) selected @endif>Service di Bengkel</option>
                        <option value='Storing' @if (old('jenis_opr') == 'Storing' ) selected @endif>Service Storing</option>
                    </select>
                  <div class="text-danger">
                    @error('jenis_opr')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tanggal</label>
                </div>
                <div class="col-sm-2">
                  <input type="date" name="tgl_jadwal" id="" class="form-control @error('tgl_jadwal') is-invalid @enderror" value="{{ old('tgl_jadwal') }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('tgl_jadwal')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Durasi</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="durasi" id="" class="form-control @error('durasi') is-invalid @enderror" value="{{ old('durasi') }}" placeholder="Durasi" aria-describedby="helpId">
                  <div class="text-danger">
                    @error('durasi')
                      {{$message}}
                    @enderror
                  </div>
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
        $('#Booking').hide();
        $('#Service').show();
        $('#jenis_jadwal').change(function(){
            $('#Booking').hide();
            $('#Service').hide();
            $('#' + $(this).val()).show();
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

    $(document).ready(function () {
        $('#unit_supir').on('change', function () {
            let id = $(this).val();
            $('#supir').empty();
            $('#supir').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetSupirKend/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#supir').empty();
                $('#supir').append(`<option value="0" disabled selected>-- Pilih Unit --</option>`);
                response.forEach(element => {
                    $('#unit_kend').append(`<option value="${element['idSupir']}">${element['nama']}</option>`);
                    });
                }
            });
        });
    });

</script>
@endsection


