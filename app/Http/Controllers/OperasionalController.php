<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class OperasionalController extends Controller
{
    public function __construct(){
        $this->operasiModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        $data = [
            'info_user' => $this->operasiModel->KaryawanData(),
            'operasi' => $this->operasiModel->KendOperasi(),
            'jadwal' => $this->operasiModel->penjadwalanData(),
            'item' => $this->operasiModel->allData('item_operasional'),
            'crew' => $this->operasiModel->allData('crew_pool'),
        ];
        return view('operasional.v_index', $data);
    }
    public function detail($id){

        if (!$this->operasiModel->detailOperasiData($id)) {
            abort(404);
        }
        $data = [
            'operasi' => $this->operasiModel->detailOperasiData($id),
        ];
        return view('operasional.v_detail_operasi', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->operasiModel->KaryawanData(),
            'item_opr' => $this->operasiModel->allData('item_operasional'),
            'jadwal' => $this->operasiModel->dataJadwalService(),
            'crew' => $this->operasiModel->allData('crew_pool'),
        ];

        return view('operasional.v_add_operasi', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'id_jadwal' => 'required',
            'jenis_opr' => 'required',
            'mekanik' => 'required',
        ],[
            'id_jadwal.required' => 'Jadwal Harus Disini Harus Diisi !!',
            'jenis_opr.required' => 'Jenis Operasional Harus Diisi !!',
            'mekanik.required' => 'Mekanik Harus Diisi !!',
        ]);

        $harga = Request()->harga;
        $qty = Request()->qty;

        for ($i=0; $i < count(Request()->item); $i++) {
            $subtotal[$i] = $harga[$i] * $qty[$i];
        }


        $total = 0;
        for ($i=0; $i < count($subtotal); $i++) {
            $total = $total + $subtotal[$i];
        }

        //$total = $sub_total;

        $sub_total = implode("|",$subtotal);
        $arrayitem = implode("|",Request()->item);
        $arrayharga = implode("|",$harga);
        $arrayqty = implode("|",$qty);
        $arrayketerangan = implode("|",Request()->keterangan);

        $data = [
            'id_jadwal' => Request()->id_jadwal,
            'jenis_opr' => Request()->jenis_opr,
            'item' => $arrayitem,
            'harga' => $arrayharga,
            'qty' => $arrayqty,
            'keterangan' => $arrayketerangan,
            'sub_total' => $sub_total,
            'total' => $total,
            'mekanik' => Request()->mekanik,
        ];

        $this->operasiModel->addData('operasional', $data);
        return redirect()->route('operasional')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'operasional'){

        if (!$this->operasiModel->detailData($table,$id)) {
            abort(404);
        }

        $data = [
            'info_user' => $this->operasiModel->KaryawanData(),
            'operasi' => $this->operasiModel->detailData($table,$id),
            'item_opr' => $this->operasiModel->allData('item_operasional'),
            'crew' => $this->operasiModel->allData('crew_pool'),
            'jadwal' => $this->operasiModel->dataJadwalService(),
        ];
        return view('operasional.v_edit_operasi', $data);
    }

    public function update($id, $table = 'operasional'){

        ///form Validation
        Request()->validate([
            'id_jadwal' => 'required',
            'jenis_opr' => 'required',
            'mekanik' => 'required',
        ],[
            'id_jadwal.required' => 'Jadwal Harus Disini Harus Diisi !!',
            'jenis_opr.required' => 'Jenis Operasional Harus Diisi !!',
            'mekanik.required' => 'Mekanik Harus Diisi !!',
        ]);

        $harga = Request()->harga;
        $qty = Request()->qty;

        for ($i=0; $i < count(Request()->item); $i++) {
            $subtotal[$i] = $harga[$i] * $qty[$i];
        }


        $total = 0;
        for ($i=0; $i < count($subtotal); $i++) {
            $total = $total + $subtotal[$i];
        }

        //$total = $sub_total;

        $sub_total = implode("|",$subtotal);
        $arrayitem = implode("|",Request()->item);
        $arrayharga = implode("|",$harga);
        $arrayqty = implode("|",$qty);
        $arrayketerangan = implode("|",Request()->keterangan);

        $data = [
            'id_jadwal' => Request()->id_jadwal,
            'jenis_opr' => Request()->jenis_opr,
            'item' => $arrayitem,
            'harga' => $arrayharga,
            'qty' => $arrayqty,
            'keterangan' => $arrayketerangan,
            'sub_total' => $sub_total,
            'total' => $total,
            'mekanik' => Request()->mekanik,
        ];


        $this->operasiModel->editData($table,$id,$data);
        return redirect()->route('operasional')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'operasional'){
        $this->operasiModel->deleteData($table,$id);
        return redirect()->route('operasional')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function report(){

        $data = [
            'info_user' => $this->operasiModel->KaryawanData(),
            'operasi' => $this->operasiModel->KendOperasi(),
            'jadwal' => $this->operasiModel->penjadwalanData(),
            'item' => $this->operasiModel->allData('item_operasional'),
            'crew' => $this->operasiModel->allData('crew_pool'),
        ];
        return view('operasional.v_report_operasi', $data);
    }
    public function reportByTanggal(){

        //form Validation
        Request()->validate([
            'range_tanggal' => 'required',
        ],[
            'range_tanggal.required' => 'Range Tanggal Harus Diisi !!',
        ]);

        $rangeTanggal = Request()->range_tanggal;
        $data = explode(" - ",$rangeTanggal);
        for ($i=0; $i < count($data); $i++) {
            $d = strtotime($data[$i]);
            if ($i > 0) {
                $tglAkhir = date("Y-m-d",$d);
            }else{
                $tglAwal = date("Y-m-d",$d);
            }

        }


        $data = [
            'info_user' => $this->operasiModel->KaryawanData(),
            'operasi' => $this->operasiModel->KendOperasiByRangeTgl($tglAwal,$tglAkhir),
            'jadwal' => $this->operasiModel->penjadwalanData(),
            'item' => $this->operasiModel->allData('item_operasional'),
            'crew' => $this->operasiModel->allData('crew_pool'),
        ];
        //dd($data);
        return view('operasional.v_report_operasi', $data);
    }

}
