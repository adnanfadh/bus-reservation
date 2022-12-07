@extends('Layout.v_template')

@section('title','Harga Tujuan')
@section('sub_title','Ubah Harga Tujuan')

@section('content')
    <a href="/harga_tujuan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/harga_tujuan/update/{{$hargaTujuan->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                    <label for="">Tipe Kendaraan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('id_tipe') is-invalid @enderror" name="id_tipe" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tipe_kend as $tipe)
                            <option value='{{ $tipe->id }}' @if ($hargaTujuan->id_tipe == $tipe->id ) selected @endif>{{$tipe->nama_tipe}}</option>
                        @endforeach
                        </select>
                      <div class="text-danger">
                        @error('id_tipe')
                          {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                    <label for="">Keberangkatan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('idTujuan_awal') is-invalid @enderror" name="idTujuan_awal" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tujuan as $data)
                            <option value='{{ $data->id }}' @if ($hargaTujuan->idTujuan_awal == $data->id ) selected @endif>{{$data->nama_tujuan}}</option>
                        @endforeach
                        </select>
                      <div class="text-danger">
                        @error('idTujuan_awal')
                          {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                    <label for="">Tujuan</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2 @error('idTujuan_akhir') is-invalid @enderror" name="idTujuan_akhir" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($tujuan as $data)
                            <option value='{{ $data->id }}' @if ($hargaTujuan->idTujuan_akhir == $data->id ) selected @endif>{{$data->nama_tujuan}}</option>
                        @endforeach
                        </select>
                      <div class="text-danger">
                        @error('idTujuan_akhir')
                          {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                    <label for="">Bahan Bakar</label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control select2" name="itembb" id="itemBB" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($itemBB as $bb)
                            <option value='{{ $bb->harga_satuan }}'>{{$bb->nama_item}} (Rp. {{$bb->harga_satuan}})</option>
                        @endforeach
                        </select>
                      <div class="text-danger">
                        @error('id_tipe')
                          {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Konsumsi Bahan Bakar</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="konsumsi_solar" id="konsumsiSolar" class="form-control @error('konsumsi_solar') is-invalid @enderror" placeholder="Konsumsi Solar" value="{{ $hargaTujuan->konsumsi_solar }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('konsumsi_solar')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Harga Bahan Bakar</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="rupiah_solar" id="rupiahSolar" class="form-control @error('rupiah_solar') is-invalid @enderror" placeholder="Harga Bahan Bakar" value="{{ $hargaTujuan->rupiah_solar }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('rupiah_solar')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jumlah Supir</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="jum_supir" id="" class="form-control @error('jum_supir') is-invalid @enderror" placeholder="Jumlah Supir" value="{{ $hargaTujuan->jum_supir }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('jum_supir')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jumlah Kernet</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="jum_kernet" id="" class="form-control @error('jum_kernet') is-invalid @enderror" placeholder="Jumlah Kernet" value="{{ $hargaTujuan->jum_kernet }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('jum_kernet')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Minimal Hari</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="min_hari" id="" class="form-control @error('min_hari') is-invalid @enderror" placeholder="Minimal Hari" value="{{ $hargaTujuan->min_hari }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('min_hari')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <!--div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kas Supir</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="kas_supir" id="" class="form-control @error('kas_supir') is-invalid @enderror" placeholder="Kas Supir" value="{{ $hargaTujuan->kas_supir }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('kas_supir')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Kas Kernet</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="jum_kernet" id="" class="form-control @error('jum_kernet') is-invalid @enderror" placeholder="Kas Kernet" value="{{ $hargaTujuan->jum_kernet }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('jum_kernet')
                      {{$message}}
                    @enderror
                </div>
                </div>
            </div-->
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Harga</label>
                </div>
                <div class="col-sm-2">
                  <input type="number" name="harga" id="" class="form-control @error('harga') is-invalid @enderror" placeholder="Harga" value="{{ $hargaTujuan->harga }}"aria-describedby="helpId">
                  <div class="text-danger">
                    @error('harga')
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
<script type="text/javascript">

    $(document).ready(function (){
        $('#konsumsiSolar').change(function(){
            var konsumsiSolar = $(this).val();
            var itemBB = $('#itemBB').val();
            var rupiahSolar = konsumsiSolar * itemBB;
            $('#rupiahSolar').val(rupiahSolar);
        })
        $('#itemBB').change(function(){
            var itemBB = $(this).val();
            var konsumsiSolar = $('#konsumsiSolar').val();
            var rupiahSolar = konsumsiSolar * itemBB;
            $('#rupiahSolar').val(rupiahSolar);
        })
    });

</script>
@endsection
