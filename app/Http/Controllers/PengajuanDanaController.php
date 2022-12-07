<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class PengajuanDanaController extends Controller
{
    public function __construct(){
        $this->danaModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'info_user' => $this->danaModel->KaryawanData(),
            'dana' => $this->danaModel->PengajuaDana(),
        ];
        return view('pengajuan_dana.v_index', $data);
    }
    public function detail($id){

        if (!$this->danaModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'dana' => $this->danaModel->detailData($id),
        ];
        return view('pengajuan_dana.v_detail_dana', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->danaModel->KaryawanData(),
        ];
        return view('pengajuan_dana.v_add_dana',$data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'tgl_pengajuan' => 'required',
            'nama_pengajuan' => 'required',
            'jenis_pengajuan' => 'required',
            'rincian_pengajuan' => 'required',
            'nominal' => 'required|numeric',
        ],[
            'tgl_pengajuan.required' => 'Tanggal Pengajuan Harus Diisi !!',
            'jenis_pengajuan.required' => 'Jenis Pengajuan Harus Diisi !!',
            'nama_pengajuan.required' => 'Nama Pengajuan Harus Diisi !!',
            'rincian_pengajuan.required' => 'Keterangan Harus Diisi !!',
            'nominal.required' => 'Nominal Pengajuan Dana Harus Diisi !!',
        ]);


        $data = [
            'tgl_pengajuan' => Request()->tgl_pengajuan,
            'jenis_pengajuan' => Request()->jenis_pengajuan,
            'nama_pengajuan' => Request()->nama_pengajuan,
            'rincian_pengajuan' => Request()->rincian_pengajuan,
            'nominal' => Request()->nominal,
            'status' => Request()->status,
            'id_karyawan' => Request()->id_karyawan,
            'tgl_konfirmasi' => Request()->tgl_konfirmasi,
            'id_karyawan_konfir' => Request()->id_karyawan_konfir,
        ];

        $this->danaModel->addData('pengajuan_dana', $data);
        return redirect()->route('pengajuan_dana')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'pengajuan_dana'){

        if (!$this->danaModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'dana' => $this->danaModel->detailPengajuanDana($id),
            'info_user' => $this->danaModel->KaryawanData(),
        ];
        return view('pengajuan_dana.v_edit_dana', $data);
    }
    public function update($id, $table = 'pengajuan_dana'){

        //form Validation
        Request()->validate([
            'tgl_pengajuan' => 'required',
            'jenis_pengajuan' => 'required',
            'nama_pengajuan' => 'required',
            'rincian_pengajuan' => 'required',
            'nominal' => 'required|numeric',
        ],[
            'tgl_pengajuan.required' => 'Tanggal Pengajuan Harus Diisi !!',
            'jenis_pengajuan.required' => 'Nama Pengajuan Harus Diisi !!',
            'nama_pengajuan.required' => 'Nama Pengajuan Harus Diisi !!',
            'rincian_pengajuan.required' => 'Keterangan Harus Diisi !!',
            'nominal.required' => 'Nominal Pengajuan Dana Harus Diisi !!',
        ]);


        $data = [
            'tgl_pengajuan' => Request()->tgl_pengajuan,
            'jenis_pengajuan' => Request()->jenis_pengajuan,
            'nama_pengajuan' => Request()->nama_pengajuan,
            'rincian_pengajuan' => Request()->rincian_pengajuan,
            'nominal' => Request()->nominal,
            'status' => Request()->status,
            'id_karyawan' => Request()->id_karyawan,
            'tgl_konfirmasi' => Request()->tgl_konfirmasi,
            'id_karyawan_konfir' => Request()->id_karyawan_konfir,
        ];

        $this->danaModel->editData($table,$id,$data);
        return redirect()->route('pengajuan_dana')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'pengajuan_dana'){
        $this->danaModel->deleteData($table,$id);
        return redirect()->route('pengajuan_dana')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function report(){

        $data = [
            'info_user' => $this->danaModel->KaryawanData(),
            'dana' => $this->danaModel->PengajuaDana(),
        ];
        return view('pengajuan_dana.v_report_dana', $data);
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
            'info_user' => $this->danaModel->KaryawanData(),
            'dana' => $this->danaModel->PengajuaDanaByRangeTgl($tglAwal,$tglAkhir),
        ];
        //dd($data);
        return view('pengajuan_dana.v_report_dana', $data);
    }

    public function suratPengajuan($id, $table = 'pengajuan_dana'){

        if (!$this->danaModel->detailData($table,$id)) {
            abort(404);

        }
        $jadwal = $this->danaModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Booking") {
            $idbooking = $jadwal->id_booking;
            $idunit = $jadwal->id_unit;
            $booking = $this->danaModel->detailData('booking',$idbooking);
            $keteranganBook = $booking->keterangan;
            $idtipe = $booking->id_tipe;
            $idharga = $booking->id_hargatujuan;
            $data = [
                'info_user' => $this->danaModel->KaryawanData(),
                'jadwal' => $this->danaModel->detailPenjadwalan($id),
                //'booking' => $this->danaModel->bookingData(),
                'bookingDetail' => $this->danaModel->detailData('booking',$idbooking),
                'supir' => $this->danaModel->dataSupirKend($idunit),
                'supirData' => $this->danaModel->supirDataOther(),
                'crew' => $this->danaModel->allData('crew_pool'),
                'unit' => $this->danaModel->detailData('unit_kendaraan',$idunit),
                //'tipeUnit' => $this->danaModel->dataTipeUnitKend($idtipe),
                'tipeUnit' => $this->danaModel->detailData('tipe_kendaraan',$idtipe),
                'mitra' => $this->danaModel->allData('mitra'),
                'kostumer' => $this->danaModel->dataKostumer(),
                'hargaTujuan' => $this->danaModel->getDataTujuan($idharga),
                'keteranganBook' => $keteranganBook,
            ];
        }
        //dd($data);
        return view('pengajuan_dana.v_surat_pengajuan', $data);
    }

    public function suratPengajuan_print($id, $table = 'pengajuan_dana'){

        if (!$this->jadwalModel->detailData($table,$id)) {
            abort(404);

        }
        $jadwal = $this->danaModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Booking") {
            $idbooking = $jadwal->id_booking;
            $idunit = $jadwal->id_unit;
            $booking = $this->danaModel->detailData('booking',$idbooking);
            $keteranganBook = $booking->keterangan;
            $idtipe = $booking->id_tipe;
            $idharga = $booking->id_hargatujuan;
            $data = [
                'info_user' => $this->danaModel->KaryawanData(),
                'jadwal' => $this->danaModel->detailPenjadwalan($id),
                //'booking' => $this->danaModel->bookingData(),
                'bookingDetail' => $this->danaModel->detailData('booking',$idbooking),
                'supir' => $this->danaModel->dataSupirKend($idunit),
                'supirData' => $this->danaModel->supirDataOther(),
                'crew' => $this->danaModel->allData('crew_pool'),
                'unit' => $this->danaModel->detailData('unit_kendaraan',$idunit),
                'tipeUnit' => $this->danaModel->detailData('tipe_kendaraan',$idtipe),
                //'tipeUnit' => $this->danaModel->dataTipeUnitKend($idtipe),
                'mitra' => $this->danaModel->allData('mitra'),
                'kostumer' => $this->danaModel->dataKostumer(),
                'hargaTujuan' => $this->danaModel->getDataTujuan($idharga),
                'keteranganBook' => $keteranganBook,
            ];
        }
        //dd($data);
        return view('pengajuan_dana.v_surat_pengajuan_print', $data);
    }
}
