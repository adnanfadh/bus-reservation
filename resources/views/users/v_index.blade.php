@extends('Layout.v_template')

@section('title','Users')
@section('sub_title','List Data Users')

@section('content')
    <a href="/users/add" class="btn bg-primary btn-app" style="margin: 5px 5px 5px 5px;"> <i class="fa fa-plus" aria-hidden="true"></i> Add Data</a>
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
                <td>Nama</td>
                <td>Email</td>
                <td>Akses</td>
                <td>Role</td>
                <td style="width: 15%">Action</td>
            </tr>
        </thead>
        <?php $no = 1 ?>
        <tbody>
    @foreach ($users as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->akses }}</td>
                <td>
                <?php $arrayRole= explode (",",$data->id_role) ?>
                @for ($i=0; $i < count($arrayRole); $i++)
                    @foreach ( $role as $role_list)
                        @if ($role_list->id==$arrayRole[$i])
                             {{$role_list->role}},
                        @endif
                    @endforeach
                @endfor
                </td>
                <td style="text-align: center">
                    <a href="/users/detail/{{$data->idUsers}}" class="btn btn-sm btn-success">Detail</a>
                    <a href="/users/edit/{{$data->idUsers}}" class="btn btn-sm btn-warning"> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{$data->idUsers}}">
                        Delete
                    </button>
                </td>
            </tr>
        <?php $no++ ?>
    @endforeach
        </tbody>
    </table>

@foreach ($users as $data)
    <div class="modal fade" id="delete{{$data->idUsers}}">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apa Kamu Yakin Untuk Menghapus Data "{{$data->nama}}"?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
          <a href="/users/delete/{{$data->idUsers}}" class="btn btn-outline-light">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
@endforeach

@endsection
