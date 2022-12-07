<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;


class HargaTujuanController extends Controller
{
    public function __construct(){
        $this->hargaModel = new HomeModel();
        $this->middleware('auth');
    }

    public function index(){

        //$order = "'nama_tujuan', 'asc'";
        $data = [
            'info_user' => $this->hargaModel->KaryawanData(),
            'hargaTujuan' => $this->hargaModel->hargaData(),
            'tujuan' => $this->hargaModel->allData('tujuan'),
        ];
        return view('harga_tujuan.v_index', $data);
    }
    public function add(){

        $data = [
            'info_user' => $this->hargaModel->KaryawanData(),
            'tujuan' => $this->hargaModel->allData('tujuan'),
            'tipe_kend' => $this->hargaModel->allData('tipe_kendaraan'),
            'itemBB' => $this->hargaModel->itemBB(),
        ];

        return view('harga_tujuan.v_add_harga',$data);
    }
    public function insert(){

        //form Validation
        Request()->validate([
            'id_tipe' => 'required',
            'idTujuan_awal' => 'required',
            'idTujuan_akhir' => 'required',
            'konsumsi_solar' => 'required',
            'jum_supir' => 'required',
            'jum_kernet' => 'required',
            'min_hari' => 'required',
        ],[
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'idTujuan_awal.required' => 'Keberangkatan Harus Diisi !!',
            'idTujuan_akhir.required' => 'Tujuan Harus Diisi !!',
            'konsumsi_solar.required' => 'Konsumsi Bahan Bakar Harus Diisi !!',
            'jum_supir.required' => 'Banyak Supir Harus Diisi !!',
            'jum_kernet.required' => 'Banyak Kernet Harus Diisi !!',
            'min_hari.required' => 'Minimal Hari Harus Diisi !!',
        ]);

        $jum_supir = Request()->jum_supir;

        if(Request()->jum_kernet == 0 || Request()->jum_kernet == null){
            $jum_kernet = 0;
        }else{
            $jum_kernet = Request()->jum_kernet;
        }
        $min_hari = Request()->min_hari;

        $tipeKend = $this->hargaModel->detailData('tipe_kendaraan',Request()->id_tipe);
        $premi_supir = $tipeKend->premi_supir;
        $premi_kernet = $tipeKend->premi_kernet;

        $kas_supir = ($premi_supir * $jum_supir) * $min_hari;

        $kas_kernet = ($premi_kernet * $jum_kernet) * $min_hari;

        $total_kas = Request()->rupiah_solar + $kas_supir + $kas_kernet;

        $data = [
            'id_tipe' => Request()->id_tipe,
            'idTujuan_awal' => Request()->idTujuan_awal,
            'idTujuan_akhir' => Request()->idTujuan_akhir,
            'konsumsi_solar' => Request()->konsumsi_solar,
            'rupiah_solar' => Request()->rupiah_solar,
            'jum_supir' => Request()->jum_supir,
            'jum_kernet' => Request()->jum_kernet,
            'min_hari' => Request()->min_hari,
            'kas_supir' => $kas_supir,
            'kas_kernet' => $kas_kernet,
            'total_kas' => $total_kas,
            'harga' => Request()->harga,
        ];

        $this->hargaModel->addData('harga_tujuan', $data);
        return redirect()->route('harga_tujuan')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'harga_tujuan'){

        if (!$this->hargaModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'info_user' => $this->hargaModel->KaryawanData(),
            'tujuan' => $this->hargaModel->allData('tujuan'),
            'tipe_kend' => $this->hargaModel->allData('tipe_kendaraan'),
            'hargaTujuan' => $this->hargaModel->detailData($table,$id),
            'itemBB' => $this->hargaModel->itemBB(),
        ];
        return view('harga_tujuan.v_edit_harga', $data);
    }

    public function update($id, $table = 'harga_tujuan'){

        //form Validation
        Request()->validate([
            'id_tipe' => 'required',
            'idTujuan_awal' => 'required',
            'idTujuan_akhir' => 'required',
            'konsumsi_solar' => 'required',
            'jum_supir' => 'required',
            'jum_kernet' => 'required',
            'min_hari' => 'required',
        ],[
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'idTujuan_awal.required' => 'Keberangkatan Harus Diisi !!',
            'idTujuan_akhir.required' => 'Tujuan Harus Diisi !!',
            'konsumsi_solar.required' => 'Konsumsi Bahan Bakar Harus Diisi !!',
            'jum_supir.required' => 'Banyak Supir Harus Diisi !!',
            'jum_kernet.required' => 'Banyak Kernet Harus Diisi !!',
            'min_hari.required' => 'Minimal Hari Harus Diisi !!',
        ]);

        $jum_supir = Request()->jum_supir;

        if(Request()->jum_kernet == 0 || Request()->jum_kernet == null){
            $jum_kernet = 0;
        }else{
            $jum_kernet = Request()->jum_kernet;
        }
        $min_hari = Request()->min_hari;

        $tipeKend = $this->hargaModel->detailData('tipe_kendaraan',Request()->id_tipe);
        $premi_supir = $tipeKend->premi_supir;
        $premi_kernet = $tipeKend->premi_kernet;

        $kas_supir = ($premi_supir * $jum_supir) * $min_hari;

        $kas_kernet = ($premi_kernet * $jum_kernet) * $min_hari;

        $total_kas = Request()->rupiah_solar + $kas_supir + $kas_kernet;

        $data = [
            'id_tipe' => Request()->id_tipe,
            'idTujuan_awal' => Request()->idTujuan_awal,
            'idTujuan_akhir' => Request()->idTujuan_akhir,
            'konsumsi_solar' => Request()->konsumsi_solar,
            'rupiah_solar' => Request()->rupiah_solar,
            'jum_supir' => Request()->jum_supir,
            'jum_kernet' => Request()->jum_kernet,
            'min_hari' => Request()->min_hari,
            'kas_supir' => $kas_supir,
            'kas_kernet' => $kas_kernet,
            'total_kas' => $total_kas,
            'harga' => Request()->harga,
        ];

        $this->hargaModel->editData($table,$id,$data);
        return redirect()->route('harga_tujuan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'harga_tujuan'){
        $this->hargaModel->deleteData($table,$id);
        return redirect()->route('harga_tujuan')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function report(){

        //$order = "'nama_tujuan', 'asc'";
        $data = [
            'info_user' => $this->hargaModel->KaryawanData(),
            'hargaTujuan' => $this->hargaModel->hargaData(),
            'tujuan' => $this->hargaModel->allData('tujuan'),
        ];
        return view('harga_tujuan.v_report_harga', $data);
    }
}
