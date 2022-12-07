@extends('Layout.v_template')

@section('title','Booking')
@section('sub_title','Invoice')

@section('content')

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
                <i class="fas fa-bus"></i> E-TICKET
                <small class="float-right">Tanggal: <?php echo date("d/m/Y");?></small>
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
                Jln Leuwisari IV No.6, Kebon Lega<br>
                Kota Bandung 40235 - Indonesia<br>
                Telp: (+62) 82130006804<br>
                Email: info@drw-trans.com
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Untuk
              <address>
                <strong>JASWITA.</strong><br>
                Jln Lengkong Besar No 135 <br>
                Kota Bandung - Indonesia<br>
                Telp: (+62) 81802169442<br>
                Email: admin@jaswitajabar.co.id
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>E-Ticket ID : #DRWT0000{{$etiket->id}}</b>
                <br>
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
                  <th>Nama</th>
                  <th>Kontingen</th>
                  <th>Tanggal</th>
                  <th>Hari</th>
                  <th>Jam Keberangkatan</th>
                  <th>Tujuan</th>
                  <th>Tipe Unit</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <ol>
                        <?php $arrayNama= explode ("|",$etiket->nama_etiket) ?>
                        @for ($i=0; $i < count($arrayNama); $i++)
                            <li>{{$arrayNama[$i]}}</li>
                        @endfor
                        </ol>
                    </td>
                    <td>{{ $etiket->kontingen_etiket }}</td>
                    <td>{{ $etiket->tgl_etiket }}</td>
                    <td>{{ $etiket->hari_etiket }}</td>
                    <td>{{ $etiket->jam_etiket }}</td>
                    <td>
                        @foreach ($hargaTujuan as $dataHarga)
                        @if ($dataHarga->id_harga == $etiket->id_hargatujuan)
                        {{ $dataHarga->tujuan_awal }} - {{ $dataHarga->tujuan_akhir }}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($tipe as $dataTipe)
                            @if ($dataTipe->id == $etiket->id_tipe)
                                {{ $dataTipe->nama_tipe }}
                            @endif
                        @endforeach
                    </td>

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
              <h4 class="lead">Kontingen :  <strong>{{ $etiket->kontingen_etiket }}</strong> </h4>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Alamat Penjemputan : <br>
                {{ $etiket->alamat_jemput }}
                </p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Keterangan : <br>
                {{ $etiket->keterangan_etiket }}
                </p>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
                <a href="/etiket/ticket_print/{{$etiket->id}}" rel="noopener" target="_blank" class="btn btn-default float-right" style="margin-right: 5px;"><i class="fas fa-print"></i> Print</a>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->

@endsection
