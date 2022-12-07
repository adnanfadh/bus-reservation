@extends('Layout.v_template')

@section('title','Penjadwalan')
@section('sub_title','Surat Perintah Jalan')

@section('content')
<a href="/penjadwalan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>


<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if (session('pesan'))
            <div class="alert alert-success alert-dismissible" id="success-alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success</h5>
            {{session('pesan')}}
        </div>
        @endif
        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <!--div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-bus"></i> DRW Trans
                <small class="float-right">Tanggal: <?php echo date("d/m/Y");?></small>
              </h4>
            </div>
            < /.col >
          </div-->
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col" style='padding-top: 50px'>
                <h3>SURAT PERINTAH JALAN</h3>
              <h5>No. : #{{ str_pad($jadwal->id_jadwal,5,'0',STR_PAD_LEFT) }}</h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col" style="vertical-align: bottom; padding-left:200px">
                <img src="{{ url('img/logo trans-01.png') }}" alt="" style='max-width: 30%;'><br>
                <address>
                    Jl. Leuwisari Leuwisari IV No.6,<br> Kebon Lega Kota Bandung 40235<br>
                    No.Telp : 08290131<br>
                    Email : admin@drw-trans.com<br>
                    Website : drw-trans.com
                </address>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive" style='padding-right:100px; padding-left:100px;'>
              <table class="table" >
                    <tr>
                        <th width='200px' class="text-right">No. Booking</th>
                        <td>#INV-{{ str_pad($bookingDetail->id,4,'0',STR_PAD_LEFT) }}</td>
                        <td></td>
                        <td></td>

                        @if ($bookingDetail->jenis_booking == "Mitra")
                        @foreach ($mitra as $dataMitra)
                            @if ($bookingDetail->id_mitra == $dataMitra->id)
                                <th width='200px' class="text-right">Kostumer</th>
                                <td>{{ $dataMitra->nama_mitra }} ({{ $dataMitra->penanggung_jawab }})</td>
                            @endif
                            @endforeach
                        @else
                            <th width='200px' class="text-right">Kostumer</th>
                            <td>{{ $bookingDetail->nama_kostumer }}</td>

                        @endif
                    </tr>
                    <tr>
                        <th class="text-right">No. Kendaraan</th>
                        <td>{{$unit->no_plat}}</td>
                        <td></td>
                        <td></td>
                        @if ($bookingDetail->jenis_booking == "Mitra")
                        @foreach ($mitra as $dataMitra)
                            @if ($bookingDetail->id_mitra == $dataMitra->id)
                                <th class="text-right">No. telp</th>
                                <td>{{ $dataMitra->no_telp_mitra}} </td>
                            @endif
                            @endforeach
                        @else
                            <th class="text-right">No. telp</th>
                            <td>{{ $bookingDetail->telp_kostumer }}</td>

                        @endif
                    </tr>
                    <tr>
                        <?php
                        $date=date_create($bookingDetail->tgl_booking);
                        ?>
                        <th class="text-right">Berangkat</th>
                        <td ><?php echo date_format($date,"d/M/Y"); ?></td>
                        <td></td>
                        <td></td>
                        <th class="text-right" rowspan="2">Alamat Jemput</th>
                        <td rowspan="2" style='width:250px; word-wrap: break-word;'>{{$bookingDetail->alamat_jemput}}</td>
                    </tr>
                    <?php
                        $date=date_create($bookingDetail->tgl_booking);
                        $durasi = $bookingDetail->lama_booking - 1;
                        date_add($date,date_interval_create_from_date_string($durasi." days"));
                    ?>
                    <tr>
                        <th class="text-right">Pulang</th>
                        <td><?php echo date_format($date,"d/M/Y"); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th class="text-right">Jam Standby</th>
                        <td>{{$jadwal->jam_standby}}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Jasa Driver</th>
                        <!--td>Rp. {{ ($hargaTujuan->kas_supir/$hargaTujuan->jum_supir)*$bookingDetail->lama_booking }}</td-->
                        <td>Rp.
                            @if ($jadwal->idsupir != null)
                                {{ $jadwal->premi_supir*$bookingDetail->lama_booking }}
                            @else
                                0
                            @endif
                        </td>
                        <th class="text-right">BBM</th>
                        <!--td>Rp. {{ ($hargaTujuan->rupiah_solar)*$bookingDetail->lama_booking }}</td-->
                        <td>Rp. @if ($keteranganBook == "Unit Only")
                                    0
                                @else
                                    {{ $jadwal->bahan_bakar }}
                                @endif
                        </td>
                        <th class="text-right">Tujuan</th>
                        <td>{{ $hargaTujuan->tujuan_awal }} - {{ $hargaTujuan->tujuan_akhir }}</td>
                    </tr>
                    <tr>
                        <th class="text-right">Jasa Driver 2 :</th>
                        @if ($hargaTujuan->jum_supir > 1)
                        <td>Rp. {{ $jadwal->premi_supir*$bookingDetail->lama_booking }}</td>
                        @else
                            <td></td>
                        @endif
                          <th class="text-right">Tol : </th>
                          <td>Rp. 0</td>
                          <th class="text-right" style='vertical-align: top;' rowspan="4">Rute : </th>
                          <td style='width:250px; word-wrap: break-word;vertical-align: top;' rowspan="4">{{$jadwal->rute}}</td>
                      </tr>
                      <tr>
                        <th class="text-right">Jasa Helper :</th>
                        <td>Rp. @if ($jadwal->idcrew != null)
                            {{ $jadwal->premi_helper*$bookingDetail->lama_booking }}
                        @else
                            0
                        @endif
                        </td>
                          <th class="text-right">Makan : </th>
                          <td>Rp. 0</td>

                      </tr>
                      <tr>
                        @if ($hargaTujuan->jum_kernet > 1)
                            <th class="text-right">Jasa Helper 2 :</th>
                            <td>Rp. {{ ($hargaTujuan->kas_kernet/$hargaTujuan->jum_kernet)*$bookingDetail->lama_booking }}</td>
                        @else
                            <td></td>
                            <td></td>
                        @endif
                          <th class="text-right">Penginapan : </th>
                          <td>Rp. 0</td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Parkir : </th>
                          <td>Rp. 0</td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Bongkar-pasang Jok : </th>
                          <td>Rp. 0</td>
                          <th class="text-right" rowspan='2'>Keterangan : </th>
                          <td rowspan='2'>{{$bookingDetail->keterangan}}</td>
                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Repair Kendaraan : </th>
                          <td>Rp. 0</td>



                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Tips Supir: </th>
                          <td>Rp. 0</td>
                          <td></td>
                          <td></td>

                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Tips Helper : </th>
                          <td>Rp. 0</td>
                          <td></td>
                          <td></td>

                      </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">Potongan Supir : </th>
                          <td>Rp. @if ($jadwal->potongan_supir != null)
                                    {{$jadwal->potongan_supir}}
                                @else
                                    0
                                @endif
                            </td>
                          <th class="text-right">Nama Driver : </th>
                          <td>
                              @if ($jadwal->idsupir != null)
                              <?php $arraySupir= explode (",",$jadwal->idsupir) ?>
                                  @for ($i=0; $i < count($arraySupir); $i++)
                                      @foreach ($supirData as $dataSupir)
                                          @if ($dataSupir->idSupir == $arraySupir[$i])
                                              {{$dataSupir->nama}},
                                          @endif
                                      @endforeach
                                  @endfor
                              @endif
                          </td>

                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <th class="text-right">Potongan Helper : </th>
                        <td>Rp. @if ($jadwal->potongan_helper != null)
                                {{$jadwal->potongan_helper}}
                            @else
                                0
                            @endif
                        </td>
                        <th class="text-right">Nama Helper : </th>
                          <td>
                              @if ($jadwal->idcrew != null)
                              <?php $arrayCrew= explode (",",$jadwal->idcrew) ?>
                                  @for ($i=0; $i < count($arrayCrew); $i++)
                                      @foreach ($crew as $dataCrew)
                                          @if ($arrayCrew[$i] == $dataCrew->id)
                                              {{$dataCrew->nama_crew}},
                                          @endif
                                      @endforeach
                                  @endfor
                              @endif
                          </td>
                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <th class="text-right">Kas & Tab. Perusahaan : </th>
                        <td>Rp. @if ($jadwal->kas_tabungan != null)
                                {{$jadwal->kas_tabungan}}
                            @else
                                0
                            @endif
                        </td>
                        <th class="text-right">Catatan : </th>
                        <td style='text-transform: uppercase;word-wrap: break-word;vertical-align: top;' rowspan='2'>{{$jadwal->catatan}}</td>
                     </tr>
                     <tr>
                        <td></td>
                        <td></td>
                        <th class="text-right">Lain-lain : </th>
                        <td>Rp. 0</td>
                     </tr>
                      <tr>
                          <td></td>
                          <td></td>
                          <th class="text-right">TOTAL : </th>
                          <th>Rp.
                            @if ($keteranganBook == "Unit Only")
                                0
                            @else
                                {{ $jadwal->total_kas_keluar }}
                            @endif
                            </th>
                            <!--th>Rp. {{ $hargaTujuan->total_kas*$bookingDetail->lama_booking }}</th-->
                          <td></td>
                      </tr>
                    <!--tr>
                        <td></td>
                        <td></td>
                        <th class="text-right">TOTAL</th>
                        <th>Rp.
                            @$keteranganBook == "Unit Only")
                                0
                            @ (($tipeUnit->premi_supir*$bookingDetail->lama_booking)*$hargaTujuan->jum_supir)+(($tipeUnit->premi_kernet*$bookingDetail->lama_booking)*$hargaTujuan->jum_kernet)+$jadwal->bahan_bakar }}
                            @
                        </th>
                        <th>Rp. $hargaTujuan->total_kas*$bookingDetail->lama_booking }}</th>
                        <td></td>
                    </tr-->
              </table>
            </div>
            <!-- /.col -->
          </div>

          <!--div class="row">
            <div class="col-12 table-responsive">
                <h4 class='text-center'>RINCIAN BIAYA OPERASIONAL</h4>
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Rincian</th>
                  <th>QTY</th>
                  <th>Harga</th>
                  <th>Tabungan</th>
                  <th>Jumlah</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>BBM</td>
                    <td></td>
                    <td>Rp. {{ $hargaTujuan->rupiah_solar }}</td>
                    <td></td>
                    <td>Rp. {{ $hargaTujuan->rupiah_solar }}</td>
                </tr>
                <tr>
                    <td>Driver</td>
                    <td>{{ $hargaTujuan->jum_supir }}</td>
                    <td>Rp. {{ $hargaTujuan->kas_supir/$hargaTujuan->jum_supir }}</td>
                    <td></td>
                    <td>Rp. {{ $hargaTujuan->kas_supir }}</td>
                </tr>
                <tr>
                    <td>Helper</td>
                    <td>{{ $hargaTujuan->jum_kernet }}</td>
                    <td>Rp. {{ $hargaTujuan->kas_kernet/$hargaTujuan->jum_kernet }}</td>
                    <td></td>
                    <td>Rp. {{ $hargaTujuan->kas_kernet }}</td>
                </tr>
                <tr>
                    <td>Tol</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Parkir</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                    <th colspan="4"> Total Operasional</th>
                    <th >Rp. {{ $hargaTujuan->total_kas }}</th>
                </tfoot>
              </table>
            </div>
            <-- /.col >
          </div>
          <-- /.row -->

          <div class="row">
            <div class="col-12 table-responsive">
            <table class="table table-borderless">
                <thead>
                <tr>
                  <th class='text-center'>Driver</th>
                  <th class='text-center'>Operasional</th>
                </tr>
                </thead>
                <tr height=100px></tr>
                <tbody>
                <tr>
                    <td class='text-center'>
                        @foreach ($supirData as $dataSupir)
                        @if ($dataSupir->idSupir == $jadwal->id_supir)
                            {{$dataSupir->nama}},
                        @endif
                    @endforeach
                    </td>
                    <td class='text-center'>
                        @foreach ($info_user as $data)
                            @if ($data->idUsers == Auth::user()->id)
                            {{ $data->nama }}
                            @endif
                        @endforeach
                    </td>
                </tr>
              </table>
            </div>
            <div class="col-12">
                <h5 style='text-decoration:underline;'>Catatan</h5>
                <p>
                    - Senyum, Ramah Tamah dan Berdo'a sebelum berangkat<br>
                    - Pakaian Rapih (Seragam atau Kemeja) Tidak diperkenankan memakai Tshirt / Kaos<br>
                    - Periksa kondisi mobil baik luar maupun dalam sebelum dan sesudah melaksanakan tugas
                </p>
                <h4 class='text-center'>"Apabila mobil sudah ada ditempat penjemputan, Mohon tamunya dikabari (bisa SMS atau Telepon)"</h4>
            </div>
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
                <a href="/penjadwalan/suratJalan_print/{{$jadwal->id}}" rel="noopener" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

@endsection
