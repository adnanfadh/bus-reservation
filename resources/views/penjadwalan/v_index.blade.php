@extends('Layout.v_template')

@section('title','Penjadwalan')
@section('sub_title','List Data Penjadwalan')

@section('content')
    <a href="/penjadwalan/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/penjadwalan/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>

    <br>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif



    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs">
            <li class="pt-2 px-3"><h3 class="card-title">Jadwal</h3></li>
            <li class="nav-item"><a class="nav-link active" href="#booking" data-toggle="tab">Booking</a></li>
            <li class="nav-item"><a class="nav-link" href="#service" data-toggle="tab">Service</a></li >
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="booking">
                <table id="datatable2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Durasi</td>
                            <td>Booking </td>
                            <td>Unit </td>
                            <td>Supir </td>
                            <td>Helper </td>
                            <td>Jam Standby </td>
                            <td>Total Kas </td>
                            <td>Status</td>
                            <td style="width: 15%"></td>
                        </tr>
                    </thead>
                    <tbody style="font-size: 15px">
                        <?php $no = 1;?>
                @foreach ($jadwal as $data)
                    @if ($data->jenis_jadwal == 'Booking')
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $data->tgl_jadwal }}</td>
                        <td>{{ $data->durasi }} Hari</td>
                        <td>
                            @foreach ($booking as $dataBooking)
                                @if ($data->id_booking == $dataBooking->idbooking)
                                    @if ($dataBooking->jenis_booking == "Mitra")
                                        {{$dataBooking->jenis_booking}} - {{$dataBooking->nama_mitra}}
                                    @else
                                        {{ $dataBooking->nama_kostumer }}
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $data->nama_tipe }} - {{ $data->nama_unit }}</td>
                        <td>
                            @if ($data->idsupir != null)
                            <?php $arraySupir= explode (",",$data->idsupir) ?>
                                @for ($i=0; $i < count($arraySupir); $i++)
                                    @foreach ($supir as $dataSupir)
                                        @if ($dataSupir->idSupir == $arraySupir[$i])
                                            {{$dataSupir->nama}},
                                        @endif
                                    @endforeach
                                @endfor
                            @endif
                        </td>
                        <td>
                            @if ($data->idcrew != null)
                            <?php $arrayCrew= explode (",",$data->idcrew) ?>
                                @for ($i=0; $i < count($arrayCrew); $i++)
                                    @foreach ($crew as $dataCrew)
                                        @if ($arrayCrew[$i] == $dataCrew->id)
                                            {{$dataCrew->nama_crew}},
                                        @endif
                                    @endforeach
                                @endfor
                            @endif
                        </td>
                        <td>{{ $data->jam_standby }}</td>
                        <td>Rp. {{ number_format(($data->total_kas_keluar), 0, ',', '.') }}</td>
                        <td>{{ $data->status_jadwal }}</td>
                        <td style="text-align: center">
                            @if ($data->id_unit != null)
                                <a href="/penjadwalan/suratJalan/{{$data->id_jadwal}}" class="btn btn-sm btn-info btn-block"> Surat Perintah Jalan</a>
                            @endif
                            <button type="button" class="btn btn-sm btn-warning dropdown-toggle btn-block" data-toggle="dropdown">
                                <i class="fas fa-edit"></i>Aksi
                            </button>
                            <div class="dropdown-menu">
                                @if ($data->status_jadwal == "Pending")
                                    <a class="dropdown-item" href="/penjadwalan/edit/{{$data->id_jadwal}}"> <span class="text-warning"> Edit </span></a>
                                    @if ($data->id_unit != null)
                                        <button type="button"class="dropdown-item" data-toggle="modal" data-target="#prosesUnitJalan{{$data->id_jadwal}}" ><span class="text-info"> Proses </span></button>
                                    @endif
                                @elseif ($data->status_jadwal == "Proses")
                                    <a class="dropdown-item" data-toggle="modal" data-target="#selesai{{$data->id_jadwal}}"  ><span class="text-success"> Selesai </span></a>
                                @else
                                    <a class="dropdown-item" href="/penjadwalan/edit/{{$data->id_jadwal}}"> <span class="text-warning"> Edit </span></a>
                                    <a class="dropdown-item disabled" data-toggle="modal" data-target="#selesai{{$data->id_jadwal}}" ><span class="text-success"> Selesai </span></a>
                                @endif
                            </div>
                            <!--button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete">Delete</button-->

                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endif
                    @endforeach
                    </tbody>
                </table>
              </div>
              <div class="tab-pane" id="service">
                <table id="datatable2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Unit </td>
                            <td>Tanggal</td>
                            <td>Durasi</td>
                            <td>Status</td>
                            <td style="width: 15%">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;?>
                @foreach ($jadwal as $data)
                    @if ($data->jenis_jadwal == 'Service')
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $data->nama_tipe }} - {{ $data->nama_unit }}</td>
                        <td>{{ $data->tgl_jadwal }}</td>
                        <td>{{ $data->durasi }} Hari</td>
                        <td>{{ $data->status_jadwal }}</td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#selesai{{$data->id_jadwal}}">Selesai</button>
                            <a href="/penjadwalan/edit/{{$data->id_jadwal}}" class="btn btn-sm btn-warning"> Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id_jadwal}}">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endif
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

@foreach ($jadwal as $data)
    <div class="modal fade" id="delete{{$data->id_jadwal}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->status_jadwal}} - {{$data->tgl_jadwal}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/penjadwalan/delete/{{$data->id_jadwal}}" class="btn btn-outline-light">Iya</a>
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
            Unit Selesai
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>"[{{$data->jenis_jadwal}}] {{$data->tgl_jadwal}} - {{$data->nama_unit}}({{$data->no_lambung}}) Sudah Selesai ? "</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/penjadwalan/selesai/{{$data->id_jadwal}}" class="btn btn-outline-light">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@foreach ($jadwal as $data)
    <div class="modal fade" id="prosesUnitJalan{{$data->id_jadwal}}">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <div class="modal-header">
            Proses Unit Jalan
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>"[{{$data->jenis_jadwal}}] {{$data->tgl_jadwal}} - {{$data->nama_unit}}({{$data->no_lambung}}) ? "</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/penjadwalan/prosesUnitJalan/{{$data->id_jadwal}}" class="btn btn-outline-light">Proses</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
