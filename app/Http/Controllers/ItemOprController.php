<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class ItemOprController extends Controller
{
    public function __construct(){
        $this->itemModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'info_user' => $this->itemModel->KaryawanData(),
            'item_opr' => $this->itemModel->allDataOrderBy('item_operasional', 'id', 'asc'),
        ];
        return view('item_opr.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->itemModel->KaryawanData(),
        ];

        return view('item_opr.v_add_item', $data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'nama_item' => 'required',
            'sku' => 'nullable',
        ],[
            'nama_item.required' => 'Nama Item Harus Diisi !!',
        ]);

        $data = [
            'nama_item' => Request()->nama_item,
            'tipe_item' => Request()->tipe_item,
            'sku' => Request()->sku,
            'harga_satuan' => Request()->harga_satuan,
        ];

        $this->itemModel->addData('item_operasional', $data);
        return redirect()->route('item_operasional')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'item_operasional'){

        if (!$this->itemModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->itemModel->KaryawanData(),
            'item_opr' => $this->itemModel->detailData($table,$id),
        ];
        return view('item_opr.v_edit_item', $data);
    }

    public function update($id, $table = 'item_operasional'){

        //form Validation
        Request()->validate([
            'nama_item' => 'required',
            'sku' => 'nullable',
        ],[
            'nama_item.required' => 'Nama Item Harus Diisi !!',
        ]);

        $data = [
            'nama_item' => Request()->nama_item,
            'tipe_item' => Request()->tipe_item,
            'sku' => Request()->sku,
            'harga_satuan' => Request()->harga_satuan,
        ];


        $this->itemModel->editData($table,$id,$data);
        return redirect()->route('item_operasional')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'item_operasional'){
        $this->itemModel->deleteData($table,$id);
        return redirect()->route('item_operasional')->with('pesan', 'Data Berhasil Dihapus');
    }
}
