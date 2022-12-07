@extends('Layout.v_template')

@section('title','Operasional')
@section('sub_title','List Data Operasional')

@section('content')
    <a href="/operasional/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/operasional/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>

    <br>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif

    <table id="datatable2" class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Unit</td>
                <td>Operasional</td>
                <td>Item</td>
                <td>Harga</td>
                <td>QTY</td>
                <td>Sub Total</td>
                <td>Keterangan</td>
                <td>Total</td>
                <td>mekanik</td>
                <td style="width: 15%">Action</td>
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
                <td style="text-align: center">
                    @foreach ($jadwal as $dataJadwal)
                        @if ($dataJadwal->id_jadwal == $data->id_jadwal)
                            @if ($dataJadwal->status_jadwal == "Pending")
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#selesai{{$data->id_jadwal}}">Selesai</button>
                                <a href="/operasional/edit/{{$data->id_opr}}" class="btn btn-sm btn-warning"> Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id_opr}}">
                                    Delete
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#selesai{{$data->id_jadwal}}" disabled>Selesai</button>
                                <button class="btn btn-sm btn-warning" disabled>
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id_opr}}">
                                    Delete
                                </button>
                            @endif
                        @endif

                    @endforeach
                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($operasi as $data)
    <div class="modal fade" id="delete{{$data->id_opr}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->tgl_jadwal}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/operasional/delete/{{$data->id_opr}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@foreach ($jadwal as $data)
    <div class="modal fade" id="selesai{{$data->id_jadwal}}">
    <div class="modal-dialog">
      <div class="modal-content bg-success">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>"Unit {{ $data->nama_unit }}, Tanggal {{$data->tgl_jadwal}}" Sudah Selesai ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/penjadwalan/selesai/{{$data->id_jadwal}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
