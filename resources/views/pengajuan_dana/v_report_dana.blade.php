@extends('Layout.v_template')

@section('title_web','Laporan Pengajuan Dana -')
@section('title','Pengajuan Dana')
@section('sub_title',' Report Data Pengajuan Dana')

@section('content')
<a href="/pengajuan_dana" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <a class="btn btn-outline-secondary btn-sm " style="margin: 5px 5px 5px 5px;" data-toggle="modal" data-target="#report"> <i class="fa fa-calendar" aria-hidden="true"></i> Range Tanggal</a>
    <a class="btn btn-outline-danger btn-sm " style="margin: 5px 5px 5px 5px;" href="/pengajuan_dana/report"> <i class="fa fa-undo" aria-hidden="true"></i> Reset</a>
    <table id="datatable1" class="table table-striped table-bordered">
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
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

    <form action="/pengajuan_dana/reportByTanggal" method="post" enctype="multipart/form-data">
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
