@extends('Layout.v_template')

@section('title','Booking')
@section('sub_title','Invoice')

@section('content')
<a href="/booking" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>


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
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-bus"></i> DRW Trans
                <small class="float-right">Tanggal: <?php echo date_format(date_create($booking->tgl_booking),"d/m/Y"); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Dari
              <address>
                <strong>DRW Trans.</strong><br>
                <div style="word-wrap: break-word;width:50%"> Jln Leuwisari IV No.6, Kebon Lega Kota Bandung 40235 - Indonesia</div>
                Telp: (+62) 821-3000-6804<br>
                Email: info@drw-trans.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Kepada
              <address>
                @if ($booking->jenis_booking == "Mitra")
                    @foreach ($mitra as $dataMitra)
                        @if ($booking->id_mitra == $dataMitra->id)
                            <strong>{{ $dataMitra->penanggung_jawab }}</strong><br>
                            <strong>{{ $dataMitra->nama_mitra }}</strong><br>
                            <div style="word-wrap: break-word;width:50%">{{ $dataMitra->alamat_mitra}}</div>
                            telp: {{ $dataMitra->no_telp_mitra}}<br>
                            Email: {{ $dataMitra->email_mitra}}
                        @endif
                    @endforeach
                @else
                    <strong>{{ $booking->nama_kostumer }}</strong><br>
                    <div style="word-wrap: break-word;width:50%">{{ $booking->alamat_kostumer }}</div>
                    telp: {{ $booking->telp_kostumer }}<br>
                @endif
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #INV-{{ str_pad($booking->id,4,'0',STR_PAD_LEFT) }}</b><br>
              <br>
              <b>Booking ID:</b> {{ $booking->id }}<br>
              <?php
                $date=date_create($booking->tgl_booking);
                date_add($date,date_interval_create_from_date_string("-2 days"));
                //echo date_format($date,"Y-m-d")
              ?>
              <b>Payment Due:</b> <?php echo date_format($date,"d/m/Y"); ?><br>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                  <th>Qty</th>
                  <th>Tipe Kendaraan</th>
                  <th>Tujuan</th>
                  <th>Tanggal</th>
                  <th>Durasi</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $booking->qty }} Unit</td>
                    <td>
                        @foreach ($tipe as $dataTipe)
                            @if ($dataTipe->id == $booking->id_tipe)
                                {{ $dataTipe->nama_tipe }}
                            @endif
                        @endforeach
                    </td>
                  <td>
                    @foreach ($hargaTujuan as $dataHarga)
                        @if ($dataHarga->id_harga == $booking->id_hargatujuan)
                            {{ $dataHarga->tujuan_awal }} - {{ $dataHarga->tujuan_akhir }}
                        @endif
                    @endforeach
                  </td>
                  <td>{{ date_format(date_create($booking->tgl_booking),"d M Y") }}</td>
                  <td>{{ $booking->lama_booking }} Hari</td>
                  <td>Rp. {{ number_format(($booking->total), 0, ',', '.') }}</td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <h4 class="lead">Metode Pembayaran :  <strong>{{ $booking->metode_bayar }}</strong> </h4>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Alamat Penjemputan : <br>
                {{ $booking->alamat_jemput }}
                </p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Keterangan : <br>
                {{ $booking->keterangan }}
                </p>
            <h4 >Status Pembayaran :
                @if ( $booking->status_booking == "Sukses")
                    <span class="text-success"> PAID</span>
                @else
                        <span class="text-danger"> UNPAID</span>
                @endif
            </h4>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <div class="table-responsive">
                <table class="table">
                  <!-- tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>{{ $booking->total }}</td>
                  </tr -->
                  <tr>
                    <th style='text-align: right'>Total Pembayaran :</th>
                    <td style='text-align: left'>Rp. <strong>{{ number_format(($booking->total), 0, ',', '.') }}</strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
                @if ( $booking->status_booking != "Sukses")
                    <a href="/booking/payment/{{$booking->id}}" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Pembayaran
                    </a>
                @else
                    <a href="/booking/payment/{{$booking->id}}" class="btn btn-success float-right disabled"><i class="far fa-credit-card"></i> Submit
                        Pembayaran
                </a>
                @endif

                <a href="/booking/invoice_print/{{$booking->id}}" rel="noopener" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

@endsection
