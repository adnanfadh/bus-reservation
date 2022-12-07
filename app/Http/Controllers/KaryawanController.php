<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class KaryawanController extends Controller
{
    public function __construct(){
        $this->karyawanModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'info_user' => $this->karyawanModel->KaryawanData(),
            'karyawan' => $this->karyawanModel->KaryawanData(),
        ];
        return view('karyawan.v_index', $data);
    }

    public function detail($id){

        if (!$this->karyawanModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'karyawan' => $this->karyawanModel->detailData($id),
        ];
        return view('karyawan.v_detail_karyawan', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->karyawanModel->KaryawanData(),
            'users' => $this->karyawanModel->usersAkses(),
            'tipe' => $this->karyawanModel->allData('tipe_kendaraan'),
            'unit' => $this->karyawanModel->allData('unit_kendaraan'),
        ];
        return view('karyawan.v_add_karyawan', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'id_users' => 'required',
            'nip' => 'required|numeric',
            'jabatan' => 'required',
            'foto' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'status' => 'required',
        ],[
            'id_users.required' => 'Nama User Harus Diisi !!',
            'nip.required' => 'NIP Harus Diisi !!',
            'nip.numeric' => 'NIP Harus Berupa Angka !!',
            'jabatan.required' => 'Jabatan Harus Diisi !!',
            'foto.required' => 'Foto Harus JPG, JPEG, BMP dan PNG !!',
            'status.required' => 'Status Harus Diisi !!',
        ]);

        $file = Request()->foto;
        $filename = Request()->nip. '.'. $file->extension();
        $file->move(public_path('img'), $filename);

        /*if (Request()->jabatan == 'Supir') {
            $idunit = Request()->id_unit;
        }else{
            $idunit = null;
        }
        */

        $data = [
            'id_users' => Request()->id_users,
            'nip' => Request()->nip,
            'jabatan' => Request()->jabatan,
            'foto' => $filename,
            'status' => Request()->status,
            //'id_unit' => $idunit,
        ];

        $this->karyawanModel->addData('karyawan', $data);
        return redirect()->route('karyawan')->with('pesan', 'Data Berhasil Ditambah');
    }

    public function edit($id, $table = 'karyawan'){

        if (!$this->karyawanModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'users' => $this->karyawanModel->usersAkses(),
            'info_user' => $this->karyawanModel->KaryawanData(),
            'karyawan' => $this->karyawanModel->detailData($table,$id),
        ];
        return view('karyawan.v_edit_karyawan', $data);
    }

    public function update($id, $table = 'karyawan'){

        //form Validation
        Request()->validate([
            'id_users' => 'required',
            'nip' => 'required|numeric',
            'jabatan' => 'required',
            'foto' => 'nullable|mimes:jpg,jpeg,bmp,png',
            'status' => 'required',
        ],[
            'id_users.required' => 'Nama User Harus Diisi !!',
            'nip.required' => 'NIP Harus Diisi !!',
            'nip.numeric' => 'NIP Harus Berupa Angka !!',
            'jabatan.required' => 'Jabatan Harus Diisi !!',
            'foto.required' => 'Foto Harus JPG, JPEG, BMP dan PNG !!',
            'status.required' => 'Status Harus Diisi !!',
        ]);

        /*if (Request()->jabatan == 'Supir') {
            $idunit = Request()->id_unit;
        }else{
            $idunit = null;
        }
        */


        if (Request()->foto <> "") {
            $file = Request()->foto;
            $filename = Request()->nip. '.'. $file->extension();
            $file->move(public_path('img'), $filename);

            $data = [
                'id_users' => Request()->id_users,
                'nip' => Request()->nip,
                'jabatan' => Request()->jabatan,
                'foto' => $filename,
                'status' => Request()->status,
                //'id_unit' => $idunit,
            ];
        } else {
            $data = [
                'id_users' => Request()->id_users,
                'nip' => Request()->nip,
                'jabatan' => Request()->jabatan,
                'status' => Request()->status,
                //'id_unit' => $idunit,
            ];
        }


        $this->karyawanModel->editData($table,$id,$data);
        return redirect()->route('karyawan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'karyawan'){
        $this->karyawanModel->deleteData($table,$id);
        return redirect()->route('karyawan')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function GetTipeUnitKend($id){
        echo json_encode($this->karyawanModel->dataTipeUnitKend($id));

    }

    public function addSupir(){

        $data = [
            'info_user' => $this->karyawanModel->KaryawanData(),
            //'users' => $this->karyawanModel->usersAkses(),
            'tipe' => $this->karyawanModel->allData('tipe_kendaraan'),
            'unit' => $this->karyawanModel->allData('unit_kendaraan'),
        ];
        return view('karyawan.v_add_supir', $data);
    }

    public function insertSupir(){

        //form Validation
        Request()->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|required_with:password_confirmation|confirmed:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'nip' => 'required|numeric',
            'foto' => 'nullable|mimes:jpg,jpeg,bmp,png',
        ],[
            'nama.required' => 'Nama Harus Diisi !!',
            'alamat.required' => 'alamat Harus Diisi !!',
            'telp.required' => 'telepon Harus Diisi !!',
            'email.required' => 'Email Harus Diisi !!',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Password Harus Diisi !!',
            'password_confirmation.required' => 'Password Konfirmasi Harus Diisi !!',
            'password.confirmed' => 'Password Tidak Sesuai !!',
            'nip.required' => 'NIP Harus Diisi !!',
            'nip.numeric' => 'NIP Harus Berupa Angka !!',
            'foto.required' => 'Foto Harus JPG, JPEG, BMP dan PNG !!',
        ]);

        /*if (Request()->jabatan == 'Supir') {
            $idunit = Request()->id_unit;
        }else{
            $idunit = null;
        }
        */

        $dataProfile = [
            'nama' => Request()->nama,
            'alamat' => Request()->alamat,
            'telp' => Request()->telp,
        ];

        $this->karyawanModel->addData('users_profile', $dataProfile);
        $idProfile = DB::getPdo()->lastInsertId();

        $roles = $this->karyawanModel->rolesSupir();
        //$idroles = $roles->id.',';

        //dd($dataProfile, $idProfile, $idrole->id);

        $dataUsers = User::Create([
            'id_profile' => $idProfile,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'akses' => 'Karyawan',
            'id_role' => $roles->id,
        ]);
        $idUsers = DB::getPdo()->lastInsertId();
        $dataUsers->assignRole($roles->name);

        //dd($dataProfile, $idProfile, $idroles, $dataUsers,$idUsers);
        $file = Request()->foto;
        $filename = Request()->nip. '.'. $file->extension();
        $file->move(public_path('img'), $filename);

        $dataSupir = [
            'id_users' => $idUsers,
            'nip' => Request()->nip,
            'jabatan' => 'Supir',
            'foto' => $filename,
            'status' => 'Aktif',
            //'id_unit' => $idunit,
        ];
        $this->karyawanModel->addData('karyawan', $dataSupir);
        $idSupir = DB::getPdo()->lastInsertId();

        if(Request()->id_unit != null){
            $dataUnit = [
                'id_supir' => $idSupir,
            ];
            $this->karyawanModel->editData('unit_kendaraan',Request()->id_unit, $dataUnit);
        }

        return redirect()->route('karyawan')->with('pesan', 'Data Berhasil Ditambah');
    }
}
