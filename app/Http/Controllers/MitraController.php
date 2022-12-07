<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class MitraController extends Controller
{
    public function __construct()
    {
        $this->mitraModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index()
    {

        $data = [
            'info_user' => $this->mitraModel->KaryawanData(),
            'mitra' => $this->mitraModel->allData('mitra'),
        ];
        return view('mitra.v_index', $data);
    }
    public function add()
    {

        $data = [
            'info_user' => $this->mitraModel->KaryawanData(),
        ];

        return view('mitra.v_add_mitra', $data);
    }

    public function insert()
    {

        //form Validation
        Request()->validate([
            'nama_mitra' => 'required',
            'penanggung_jawab' => 'required',
            'alamat_mitra' => 'required',
            'no_telp_mitra' => 'required|numeric',
            'email_mitra' => 'required',
            'kemitraan' => 'required',
            'keterangan' => 'nullable',
        ], [
            'nama_mitra.required' => 'Nama Mitra Harus Diisi !!',
            'penanggung_jawab.required' => 'Penanggung Jawab Harus Diisi !!',
            'alamat_mitra.required' => 'Alamat Mitra Harus Diisi !!',
            'no_telp_mitra.required' => 'No Telepon Mitra Harus Diisi !!',
            'no_telp_mitra.numeric' => 'No Telepon Mitra Harus Berupa Angka !!',
            'email_mitra.required' => 'Email Mitra Harus Diisi !!',
            'kemitraan.required' => 'Kemitraan Harus Diisi !!',
        ]);

        $data = [
            'nama_mitra' => Request()->nama_mitra,
            'penanggung_jawab' => Request()->penanggung_jawab,
            'alamat_mitra' => Request()->alamat_mitra,
            'no_telp_mitra' => Request()->no_telp_mitra,
            'email_mitra' => Request()->email_mitra,
            'kemitraan' => Request()->kemitraan,
            'keterangan' => Request()->keterangan,
        ];

        $this->mitraModel->addData('mitra', $data);
        return redirect()->route('mitra')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function insertOther()
    {

        //form Validation
        Request()->validate([
            'nama_mitra' => 'required',
            'penanggung_jawab' => 'required',
            'alamat_mitra' => 'required',
            'no_telp_mitra' => 'required|numeric',
            'kemitraan' => 'required',
            'keterangan' => 'nullable',
        ], [
            'nama_mitra.required' => 'Nama Mitra Harus Diisi !!',
            'penanggung_jawab.required' => 'Penanggung Jawab Harus Diisi !!',
            'alamat_mitra.required' => 'Alamat Mitra Harus Diisi !!',
            'no_telp_mitra.required' => 'No Telepon Mitra Harus Diisi !!',
            'no_telp_mitra.numeric' => 'No Telepon Mitra Harus Berupa Angka !!',
            'kemitraan.required' => 'Kemitraan Harus Diisi !!',
        ]);

        $data = [
            'nama_mitra' => Request()->nama_mitra,
            'penanggung_jawab' => Request()->penanggung_jawab,
            'alamat_mitra' => Request()->alamat_mitra,
            'no_telp_mitra' => Request()->no_telp_mitra,
            'email_mitra' => Request()->email_mitra,
            'kemitraan' => Request()->kemitraan,
            'keterangan' => Request()->keterangan,
        ];

        $this->mitraModel->addData('mitra', $data);
        return redirect()->route('addBooking')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'mitra')
    {

        if (!$this->mitraModel->detailData($table, $id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->mitraModel->KaryawanData(),
            'mitra' => $this->mitraModel->detailData($table, $id),
        ];
        return view('mitra.v_edit_mitra', $data);
    }

    public function update($id, $table = 'mitra')
    {

        //form Validation
        Request()->validate([
            'nama_mitra' => 'required',
            'penanggung_jawab' => 'required',
            'alamat_mitra' => 'required',
            'no_telp_mitra' => 'required|numeric',
            'email_mitra' => 'required',
            'kemitraan' => 'required',
            'keterangan' => 'nullable',
        ], [
            'nama_mitra.required' => 'Nama Mitra Harus Diisi !!',
            'penanggung_jawab.required' => 'Penanggung Jawab Harus Diisi !!',
            'alamat_mitra.required' => 'Alamat Mitra Harus Diisi !!',
            'no_telp_mitra.required' => 'No Telepon Mitra Harus Diisi !!',
            'no_telp_mitra.numeric' => 'No Telepon Mitra Harus Berupa Angka !!',
            'email_mitra.required' => 'Email Mitra Harus Diisi !!',
            'kemitraan.required' => 'Kemitraan Harus Diisi !!',
        ]);

        $data = [
            'nama_mitra' => Request()->nama_mitra,
            'penanggung_jawab' => Request()->penanggung_jawab,
            'alamat_mitra' => Request()->alamat_mitra,
            'no_telp_mitra' => Request()->no_telp_mitra,
            'email_mitra' => Request()->email_mitra,
            'kemitraan' => Request()->kemitraan,
            'keterangan' => Request()->keterangan,
        ];


        $this->mitraModel->editData($table, $id, $data);
        return redirect()->route('mitra')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'mitra')
    {
        $this->mitraModel->deleteData($table, $id);
        return redirect()->route('mitra')->with('pesan', 'Data Berhasil Dihapus');
    }
}
