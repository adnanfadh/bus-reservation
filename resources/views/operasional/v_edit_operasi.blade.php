@extends('Layout.v_template')

@section('title','Operasional')
@section('sub_title','Ubah Data Operasional')

@section('content')
    <a href="/operasional" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <form action="/operasional/update/{{$operasi->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="content">
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Jadwal Service</label>
                </div>
                <div class="col-sm-3">
                    <select class="form-control select2 @error('id_jadwal') is-invalid @enderror" name="id_jadwal" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($jadwal as $data)
                        <option value='{{ $data->id_jadwal }}' @if ($operasi->id_jadwal == $data->id_jadwal ) selected @endif>{{$data->tgl_jadwal}} - {{$data->nama_tipe}} - {{$data->nama_unit}}</option>
                        @endforeach
                    </select>
                  <div class="text-danger">
                    @error('id_jadwal')
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
                <div class="offset-md-1 col-sm-10">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <tr>
                            <th style="width:30%">Item</th>
                            <th style="width:25%">Harga</th>
                            <th style="width:15%">QTY</th>
                            <th style="width:25%">keterangan</th>
                            <th style="width:5%"></th>
                        </tr>
                        <?php
                            $arrayItem = explode('|', $operasi->item);
                            $arrayHarga = explode('|', $operasi->harga);
                            $arrayQty = explode('|', $operasi->qty);
                            $arrayKeterangan = explode('|', $operasi->keterangan);
                            for ($i=0; $i < count($arrayItem) ; $i++) {
                                ?>
                        <tr>
                            <td>
                                <input type="text" name="item[0]" placeholder="Nama Item" class="form-control"  value="{{($operasi->item != null ) ? $arrayItem[$i] : old('item[0]')}}"/>
                                {{-- <select class="form-control select2 @error('item') is-invalid @enderror" name="item[{{$i}}]" id="" style="width: 100%;">
                                    <option value="">-- pilih --</option>
                                    @foreach ($item_opr as $item)
                                    <option value='{{ $item->id }}' @if ( $arrayItem[$i] == $item->id ) selected @endif>{{$item->nama_item}}</option>
                                    @endforeach

                                </select> --}}
                            </td>
                            <td><input type="number" name="harga[{{$i}}]" placeholder="Harga Satuan" class="form-control" id="harga0" value="{{ $arrayHarga[$i]}}"/></td>
                            <td><input type="number" name="qty[{{$i}}]" placeholder="Banyak item" class="form-control" id="qty0" value="{{ $arrayQty[$i]}}" /></td>
                            <td><input type="text" name="keterangan[{{$i}}]" placeholder="Keterangan" class="form-control"  value="{{ $arrayKeterangan[$i]}}"/></td>
                            @if ($i == 0)
                            <td><button type="button" name="add" id="add-btn" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                            @else
                                <td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-minus" aria-hidden="true"></i></button></td>
                            @endif
                        </tr>
                            <?php
                            }

                            ?>
                    </table>
                </div>
            </div>
            <div class="row form-group" >
                <div class="offset-md-1 col-sm-2">
                  <label for="">Mekanik</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="mekanik" class="form-control @error('mekanik') is-invalid @enderror" id="" style="width: 100%;" value="{{ ($operasi->mekanik != null) ? $operasi->mekanik : old('mekanik') }}"aria-describedby="helpId" placeholder="Nama Mekanik / Bengkel">
                    {{-- <select class="form-control select2 @error('mekanik') is-invalid @enderror" name="mekanik" id="" style="width: 100%;">
                        <option value="">-- pilih --</option>
                        @foreach ($crew as $data)
                            <option value='{{ $data->id }}' @if ($operasi->mekanik == $data->id ) selected @endif>{{$data->nama_crew}}</option>
                        @endforeach
                    </select> --}}
                  <div class="text-danger">
                    @error('mekanik')
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
<script type="text/javascript">
    var i = 0;

    $("#add-btn").click(function(){
    ++i;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="item['+i+']" placeholder="Nama Item" class="form-control"  /></td><td><input type="number" name="harga['+i+']" placeholder="Harga Satuan" class="form-control" id="harga'+i+'"/></td><td><input type="number" name="qty['+i+']" placeholder="Banyak Satuan" class="form-control" id="qty'+i+'"/></td><td><input type="text" name="keterangan['+i+']" placeholder="Keterangan" class="form-control"  /></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fa fa-minus" aria-hidden="true"></i></button></td></tr>');
    });
    $(document).on('click', '.remove-tr', function(){
    $(this).parents('tr').remove();
    });

    /*
    $("#dynamicAddRemove").append('<tr><td><select class="form-control select2 @error('item') is-invalid @enderror" name="item['+i+']" id="" style="width: 100%;"><option value="">-- pilih --</option><?php foreach ($item_opr as $item){ ?><option value="{{ $item->id }}" @if (old('item') == $item->id ) selected @endif>{{$item->nama_item}}</option><?php } ?></select></td><td><input type="number" name="harga['+i+']" placeholder="Enter title" class="form-control" id="harga'+i+'"/></td><td><input type="number" name="qty['+i+']" placeholder="Enter title" class="form-control" id="qty'+i+'"/></td><td><input type="text" name="keterangan['+i+']" placeholder="Enter title" class="form-control"  /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

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
