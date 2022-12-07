@extends('Layout.v_template')

@section('title','Penjadwalan')
@section('sub_title','Ubah Data Penjadwalan')

@section('content')
    <a href="/penjadwalan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/penjadwalan/update/{{$jadwal->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Penjadwalan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jenis_jadwal') is-invalid @enderror" name="jenis_jadwal" id="jenis_jadwal" style="width: 100%;" readonly>
                    @if ($jadwal->jenis_jadwal == 'Booking')
                        <option value='Booking' selected >Booking</option>
                    @elseif ($jadwal->jenis_jadwal == 'Service')
                        <option value='Service' selected>Service</option>
                    @endif
                    </select>
                    <div class="text-danger">
                        @error('status')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            @if ($jadwal->jenis_jadwal == 'Booking')
            <div class="row form-group">
                <div class="offset-md-1 col-sm-2">
                  <label for="">Booking</label>
                </div>
                <div class="col-sm-6">
                    <select class="form-control select2 @error('id_booking') is-invalid @enderror" name="id_booking" id="" style="width: 100%;" readonly>
                        <option value="" disabled>-- pilih --</option>
                        @foreach ($booking as $data)
                            <option value='{{ $data->idbooking }}' @if ($jadwal->id_booking == $data->idbooking ) selected @else disabled @endif>
                                Tanggal : {{$data->tgl_booking}} |
                                @if ($data->jenis_booking == "Mitra")
                                    {{$data->jenis_booking}} - {{$data->nama_mitra}}
                                @else
                                    {{$data->nama_kostumer}}
                                @endif
                                | Keberangkatan :
                                @if ($hargaTujuan->id == $data->id_hargatujuan)
                                    @foreach ($tujuan as $dataTujuan)
                                        @if ($hargaTujuan->idTujuan_awal == $dataTujuan->id)
                                        {{ $dataTujuan->nama_tujuan }}
                                        @endif
                                    @endforeach
                                    | Tujuan :
                                    @foreach ($tujuan as $dataTujuan)
                                        @if ($hargaTujuan->idTujuan_akhir == $dataTujuan->id)
                                        {{ $dataTujuan->nama_tujuan }}
                                        @endif
                                    @endforeach
                                @endif
                            </option>
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
                <div class="col-sm-3">
                    <select class="form-control select2 @error('id_unit') is-invalid @enderror" name="id_unit" id="unit_supir_helper" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipeUnit as $data)
                        <option value='{{ $data->id }}' @if ($jadwal->id_unit == $data->id ) selected @endif>{{$data->nama_unit}} - {{$data->no_lambung}} ({{$data->jumlah_seats}})</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_unit')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            @if ($keteranganBook == "Unit Only")

            @else

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">BBM</label>
                </div>
                <div class="col-sm-3">
                        <input type="number" name="bahan_bakar" id="bbm" class="form-control @error('bahan_bakar') is-invalid @enderror" value="{{$jadwal->bahan_bakar}}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('bahan_bakar')
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
                    @if ($jadwal->id_supir == null)
                        <select class="form-control select2 " name="id_supir[]" id="supir" style="width: 100%;" placeholder='-- Pilih Unit --'>
                            <option value="" disabled selected>-- pilih --</option>
                        </select>
                    @else
                        <select class="form-control select2 " name="id_supir[]" id="supir" style="width: 100%;">
                            <option value="" disabled>-- pilih --</option>
                            @foreach ($supir as $data)
                                <option value='{{ $data->idSupir }}' @if ($jadwal->id_supir == $data->idSupir ) selected @endif>{{$data->nama}} ({{$data->status}})</option>
                            @endforeach
                        </select>
                    @endif
                <div class="text-danger">
                    @error('id_supir')
                    {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            @if ($hargaTujuan->jum_supir > 1)
            <?php
                $arraySupir= explode (",",$jadwal->idsupir);
                //dd(count($arraySupir));
            ?>
             @if (isset($arraySupir[1]) == false)

             <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                <label for="">Supir 2</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 " name="id_supir[]" id="supir2" style="width: 100%;" placeholder='-- Pilih Unit --'>
                            <option value="" disabled selected>-- pilih --</option>
                    </select>
                <div class="text-danger">
                    @error('id_supir')
                    {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            @else
            @for ($i=1; $i < count($arraySupir); $i++)

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                <label for="">Supir 2</label>
                </div>
                <div class="col-sm-2">
                        <select class="form-control select2 " name="id_supir[]" id="supir2" style="width: 100%;">
                            <option value="" disabled>-- pilih --</option>
                            @foreach ($supirData as $data)
                                <option value='{{ $data->idSupir }}' @if ($arraySupir[$i] == $data->idSupir ) selected @endif>{{$data->nama}} ({{$data->status}})</option>
                            @endforeach
                        </select>
                <div class="text-danger">
                    @error('id_supir')
                    {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            @endfor
         @endif
        @endif
        <div class="row form-group" >
            <div class="offset-md-1 col-sm-2">
              <label for="">Premi Supir</label>
            </div>
            <div class="col-sm-3">
                    <input type="number" name="premi_supir" id="premi_supir" class="form-control @error('premi_supir') is-invalid @enderror" value="{{$tipeKend->premi_supir}}"aria-describedby="helpId" >
              <div class="text-danger">
                @error('premi_supir')
                  {{$message}}
                @enderror
              </div>
            </div>
        </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                <label for="">Potongan Supir</label>
                </div>
                <div class="col-sm-3">
                        <input type="number" name="potongan_supir" id="potongan_supir" class="form-control @error('potongan_supir') is-invalid @enderror" value="{{$jadwal->potongan_supir}}"aria-describedby="helpId" oninput="potonganSupir()">
                <div class="text-danger">
                    @error('potongan_supir')
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
                    @if ($jadwal->id_crew == null)
                        <select class="form-control select2 " name="id_crew[]" id="helper" style="width: 100%;" placeholder='-- Pilih Unit --'>
                            <option value="" disabled selected>-- pilih --</option>
                        </select>
                    @else
                        <select class="form-control select2 " name="id_crew[]" id="helper" style="width: 100%;">
                            <option value="" disabled>-- pilih --</option>
                            @foreach ($crewData as $data)
                                <option value='{{ $data->idCrew }}' @if ($jadwal->id_crew == $data->idCrew ) selected @endif>{{$data->nama_crew}}</option>
                            @endforeach
                        </select>
                    @endif
                <div class="text-danger">
                    @error('id_crew')
                    {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            @if ($hargaTujuan->jum_kernet > 1)

             <?php
                $arrayCrew = explode (",",$jadwal->idcrew);
                //dd(isset($arrayCrew[1]));
             ?>

             @if (isset($arrayCrew[1]) == false)

                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                    <label for="">Helper 2</label>
                    </div>
                    <div class="col-sm-2">
                            <select class="form-control select2 " name="id_crew[]" id="helper2" style="width: 100%;" placeholder='-- Pilih Unit --'>
                                <option value="" disabled selected>-- pilih --</option>
                            </select>
                    <div class="text-danger">
                        @error('id_crew')
                        {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
             @else
             @for ($i=1; $i < count($arrayCrew); $i++)
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                    <label for="">Helper 2</label>
                    </div>
                    <div class="col-sm-2">
                            <select class="form-control select2 " name="id_crew[]" id="helper2" style="width: 100%;">
                                <option value="" disabled>-- pilih --</option>
                                @foreach ($crew as $data)
                                    <option value='{{ $data->idCrew }}'  @if ($arrayCrew[$i] == $data->id) ) selected @endif>{{$data->nama_crew}}</option>
                                @endforeach
                            </select>
                    <div class="text-danger">
                        @error('id_crew')
                        {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
             @endfor

             @endif
            @endif

            @endif
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Premi Helper</label>
                </div>
                <div class="col-sm-3">
                        <input type="number" name="premi_helper" id="premi_kernet" class="form-control @error('premi_helper') is-invalid @enderror" value="{{$tipeKend->premi_kernet}}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('premi_helper')
                      {{$message}}
                    @enderror
                  </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Potongan Helper</label>
                </div>
                <div class="col-sm-3">
                        <input type="number" name="potongan_helper" id="potongan_kernet" class="form-control @error('potongan_helper') is-invalid @enderror" value="{{$jadwal->potongan_helper}}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('potongan_helper')
                      {{$message}}
                    @enderror
                  </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kas & Tabungan Perusahaan</label>
                </div>
                <div class="col-sm-3">
                        <input type="number" name="kas_tabungan" id="kas_tabungan" class="form-control @error('kas_tabungan') is-invalid @enderror" value="{{$jadwal->kas_tabungan}}"aria-describedby="helpId" >
                  <div class="text-danger">
                    @error('kas_tabungan')
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
                   @foreach ($booking as $data)
                    @if ($jadwal->id_booking == $data->idbooking )
                        <input type="date" name="tgl_jadwal" id="" class="form-control @error('tgl_jadwal') is-invalid @enderror" value="{{$data->tgl_booking}}"aria-describedby="helpId" readonly>
                     @endif
                   @endforeach
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
                <div class="col-sm-1">
                    @foreach ($booking as $data)
                    @if ($jadwal->id_booking == $data->idbooking )
                        <input type="number" name="durasi" id="" class="form-control @error('durasi') is-invalid @enderror" value="{{$data->lama_booking}}"aria-describedby="helpId" readonly>
                     @endif
                   @endforeach
                  <div class="text-danger">
                    @error('durasi')
                      {{$message}}
                    @enderror
                  </div>
                </div>
            </div>
        </div>

        <div class="row form-group" >
            <div class="offset-md-1 col-sm-2">
              <label for="">Jam Standby</label>
            </div>
            <div class="col-sm-2">
                <input type="time" name="jam_standby" id="" class="form-control @error('jam_standby') is-invalid @enderror" value= @if ($jadwal->jam_standby != null){{$jadwal->jam_standby}} @else {{ old('jam_standby') }} @endif
                aria-describedby="helpId">
              <div class="text-danger">
                @error('jam_standby')
                  {{$message}}
                @enderror
            </div>
            </div>
        </div>
        <div class="row form-group" >
            <div class="offset-md-1 col-sm-2">
              <label for="">Rute</label>
            </div>
            <div class="col-sm-5">
              <textarea rows="2" placeholder="Rute Perjalanan" name="rute" id="" class="form-control @error('rute') is-invalid @enderror" aria-describedby="helpId">@if ($jadwal->rute != null){{$jadwal->rute}} @else {{ old('rute') }} @endif</textarea>
              <div class="text-danger">
                @error('rute')
                  {{$message}}
                @enderror
            </div>
            </div>
        </div>
        <div class="row form-group" >
            <div class="offset-md-1 col-sm-2">
              <label for="">Catatan</label>
            </div>
            <div class="col-sm-4">
              <textarea rows="2" placeholder="Catatan Perjalanan" name="catatan" id="" class="form-control @error('catatan') is-invalid @enderror" aria-describedby="helpId">@if ($jadwal->catatan != null){{$jadwal->catatan}} @else {{ old('catatan') }} @endif</textarea>
              <div class="text-danger">
                @error('catatan')
                  {{$message}}
                @enderror
            </div>
            </div>
        </div>

            @else

            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tipe Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_unit') is-invalid @enderror" name="" id="tipe_unit" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipe as $data)
                        <option value='{{ $data->id }}' @if ($idtipe == $data->id ) selected @endif>{{$data->nama_tipe}}</option>
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
                        @foreach ($unit as $data)
                            <option value='{{ $data->id }}' @if ($jadwal->id_unit == $data->id ) selected @endif>{{$data->nama_unit}}</option>
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
                  <label for="">Jenis Operasional</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jenis_opr') is-invalid @enderror" name="jenis_opr" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        <option value='Service' @if ($operasi->jenis_opr == 'Service' ) selected @endif>Service di Bengkel</option>
                        <option value='Storing' @if ($operasi->jenis_opr == 'Storing' ) selected @endif>Service Storing</option>
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
                  <input type="date" name="tgl_jadwal" id="" class="form-control @error('tgl_jadwal') is-invalid @enderror" value="{{ $jadwal->tgl_jadwal }}"aria-describedby="helpId">
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
                  <input type="number" name="durasi" id="" class="form-control @error('durasi') is-invalid @enderror" value="{{ $jadwal->durasi }}" placeholder="Durasi" aria-describedby="helpId">
                  <div class="text-danger">
                    @error('durasi')
                      {{$message}}
                    @enderror
                  </div>
                </div>
            </div>
            @endif

            <div class="row">
                <button class="offset-md-3 btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
<script>

    /*let bbm = parseInt(document.getElementById("bbm").value);
    let premi_supir = parseInt(document.getElementById("premi_supir").value);
    let premi_kernet = parseInt(document.getElementById("premi_kernet").value);
    function potonganSupir(){
        let potongan_supir = parseInt(document.getElementById("potongan_supir").value);
        console.log(potongan_supir);
    }
    //if (document.getElementById("potongan_supir") != null){}
    if (document.getElementById("potongan_kernet") != null){
        let potongan_kernet = parseInt(document.getElementById("potongan_kernet").value);
    }
    if (document.getElementById("kas_tabungan") != null){
        let kas_tabungan = parseInt(document.getElementById("kas_tabungan").value);
    }
    if (document.getElementById("supir2") != null){
        premi_supir = premi_supir * 2;
    }
    console.log(bbm,premi_supir,premi_kernet);
    let total_kas_keluar = bbm + premi_supir  + premi_kernet;
    console.log(total_kas_keluar);
    console.log(total_kas_keluar-potongan_supir );*/

    $(document).ready(function () {
        $('#tipe_unit').on('change', function () {
            let id = $(this).val();
            $('#unit_kend').empty();
            $('#unit_kend').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetTipeUnitKendaraan/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#unit_kend').empty();
                $('#unit_kend').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#unit_kend').append(`<option value="${element['id']}">${element['nama_unit']}</option>`);
                    });
                }
            });
        });
    });

    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
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
                $('#supir').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#supir').append(`<option value="${element['idSupir']}" selected>${element['nama']} (${element['status']})</option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
            let id = $(this).val();
            //$('#supir').empty();
            //$('#supir').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetOtherSupir/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
               // $('#supir').empty();
                //$('#supir').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#supir').append(`<option value="${element['idSupir']}" >${element['nama']} (${element['status']})</option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
            let id = $(this).val();
            $('#supir2').empty();
            $('#supir2').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetOtherSupir/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
               $('#supir2').empty();
                $('#supir2').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#supir2').append(`<option value="${element['idSupir']}" >${element['nama']} (${element['status']})</option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
            let id = $(this).val();
            $('#helper').empty();
            $('#helper').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetHelper/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#helper').empty();
                $('#helper').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#helper').append(`<option value="${element['idCrew']}" selected>${element['nama_crew']} </option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
            let id = $(this).val();
            //$('#supir').empty();
            //$('#supir').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetOtherHelper/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
               // $('#supir').empty();
                //$('#supir').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#helper').append(`<option value="${element['idCrew']}" >${element['nama_crew']} </option>`);
                    });
                }
            });
        });
    });
    $(document).ready(function () {
        $('#unit_supir_helper').on('change', function () {
            let id = $(this).val();
            $('#helper2').empty();
            $('#helper2').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetOtherHelper/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#helper2').empty();
                $('#helper2').append(`<option value="0" disabled selected>-- Pilih --</option>`);
                response.forEach(element => {
                    $('#helper2').append(`<option value="${element['idCrew']}" >${element['nama_crew']} </option>`);
                    });
                }
            });
        });
    });

</script>
@endsection
