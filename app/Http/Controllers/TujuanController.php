<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Str;


class TujuanController extends Controller
{
    public function __construct(){
        $this->tujuanModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        //$order = "'nama_tujuan', 'asc'";
        $data = [
            'info_user' => $this->tujuanModel->KaryawanData(),
            'tujuan' => $this->tujuanModel->allDataOrderBy('tujuan', 'nama_tujuan', 'asc'),
        ];
        return view('tujuan.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->tujuanModel->KaryawanData(),
        ];

        return view('tujuan.v_add_tujuan',$data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'nama_tujuan' => 'required|unique:tujuan,nama_tujuan',
            'kode_tujuan' => 'required|unique:tujuan,kode_tujuan|min:3|max:5|',
        ],[
            'nama_tujuan.required' => 'Nama Tujuan Harus Diisi !!',
            'nama_tujuan.unique' => 'Tujuan Sudah Terdaftar',
            'kode_tujuan.required' => 'Kode Tujuan Harus Diisi !!',
            'kode_tujuan.unique' => 'Kode Tujuan Sudah Terdaftar',
        ]);

        $kode_tujuan = Str::of(Request()->kode_tujuan)->upper();

        $data = [
            'nama_tujuan' => Request()->nama_tujuan,
            'kode_tujuan' => $kode_tujuan,
        ];

        $this->tujuanModel->addData('tujuan', $data);
        return redirect()->route('tujuan')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'tujuan'){

        if (!$this->tujuanModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->tujuanModel->KaryawanData(),
            'tujuan' => $this->tujuanModel->detailData($table,$id),
        ];
        return view('tujuan.v_edit_tujuan', $data);
    }

    public function update($id, $table = 'tujuan'){

        //form Validation
        Request()->validate([
            'nama_tujuan' => 'required',
            'kode_tujuan' => 'required|min:3|max:5|',
        ],[
            'nama_tujuan.required' => 'Nama Tujuan Harus Diisi !!',
            'kode_tujuan.required' => 'Kode Tujuan Harus Diisi !!',
        ]);

        $kode_tujuan = Str::of(Request()->kode_tujuan)->upper();

        $data = [
            'nama_tujuan' => Request()->nama_tujuan,
            'kode_tujuan' => $kode_tujuan,
        ];

        $this->tujuanModel->editData($table,$id,$data);
        return redirect()->route('tujuan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'tujuan'){
        $this->tujuanModel->deleteData($table,$id);
        return redirect()->route('tujuan')->with('pesan', 'Data Berhasil Dihapus');
    }
}
