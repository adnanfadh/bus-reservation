@extends('Layout.v_template')

@section('title','Harga & Tujuan')

@hasanyrole('Administrator|Admin Office')
    @section('sub_title','List Data Harga dan Tujuan')
@endhasanyrole

@hasanyrole('Marketing')
    @section('sub_title','Daftar Harga dan Tujuan')
@endhasanyrole

@section('content')
@hasanyrole('Administrator|Admin Office')
    <a href="/harga_tujuan/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/harga_tujuan/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>
@endhasanyrole
    <br>

    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
           {{session('pesan')}}
      </div>
    @endif

    <table id="datatable2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <td>No</td>
                <td>Tipe Kendaraan</td>
                <td>Tujuan</td>
                <td>Konsumsi Solar</td>
                <td>Rupiah Solar</td>
                <td>Jumlah Supir</td>
                <td>Jumlah Kernet</td>
                <td>Minimal Hari</td>
                <td>Kas Supir</td>
                <td>Kas Kernet</td>
                <td>Total Kas</td>
                <td>Harga Jual</td>
                @hasanyrole('Administrator|Admin Office')
                <td style="width: 15%">Action</td>
                @endhasanyrole
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($hargaTujuan as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_tipe }}</td>
                <td>
                    @foreach ($tujuan as $dataTujuan)
                        @if ($data->idTujuan_awal == $dataTujuan->id)
                        {{ $dataTujuan->nama_tujuan }}
                        @endif
                    @endforeach
                     -
                    @foreach ($tujuan as $dataTujuan)
                        @if ($data->idTujuan_akhir == $dataTujuan->id)
                        {{ $dataTujuan->nama_tujuan }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $data->konsumsi_solar }}</td>
                <td>{{ $data->rupiah_solar }}</td>
                <td>{{ $data->jum_supir }}</td>
                <td>{{ $data->jum_kernet }}</td>
                <td>{{ $data->min_hari }}</td>
                <td>{{ $data->kas_supir }}</td>
                <td>{{ $data->kas_kernet }}</td>
                <td>{{ $data->total_kas }}</td>
                <td>{{ $data->harga }}</td>
                @hasanyrole('Administrator|Admin Office')
                <td style="text-align: center">
                    <a href="/harga_tujuan/edit/{{$data->id_harga}}" class="btn btn-sm btn-warning"> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id_harga}}">
                        Delete
                    </button>
                </td>
                @endhasanyrole
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>


@foreach ($hargaTujuan as $data)
    <div class="modal fade" id="delete{{$data->id_harga}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->id_harga}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/harga_tujuan/delete/{{$data->id_harga}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
