@extends('Layout.v_template')

@section('title','Dashboard')

@section('content')
<!-- Info boxes -->

    <!-- TABLE: LATEST ORDERS -->
 <div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-tools"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">On Service</span>
                  <span class="info-box-number">{{ $jumlah_service }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar-check"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">On Booking</span>
                  <span class="info-box-number">{{ $jumlah_booking }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-history"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">On Pending</span>
                    <span class="info-box-number">{{ $jumlah_pending }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-bus"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Standby Unit</span>
                  <span class="info-box-number">{{$unit_tersedia}} / {{$unit_jumlah}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          @hasanyrole('Administrator|Admin Office|Admin Keuangan')
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Statistik Penjualan</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Penjualan: January, 2021 - December, 2021</strong>
                  </p>

                  <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-4 col-6">
                  <div class="description-block border-right">
                    <!--span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span-->
                    <h5 class="description-header">

                            {{ number_format($totalPemasukan, 2, ',', '.') }}

                    </h5>
                    <span class="description-text text-success">TOTAL PEMASUKAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-6">
                  <div class="description-block border-right">
                    <!--span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span-->
                    <h5 class="description-header">Rp. {{ number_format($totalPengeluaran, 2, ',', '.') }}</h5>
                    <span class="description-text text-warning">TOTAL PENGELUARAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-12">
                  <div class="description-block border-right">
                    <!--span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span-->
                    <h5 class="description-header">Rp. {{ number_format(($totalPemasukan-$totalPengeluaran), 2, ',', '.') }}</h5>
                    <span class="description-text text-success">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          @endhasanyrole

      <!-- booking baru -->
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Booking Terbaru</h3>

          <div class="card-tools">
            <a href="/booking/add" class="btn btn-sm btn-info float-left">Booking Baru</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" >
          <div class="table-responsive" >
            <table class="table m-0">
              <thead>
              <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Kostumer</th>
                <th>Unit</th>
                <th>Tujuan</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody style="font-size: 13px;">
                @foreach ($booking->take(5) as $data)
              <tr>
                <td><a href="/booking/invoice/{{$data->idbooking}}">#INV-{{ str_pad($data->idbooking,5,'0',STR_PAD_LEFT) }}</a></td>
                <td>{{$data->tgl_booking}}</td>
                <td>
                    @if ($data->nama_kostumer == null)
                        @foreach ($mitra as $dataMitra)
                            @if ($dataMitra->id == $data->id_mitra)
                                    Mitra - {{ $dataMitra->nama_mitra }}
                            @endif
                        @endforeach
                    @else
                        {{$data->nama_kostumer}}
                    @endif
                </td>
                <td>
                    @foreach ($jadwal as $dataJadwal)
                        @if ($data->idbooking == $dataJadwal->id_booking)
                            {{ $dataJadwal->nama_tipe }} - {{ $dataJadwal->nama_unit }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($harga_tujuan as $dataHarga)
                        @if ($dataHarga->id_harga == $data->id_hargatujuan)
                        @foreach ($tujuan as $dataTujuan)
                            @if ($dataHarga->idTujuan_awal == $dataTujuan->id)
                            {{ $dataTujuan->nama_tujuan }}
                            @endif
                        @endforeach
                        -
                        @foreach ($tujuan as $dataTujuan)
                            @if ($dataHarga->idTujuan_akhir == $dataTujuan->id)
                            {{ $dataTujuan->nama_tujuan }}
                            @endif
                    @endforeach
                        @endif
                    @endforeach
                </td>
                <td>
                    @if ($data->status_booking == "Pending")
                        <span class="badge badge-warning">{{ $data->status_booking }} / Belum Lunas</span>
                    @elseif ($data->status_booking == "Sukses")
                        <span class="badge badge-success">{{ $data->status_booking }} / Lunas</span>
                    @elseif ($data->status_booking == "Cancel")
                        <span class="badge badge-danger">{{ $dataJadwal->status_jadwal }} / Batal</span>
                    @endif
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="/booking" class="btn btn-sm btn-secondary float-left">Lihat Lebih Banyak</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Jadwal Unit Terbaru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" >
          <div class="table-responsive" >
            <table class="table m-0">
              <thead>
              <tr>
                <th>Tanggal</th>
                <th>Durasi</th>
                <th>Jenis</th>
                <th>Unit</th>
                <th>Status</th>
                <th></th>
              </tr>
              </thead>
              <tbody style="font-size: 13px;">
                @foreach ($jadwal->take(5) as $data)
              <tr>
                <td>{{$data->tgl_jadwal}}</td>
                <td>{{$data->durasi}} Hari</td>
                <td>{{ $data->jenis_jadwal }}</td>
                <td>
                    {{ $data->nama_unit }}
                </td>
                <td>
                    @if ($data->status_jadwal == "Pending")
                        <span class="badge badge-warning">{{ $data->status_jadwal }}</span>
                    @elseif ($data->status_jadwal == "Proses")
                        <span class="badge badge-info">{{ $data->status_jadwal }}</span>
                    @elseif ($data->status_jadwal == "Selesai")
                        <span class="badge badge-success">{{ $data->status_jadwal }}</span>
                    @elseif ($data->status_jadwal == "Batal")
                        <span class="badge badge-danger">{{ $data->status_jadwal }}</span>
                    @endif
                </td>
                <td>
                    @if ($data->status_jadwal == "Selesai")
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle disabled" data-toggle="dropdown">
                            <i class="fas fa-edit"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-edit"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if ($data->id_unit != null)
                                <a class="dropdown-item" href="/penjadwalan/suratJalan/{{$data->id_jadwal}}">Surat Perintah Jalan</a>
                            @endif
                            @if ($data->status_jadwal == "Pending")
                                <a class="dropdown-item" href="/penjadwalan/edit/{{$data->id_jadwal}}">Edit</a>
                                @if ($data->id_unit != null)
                                    <a class="dropdown-item" href="#">Proses</a>
                                @endif
                            @elseif ($data->status_jadwal == "Proses")
                                <a class="dropdown-item" href="#">Selesai</a>
                            @else
                            @endif
                        @endif
                    </div>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="/penjadwalan" class="btn btn-sm btn-secondary float-left">Lihat Lebih Banyak</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

      <?php /*
      <!-- BAR CHART -->
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title">Statistik Penjualan Per-Unit</h3>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      */ ?>
    </div>
    <div class="col-md-4">
        @hasanyrole('Administrator|Admin Office|Admin Keuangan')
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penjualan Unit</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix">
                    <li><i class="far fa-circle text-danger"></i> Hiace</li>
                    <li><i class="far fa-circle text-success"></i> Medium Bus</li>
                    <li><i class="far fa-circle text-warning"></i> Big Bus</li>
                  </ul>
                </div>
                <!-- /.col -->

                <div class="col-md-12" style="padding-top:5%;font-size:12px">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>
                    @foreach ($goal_pendapatan_unit as $data)
                        <div class="progress-group">
                            {{ $data->nama_unit }} - {{ $data->no_lambung }}
                            <span class="float-right"><b>
                            @if ($data->goal_pendapatan_unit == null)
                                0
                            @else
                            Rp. {{ number_format(($data->goal_pendapatan_unit), 0, ',', '.') }}
                            @endif
                            @if (stripos($data->nama_unit, "Big") == true)
                                @if ($data->jumlah_seats = 59)
                                    </b>/Rp. {{ number_format((1885638000), 0, ',', '.') }}</span>
                                    <?php $persen = ($data->goal_pendapatan_unit/1885638000)*100 ?>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: {{$persen}}%"></div>
                                    </div>
                                @else
                                    @if (stripos($data->nama_unit, "05 B") == true)
                                        </b>/Rp. {{ number_format((1905177500), 0, ',', '.') }}</span>
                                        <?php $persen = ($data->goal_pendapatan_unit/1905177500)*100 ?>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: {{$persen}}%"></div>
                                        </div>
                                    @else
                                        </b>/Rp. {{ number_format((1890177500), 0, ',', '.') }}</span>
                                        <?php $persen = ($data->goal_pendapatan_unit/1890177500)*100 ?>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: {{$persen}}%"></div>
                                        </div>
                                    @endif
                                @endif
                            @elseif (stripos($data->nama_unit, "Medium") == true)
                                </b>/Rp. {{ number_format((1047198000), 0, ',', '.') }}</span>
                                <?php $persen = ($data->goal_pendapatan_unit/1047198000)*100 ?>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width: {{$persen}}%"></div>
                                </div>
                            @else
                                </b>/Rp. {{ number_format((325000000), 0, ',', '.') }}</span>
                                <?php $persen = ($data->goal_pendapatan_unit/325000000)*100 ?>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" style="width: {{$persen}}%"></div>
                                </div>
                            @endif
                        </div>
                          <!-- /.progress-group -->
                    @endforeach
                  </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <!-- /.footer -->
        </div>
        @endhasanyrole

        <div class="card ">
            <div class="card-header">
              <h3 class="card-title">Daftar Ketersediaan Unit Kendaraan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0 table-responsive p-0" style="height: 250px;">
              <table class="table table-sm table-head-fixed text-nowrap" style="font-size:12px;">
                <thead>
                  <tr>
                    <th>Unit</th>
                <th>Plat Nomor</th>
                <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($unit_kend as $data)
                        <tr>
                            <td>{{ $data->nama_tipe }} - {{ $data->nama_unit }}</td>
                            <td>{{ $data->no_plat }}</td>
                            <td><span class="tag tag-success">{{ $data->status_unit }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
        @role('Administrator')
      <!-- PENGGUNA BARU -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pengguna Baru</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach ( $data_kostumer->take(5) as $dataKostumer)
            <?php
                $date=date_create($dataKostumer->tgl_regis);
                date_add($date,date_interval_create_from_date_string("0 days"));
                //echo date_format($date,"Y-m-d")
              ?>
            <li class="item">
              <div class="product-info" style="margin-left:20px">
                <span class="product-description" style="color: rgb(22, 216, 22);font-size: 12px;">
                  [<?php echo date_format($date,"d-m-Y") ?>] "{{$dataKostumer->nama}}" Baru Saja Registrasi.
                  <a href="javascript:void(0)" class="float-right">Lihat</a>
                </span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
          <a href="/users" class="uppercase">Lihat Lebih Banyak</a>
        </div>
        <!-- /.card-footer -->
        </div>
    @endrole
    </div>
 </div>
    <!-- /.col -->
    @foreach ($jadwal as $data)
        <div class="modal fade" id="prosesUnitJalan{{$data->id_jadwal}}">
        <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p>"{{$data->status_jadwal}} - {{$data->tgl_jadwal}}" Sudah Selesai ?</p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
            <a href="/penjadwalan/prosesUnitJalan/{{$data->id_jadwal}}" class="btn btn-outline-light">Iya</a>
            </div>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection

<?php //dd($pendapatan_unit[1]); ?>

@section("footer_scripts")
    <script>
     $(function () {

         //-----------------------
  // - MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

var salesChartData = {
  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
  datasets: [
    {
      label: 'Digital Goods',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [<?php echo $pendapatan_month[0] ?>, <?php echo $pendapatan_month[1]?>, <?php echo $pendapatan_month[2]?>, <?php echo $pendapatan_month[3] ?>, <?php echo $pendapatan_month[4]?>, <?php echo $pendapatan_month[5]?>, <?php echo $pendapatan_month[6] ?>, <?php echo $pendapatan_month[7]?>, <?php echo $pendapatan_month[8]?>, <?php echo $pendapatan_month[9] ?>, <?php echo $pendapatan_month[10]?>, <?php echo $pendapatan_month[11]?>,]
    }
  ]
}

var salesChartOptions = {
  maintainAspectRatio: false,
  responsive: true,
  legend: {
    display: false
  },
  scales: {
    xAxes: [{
      gridLines: {
        display: false
      }
    }],
    yAxes: [{
      gridLines: {
        display: false
      }
    }]
  }
}

// This will get the first returned node in the jQuery collection.
// eslint-disable-next-line no-unused-vars
var salesChart = new Chart(salesChartCanvas, {
  type: 'line',
  data: salesChartData,
  options: salesChartOptions
}
)

//---------------------------
// - END MONTHLY SALES CHART -
//---------------------------
        // - PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
        var pieData = {
            labels: [
            'Hiace',
            'Medium Bus',
            'Big Bus',
            ],
            datasets: [
            {
                data: [<?php echo $pendapatan_unit[0] ?>, <?php echo $pendapatan_unit[1]?>, <?php echo $pendapatan_unit[2]?>],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12']
            }
            ]
        }
        var pieOptions = {
            legend: {
            display: false
            }
        }
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        // eslint-disable-next-line no-unused-vars
        var pieChart = new Chart(pieChartCanvas, {
            type: 'doughnut',
            data: pieData,
            options: pieOptions
        })

        //-----------------
        // - END PIE CHART -
     })

     var areaChartData = {
      labels  : ['BIG 1', 'BIG 2', 'BIG 3', 'BIG 4', 'BIG 5', 'BIG 6', 'BIG 7', 'BIG 8', 'MED 1', 'MED 2', 'HIA 1', 'HIA 2', 'HIA 3', 'HIA 4', 'HIA 5'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
      ]
    }

     //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
    </script>
@endsection

