@extends('Layout.v_template')

@section('title','Unit Kendaraan')
@section('sub_title','List Data Unit Kendaraan')

@section('content')
@hasanyrole('Administrator|Admin Office|Admin Pool')
    <a href="/unit_kend/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
    @unlessrole('Admin Pool')
    <a href="/unit_kend/report" class="btn bg-info btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-book" aria-hidden="true"></i> Report Data</a>
    @endunlessrole
@endhasanyrole

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
                <td>Nama Unit </td>
                <td>Tipe Unit</td>
                <td>Seats</td>
                <td>Plat Nomer</td>
                <td>Fasilitas</td>
                @hasanyrole('Administrator|Admin Office|Admin Pool')
                <td>Supir</td>
                <td>Helper</td>
                <td>Harga</td>
                @endhasanyrole
                <td>Status</td>
                @hasanyrole('Administrator|Admin Office|Admin Pool')
                <td style="width: 15%">Action</td>
                @endhasanyrole
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($unit_kend as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_unit }} (
                    @if ($data->no_ap != null)
                        {{ $data->no_ap }} / {{ $data->no_lambung }}
                    @else
                        {{ $data->no_lambung }}
                    @endif
                    )</td>
                <td>{{ $data->nama_tipe }}</td>
                <td>{{ $data->jumlah_seats }}</td>
                <td>{{ $data->no_plat }}</td>
                <td>{{ $data->fasilitas }}</td>
                @hasanyrole('Administrator|Admin Office|Admin Pool')
                <td>
                    @foreach ($supir as $dataSupir)
                        @if ($dataSupir->idSupir == $data->id_supir)
                            {{ $dataSupir->nama }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($crew as $dataCrew)
                        @if ($dataCrew->id == $data->id_crew)
                            {{ $dataCrew->nama_crew }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $data->harga_tipe }}</td>
                @endhasanyrole
                <td>{{ $data->status_unit }}</td>
                @hasanyrole('Administrator|Admin Office|Admin Pool')
                <td style="text-align: center">
                    <a href="/unit_kend/edit/{{$data->idunit}}" class="btn btn-sm btn-warning"> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->idunit}}">
                        Delete
                    </button>
                </td>
                @endhasanyrole
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@foreach ($unit_kend as $data)
    <div class="modal fade" id="delete{{$data->idunit}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->nama_unit}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/unit_kend/delete/{{$data->idunit}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach


@endsection


