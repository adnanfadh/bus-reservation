@extends('Layout.v_template')

@section('title','Item Operasional')
@section('sub_title','List Data Item Operasional')

@section('content')
    <a href="/item_opr/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
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
                <td>Nama Item </td>
                <td>Tipe Item </td>
                <td>SKU</td>
                <td>Harga Satuan</td>
                <td style="width: 15%">Action</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($item_opr as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_item }}</td>
                <td>{{ $data->tipe_item }}</td>
                <td>{{ $data->sku }}</td>
                <td>{{ $data->harga_satuan }}</td>
                <td style="text-align: center">
                    <a href="/item_opr/edit/{{$data->id}}" class="btn btn-sm btn-warning"> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}">
                        Delete
                    </button>
                </td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($item_opr as $data)
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
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->nama_item}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/item_opr/delete/{{$data->id}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
