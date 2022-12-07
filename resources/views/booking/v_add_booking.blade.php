@extends('Layout.v_template')

@section('title','Booking')
@section('sub_title','Tambah Data Booking')

@section('content')
    <a href="/booking" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif

    <form action="/booking/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">No Booking</label>
                </div>
                <div class=" col-sm-3 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">INV </span>
                      </div>
                    <input type="number" name="idbooking" id="" class="form-control @error('idbooking') is-invalid @enderror" placeholder="No di belakang 0" value="{{ old('idbooking') }}"aria-describedby="helpId" autofocus>
                    <div class="text-danger">
                    @error('idbooking')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Tanggal Booking</label>
                </div>
                <div class=" col-sm-2">
                  <input type="date" name="tgl_booking" id="" class="form-control @error('tgl_booking') is-invalid @enderror" value="{{ old('tgl_booking') }}"aria-describedby="helpId" autofocus>
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
                  <input type="number" name="lama_booking" id="" class="form-control @error('lama_booking') is-invalid @enderror" placeholder="Durasi" value="{{ old('lama_booking') }}"aria-describedby="helpId" autofocus>
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
                        <?php
                        //<option value='Mitra' @if (old('jenis_booking') == 'Mitra' ) selected @endif>Mitra</option>
                        ?>
                        <option value='User' @if (old('jenis_booking') == 'User' ) selected @endif>User Publish</option>
                    </select>
                  <div class="text-danger">
                    @error('jenis_booking')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            <div id="User">
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2">
                      <label for="" >Nama Kostumer</label>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" name="nama_kostumer" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}"aria-describedby="helpId">
                      <div class="text-danger">
                        @error('nama')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class=" offset-md-1 col-sm-2"  >
                      <label for="">Alamat Kostumer</label>
                    </div>
                    <div class="col-sm-5">
                        <textarea name="alamat_kostumer" id="" cols="9" rows="2" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>

                        <div class="text-danger">
                        @error('alamat')
                          {{$message}}
                        @enderror
                        </div>

                    </div>
                </div>
                <div class="row form-group" >
                    <div class="offset-md-1 col-sm-2" >
                      <label for="">Telepon Kostumer</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="telp_kostumer" id="" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon" value="{{ old('telp') }}"aria-describedby="helpId">
                        <div class="text-danger">
                            @error('telp')
                            {{$message}}
                            @enderror
                        </div>
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
                        <option value='{{ $data->id }}' @if (old('id_mitra') == $data->id ) selected @endif>{{$data->nama_mitra}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_mitra')
                      {{$message}}
                    @enderror
                </div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn bg-primary" data-toggle="modal" data-target="#tambahMitra" style="padding: 2px 2px 2px 2px; margin: 5px 5px 5px 5px;">
                        <i class="fa fa-plus" aria-hidden="true"></i> Mitra
                    </button>
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
                        <option value='{{ $data->id }}' @if (old('id_tipe') == $data->id ) selected @endif>{{$data->nama_tipe}} </option>
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
                        <?php /*
                        <option value="" selected disabled>-- pilih --</option>
                        @foreach ($hargaTujuan as $data)
                        <option value='{{ $data->id }}' @if (old('id_tujuan') == $data->id ) selected @endif>{{$data->tujuan_awal}} - {{$data->tujuan_akhir}} ({{$data->harga}}) <small>*minimal booking {{$data->min_hari}} hari</small> </option>
                        @endforeach
                        */ ?>
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
                  <input type="number" name="harga_nominal" id="harga_nominal" class="form-control @error('harga_nominal') is-invalid @enderror" placeholder="Nominal Harga" value="{{ old('harga_nominal') }}"aria-describedby="helpId" autofocus>
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
                  <input type="number" name="qty" id="" class="form-control @error('qty') is-invalid @enderror" placeholder="QTY" value="{{ old('qty') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('qty')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <?php /*
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Total</label>
                </div>
                <div class=" col-sm-2">
                  <input type="number" name="total" id="" class="form-control @error('total') is-invalid @enderror" placeholder="Total" value="{{ old('total') }}"aria-describedby="helpId" readonly>
                  <div class="text-danger">
                    @error('total')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            */ ?>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Metode Pembayaran</label>
                </div>
                <div class=" col-sm-3">
                  <input type="text" name="metode_bayar" id="" class="form-control @error('metode_bayar') is-invalid @enderror" placeholder="Metode Pembayaran" value="{{ old('metode_bayar') }}"aria-describedby="helpId" autofocus>
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
                  <input type="file" name="bukti_bayar" id="" class="form-control @error('bukti_bayar') is-invalid @enderror" placeholder="Bukti Pembayaran" value="{{ old('bukti_bayar') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('bukti_bayar')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <!--div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Status</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control @error('status_booking') is-invalid @enderror" name="status_booking" id="" style="width: 100%;">
                        <option value='Pending' @if (old('status_booking') == 'Pending' ) selected @endif selected>Pending</option>
                    </select>
                  <div class="text-danger">
                    @error('status_booking')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div-->
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Alamat Penjemputan</label>
                </div>
                <div class="col-sm-4">
                  <textarea rows="2" placeholder="Alamat Jemput ..." name="alamat_jemput" id="" class="form-control @error('alamat_jemput') is-invalid @enderror" aria-describedby="helpId">{{ old('alamat_jemput') }}</textarea>
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
                  <textarea rows="2" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ old('keterangan') }}</textarea>
                    <div class="">
                        <small>*<i>Ketik " Unit Only " Jika booking unitnya saja.</i></small>
                    </div>
                    <div class="text-danger">
                        @error('keterangan')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Marketing</label>
                </div>
                <div class="col-sm-3">
                    <select class="form-control  @error('id_karyawan') is-invalid @enderror" name="id_karyawan" id="tipe_kend" style="width: 100%;">
                        <option value="" selected disabled>-- pilih --</option>
                        @foreach ($marketing as $data)
                        <option value='{{ $data["id_karyawan"] }}' @if (old('id_karyawan') == $data["id_karyawan"] ) selected @endif>{{$data["nama_karyawan"]}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_karyawan')
                      {{$message}}
                    @enderror
                </div>
            </div>
            <!--div id='form-1'></div-->
            <div class="row offset-md-3">
                <!--a class="btn btn btn-outline-info btn-sm" style="margin-right: 10px" id="add-btn">Tambah Form </a-->
                <button type='submit' class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>


    <div class="modal fade" id="tambahKostumer">
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-default">
            <form action="/kostumer/insertOther" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
              <h4 class="modal-title">Tambah Kostumer Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="">
                <div class="row form-group" >
                    <div class="col-sm-2 col-form-label" style="text-align: right;" >
                      <label for="" ><span style='color:red'>*</span>Nama </label>
                    </div>
                    <div class="col-sm-9">
                      <input type="text" name="nama" id="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}"aria-describedby="helpId">
                      <div class="text-danger">
                        @error('nama')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class=" col-sm-2 col-form-label" style="text-align: right;"  >
                      <label for=""><span style='color:red'>*</span>Alamat</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="" cols="9" rows="2" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat">{{ old('alamat') }}</textarea>

                        <div class="text-danger">
                        @error('alamat')
                          {{$message}}
                        @enderror
                        </div>

                    </div>
                </div>
                <div class="row form-group" >
                    <div class="col-sm-2 col-form-label" style="text-align: right;" >
                      <label for=""><span style='color:red'>*</span>Telepon</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="telp" id="" class="form-control @error('telp') is-invalid @enderror" placeholder="Telepon" value="{{ old('telp') }}"aria-describedby="helpId">
                        <div class="text-danger">
                            @error('telp')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="col-sm-2 col-form-label" style="text-align: right;">
                      <label for="">Foto</label>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="foto" id="" class="custom-file-input @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                                <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                            </div>
                        </div>
                        <div class="text-danger">
                        @error('foto')
                          {{$message}}
                        @enderror
                        </div>
                    </div>
                </div><span style='color:red;font-size: 12px;'>* <i>Harap Diisi</i></span>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark " data-dismiss="modal" aria-label="Close">Tidak</button>
                <button class="btn btn-outline-success">Tambah</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>

    <div class="modal fade" id="tambahMitra">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-default">
            <form action="/mitra/insertOther" method="post" enctype="multipart/form-data">
                @csrf
              <div class="modal-header">
                <h4 class="modal-title">Tambah Mitra Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" style="">

                  <div class="row form-group" >
                      <div class="col-sm-2 col-form-label" style="text-align: right;" >
                        <label for="" ><span style='color:red'>*</span>Nama Mitra</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" name="nama_mitra" id="" class="form-control @error('nama_mitra') is-invalid @enderror" placeholder="Nama Mitra" value="{{ old('nama_mitra') }}"aria-describedby="helpId">
                        <div class="text-danger">
                          @error('nama_mitra')
                            {{$message}}
                          @enderror
                      </div>
                      </div>
                  </div>
                  <div class="row form-group" >
                      <div class="col-sm-2 col-form-label" style="text-align: right;" >
                        <label for="" ><span style='color:red'>*</span>Penanggung Jawab</label>
                      </div>
                      <div class="col-sm-9">
                        <input type="text" name="penanggung_jawab" id="" class="form-control @error('penanggung_jawab') is-invalid @enderror" placeholder="Penanggung Jawab" value="{{ old('penanggung_jawab') }}"aria-describedby="helpId">
                        <div class="text-danger">
                          @error('penanggung_jawab')
                            {{$message}}
                          @enderror
                      </div>
                      </div>
                  </div>
                  <div class="row form-group" >
                      <div class=" col-sm-2 col-form-label" style="text-align: right;"  >
                        <label for=""><span style='color:red'>*</span>Alamat Mitra</label>
                      </div>
                      <div class="col-sm-9">
                          <textarea name="alamat_mitra" id="" cols="9" rows="2" class="form-control @error('alamat_mitra') is-invalid @enderror" placeholder="Alamat Mitra">{{ old('alamat_mitra') }}</textarea>
                          <div class="text-danger">
                          @error('alamat_mitra')
                            {{$message}}
                          @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row form-group" >
                      <div class="col-sm-2 col-form-label" style="text-align: right;" >
                        <label for=""><span style='color:red'>*</span>Telepon Mitra</label>
                      </div>
                      <div class="col-sm-5">
                          <input type="text" name="no_telp_mitra" id="" class="form-control @error('no_telp_mitra') is-invalid @enderror" placeholder="Nomor Telepon Mitra" value="{{ old('no_telp_mitra') }}"aria-describedby="helpId">
                          <div class="text-danger">
                              @error('no_telp_mitra')
                              {{$message}}
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row form-group" >
                      <div class="col-sm-2 col-form-label" style="text-align: right;" >
                        <label for=""></span>Email Mitra</label>
                      </div>
                      <div class="col-sm-9">
                          <input type="email" name="email_mitra" id="" class="form-control @error('email_mitra') is-invalid @enderror" placeholder="Email Mitra" value="{{ old('email_mitra') }}"aria-describedby="helpId">
                          <div class="text-danger">
                              @error('email_mitra')
                              {{$message}}
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="row form-group" >
                    <div class="col-sm-2 col-form-label" style="text-align: right;">
                      <label for=""><span style='color:red'>*</span>Kemitraan</label>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control @error('kemitraan') is-invalid @enderror" name="kemitraan" id="" style="width: 100%;">
                            <option value='' >-- Pilih --</option>
                            <option value='Pool Bis' @if (old('kemitraan') == 'Pool Bis' ) selected @endif>Pool Bis</option>
                            <option value='Travel Agent' @if (old('kemitraan') == 'Travel Agent' ) selected @endif>Travel Agent</option>
                            <option value='Owner' @if (old('kemitraan') == 'Owner' ) selected @endif>Owner</option>
                        </select>
                      <div class="text-danger">
                        @error('kemitraan')
                          {{$message}}
                        @enderror
                        </div>
                    </div>
                </div>
                <div class="row form-group" >
                    <div class="col-sm-2 col-form-label" style="text-align: right;">
                      <label for="">Keterangan</label>
                    </div>
                    <div class="col-sm-9">
                      <textarea rows="2" placeholder="Keterangan ..." name="keterangan" id="" class="form-control @error('keterangan') is-invalid @enderror" aria-describedby="helpId">{{ old('keterangan') }}</textarea>
                      <div class="text-danger">
                        @error('keterangan')
                          {{$message}}
                        @enderror
                    </div>
                    </div>
                </div>
                  <span style='color:red;font-size: 12px;'>* <i>Harap Diisi</i></span>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal" aria-label="Close">Tidak</button>

                <button class="btn btn-outline-success">Tambah</button>
              </div>
            </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
@endsection

@section('footer_scripts')
<script>

    $(function() {
        $('#Mitra').hide();
        $('#User').hide();
        $('#jenis_booking').change(function(){
            $('#Mitra').hide();
            $('#User').hide();
            $('#' + $(this).val()).show();
        });
    });

    //const sessionStorageKey = "HARGA_TUJUAN";
    //let harga_nominal = document.querySelector("#harga_nominal");

    $(document).ready(function () {
        $('#tipe_kend').on('change', function () {
            let id = $(this).val();
            $('#harga_tujuan').empty();
            $('#harga_tujuan').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'get',
                url: 'GetHargaTujuan/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                $('#harga_tujuan').empty();
                $('#harga_tujuan').append(`<option value="0" disabled selected>-- Pilih Tujuan --</option>`);
                response.forEach(element => {
                    $('#harga_tujuan').append(`<option value="${element['id_harga']}" >${element['tujuan_awal']} - ${element['tujuan_akhir']}</option>`);
                    //let harga = element['harga'];(Rp. ${element['harga']})
                    //sessionStorage.setItem(sessionStorageKey, harga);
                });
                }
            });
        });
    });

</script>
@endsection
