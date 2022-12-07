@extends('Layout.v_template')

@section('title_web','Laporan Unit Kendaraan -')
@section('title','Unit Kendaraan')
@section('title','Report Data Unit Kendaraan')

@section('content')
<a href="/unit_kend" class="btn btn-sm btn-success" style="margin: 5px 5px 5px 5px;">Kembali</a>

    <table id="datatable1" class="table table-striped table-bordered" style="font-size: 12px">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama Unit </td>
                <td>Tipe Unit</td>
                <td>Seats</td>
                <td>No. AP</td>
                <td>No. Rangka</td>
                <td>No. Plat</td>
                <td>No. Uji</td>
                <td>No. Lambung</td>
                <td>Masa Berlaku STNK</td>
                <td>Masa Berlaku Pajak</td>
                <td>Masa Berlaku KIR</td>
                <td>Kode GPS</td>
                <td>Supir</td>
                <td>Helpler</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1;?>
    @foreach ($unit_kend as $data)
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $data->nama_unit }}</td>
                <td>{{ $data->nama_tipe }}</td>
                <td>{{ $data->jumlah_seats }}</td>
                <td>{{ $data->no_ap }}</td>
                <td>{{ $data->no_rangka }}</td>
                <td>{{ $data->no_plat }}</td>
                <td>{{ $data->no_uji }}</td>
                <td>{{ $data->no_lambung }}</td>
                <td>{{ $data->masa_berlaku_stnk }}</td>
                <td>{{ $data->masa_berlaku_pajak }}</td>
                <td>{{ $data->masa_berlaku_kir }}</td>
                <td>{{ $data->kode_gps }}</td>
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
                <td>{{ $data->status_unit }}</td>
            </tr>
        <?php $no++; ?>
    @endforeach
        </tbody>
    </table>

@endsection
