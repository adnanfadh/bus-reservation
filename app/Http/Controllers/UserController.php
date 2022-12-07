<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{

    public function __construct(){
        $this->usersModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->usersModel->KaryawanData(),
            'users' => $this->usersModel->usersAkses(),
            'role' => $this->usersModel->allData('role'),
        ];
        return view('users.v_index', $data);
    }

    public function detail($id){

        if (!$this->usersModel->detailAksesData($id)) {
            abort(404);
        }
        $data = [
            'users' => $this->usersModel->detailAksesData($id),
        ];
        return view('users.v_detail_users', $data);
    }

    public function add(){
        $data = [
            'info_user' => $this->usersModel->KaryawanData(),
            'profile' => $this->usersModel->allData('users_profile'),
            'role' => $this->usersModel->allData('role'),
        ];

        return view('users.v_add_users',$data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'id_profile' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|required_with:password_confirmation|confirmed:password_confirmation',
            'password_confirmation' => 'required|min:6',
            'akses' => 'required',
            'role' => 'required',
        ],[
            'id_profile.required' => 'Nama Profil Harus Diisi !!',
            'email.required' => 'Email Harus Diisi !!',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Password Harus Diisi !!',
            'password_confirmation.required' => 'Password Konfirmasi Harus Diisi !!',
            'password.confirmed' => 'Password Tidak Sesuai !!',
            'akses.required' => 'Akses Harus Diisi !!',
            'role.required' => 'Role Harus Diisi !!',
        ]);

        //$file = Request()->foto;
        //$filename = Request()->nip. '.'. $file->extension();
        //$file->move(public_path('img'), $filename);

        $role = implode(",",Request()->role);

        /*$data = [
            'id_profile' => Request()->id_profile,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            //'foto' => $filename,
            'akses' => Request()->akses,
            'id_role' => $role,
        ];*/
        $data = User::Create([
            'id_profile' => Request()->id_profile,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'akses' => Request()->akses,
            'id_role' => $role,
        ]);
        $dataArray = $this->usersModel->allData('roles');
        for ($i=0; $i < count(Request()->role); $i++){
            foreach ($dataArray as $dataRoles) {
                if ($dataRoles->id == Request()->role[$i]) {
                    $namaRoles = $dataRoles->name;
                    $data->assignRole($namaRoles);
                }
            }
        }



        //$this->usersModel->addData('users', $data);
        return redirect()->route('users')->with('pesan', 'Data Berhasil Ditambah');
    }

    public function edit($id, $table = 'users'){

        if (!$this->usersModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->usersModel->KaryawanData(),
            'profile' => $this->usersModel->allData('users_profile'),
            'role' => $this->usersModel->allData('role'),
            'users' => $this->usersModel->detailData($table,$id),
        ];
        return view('users.v_edit_users', $data);
    }

    public function update($id, $table = 'users'){

        //form Validation
        Request()->validate([
            'id_profile' => 'required',
            'email' => 'required',
            //'password' => 'required|min:6|required_with:password_confirmation|confirmed:password_confirmation',
            //'password_confirmation' => 'required|min:6',
            'akses' => 'required',
            //'role' => 'required',
        ],[
            'id_profile.required' => 'Nama Profil Harus Diisi !!',
            'email.required' => 'Email Harus Diisi !!',
            //'password.required' => 'Password Harus Diisi !!',
            //'password_confirmation.required' => 'Password Konfirmasi Harus Diisi !!',
            //'password.confirmed' => 'Password Tidak Sesuai !!',
            'akses.required' => 'Akses Harus Diisi !!',
            //'role.required' => 'Role Harus Diisi !!',
        ]);



        if(Request()->akses == "Karyawan"){
            $role = implode(",",Request()->role);
        }else{
            $role = null;
        }

        /*
        if (Request()->foto <> "") {
            $file = Request()->foto;
            $filename = Request()->nip. '.'. $file->extension();
            $file->move(public_path('img'), $filename);

            $data = [
                'nip' => Request()->nip,
                'name' => Request()->name,
                'email' => Request()->email,
                'foto' => $filename,
                'level' => $level,
            ];
        } else {
            $data = [
                'nip' => Request()->nip,
                'name' => Request()->name,
                'email' => Request()->email,
                'level' => $level,
            ];
        }


        */

        //dd(Request()->role, $role);
        $data = [
            'id_profile' => Request()->id_profile,
            'email' => Request()->email,
            //'password' => Hash::make(Request()->password),
            //'foto' => $filename,
            'akses' => Request()->akses,
            'id_role' => $role,
        ];

        $this->usersModel->editData($table,$id,$data);
        return redirect()->route('users')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'users'){
        $this->usersModel->deleteData($table,$id);
        return redirect()->route('users')->with('pesan', 'Data Berhasil Dihapus');
    }

    public function showChangePasswordForm(){

        return view('users.v_changepassword');
    }

    public function changePassword($id,Request $request, $table = 'users'){

        //if (!$this->usersModel->detailData($table,$id)) {
            //abort(404);
        //}

        $users =  $this->usersModel->detailData($table,$id);

        if (!(Hash::check($request->get('current-password'), $users->password))) {
        // The passwords matches
        return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
        return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");

        }
        if(!(strcmp($request->get('new-password'), $request->get('new-password-confirm'))) == 0){
                    //New password and confirm password are not same
                    return redirect()->back()->with("error","New Password should be same as your confirmed password. Please retype new password.");
        }


        //Change Password
        //$user = $data;
        //$user->password = bcrypt($request->get('new-password'));
        //$user->save();

        $data = [
            'password' => Hash::make($request->get('new-password')),
        ];

        $this->usersModel->editPasswordData($table,$id,$data);

        return redirect()->back()->with("success","Password changed successfully !");

        }

}
