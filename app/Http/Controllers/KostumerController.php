<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;
//use App\Models\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Nullable;

class KostumerController extends Controller
{
    public function __construct(){
        $this->kostumerModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'info_user' => $this->kostumerModel->KaryawanData(),
            'kostumer' => $this->kostumerModel->dataKostumer(),
        ];
        return view('kostumer.v_index', $data);
    }

    public function detail($id){

        if (!$this->kostumerModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'kostumer' => $this->kostumerModel->detailData($id),
        ];
        return view('kostumer.v_detail_kostumer', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->kostumerModel->KaryawanData(),
        ];

        return view('kostumer.v_add_kostumer', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|required_with:password_confirmation|confirmed:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'foto' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'lampiran' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'keterangan' => 'nullable',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'alamat.required' => 'Alamat Harus Diisi !!',
            'telp.required' => 'No Telepon Harus Diisi !!',
            'telp.numeric' => 'No Telepon Harus Berupa Angka !!',
            'email.required' => 'Email Harus Diisi !!',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Password Harus Diisi !!',
            'password_confirmation.required' => 'Password Konfirmasi Harus Diisi !!',
            'password.confirmed' => 'Password Tidak Sesuai !!',
            'foto.mimes' => 'Foto Harus JPG, JPEG, BMP dan PNG !!',
            'lampiran.mimes' => 'Lampiran Harus JPG, JPEG, BMP dan PNG !!',
        ]);

        $dataProfile = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'telp' => Request()->telp,
        ];
        $this->kostumerModel->addData('users_profile', $dataProfile);
        $idprofile = DB::getPdo()->lastInsertId();

        $dataUsers = [
            'id_profile' => $idprofile,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'akses' => 'Kostumer',
        ];
        $this->kostumerModel->addData('users', $dataUsers);
        $idusers = DB::getPdo()->lastInsertId();


        if (Request()->foto <> "") {
            $file_foto = Request()->foto;
            $filename_foto = Request()->idusers. '.'. $file_foto->extension();
            $file_foto->move(public_path('img'), $filename_foto);
        } else {
            $filename_foto = null;
        }

        if (Request()->lampiran <> "") {
            $file_lampiran = Request()->lampiran;
            $filename_lampiran = Request()->idusers. '.'. $file_lampiran->extension();
            $file_lampiran->move(public_path('img'), $filename_lampiran);
        } else {
            $filename_lampiran = null;
        }

        $data = [
            'id_users' => $idusers,
            'foto' => $filename_foto,
            'lampiran' => $filename_lampiran,
            'keterangan' => Request()->keterangan,
            'created_at' => date("Y.m.d"),
        ];
        $this->kostumerModel->addData('kostumer', $data);
        return redirect()->route('kostumer')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function insertOther(){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'telp' => 'required|numeric',
            'foto' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'lampiran' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'keterangan' => 'nullable',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'telp.required' => 'No Telepon Harus Diisi !!',
            'telp.numeric' => 'No Telepon Harus Berupa Angka !!',
            'foto.mimes' => 'Foto Harus JPG, JPEG, BMP dan PNG !!',
            'lampiran.mimes' => 'Lampiran Harus JPG, JPEG, BMP dan PNG !!',
        ]);

        $dataProfile = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'telp' => Request()->telp,
        ];
        $this->kostumerModel->addData('users_profile', $dataProfile);
        $idprofile = DB::getPdo()->lastInsertId();

        $dataUsers = [
            'id_profile' => $idprofile,
        ];
        $this->kostumerModel->addData('users', $dataUsers);
        $idusers = DB::getPdo()->lastInsertId();


        if (Request()->foto <> "") {
            $file_foto = Request()->foto;
            $filename_foto = Request()->idusers. '.'. $file_foto->extension();
            $file_foto->move(public_path('img'), $filename_foto);
        } else {
            $filename_foto = null;
        }

        if (Request()->lampiran <> "") {
            $file_lampiran = Request()->lampiran;
            $filename_lampiran = Request()->idusers. '.'. $file_lampiran->extension();
            $file_lampiran->move(public_path('img'), $filename_lampiran);
        } else {
            $filename_lampiran = null;
        }

        $data = [
            'id_users' => $idusers,
            'foto' => $filename_foto,
            'lampiran' => $filename_lampiran,
            'keterangan' => Request()->keterangan,
            'created_at' => date("Y.m.d"),
        ];
        $this->kostumerModel->addData('kostumer', $data);
        return redirect()->route('addBooking')->with('pesan', 'Data Berhasil Ditambah');
    }

    public function edit($id, $table = 'kostumer'){

        if (!$this->kostumerModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->kostumerModel->KaryawanData(),
            'kostumer' => $this->kostumerModel->detailData($table,$id),
        ];
        return view('kostumer.v_edit_kostumer', $data);
    }

    public function update($id, $table = 'kostumer'){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'email' => 'required',
            'keterangan' => 'nullable',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'alamat.required' => 'Alamat Harus Diisi !!',
            'no_telp.required' => 'No Telepon Harus Diisi !!',
            'no_telp.numeric' => 'No Telepon Harus Berupa Angka !!',
            'email.required' => 'Email Harus Diisi !!',
        ]);

        $data = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'no_telp' => Request()->no_telp,
            'email' => Request()->email,
            'keterangan' => Request()->keterangan,
        ];

        $this->kostumerModel->editData($table,$id,$data);
        return redirect()->route('kostumer')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'kostumer'){
        $this->kostumerModel->deleteData($table,$id);
        return redirect()->route('kostumer')->with('pesan', 'Data Berhasil Dihapus');
    }
}
