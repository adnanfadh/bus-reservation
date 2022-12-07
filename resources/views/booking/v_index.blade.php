@extends('Layout.v_template')

@section('title','Booking')
@section('sub_title','List Data Booking')

@section('content')
    @hasanyrole('Administrator|Admin Office')
    <a href="/booking/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/booking/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>
    @endhasanyrole

    @hasanyrole('Marketing')
    <a href="/booking/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Booking Baru</a>
    @endhasanyrole


    <br>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif

    <table id="datatable2" class="table table-striped table-bordered" >
        <thead style="font-size: 15px">
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
                <td style="width: 15%">Action</td>
            </tr>
        </thead>
        <tbody style="font-size: 13px">
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
                <td style="text-align: center">
                    <a href="/booking/invoice/{{$data->idbooking}}" class="btn btn-sm btn-info"> Invoice</a>
                    <a href="/booking/edit/{{$data->idbooking}}" class="btn btn-sm btn-warning"> Edit</a>
                    @hasanyrole('Administrator|Admin Office')
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->idbooking}}">
                        Delete
                    </button>
                    @endhasanyrole
                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($booking as $data)
    <div class="modal fade" id="delete{{$data->idbooking}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->tgl_booking}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/booking/delete/{{$data->idbooking}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
