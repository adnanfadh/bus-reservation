@extends('Layout.v_template')

@section('title','E-Ticket')
@section('sub_title','List Data E-Ticket')

@section('content')
    @hasanyrole('Administrator|Admin Office')
    <a href="/etiket/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    <a href="/etiket/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>
    @endhasanyrole

    @hasanyrole('Marketing')
    <a href="/etiket/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> E-Ticket Baru</a>
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
                <td>List Nama</td>
                <td>Kontingen</td>
                <td>Hari</td>
                <td>Tanggal</td>
                <td>Jam</td>
                <td>Tujuan</td>
                <td>Tipe Kendaraan</td>
                <td style="width: 15%">Action</td>
            </tr>
        </thead>
        <tbody style="font-size: 13px">
        <?php $no = 1;?>
    @foreach ($etiket as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_etiket }}</td>
                <td>{{ $data->kontingen_etiket }}</td>
                <td>{{ $data->hari_etiket }}</td>
                <td>{{ $data->tgl_etiket }}</td>
                <td>{{ $data->jam_etiket }}</td>
                <td>{{ $data->id_tipe }}</td>
                <td>{{ $data->id_hargatujuan }}</td>

                </td>
                <td style="text-align: center">
                    <a href="/etiket/ticket/{{$data->id}}" class="btn btn-sm btn-info"> E-Ticket</a>
                    <a href="/etiket/edit/{{$data->id}}" class="btn btn-sm btn-warning"> Edit</a>
                    @hasanyrole('Administrator|Admin Office')
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}">
                        Delete
                    </button>
                    @endhasanyrole
                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($etiket as $data)
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
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->tgl_etiket}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/etiket/delete/{{$data->id}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
