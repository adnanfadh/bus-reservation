@extends('Layout.v_template')

@section('title_web','Laporan Reservasi -')
@section('title','Booking')
@section('sub_title','Report Data Booking')

@section('content')
    <a href="/booking" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a><br>
    <a class="btn btn-outline-secondary btn-sm " style="margin: 5px 5px 5px 5px;" data-toggle="modal" data-target="#report"> <i class="fa fa-calendar" aria-hidden="true"></i> Range Tanggal</a>
    <a class="btn btn-outline-danger btn-sm " style="margin: 5px 5px 5px 5px;" href="/booking/report"> <i class="fa fa-undo" aria-hidden="true"></i> Reset</a>

    <br>

    <table id="datatable1" class="table table-striped table-bordered" style="font-size: 12px">
        <thead>
            <tr>
                <td>No</td>
                <td>Invoice</td>
                <td>Tanggal</td>
                <td>Durasi</td>
                <td>Jenis Booking</td>
                <td>Kostumer/Mitra</td>
                <td>Tipe Unit</td>
                <td>Tujuan</td>
                <td>QTY</td>
                <td>Total</td>
                <td>Pembayaran</td>
                <td>Bukti Bayar</td>
                <td>Status</td>
                <td>Penjemputan</td>
                <td>Keterangan</td>
                <td>Marketing</td>
            </tr>
        </thead>
        <tbody >
        <?php $no = 1;?>
    @foreach ($booking as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>#INV-{{ str_pad($data->idbooking,4,'0',STR_PAD_LEFT) }}</td>
                <td>{{ $data->tgl_booking }}</td>
                <td>{{ $data->lama_booking }} Hari</td>
                <td>{{ $data->jenis_booking }}</td>
                <td>
                    @if ($data->nama_kostumer == null)
                        @foreach ($mitra as $dataMitra)
                            @if ($dataMitra->id == $data->id_mitra)
                                    {{ $dataMitra->nama_mitra }}
                            @endif
                        @endforeach
                    @else
                        {{ $data->nama_kostumer }}
                    @endif
                </td>
                <td>
                    @foreach ($tipe_kend as $dataTipe)
                        @if ($dataTipe->id == $data->id_tipe)
                            {{ $dataTipe->nama_tipe }}
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
                <td>{{ $data->qty }}</td>
                <td>Rp. {{ number_format(($data->total), 0, ',', '.') }}</td>
                <td>{{ $data->metode_bayar }}</td>
                <td>
                    @if ($data->bukti_bayar == null)
                        Tidak ada
                    @else
                        Terlampir
                    @endif
                </td>
                <td>{{ $data->status_booking }}</td>
                <td>{{ $data->alamat_jemput }}</td>
                <td>{{ $data->keterangan_book }}</td>
                <td>
                    @foreach ($karyawan as $dataKaryawan)
                        @if ($dataKaryawan->id_users == $data->id_karyawan)
                            {{ $dataKaryawan->nama }}
                        @endif
                    @endforeach
                </td>

            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

    <form action="/booking/reportByTanggal" method="post" enctype="multipart/form-data">
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
