<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class CrewController extends Controller
{
    public function __construct(){
        $this->crewModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->crewModel->KaryawanData(),
            'crew' => $this->crewModel->allData('crew_pool'),
        ];
        return view('crew.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->crewModel->KaryawanData(),
        ];

        return view('crew.v_add_crew',$data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'nama_crew' => 'required',
        ],[
            'nama_crew.required' => 'Nama Crew Harus Diisi !!',
        ]);


        $data = [
            'nama_crew' => Request()->nama_crew,
        ];

        $this->crewModel->addData('crew_pool', $data);
        return redirect()->route('crew')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'crew_pool'){

        if (!$this->crewModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [

            'info_user' => $this->crewModel->KaryawanData(),
            'crew' => $this->crewModel->detailData($table,$id),
        ];
        return view('crew.v_edit_crew', $data);
    }

    public function update($id, $table = 'crew_pool'){

        //form Validation
        Request()->validate([
            'nama_crew' => 'required',
        ],[
            'nama_crew.required' => 'Nama Crew Harus Diisi !!',
        ]);


        $data = [
            'nama_crew' => Request()->nama_crew,
        ];

        $this->crewModel->editData($table,$id,$data);
        return redirect()->route('crew')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'crew_pool'){
        $this->crewModel->deleteData($table,$id);
        return redirect()->route('crew')->with('pesan', 'Data Berhasil Dihapus');
    }
}
