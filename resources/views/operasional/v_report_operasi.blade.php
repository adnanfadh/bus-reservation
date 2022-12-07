@extends('Layout.v_template')

@section('title_web','Laporan Operasional Unit -')
@section('title','Operasional')
@section('sub_title','Report Data Operasional')

@section('content')
    <a href="/operasional" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>
    <br>
    <a class="btn btn-outline-secondary btn-sm " style="margin: 5px 5px 5px 5px;" data-toggle="modal" data-target="#report"> <i class="fa fa-calendar" aria-hidden="true"></i> Range Tanggal</a>
    <a class="btn btn-outline-danger btn-sm " style="margin: 5px 5px 5px 5px;" href="/operasional/report"> <i class="fa fa-undo" aria-hidden="true"></i> Reset</a>
    <table id="datatable1" class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Unit</td>
                <td>Operasional</td>
                <td>Item</td>
                <td>Harga</td>
                <td>Banyak Item</td>
                <td>Sub Total</td>
                <td>Keterangan</td>
                <td>Total</td>
                <td>mekanik</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($operasi as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->tgl_jadwal }}</td>
                <td>{{ $data->nama_unit }}</td>
                <td>{{ $data->jenis_opr }}</td>
                <td>
                    <ol>
                    <?php $arrayItem= explode ("|",$data->item) ?>
                    @for ($i=0; $i < count($arrayItem); $i++)
                        <li>{{$arrayItem[$i]}}</li>
                    @endfor
                    </ol>
                </td>
                <td>
                    <ul style="list-style-type: circle;">
                        <?php $arrayHarga= explode ("|",$data->harga) ?>
                        @for ($i=0; $i < count($arrayHarga); $i++)
                                <li>{{$arrayHarga[$i]}}</li>
                        @endfor
                    </ul>
                </td>
                <td>
                    <ul style="list-style-type:circle"l>
                        <?php $arrayQty= explode ("|",$data->qty) ?>
                        @for ($i=0; $i < count($arrayQty); $i++)
                                <li>{{$arrayQty[$i]}}</li>
                        @endfor
                    </ul>
                </td>
                <td>
                    <ul style="list-style-type:circle">
                        <?php $arraySubtotal= explode ("|",$data->sub_total) ?>
                        @for ($i=0; $i < count($arraySubtotal); $i++)
                                <li>{{$arraySubtotal[$i]}}</li>
                        @endfor
                    </ul>
                </td>
                <td>
                    <ul style="list-style-type:circle;font-size:13px">
                        <?php $arrayKeterangan= explode ("|",$data->keterangan) ?>
                        @for ($i=0; $i < count($arrayKeterangan); $i++)
                                <li>{{$arrayKeterangan[$i]}}</li>
                        @endfor
                    </ul>
                </td>
                <td>{{ $data->total }}</td>
                <td>
                    {{$data->mekanik}}

                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

    <form action="/operasional/reportByTanggal" method="post" enctype="multipart/form-data">
        <div class="modal fade" id="report">
        <div class="modal-dialog">
          <div class="modal-content bg-default">
            <div class="modal-header">
              <h4 class="modal-title">Report Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Buat Laporan</p>

                @csrf
              <div class="form-group">
                <label>Date range:</label>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" name="range_tanggal" class="form-control float-right" id="reservation">
                </div>
                <!-- /.input group -->

              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tidak</button>
              <button type="submit" class="btn btn-outline-dark">Iya</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
    </form>

@endsection

@section('footer_scripts')
<!-- date-range-picker -->
<script src="{{asset('template')}}/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript">
    $('#reservation').daterangepicker()
</script>
@endsection
