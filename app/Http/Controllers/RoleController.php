<?php

namespace App\Http\Controllers;

use App\Models\HomeModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
//use App\Models\User;

class RoleController extends Controller
{
    public function __construct(){
        $this->roleModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->roleModel->KaryawanData(),
            'role' => $this->roleModel->allData('roles'),
            'permission' => $this->roleModel->allData('permissions'),
            'roleHasPerm' => $this->roleModel->allData('role_has_permissions'),
        ];
        return view('role.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->roleModel->KaryawanData(),
        ];

        return view('role.v_add_role',$data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'role' => 'required|unique:role,role',
        ],[
            'role.required' => 'Nama Role Harus Diisi !!',
            'role.unique' => 'Role Sudah Terdaftar',
        ]);


        $data = [
            'role' => Request()->role,
        ];

        $this->roleModel->addData('role', $data);
        return redirect()->route('role')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'role'){

        if (!$this->roleModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'role' => $this->roleModel->detailData($table,$id),
            'info_user' => $this->roleModel->KaryawanData(),

        ];
        return view('role.v_edit_role', $data);
    }

    public function update($id, $table = 'role'){

        //form Validation
        Request()->validate([
            'role' => 'required',
        ],[
            'role.required' => 'Nama Role Harus Diisi !!',
        ]);

        $data = [
            'role' => Request()->role,
        ];

        $this->roleModel->editData($table,$id,$data);
        return redirect()->route('role')->with('pesan', 'Data Berhasil Diubah');
    }

    public function delete($id, $table = 'role'){
        $this->roleModel->deleteData($table,$id);
        return redirect()->route('role')->with('pesan', 'Data Berhasil Dihapus');
    }

    public function akses($id, $table = 'roles'){

        if (!$this->roleModel->detailData($table,$id)) {
            abort(404);
        }
        /*$RolePerm = $this->roleModel->allData('role_has_permissions');
        foreach ($RolePerm as $datarole){
            dd(in_array($id,$datarole->role_id));

        }


        //$datapermission = $this->roleModel->allData('permissions');
        //$datausers = $this->roleModel->allData('users');
        //$idRole = $dataRolePerm->role_id;
        */
        $roleHasPerm = $this->roleModel->rolePermissionData($id);

        //if (is_null($roleHasPerm) == False){
        //    $dataArray = null;
        //}else{
            $Array = null;
            $a = 0;
            foreach ($roleHasPerm as $data) {

                $Array[$a] = $data->permission_id;
                $a++;
            }
            if($Array == null){
                $dataArray = null;
            }else{
                $dataArray = implode(", ", $Array);
            }
       //dd($dataArray);

        $data = [
            'info_user' => $this->roleModel->KaryawanData(),
            'role' => $this->roleModel->detailData($table,$id),
            'permission' => $this->roleModel->allData('permissions'),
            'roleHasPerm' => $dataArray,
        ];
        return view('role.v_akses_role', $data);
        //dd($dataArray);
    }

    public function permission($id){

        //form Validation
        Request()->validate([
            'role' => 'required',
        ],[
            'role.required' => 'Nama Role Harus Diisi !!',
        ]);

        //$permissions = Request()->permissions;
        $role = Role::find($id);
        $role->syncPermissions(Request()->pemissions);
        //dd($role->name);

        return redirect()->route('role')->with('pesan', 'Akses Role '.$role->name.' Berhasil');
    }
}
