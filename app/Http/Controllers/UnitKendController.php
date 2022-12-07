<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class UnitKendController extends Controller
{
    public function __construct(){
        $this->unitModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->unitModel->KaryawanData(),
            'unit_kend' => $this->unitModel->tipeUnitKend(),
            'supir' => $this->unitModel->supirData(),
            'crew' => $this->unitModel->allData('crew_pool'),

        ];
        return view('unit_kend.v_index', $data);
    }
    public function detail($id){

        if (!$this->unitModel->detailUnitData($id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->unitModel->KaryawanData(),
            'unit_kend' => $this->unitModel->detailUnitData($id),
        ];
        return view('unit_kend.v_detail_operasi', $data);
    }

    public function add(){

        $tipeData = [
            'tipe_kend' => $this->unitModel->allData('tipe_kendaraan'),
            'info_user' => $this->unitModel->karyawanData(),
            'supir' => $this->unitModel->supirData(),
            'crew' => $this->unitModel->allData('crew_pool'),
        ];

        return view('unit_kend.v_add_unit', $tipeData);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'nama_unit' => 'required',
            'id_tipe' => 'required',
            'jumlah_seats' => 'required',
            'no_plat' => 'required',
            'no_lambung' => 'required',
            'status' => 'required',
        ],[
            'nama_unit.required' => 'Nama Unit Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'jumlah_seats.required' => 'Jumlah Seats Harus Diisi !!',
            'no_plat.required' => 'Plat Nomber Harus Diisi !!',
            'no_plat.unique' => 'Plat Nomber Sudah Terdaftar !!',
            'no_lambung.required' => 'No. Lambung Harus Diisi !!',
            'no_lambung.unique' => 'No. Lambung Sudah Terdaftar !!',
            'status.required' => 'status Harus Diisi !!',
        ]);


        $data = [
            'nama_unit' => Request()->nama_unit,
            'id_tipe' => Request()->id_tipe,
            'jumlah_seats' => Request()->jumlah_seats,
            'no_ap' => Request()->no_ap,
            'no_rangka' => Request()->no_rangka,
            'no_plat' => Request()->no_plat,
            'no_uji' => Request()->no_uji,
            'no_lambung' => Request()->no_lambung,
            'masa_berlaku_stnk' => Request()->masa_berlaku_stnk,
            'masa_berlaku_pajak' => Request()->masa_berlaku_pajak,
            'masa_berlaku_kir' => Request()->masa_berlaku_kir,
            'kode_gps' => Request()->kode_gps,
            'id_supir' => Request()->id_supir,
            'id_crew' => Request()->id_crew,
            'status_unit' => Request()->status,
        ];

        $this->unitModel->addData('unit_kendaraan', $data);
        return redirect()->route('unit_kendaraan')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'unit_kendaraan'){

        if (!$this->unitModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->unitModel->KaryawanData(),
            'unit_kend' => $this->unitModel->detailData($table,$id),
            'tipe_kend' => $this->unitModel->allData('tipe_kendaraan'),
            'supir' => $this->unitModel->supirData(),
            'crew' => $this->unitModel->allData('crew_pool'),

        ];

        return view('unit_kend.v_edit_unit', $data);
    }
    public function update($id, $table = 'unit_kendaraan'){

        //form Validation
        Request()->validate([
            'nama_unit' => 'required',
            'id_tipe' => 'required',
            'jumlah_seats' => 'required',
            'no_plat' => 'required',
            'no_lambung' => 'required',
            'status' => 'required',
        ],[
            'nama_unit.required' => 'Nama Unit Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'jumlah_seats.required' => 'Jumlah Seats Harus Diisi !!',
            'no_plat.required' => 'Plat Nomber Harus Diisi !!',
            'no_plat.unique' => 'Plat Nomber Sudah Terdaftar !!',
            'no_lambung.required' => 'No. Lambung Harus Diisi !!',
            'no_lambung.unique' => 'No. Lambung Sudah Terdaftar !!',
            'status.required' => 'status Harus Diisi !!',
        ]);


        $data = [
            'nama_unit' => Request()->nama_unit,
            'id_tipe' => Request()->id_tipe,
            'jumlah_seats' => Request()->jumlah_seats,
            'no_ap' => Request()->no_ap,
            'no_rangka' => Request()->no_rangka,
            'no_plat' => Request()->no_plat,
            'no_uji' => Request()->no_uji,
            'no_lambung' => Request()->no_lambung,
            'masa_berlaku_stnk' => Request()->masa_berlaku_stnk,
            'masa_berlaku_pajak' => Request()->masa_berlaku_pajak,
            'masa_berlaku_kir' => Request()->masa_berlaku_kir,
            'kode_gps' => Request()->kode_gps,
            'id_supir' => Request()->id_supir,
            'id_crew' => Request()->id_crew,
            'status_unit' => Request()->status,
        ];

        $this->unitModel->editData($table,$id,$data);
        return redirect()->route('unit_kendaraan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'unit_kendaraan'){
        $this->unitModel->deleteData($table,$id);
        return redirect()->route('unit_kendaraan')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function report(){

        $data = [
            'info_user' => $this->unitModel->KaryawanData(),
            'unit_kend' => $this->unitModel->tipeUnitKend(),
            'supir' => $this->unitModel->supirData(),
            'crew' => $this->unitModel->allData('crew_pool'),
        ];
        return view('unit_kend.v_report_unit', $data);
    }
}
