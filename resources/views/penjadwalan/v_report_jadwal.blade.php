@extends('Layout.v_template')

@section('title_web','Laporan Penjadwalan -')
@section('title','Penjadwalan')
@section('sub_title','Report Data Penjadwalan')

@section('content')
    <a href="/penjadwalan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <br>

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

                <a class="btn btn-outline-secondary btn-sm " style="margin: 5px 5px 5px 5px;" data-toggle="modal" data-target="#report"> <i class="fa fa-calendar" aria-hidden="true"></i> Range Tanggal</a>
                <a class="btn btn-outline-danger btn-sm " style="margin: 5px 5px 5px 5px;" href="/penjadwalan/report"> <i class="fa fa-undo" aria-hidden="true"></i> Reset</a>

                <table id="datatable1" class="table table-striped table-bordered">
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
                        </tr>
                    </thead>
                    <tbody>
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
                        <td>{{ $data->total_kas_keluar }}</td>
                        <td>{{ $data->status_jadwal }}</td>
                    </tr>
                    <?php $no++; ?>
                    @endif
                    @endforeach
                    </tbody>
                </table>
              </div>
              <div class="tab-pane" id="service">

                <a class="btn btn-outline-secondary btn-sm " style="margin: 5px 5px 5px 5px;" data-toggle="modal" data-target="#report"> <i class="fa fa-calendar" aria-hidden="true"></i> Range Tanggal</a>
                <a class="btn btn-outline-danger btn-sm " style="margin: 5px 5px 5px 5px;" href="/penjadwalan/report"> <i class="fa fa-undo" aria-hidden="true"></i> Reset</a>

                <table id="datatable1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Unit </td>
                            <td>Supir</td>
                            <td>Tanggal</td>
                            <td>Durasi</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;?>
                @foreach ($jadwal as $data)
                    @if ($data->jenis_jadwal == 'Service')
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $data->nama_tipe }} - {{ $data->nama_unit }}</td>
                        <td>
                            @foreach ($supir as $dataSupir)
                                @if ($data->id_unit == $dataSupir->id_unit)
                                    {{$dataSupir->nama}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $data->tgl_jadwal }}</td>
                        <td>{{ $data->durasi }} Hari</td>
                        <td>{{ $data->status_jadwal }}</td>
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

    <form action="/penjadwalan/reportByTanggal" method="post" enctype="multipart/form-data">
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
