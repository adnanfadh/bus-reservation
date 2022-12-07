<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use Illuminate\Http\Request;

class TipeKendController extends Controller
{
    public function __construct(){
        $this->tipeModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->tipeModel->KaryawanData(),
            'tipe_kend' => $this->tipeModel->allData('tipe_kendaraan'),
        ];
        return view('tipe_kend.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->tipeModel->KaryawanData()
        ];

        return view('tipe_kend.v_add_tipe', $data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'nama_tipe' => 'required',
            'merk' => 'required',
            //'seats' => 'required|numeric',
            'fasilitas' => 'required',
            //'harga_tipe' => 'numeric',
            'premi_supir' => 'required|numeric',
        ],[
            'nama_tipe.required' => 'Nama Tipe Harus Diisi !!',
            'merk.required' => 'merk Harus Diisi !!',
            //'seats.required' => 'Seat Harus Diisi !!!',
            'fasilitas.required' => 'Fasilitas Harus Diisi !!',
            'premi_supir.required' => 'Premi Supir Harus Diisi !!',
        ]);

        $data = [
            'nama_tipe' => Request()->nama_tipe,
            'merk' => Request()->merk,
            //'seats' => Request()->seats,
            'fasilitas' => Request()->fasilitas,
            'harga_tipe' => Request()->harga_tipe,
            'premi_supir' => Request()->premi_supir,
            'premi_kernet' => Request()->premi_kernet,

        ];

        $this->tipeModel->addData('tipe_kendaraan', $data);
        return redirect()->route('tipe_kendaraan')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'tipe_kendaraan'){

        if (!$this->tipeModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->tipeModel->KaryawanData(),
            'tipe_kend' => $this->tipeModel->detailData($table,$id),
        ];
        return view('tipe_kend.v_edit_tipe', $data);
    }

    public function update($id, $table = 'tipe_kendaraan'){

        //form Validation
        Request()->validate([
            'nama_tipe' => 'required',
            'merk' => 'required',
            //'seats' => 'required|numeric',
            'fasilitas' => 'required',
            'harga_tipe' => 'numeric',
            'premi_supir' => 'required|numeric',
            //'premi_kernet' => 'numeric',
        ],[
            'nama_tipe.required' => 'Nama Tipe Harus Diisi !!',
            'merk.required' => 'merk Harus Diisi !!',
            //'seats.required' => 'Seat Harus Diisi !!!',
            'fasilitas.required' => 'Fasilitas Harus Diisi !!',
            'premi_supir.required' => 'Premi Supir Harus Diisi !!',
        ]);

        $data = [
            'nama_tipe' => Request()->nama_tipe,
            'merk' => Request()->merk,
            //'seats' => Request()->seats,
            'fasilitas' => Request()->fasilitas,
            'harga_tipe' => Request()->harga_tipe,
            'premi_supir' => Request()->premi_supir,
            'premi_kernet' => Request()->premi_kernet,
        ];

        $this->tipeModel->editData($table,$id,$data);
        return redirect()->route('tipe_kendaraan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'tipe_kendaraan'){
        $this->tipeModel->deleteData($table,$id);
        return redirect()->route('tipe_kendaraan')->with('pesan', 'Data Berhasil Dihapus');
    }
}
