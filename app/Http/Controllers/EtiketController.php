<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;

class EtiketController extends Controller
{
    public function __construct(){
        $this->tiketModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'etiket' => $this->tiketModel->allData('etiket'),
            //'tipe_kend' => $this->tiketModel->allData('tipe_kendaraan'),
            //'harga_tujuan' => $this->tiketModel->hargaData(),
            //'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
            //'karyawan' => $this->tiketModel->KaryawanData(),
            //'kostumer' => $this->tiketModel->dataKostumer(),
        ];
        return view('etiket.v_index', $data);
    }
    public function detail($id){

        if (!$this->tiketModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'etiket' => $this->tiketModel->detailData($id),
        ];
        return view('etiket.v_detail_etiket', $data);
    }

    public function add(){

        $data = [
            'tipe' => $this->tiketModel->allData('tipe_kendaraan'),
            'hargaTujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
        ];

        return view('etiket.v_add_etiket', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'nama_etiket' => 'required',
            'kontingen_etiket' => 'required',
            'tgl_etiket' => 'required',
            'jam_etiket' => 'required',
            'hari_etiket' => 'required',
            'id_tipe' => 'required',
            'id_hargaTujuan' => 'required',
        ],[
            'tgl_etiket.required' => 'Nama Harus Diisi !!',
            'tgl_etiket.required' => 'Kontingen Harus Diisi !!',
            'tgl_etiket.required' => 'Tanggal Keberangkatan Harus Diisi !!',
            'jam_etiket.required' => 'Jam Keberangkatan Harus Diisi !!',
            'hari_etiket.required' => 'Hari Keberangkatan Harus Diisi !!',
            'id_hargaTujuan.required' => 'Tujuan Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
        ]);

        $arrayNama = implode("|",Request()->nama_etiket);

        $data = [
            'nama_etiket' => $arrayNama,
            'kontingen_etiket' => Request()->kontingen_etiket,
            'tgl_etiket' => Request()->tgl_etiket,
            'jam_etiket' => Request()->jam_etiket,
            'hari_etiket' => Request()->hari_etiket,
            'id_tipe' => Request()->id_tipe,
            'id_hargaTujuan' => Request()->id_hargaTujuan,
            'alamat_jemput' => Request()->alamat_jemput,
            'keterangan_etiket' => Request()->keterangan,
        ];

        $this->tiketModel->addData('etiket', $data);

        //return response()->json(array('success' => true, 'last_insert_id' => $data->id), 200);

        return redirect()->route('etiket')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'etiket'){

        if (!$this->tiketModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'etiket' => $this->tiketModel->detailData($table,$id),
            'tipe' => $this->tiketModel->allData('tipe_kendaraan'),
            'mitra' => $this->tiketModel->allData('mitra'),
            'kostumer' => $this->tiketModel->dataKostumerDesc(),
            'hargaTujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),

        ];
        return view('etiket.v_edit_etiket', $data);
    }
    public function update($id, $table = 'etiket'){

        //form Validation
        Request()->validate([
            'tgl_etiket' => 'required',
            'lama_etiket' => 'required',
            'jenis_etiket' => 'required',
            'id_kostumer' => 'nullable',
            'id_mitra' => 'nullable',
            'id_tipe' => 'required',
            'id_hargaTujuan' => 'required',
            'harga_nominal' => 'required',
            'qty' => 'required',
            'metode_bayar' => 'required',
            'bukti_bayar' => 'nullable',
            'status_etiket' => 'required',
            'keterangan' => 'nullable',
            'id_karyawan' => 'required',
        ],[
            'tgl_etiket.required' => 'Tanggal etiket Harus Diisi !!',
            'lama_etiket.required' => 'Durasi etiket Harus Diisi !!',
            'jenis_etiket.required' => 'Jenis etiket Harus Diisi !!',
            'id_hargaTujuan.required' => 'Tujuan Harus Diisi !!',
            'harga_nominal.required' => 'Harga Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'qty.required' => 'QTY Harus Diisi !!',
            'metode_bayar.required' => 'Metode Bayar Harus Diisi !!',
            'status_etiket.required' => 'Status Harus Diisi !!',
            'id_user.required' => 'Penanggung Jawab Harus Diisi !!',
        ]);

       //$hargaTujuan = $this->tiketModel->detailData('harga_tujuan',Request()->id_hargaTujuan);

        //$nominal = $hargaTujuan->harga;
        //$nominal = $hargaTujuan->harga;
        $nominal = Request()->harga_nominal;
        //$lamaBook = Request()->lama_etiket;
        //$subtotal_hari = $nominal * $lamaBook;
        $qty = Request()->qty;
        $total =  $nominal;

        if (Request()->foto <> "") {
            $file = Request()->foto;
            $filename = Request()->nip. '.'. $file->extension();
            $file->move(public_path('img'), $filename);

            $data = [
                'tgl_etiket' => Request()->tgl_etiket,
                'lama_etiket' => Request()->lama_etiket,
                'jenis_etiket' => Request()->jenis_etiket,
                'id_kostumer' => Request()->id_kostumer,
                'id_mitra' => Request()->id_mitra,
                'id_tipe' => Request()->id_tipe,
                'id_hargaTujuan' => Request()->id_hargaTujuan,
                'harga_nominal' => Request()->harga_nominal,
                'qty' => Request()->qty,
                'total' => $total,
                'metode_bayar' => Request()->metode_bayar,
                'bukti_bayar' => $filename,
                'status_etiket' => Request()->status_etiket,
                'alamat_jemput' => Request()->alamat_jemput,
                'keterangan' => Request()->keterangan,
                'id_karyawan' => Request()->id_karyawan,
            ];
        } else {
            $data = [
                'tgl_etiket' => Request()->tgl_etiket,
                'lama_etiket' => Request()->lama_etiket,
                'jenis_etiket' => Request()->jenis_etiket,
                'id_kostumer' => Request()->id_kostumer,
                'id_mitra' => Request()->id_mitra,
                'id_tipe' => Request()->id_tipe,
                'id_hargaTujuan' => Request()->id_hargaTujuan,
                'harga_nominal' => Request()->harga_nominal,
                'qty' => Request()->qty,
                'total' => $total,
                'metode_bayar' => Request()->metode_bayar,
                'status_etiket' => Request()->status_etiket,
                'alamat_jemput' => Request()->alamat_jemput,
                'keterangan' => Request()->keterangan,
                'id_karyawan' => Request()->id_karyawan,
            ];
        }

        $this->tiketModel->editData($table,$id,$data);

        $jadwal = $this->tiketModel->getJadwaletiket($id);
        foreach ($jadwal as $data){
            //for ($i=0; $i < count($jadwal); $i++) {
                $idJadwal[] = $data->id;
            //}
        }
        //dd($idJadwal);

        $a = count($jadwal);
        $b = $qty;
        if (count($jadwal) != $qty) {
            if (count($jadwal)  > $qty) {
                for ($i=$qty; $i < count($jadwal); $i++) {
                    //$dataJadwal = [
                    //    'id' => $idJadwal[$i],
                    //];
                    $this->tiketModel->deleteData('penjadwalan',$idJadwal[$i]);
                    $a = $a -1;
                }
            }else{
                for ($i=count($jadwal); $i < $qty; $i++) {
                    $a = $a + 1;
                    //$dataJadwal[] =  $a;
                    $dataJadwal = [
                        'jenis_jadwal' => "etiket",
                        'id_etiket' => $id,
                        'tgl_jadwal' => Request()->tgl_etiket,
                        'durasi' => Request()->lama_etiket,
                        'status_jadwal' => "Pending",
                    ];

                    $this->tiketModel->addData('penjadwalan', $dataJadwal);
                }
            }
           // $hasil = true;
        }else{
            $dataJadwal = [
                'tgl_jadwal' => Request()->tgl_etiket,
                'durasi' => Request()->lama_etiket,
            ];
        }
        //dd($jadwal, $idJadwal, count($jadwal), $qty, $a, $b);
        //$dataJadwal = [
        //    'tgl_jadwal' => Request()->tgl_etiket,
        //    'durasi' => Request()->lama_etiket,
        //];

        //$this->tiketModel->editData('penjadwalan',$idJadwal,$dataJadwal);

        $event = $this->tiketModel->getEventJadwal($idJadwal);
        if ($event != null) {

                $id_event = $event->id;
                $unit = $this->tiketModel->detailData('unit_kendaraan',$jadwal->id_unit);
                $title = "etiket ".$unit->nama_unit;

                $durasi = Request()->lama_etiket;
                $enddate=date_create(Request()->tgl_etiket);
                date_add($enddate,date_interval_create_from_date_string($durasi." days"));

                $dataEvent = [
                    'title' => $title,
                    'status_event' => "etiket",
                    'id_status' => $idJadwal,
                    'start' => Request()->tgl_etiket,
                    'end' => $enddate,
                ];

                $this->tiketModel->editData('events',$id_event,$dataEvent);
        }

        return redirect()->route('etiket')->with('pesan', 'Data Berhasil Diubah');
    }

    public function payment($id, $table = 'etiket'){

        $data = [
            'status_etiket' => "Sukses",
        ];
        $this->tiketModel->editData($table,$id,$data);
        return redirect()->action([etiketController::class, 'invoice'], ['id' => $id])->with('pesan', 'Pembayaran Berhasil');
    }
    public function ticket($id, $table = 'etiket'){

        if (!$this->tiketModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'etiket' => $this->tiketModel->detailData($table,$id),
            'tipe' => $this->tiketModel->allData('tipe_kendaraan'),
            'mitra' => $this->tiketModel->allData('mitra'),
            'kostumer' => $this->tiketModel->dataKostumer(),
            'hargaTujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
        ];
        return view('etiket.v_etiket', $data);
    }

    public function ticket_print($id, $table = 'etiket'){

        if (!$this->tiketModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'etiket' => $this->tiketModel->detailData($table,$id),
            'tipe' => $this->tiketModel->allData('tipe_kendaraan'),
            'mitra' => $this->tiketModel->allData('mitra'),
            'kostumer' => $this->tiketModel->dataKostumer(),
            'hargaTujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
        ];
        return view('etiket.v_etiket_print', $data);
    }
    public function delete($id, $table = 'etiket'){
        $this->tiketModel->deleteData($table,$id);
        return redirect()->route('etiket')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function GetHargaTujuan($id){
        echo json_encode($this->tiketModel->dataHargaTujuan2($id));

    }
    public function report(){

        $data = [
            'etiket' => $this->tiketModel->etiketData(),
            'mitra' => $this->tiketModel->allData('mitra'),
            'kostumer' => $this->tiketModel->dataKostumer(),
            'tipe_kend' => $this->tiketModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
        ];
        return view('etiket.v_report_etiket', $data);
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
            'etiket' => $this->tiketModel->etiketDataByRangeTgl($tglAwal,$tglAkhir),
            'mitra' => $this->tiketModel->allData('mitra'),
            'kostumer' => $this->tiketModel->dataKostumer(),
            'tipe_kend' => $this->tiketModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->tiketModel->hargaData(),
            'tujuan' => $this->tiketModel->allData('tujuan'),
            'info_user' => $this->tiketModel->KaryawanData(),
        ];
        //dd($data);
        return view('etiket.v_report_etiket', $data);
    }
}
