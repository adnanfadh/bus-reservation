@extends('Layout.v_template')

@section('title_web','Laporan Harga Tujuan -')
@section('title','Harga Tujuan')
@section('sub_title','Report Data Harga Tujuan')

@section('content')

<a href="/harga_tujuan" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <table id="datatable1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <td>No</td>
                <td>Tipe Kendaraan</td>
                <td>Tujuan</td>
                <td>Minimal Hari</td>
                <td>Harga</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($hargaTujuan as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_tipe }}</td>
                <td>{{ $data->tujuan_awal }} - {{ $data->tujuan_akhir }}</td>
                <td>{{ $data->min_hari }}</td>
                <td>{{ $data->harga }}</td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@endsection
