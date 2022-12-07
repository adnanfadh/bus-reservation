@extends('Layout.v_template')

@section('title','Pengajuan Dana')
@section('sub_title','List Data Pengajuan Dana')

@section('content')
    <a href="/pengajuan_dana/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/pengajuan_dana/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>

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
                <td>Tanggal Pengajuan </td>
                <td>Jenis Pengajuan</td>
                <td>Nama Pengajuan</td>
                <td>Keterangan</td>
                <td>Nominal</td>
                <td>Status</td>
                <td>Pengajuan</td>
                <td>Tanggal Konfirmasi</td>
                <td>Konfirmasi</td>
                <td style="width: 15%">Action</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($dana as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->tgl_pengajuan }}</td>
                <td>{{ $data->jenis_pengajuan }}</td>
                <td>{{ $data->nama_pengajuan }}</td>
                <td>{{ $data->rincian_pengajuan }}</td>
                <td>{{ $data->nominal }}</td>
                <td>{{ $data->status }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->tgl_konfirmasi }}</td>
                <td>{{ $data->nama_konfir }}</td>
                <td style="text-align: center">
                    <a href="/pengajuan_dana/suratPengajuan/{{$data->id}}" class="btn btn-sm btn-info">SPD</a>
                    <a href="/pengajuan_dana/edit/{{$data->id}}" class="btn btn-sm btn-warning"> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}">
                        Delete
                    </button>
                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($dana as $data)
    <div class="modal fade" id="delete{{$data->id}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->nama_pengajuan}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/pengajuan_dana/delete/{{$data->id}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
