<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PenjadwalanController extends Controller
{
    public function __construct(){
        $this->jadwalModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'info_user' => $this->jadwalModel->KaryawanData(),
            'jadwal' => $this->jadwalModel->penjadwalanData(),
            'supir' => $this->jadwalModel->supirDataOther(),
            'booking' => $this->jadwalModel->bookingData(),
            'kostumer' => $this->jadwalModel->dataKostumer(),
            'crew' => $this->jadwalModel->allData('crew_pool'),
        ];
        //dd($data);
        return view('penjadwalan.v_index', $data);
    }
    public function detail($id){

        if (!$this->jadwalModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'jadwal' => $this->jadwalModel->detailData($id),
        ];
        return view('penjadwalan.v_detail_jadwal', $data);
    }

    public function add(){

        $data = [
            'info_user' => $this->jadwalModel->KaryawanData(),
            'booking' => $this->jadwalModel->bookingData(),
            'tipe' => $this->jadwalModel->allData('tipe_kendaraan'),
            'unit' => $this->jadwalModel->allData('unit_kendaraan'),
            //'users' => $this->jadwalModel->allData('users'),
        ];

        return view('penjadwalan.v_add_jadwal', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'jenis_jadwal' => 'required',
            //'id_unit' => 'required',
            //'tgl_jadwal' => 'required',
            //'durasi' => 'required',
        ],[
            'jenis_jadwal.required' => 'Status Jadwal Harus Dipilih !!',
            //'id_unit.required' => 'Unit Kendaraan Harus Diisi !!',
            //'tgl_jadwal.required' => 'Tanggal Harus Diisi !!',
            //'durasi.required' => 'Durasi Waktu Harus Diisi !!',
        ]);


        $data = [
            'jenis_jadwal' => Request()->jenis_jadwal,
            'id_booking' => Request()->id_booking,
            'id_unit' => Request()->id_unit,
            'tgl_jadwal' => Request()->tgl_jadwal,
            'durasi' => Request()->durasi,
            'status_jadwal' => "Pending",
        ];

        if (Request()->jenis_jadwal = "Service") {
            $id_unit = Request()->id_unit;
            $status = ['status_unit' => 'Perbaikan',];
            $this->jadwalModel->editData('unit_kendaraan',$id_unit,$status);

            $this->jadwalModel->addData('penjadwalan', $data);

            $idjadwal = DB::getPdo()->lastInsertId();
            $dataOpr = [
                'id_jadwal' => $idjadwal,
                'jenis_opr' => Request()->jenis_opr,
            ];

            $this->jadwalModel->addData('operasional', $dataOpr);

            $unit = $this->jadwalModel->detailData('unit_kendaraan',$id_unit);
            $title = Request()->jenis_opr." ".$unit->nama_unit;

            $durasi = Request()->durasi;
            $enddate=date_create(Request()->tgl_jadwal);
            date_add($enddate,date_interval_create_from_date_string($durasi." days"));

            $dataEvent = [
                'title' => $title,
                'status_event' => Request()->jenis_opr,
                'id_status' => $idjadwal,
                'start' => Request()->tgl_jadwal,
                'end' => $enddate,
            ];

            $this->jadwalModel->addData('events', $dataEvent);
        }
        return redirect()->route('penjadwalan')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'penjadwalan'){

        if (!$this->jadwalModel->detailData($table,$id)) {
            abort(404);

        }
        $jadwal = $this->jadwalModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Booking") {
            $idbooking = $jadwal->id_booking;
            $idunit = $jadwal->id_unit;
            $booking = $this->jadwalModel->detailData('booking',$idbooking);
            $idtipe = $booking->id_tipe;
            $keteranganBook = $booking->keterangan;
            $idhargaTujuan = $booking->id_hargatujuan;
            $data = [
                'info_user' => $this->jadwalModel->KaryawanData(),
                'jadwal' => $this->jadwalModel->detailPenjadwalan($id),
                'booking' => $this->jadwalModel->bookingData(),
                'supir' => $this->jadwalModel->dataSupirKend($idunit),
                'supirData' => $this->jadwalModel->dataOtherSupir($idunit),
                'crewData' => $this->jadwalModel->dataHelper($idunit),
                'crew' => $this->jadwalModel->dataOtherHelper($idunit),
                'unit' => $this->jadwalModel->allData('unit_kendaraan'),
                'tipeUnit' => $this->jadwalModel->dataUnitBook($idtipe),
                'tipeKend' => $this->jadwalModel->detailData('tipe_kendaraan',$idtipe),
                'hargaTujuan' => $this->jadwalModel->detailData('harga_tujuan',$idhargaTujuan),
                'tujuan' => $this->jadwalModel->allData('tujuan'),
                'kostumer' => $this->jadwalModel->dataKostumer(),
                'keteranganBook' => $keteranganBook,
            ];
            //dd($data);
            return view('penjadwalan.v_edit_jadwal', $data);
        } else {
            $idunit = $jadwal->id_unit;
            $unit = $this->jadwalModel->detailData('unit_kendaraan',$idunit);
            //$idtipe = $unit->id_tipe;
            //$operasi = $this->jadwalModel->getOperasiJadwal($id);

            $data = [
                'info_user' => $this->jadwalModel->KaryawanData(),
                'idtipe' => $unit->id_tipe,
                'jadwal' => $this->jadwalModel->detailPenjadwalan($id),
                //'booking' => $this->jadwalModel->bookingData(),
                'tipe' => $this->jadwalModel->allData('tipe_kendaraan'),
                'unit' => $this->jadwalModel->allData('unit_kendaraan'),
                'crew' => $this->jadwalModel->allData('crew_pool'),
                'operasi' => $this->jadwalModel->getOperasiJadwal($id),
            ];
            return view('penjadwalan.v_edit_jadwal', $data);
        }


    }
    public function update($id, $table = 'penjadwalan'){

        //form Validation
        if (Request()->jenis_jadwal == "Booking") {
            Request()->validate([
                //'jenis_jadwal' => 'required',
                'id_unit' => 'required',
                //''id_supir' => 'required',
                //'id_crew' => 'required',
            ],[
                //'jenis_jadwal.required' => 'Status Jadwal Harus Dipilih !!',
                'id_unit.required' => 'Unit Kendaraan Harus Diisi !!',
                //''id_supir.required' => 'Driver Harus Diisi !!',
                //'id_supir.required' => 'Helper Waktu Harus Diisi !!',
            ]);
        }


        if (Request()->id_supir != null){
            $dataSupir = implode(",", Request()->id_supir);
        }else{
            $dataSupir = null;
        }
        if (Request()->id_crew != null){
            $dataCrew = implode(",", Request()->id_crew);
        }else{
            $dataCrew = null;
        }

        $booking = $this->jadwalModel->detailData('booking',Request()->id_booking);
        $idhargaTujuan = $booking->id_hargatujuan;
        $hargaTujuan = $this->jadwalModel->detailData('harga_tujuan',$idhargaTujuan);

        $bbm = Request()->bahan_bakar;
        $premi_supir = Request()->premi_supir;
        $premi_helper = Request()->premi_helper;
        $potongan_supir = Request()->potongan_supir;
        $potongan_helper = Request()->potongan_helper;
        $kas_tabungan = Request()->kas_tabungan;

        if ($hargaTujuan->jum_supir > 1){
            $premi_supir = $premi_supir * $hargaTujuan->jum_supir;
        }

        $total_kas_keluar = $bbm + (($premi_supir * $booking->lama_booking) - $potongan_supir) + (($premi_helper * $booking->lama_booking) - $potongan_helper) + $kas_tabungan;
        //dd($bbm,"+ (",$premi_supir,"-",$potongan_supir,") + (",$premi_helper,"-",$potongan_helper,") + ",$kas_tabungan," = ",$total_kas_keluar);

        $dataStatus = $this->jadwalModel->detailData($table,$id);
        if ($dataStatus->status_jadwal != null) {
            $status_jadwal = $dataStatus->status_jadwal;
        }else{
            $status_jadwal = "Pending";
        }

        $data = [
            'jenis_jadwal' => Request()->jenis_jadwal,
            'id_booking' => Request()->id_booking,
            'id_unit' => Request()->id_unit,
            'id_supir' => $dataSupir,
            'id_crew' => $dataCrew,
            'tgl_jadwal' => Request()->tgl_jadwal,
            'durasi' => Request()->durasi,
            'status_jadwal' => $status_jadwal,
            'bahan_bakar' => Request()->bahan_bakar,
            'premi_supir' => Request()->premi_supir,
            'premi_helper' => Request()->premi_helper,
            'potongan_supir' => Request()->potongan_supir,
            'potongan_helper' => Request()->potongan_helper,
            'kas_tabungan' => Request()->kas_tabungan,
            'jam_standby' => Request()->jam_standby,
            'rute' => Request()->rute,
            'catatan' => Request()->catatan,
            'total_kas_keluar' => $total_kas_keluar,
        ];

        if (Request()->jenis_jadwal == "Service") {
            //SERVICE EVENT
            $jadwal = $this->jadwalModel->detailPenjadwalan($id);
            $idUnit_lama = $jadwal->id_unit;

            if ($idUnit_lama != Request()->id_unit) {
                $idUnit_baru = Request()->id_unit;
                $status_lama = ['status_unit' => 'Tersedia',];
                $status_baru = ['status_unit' => 'Perbaikan',];
                $this->jadwalModel->editData('unit_kendaraan',$idUnit_lama,$status_lama);
                $this->jadwalModel->editData('unit_kendaraan',$idUnit_baru,$status_baru);

                $unit = $this->jadwalModel->detailData('unit_kendaraan',$idUnit_baru);

            }

            $operasi = $this->jadwalModel->getOperasiJadwal($id);
            $id_opr = $operasi->id;

            $dataOpr = [
                'jenis_opr' => Request()->jenis_opr,
            ];

            $this->jadwalModel->editData('operasional',$id_opr, $dataOpr);

            $unit = $this->jadwalModel->detailData('unit_kendaraan',Request()->id_unit);
            $title = Request()->jenis_opr." ".$unit->nama_unit;

            $durasi = Request()->durasi;
            $enddate=date_create(Request()->tgl_jadwal);
            date_add($enddate,date_interval_create_from_date_string($durasi." days"));

            $dataEvent = [
                'title' => $title,
                'status_event' => Request()->jenis_opr,
                'id_status' => $id,
                'start' => Request()->tgl_jadwal,
                'end' => $enddate,
            ];

            $event = $this->jadwalModel->getEventJadwal($id);
            $id_event = $event->id;
            $this->jadwalModel->editData('events',$id_event,$dataEvent);

        } else{
            //BOOKING EVENT
            $unit = $this->jadwalModel->detailData('unit_kendaraan',Request()->id_unit);
            $title = "Booking ".$unit->nama_unit;

            $durasi = Request()->durasi;
            $enddate=date_create(Request()->tgl_jadwal);
            date_add($enddate,date_interval_create_from_date_string($durasi." days"));

            $dataEvent = [
                'title' => $title,
                'status_event' => "Booking",
                'id_status' => $id,
                'start' => Request()->tgl_jadwal,
                'end' => $enddate,
            ];

            $event = $this->jadwalModel->getEventJadwal($id);
            if ($event == null) {
                $this->jadwalModel->addData('events', $dataEvent);
            }else{
               $id_event = $event->id;
                $this->jadwalModel->editData('events',$id_event,$dataEvent);

            }

            $booking = $this->jadwalModel->detailData('booking',Request()->id_booking);
            //$idtipe = $booking->id_tipe;
            $tipeKend = $this->jadwalModel->detailData('tipe_kendaraan',$booking->id_tipe);
            $hargaTujuan = $this->jadwalModel->detailData('harga_tujuan',$booking->id_hargatujuan);


            $info_user = $this->jadwalModel->KaryawanData();
            foreach ($info_user as $dataInfo){
                if ($dataInfo->idUsers == Auth::user()->id){
                    $idKaryawan = $dataInfo->idKaryawan;
                }
            }

            /*
            $namaPengajuan = 'Kas Jalan '.Request()->tgl_jadwal.' - '.$tipeKend->nama_tipe;
            $rincianPengajuan = 'Unit Bisnis : '.$unit->nama_unit.' / '.'No Pol. : '.$unit->no_plat;
            $premi_supir = ($tipeKend->premi_supir*$booking->lama_booking)*$hargaTujuan->jum_supir;
            $premi_kernet = ($tipeKend->premi_kernet*$booking->lama_booking)*$hargaTujuan->jum_kernet;
            $nominal = $premi_supir + $premi_kernet + Request()->bahan_bakar;
            $dataDana = [
                'tgl_pengajuan' => Request()->tgl_jadwal,
                'jenis_pengajuan' => 'Perjalanan',
                'nama_pengajuan' => $namaPengajuan,
                'rincian_pengajuan' => $rincianPengajuan,
                'nominal' => $nominal,
                'status' => 'Pending',
                'id_karyawan' => $idKaryawan,
            ];
            //dd($dataDana);
            $this->jadwalModel->addData('pengajuan_dana', $dataDana);
            */
        }


        $this->jadwalModel->editData($table,$id,$data);
        return redirect()->route('penjadwalan')->with('pesan', 'Data Berhasil Diubah');
    }
    public function delete($id, $table = 'penjadwalan'){

        $jadwal = $this->jadwalModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Service") {
                $operasi = $this->jadwalModel->getOperasiJadwal($id);
                $id_opr = $operasi->id;
                $this->jadwalModel->deleteData('operasional',$id_opr);
        } else if ($jadwal->jenis_jadwal == "Booking"){
            $idbooking = $jadwal->id_booking;

            $this->jadwalModel->deleteData('booking', $idbooking);

        }

        $idUnit = $jadwal->id_unit;
        $status = ['status_unit' => 'Tersedia',];
        $this->jadwalModel->editData('unit_kendaraan',$idUnit,$status);

        $event = $this->jadwalModel->getEventJadwal($id);
        //dd($event);
        if ($event != null) {
            $id_event = $event->id;
            $this->jadwalModel->deleteData('events',$id_event);
        }
        $this->jadwalModel->deleteData($table,$id);
        return redirect()->route('penjadwalan')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function prosesUnitJalan($id){
        $status_unit = ['status_unit' => 'Tidak Tersedia',];
        $dataJadwal = [
            'status_jadwal' => 'Proses',
        ];

        $this->jadwalModel->editData('penjadwalan',$id,$dataJadwal);

        $unit = $this->jadwalModel->detailData('penjadwalan',$id);

        $idUnit = $unit->id_unit;

        $this->jadwalModel->editData('unit_kendaraan',$idUnit,$status_unit);
        return redirect()->route('penjadwalan')->with('pesan', 'Data Berhasil Diproses');
    }
    public function selesai($id){
        $status_unit = ['status_unit' => 'Tersedia',];
        $status_jadwal = ['status_jadwal' => 'Selesai',];

        $this->jadwalModel->editData('penjadwalan',$id,$status_jadwal);

        $unit = $this->jadwalModel->allData('penjadwalan');

        $idUnit = null;
        foreach ($unit as $data) {
            if ($data->id == $id) {
               $idUnit = $data->id_unit;
            }
        }
        //$idUnit = $data['unit']->id_unit;
        $this->jadwalModel->editData('unit_kendaraan',$idUnit,$status_unit);
        return redirect()->route('penjadwalan')->with('pesan', 'Data Berhasil Dikerjakan');
    }

    public function GetTipeUnitKend($id){
            echo json_encode($this->jadwalModel->dataUnitService($id));

    }
    public function GetSupirKend($id){
            echo json_encode($this->jadwalModel->dataSupirKend($id));

    }
    public function GetOtherSupir($id){
            echo json_encode($this->jadwalModel->dataOtherSupir($id));

    }
    public function GetHelper($id){
            echo json_encode($this->jadwalModel->dataHelper($id));

    }
    public function GetOtherHelper($id){
            echo json_encode($this->jadwalModel->dataOtherHelper($id));

    }
    public function report(){

        $data = [
            'info_user' => $this->jadwalModel->KaryawanData(),
            'jadwal' => $this->jadwalModel->penjadwalanData(),
            'supir' => $this->jadwalModel->supirDataOther(),
            'booking' => $this->jadwalModel->bookingData(),
            'kostumer' => $this->jadwalModel->dataKostumer(),
            'crew' => $this->jadwalModel->allData('crew_pool'),

        ];
        return view('penjadwalan.v_report_jadwal', $data);
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
            'info_user' => $this->jadwalModel->KaryawanData(),
            'jadwal' => $this->jadwalModel->penjadwalanDataByRangeTgl($tglAwal,$tglAkhir),
            'supir' => $this->jadwalModel->supirDataOther(),
            'booking' => $this->jadwalModel->bookingData(),
            'kostumer' => $this->jadwalModel->dataKostumer(),
            'crew' => $this->jadwalModel->allData('crew_pool'),
        ];
        //dd($data);
        return view('penjadwalan.v_report_jadwal', $data);
    }

    public function suratJalan($id, $table = 'penjadwalan'){

        if (!$this->jadwalModel->detailData($table,$id)) {
            abort(404);

        }
        $jadwal = $this->jadwalModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Booking") {
            $idbooking = $jadwal->id_booking;
            $idunit = $jadwal->id_unit;
            $booking = $this->jadwalModel->detailData('booking',$idbooking);
            $keteranganBook = $booking->keterangan;
            $idtipe = $booking->id_tipe;
            $idharga = $booking->id_hargatujuan;
            $data = [
                'info_user' => $this->jadwalModel->KaryawanData(),
                'jadwal' => $this->jadwalModel->detailPenjadwalan($id),
                //'booking' => $this->jadwalModel->bookingData(),
                'bookingDetail' => $this->jadwalModel->detailData('booking',$idbooking),
                'supir' => $this->jadwalModel->dataSupirKend($idunit),
                'supirData' => $this->jadwalModel->supirDataOther(),
                'crew' => $this->jadwalModel->allData('crew_pool'),
                'unit' => $this->jadwalModel->detailData('unit_kendaraan',$idunit),
                //'tipeUnit' => $this->jadwalModel->dataTipeUnitKend($idtipe),
                'tipeUnit' => $this->jadwalModel->detailData('tipe_kendaraan',$idtipe),
                'mitra' => $this->jadwalModel->allData('mitra'),
                'kostumer' => $this->jadwalModel->dataKostumer(),
                'hargaTujuan' => $this->jadwalModel->getDataTujuan($idharga),
                'keteranganBook' => $keteranganBook,
            ];
        }
        //dd($data);
        return view('penjadwalan.v_surat_jalan', $data);
    }

    public function suratJalan_print($id, $table = 'penjadwalan'){

        if (!$this->jadwalModel->detailData($table,$id)) {
            abort(404);

        }
        $jadwal = $this->jadwalModel->detailPenjadwalan($id);
        if ($jadwal->jenis_jadwal == "Booking") {
            $idbooking = $jadwal->id_booking;
            $idunit = $jadwal->id_unit;
            $booking = $this->jadwalModel->detailData('booking',$idbooking);
            $keteranganBook = $booking->keterangan;
            $idtipe = $booking->id_tipe;
            $idharga = $booking->id_hargatujuan;
            $data = [
                'info_user' => $this->jadwalModel->KaryawanData(),
                'jadwal' => $this->jadwalModel->detailPenjadwalan($id),
                //'booking' => $this->jadwalModel->bookingData(),
                'bookingDetail' => $this->jadwalModel->detailData('booking',$idbooking),
                'supir' => $this->jadwalModel->dataSupirKend($idunit),
                'supirData' => $this->jadwalModel->supirDataOther(),
                'crew' => $this->jadwalModel->allData('crew_pool'),
                'unit' => $this->jadwalModel->detailData('unit_kendaraan',$idunit),
                'tipeUnit' => $this->jadwalModel->detailData('tipe_kendaraan',$idtipe),
                //'tipeUnit' => $this->jadwalModel->dataTipeUnitKend($idtipe),
                'mitra' => $this->jadwalModel->allData('mitra'),
                'kostumer' => $this->jadwalModel->dataKostumer(),
                'hargaTujuan' => $this->jadwalModel->getDataTujuan($idharga),
                'keteranganBook' => $keteranganBook,
            ];
        }
        //dd($data);
        return view('penjadwalan.v_surat_jalan_print', $data);
    }
}
