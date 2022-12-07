<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class UsersProfileController extends Controller
{
    public function __construct(){
        $this->profileModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->profileModel->KaryawanData(),
            'profile' => $this->profileModel->allData('users_profile'),
        ];
        return view('users_profile.v_index', $data);
    }

    public function detail($id){

        if (!$this->profileModel->detailAksesData($id)) {
            abort(404);
        }
        $data = [
            'users' => $this->profileModel->detailAksesData($id),
        ];
        return view('users_profile.v_detail_profile', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->profileModel->KaryawanData(),
        ];

        return view('users_profile.v_add_profile', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'alamat.required' => 'alamat Harus Diisi !!',
            'telp.required' => 'telepon Harus Diisi !!',
        ]);

        $data = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'telp' => Request()->telp,
        ];

        $this->profileModel->addData('users_profile', $data);
        return redirect()->route('users_profile')->with('pesan', 'Data Berhasil Ditambah');
    }

    public function edit($id, $table = 'users_profile'){

        if (!$this->profileModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->profileModel->KaryawanData(),
            //'level_akses' => $this->usersModel->allData('level_akses'),
            'profile' => $this->profileModel->detailData($table,$id),
        ];
        return view('users_profile.v_edit_profile', $data);
    }

    public function update($id, $table = 'users_profile'){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'alamat.required' => 'alamat Harus Diisi !!',
            'telp.required' => 'telepon Harus Diisi !!',
        ]);

        $data = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'telp' => Request()->telp,
        ];

        $this->profileModel->editData($table,$id,$data);
        return redirect()->route('users_profile')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'users_profile'){
        $this->profileModel->deleteData($table,$id);
        return redirect()->route('users_profile')->with('pesan', 'Data Berhasil Dihapus');
    }
}
