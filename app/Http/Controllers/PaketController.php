<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class PaketController extends Controller
{
    public function __construct(){
        $this->paketModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'paket' => $this->paketModel->paketData(),
        ];
        return view('paket.v_index', $data);
    }
    public function detail($id){

        if (!$this->jadwalModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'paket' => $this->paketModel->detailData($id),
        ];
        return view('paket.v_detail_paket', $data);
    }

    public function add(){

        $data = [
            'jadwal' => $this->paketModel->allDataOrderBy('penjadwalan', 'id', 'desc'),
        ];
        return view('paket.v_add_paket', $data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'nama_paket' => 'required',
            'id_penjadwalan' => 'required',
            'nominal_harga' => 'required',
            'keterangan' => 'nullable',
            'status' => 'required',
        ],[
            'nama_paket.required' => 'Nama Paket Harus Diisi !!',
            'id_jadwal.required' => 'Jadwal Harus Diisi !!',
            'nominal_harga.required' => 'Nominal Harga Harus Diisi !!',
            'status.required' => 'Status Harus Diisi !!',
        ]);


        $data = [
            'nama_paket' => Request()->nama_paket,
            'id_penjadwalan' => Request()->id_penjadwalan,
            'nominal_harga' => Request()->nominal_harga,
            'keterangan' => Request()->keterangan,
            'status' => Request()->status,
        ];

        $this->paketModel->addData('paket', $data);
        return redirect()->route('paket')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'paket'){

        if (!$this->paketModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'paket' => $this->paketModel->detailData('paket',$id),
            'jadwal' => $this->paketModel->allDataOrderBy('penjadwalan', 'id', 'desc'),
        ];
        return view('paket.v_edit_paket', $data);
    }
    public function update($id, $table = 'paket'){

        //form Validation
        Request()->validate([
            'nama_paket' => 'required',
            'id_penjadwalan' => 'required',
            'nominal_harga' => 'required',
            'keterangan' => 'nullable',
            'status' => 'required',
        ],[
            'nama_paket.required' => 'Nama Paket Harus Diisi !!',
            'id_jadwal.required' => 'Jadwal Harus Diisi !!',
            'nominal_harga.required' => 'Nominal Harga Harus Diisi !!',
            'status.required' => 'Status Harus Diisi !!',
        ]);


        $data = [
            'nama_paket' => Request()->nama_paket,
            'id_penjadwalan' => Request()->id_penjadwalan,
            'nominal_harga' => Request()->nominal_harga,
            'keterangan' => Request()->keterangan,
            'status' => Request()->status,
        ];

        $this->paketModel->editData($table,$id,$data);
        return redirect()->route('paket')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'paket'){
        $this->paketModel->deleteData($table,$id);
        return redirect()->route('paket')->with('pesan', 'Data Berhasil Dihapus');
    }
}
