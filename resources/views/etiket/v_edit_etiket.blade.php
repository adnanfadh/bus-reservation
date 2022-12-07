@extends('Layout.v_template')

@section('title','Booking')
@section('sub_title','Ubah Data Booking')

@section('content')
    <a href="/booking" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/booking/update/{{$booking->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Tanggal Booking</label>
                </div>
                <div class=" col-sm-2">
                  <input type="date" name="tgl_booking" id="" class="form-control @error('tgl_booking') is-invalid @enderror" value="{{ $booking->tgl_booking }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('tgl_booking')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Lama Booking</label>
                </div>
                <div class=" col-sm-1">
                  <input type="number" name="lama_booking" id="" class="form-control @error('lama_booking') is-invalid @enderror" placeholder="Durasi" value="{{ $booking->lama_booking }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('lama_booking')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jenis Booking</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('jenis_booking') is-invalid @enderror" name="jenis_booking" id="jenis_booking" style="width: 100%;">
                        <option value='' selected disabled >-- Pilih --</option>
                        <option value='Mitra' @if ($booking->jenis_booking == 'Mitra' ) selected @endif>Mitra</option>
                        <option value='User' @if ($booking->jenis_booking == 'User' ) selected @endif>User Publish</option>
                    </select>
                  <div class="text-danger">
                    @error('jenis_booking')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" id="User">
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kostumer</label>
                </div>
                <div class="col-sm-3">
                    <select class="form-control select2 @error('id_kostumer') is-invalid @enderror" name="id_kostumer" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($kostumer as $data)
                        <option value='{{ $data->id }}' @if ($booking->id_kostumer == $data->id ) selected @endif>{{$data->nama}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_kostumer')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" id="Mitra" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Mitra</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_mitra') is-invalid @enderror" name="id_mitra" id="" style="width: 100%;">
                        <option value="" selected disabled>-- pilih--</option>
                        @foreach ($mitra as $data)
                        <option value='{{ $data->id }}' @if ($booking->id_mitra == $data->id ) selected @endif>{{$data->nama_mitra}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_mitra')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" id >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tipe Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control  @error('id_tipe') is-invalid @enderror" name="id_tipe" id="tipe_kend" style="width: 100%;">
                        <option value="" selected disabled>-- pilih --</option>
                        @foreach ($tipe as $data)
                        <option value='{{ $data->id }}' @if ($booking->id_tipe == $data->id ) selected @endif>{{$data->nama_tipe}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_tipe')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" id >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tujuan</label>
                </div>
                <div class="col-sm-4">
                    <select class="form-control select2 @error('id_hargaTujuan') is-invalid @enderror" name="id_hargaTujuan" id="harga_tujuan" style="width: 100%;">
                        @foreach ($hargaTujuan as $data)
                        @if ($booking->id_hargatujuan == $data->id_harga )
                        <option value='{{ $data->id_harga }}' selected>{{$data->tujuan_awal}} - {{ $data->tujuan_akhir }}</option>
                        @endif
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_hargaTujuan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Harga</label>
                </div>
                <div class=" col-sm-3">
                  <input type="number" name="harga_nominal" id="harga_nominal" class="form-control @error('harga_nominal') is-invalid @enderror" placeholder="Nominal Harga" value="{{ $booking->harga_nominal }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('harga_nominal')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">QTY</label>
                </div>
                <div class=" col-sm-1">
                  <input type="number" name="qty" id="" class="form-control @error('qty') is-invalid @enderror" placeholder="QTY" value="{{ $booking->qty }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('qty')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Metode Pembayaran</label>
                </div>
                <div class=" col-sm-3">
                  <input type="text" name="metode_bayar" id="" class="form-control @error('metode_bayar') is-invalid @enderror" placeholder="Metode Pembayaran" value="{{ $booking->metode_bayar }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('metode_bayar')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Bukti Pembayaran</label>
                </div>
                <div class=" col-sm-2">
                  <input type="file" name="bukti_bayar" id="" class="form-control @error('bukti_bayar') is-invalid @enderror" placeholder="Bukti Pembayaran" value="{{ $booking->bukti_bayar }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('bukti_bayar')
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
                    <select class="form-control @error('status_booking') is-invalid @enderror" name="status_booking" id="" style="width: 100%;">
                        <option value='' disabled>-- Pilih --</option>
                        <option value='Sukses' @if ($booking->status_booking == 'Sukses' ) selected @endif>Sukses</option>
                        <option value='Pending' @if ($booking->status_booking == 'Pending' ) selected @endif selected>Pending</option>
                        <option value='Cancel' @if ($booking->status_booking == 'Cancel' ) selected @endif>Cancel</option>
                    </select>
                  <div class="text-danger">
                    @error('status_booking')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Alamat Penjemputan</label>
                </div>
                <div class="col-sm-4">
                  <textarea rows="2" placeholder="Alamat Jemput ..." name="alamat_jemput" id="" class="form-control @error('alamat_jemput') is-invalid @enderror" aria-describedby="helpId">{{ $booking->alamat_jemput }}</textarea>
                  <div class="text-danger">
                    @error('alamat_jemput')
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
                  <textarea rows="4" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ $booking->keterangan }}</textarea>
                  <div class="text-danger">
                    @error('keterangan')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <input type="hidden" name="id_karyawan" value="{{ Auth::user()->id }}" >
            <div class="row offset-md-3">
                <button type='submit' class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_scripts')
<script>

    $(function() {
        $('#User').hide();
        $('#Mitra').hide();
        if ($('#jenis_booking').val()=='Mitra') {
            $('#Mitra').show();
        }else{
            $('#User').show();
        }

        $('#jenis_booking').change(function(){
            $('#Mitra').hide();
            $('#User').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(document).ready(function () {
        $('#tipe_kend').on('change', function () {
            let id = $(this).val();
            $('#harga_tujuan').empty();
            $('#harga_tujuan').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: '../GetHargaTujuan/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#harga_tujuan').empty();
                $('#harga_tujuan').append(`<option value="0" disabled selected>-- Pilih Tujuan --</option>`);
                response.forEach(element => {
                    $('#harga_tujuan').append(`<option value="${element['id_harga']}" @if ($booking->id_hargatujuan == $data->id_harga ) selected @endif>${element['tujuan_awal']} - ${element['tujuan_akhir']}</option>`);
                    });
                }
            });
        });
    });

</script>
@endsection
