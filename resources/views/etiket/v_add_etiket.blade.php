@extends('Layout.v_template')

@section('title','E-Ticket')
@section('sub_title','Tambah Data E-Ticket')

@section('content')
    <a href="/etiket" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif

    <form action="/etiket/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-10">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th style="width:20%">Nama</th>
                            <td style="width:60%"><input type="text" name="nama_etiket[0]" placeholder="Masukan Nama" class="form-control" id="nama_etiket0"/></td>
                            <td style="width:20%"><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Kontingen</label>
                </div>
                <div class=" col-sm-4">
                  <input type="text" name="kontingen_etiket" id="" class="form-control @error('kontingen_etiket') is-invalid @enderror" placeholder="Kontingen" value="{{ old('kontingen_etiket') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('kontingen_etiket')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Hari Keberangkatan</label>
                </div>
                <div class=" col-sm-3">
                  <input type="text" name="hari_etiket" id="" class="form-control @error('hari_etiket') is-invalid @enderror" placeholder="hari Keberangakatan" value="{{ old('hari_etiket') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('hari_etiket')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Tanggal Keberangkatan</label>
                </div>
                <div class=" col-sm-2">
                  <input type="date" name="tgl_etiket" id="" class="form-control @error('tgl_etiket') is-invalid @enderror" value="{{ old('tgl_etiket') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('tgl_etiket')
                      {{$message}}
                    @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row" >
                <div class=" offset-md-1 col-sm-2">
                  <label for="">Jam Keberangkatan</label>
                </div>
                <div class=" col-sm-2">
                  <input type="time" name="jam_etiket" id="" class="form-control @error('jam_etiket') is-invalid @enderror" placeholder="Durasi" value="{{ old('jam_etiket') }}"aria-describedby="helpId" autofocus>
                  <div class="text-danger">
                    @error('jam_etiket')
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
                        <option value='{{ $data->id }}' @if (old('id_tipe') == $data->id ) selected @endif>{{$data->nama_tipe}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_tipe')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>

            <div class="row form-group"  >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Tujuan</label>
                </div>
                <div class="col-sm-4">
                    <select class="form-control select2 @error('id_hargaTujuan') is-invalid @enderror" name="id_hargaTujuan" id="harga_tujuan" style="width: 100%;">
                        <?php /*
                        <option value="" selected disabled>-- pilih --</option>
                        @foreach ($hargaTujuan as $data)
                        <option value='{{ $data->id }}' @if (old('id_tujuan') == $data->id ) selected @endif>{{$data->tujuan_awal}} - {{$data->tujuan_akhir}} ({{$data->harga}}) <small>*minimal etiket {{$data->min_hari}} hari</small> </option>
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
                    <div class="text-danger">
                        @error('keterangan')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <!--div id='form-1'></div-->
            <div class="row offset-md-3">
                <!--a class="btn btn btn-outline-info btn-sm" style="margin-right: 10px" id="add-btn">Tambah Form </a-->
                <button type='submit' class="btn btn-primary btn-sm">Simpan</button>
            </div>
        </div>
    </form>

@endsection

@section('footer_scripts')
<script>

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
                //$('#harga_tujuan').append(`<option value="0" disabled selected>-- Pilih Tujuan --</option>`);
                response.forEach(element => {
                    $('#harga_tujuan').append(`<option value="${element['id_harga']}" selected >${element['tujuan_awal']} - ${element['tujuan_akhir']}</option>`);
                    //let harga = element['harga'];(Rp. ${element['harga']})
                    //sessionStorage.setItem(sessionStorageKey, harga);
                });
                }
            });
        });
    });

</script>
<script type="text/javascript">
    var i = 0;

    $("#add-btn").click(function(){
    ++i;
        $("#dynamicAddRemove").append('<tr><th>Nama</th><td style="width:60%"><input type="text" name="nama_etiket['+i+']" placeholder="Masukan Nama" class="form-control" id="" @error('nama_etiket') is-invalid @enderror" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></tr>');
    });
    $(document).on('click', '.remove-tr', function(){
    $(this).parents('tr').remove();
    });
    /*
    $(document).ready(function(){
        $("#qty"+i).change(function() {
            var harga  = [parseInt($("#harga"+i).val())];
            var qty  = [parseInt($("#qty"+i).val())];
            var subtotal = [harga[i] * qty[i]];
            $("#subtotal"+i).val(subtotal[i]);
            $("#harga"+i).change(function() {
                var harga  = [parseInt($("#harga"+i).val())];
                var qty  = [parseInt($("#qty"+i).val())];
                var subtotal = [harga[i] * qty[i]];
                $("#subtotal"+i).val(subtotal[i]);
            });
        });
    }) */
</script>
@endsection
