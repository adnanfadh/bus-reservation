<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct(){
        $this->bookModel = new HomeModel();
        $this->middleware('auth');
    }
    public function index(){

        $data = [
            'booking' => $this->bookModel->bookingData(),
            'mitra' => $this->bookModel->allData('mitra'),
            'tipe_kend' => $this->bookModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
            'karyawan' => $this->bookModel->KaryawanData(),
            'kostumer' => $this->bookModel->dataKostumer(),
        ];
        return view('booking.v_index', $data);
    }
    public function detail($id){

        if (!$this->bookModel->detailData($id)) {
            abort(404);
        }
        $data = [
            'booking' => $this->bookModel->detailData($id),
        ];
        return view('booking.v_detail_booking', $data);
    }

    public function add(){

        $users = $this->bookModel->KaryawanRoleData();
        $role = $this->bookModel->allData('role');

        foreach ($users as $data){
            $arrayRole = explode(",",$data->id_role);

            for ($i=0; $i < count($arrayRole); $i++) {
                foreach ($role as $dataRole){
                    if ($dataRole->id==$arrayRole[$i]) {
                        if ($dataRole->role == "Marketing") {
                            $arrayMarketing[] = [
                                        'id_karyawan'=>$data->idKaryawan,
                                        'nama_karyawan'=>$data->nama,
                                        ];
                        }
                    }
                }
            }
        }
        $dataMarketing = $arrayMarketing;

        // foreach ($dataMarketing as $data1){
        //     dd($data1["id_karyawan"]);
        // }

         //dd($users,$arrayRole, $dataMarketing,$arrayMarketing);


        $data = [
            'tipe' => $this->bookModel->allData('tipe_kendaraan'),
            'hargaTujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'mitra' => $this->bookModel->allData('mitra'),
            //'kostumer' => $this->bookModel->dataKostumerDesc(),
            'info_user' => $this->bookModel->KaryawanData(),
            'marketing' => $dataMarketing,

        ];

        return view('booking.v_add_booking', $data);
    }

    public function insert(){

        //form Validation
        Request()->validate([
            'idbooking' => 'required',
            'tgl_booking' => 'required',
            'lama_booking' => 'required',
            'jenis_booking' => 'required',
            'nama_kostumer' => 'required',
            //'alamat_kostumer' => 'required',
            //'telp_kostumer' => 'required',
            'id_mitra' => 'nullable',
            'id_tipe' => 'required',
            'id_hargaTujuan' => 'required',
            'harga_nominal' => 'required',
            'qty' => 'required',
            'metode_bayar' => 'required',
            'bukti_bayar' => 'nullable',
            //'status_booking' => 'required',
            'id_karyawan' => 'required',
        ],[
            'idbooking.required' => 'No Booking Harus Diisi !!',
            'tgl_booking.required' => 'Tanggal Booking Harus Diisi !!',
            'lama_booking.required' => 'Durasi Booking Harus Diisi !!',
            'jenis_booking.required' => 'Jenis Booking Harus Diisi !!',
            'nama_kostumer.required' => 'Nama Kostumer Harus Diisi !!',
            //'alamat_kostumer.required' => 'Alamat Kostumer Harus Diisi !!',
            //'telp_kostumer.required' => 'Telepon Kostumer Harus Diisi !!',
            'id_hargaTujuan.required' => 'Tujuan Harus Diisi !!',
            'harga_nominal.required' => 'Harga Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'qty.required' => 'QTY Harus Diisi !!',
            'metode_bayar.required' => 'Metode Bayar Harus Diisi !!',
            //'status_booking.required' => 'Status Harus Diisi !!',
            //'id_user.required' => 'Penanggung Jawab Harus Diisi !!',
        ]);

        //$hargaTujuan = $this->bookModel->detailData('harga_tujuan',Request()->id_hargaTujuan);

        //$nominal = $hargaTujuan->harga;
        $nominal = Request()->harga_nominal;
        //$lamaBook = Request()->lama_booking;
        //$subtotal_hari = $nominal * $lamaBook;
        //$qty = Request()->qty;
        $total =  $nominal;

        if (Request()->bukti_bayar != null ){
            $file = Request()->bukti_bayar;
            $filename = Request()->tgl_booking. '.'. $file->extension();
            $file->move(public_path('img'), $filename);
        }else{
            $filename = null;
        }

        $data = [
            'id' => Request()->idbooking,
            'tgl_booking' => Request()->tgl_booking,
            'lama_booking' => Request()->lama_booking,
            'jenis_booking' => Request()->jenis_booking,
            'nama_kostumer' => Request()->nama_kostumer,
            'alamat_kostumer' => Request()->alamat_kostumer,
            'telp_kostumer' => Request()->telp_kostumer,
            //'id_kostumer' => Request()->id_kostumer,
            'id_mitra' => Request()->id_mitra,
            'id_tipe' => Request()->id_tipe,
            'id_hargaTujuan' => Request()->id_hargaTujuan,
            'harga_nominal' => Request()->harga_nominal,
            'qty' => Request()->qty,
            'total' => $total,
            'metode_bayar' => Request()->metode_bayar,
            'bukti_bayar' => $filename,
            'status_booking' => "Pending",
            'alamat_jemput' => Request()->alamat_jemput,
            'keterangan' => Request()->keterangan,
            'id_karyawan' => Request()->id_karyawan,
            'created_at' => date("Y.m.d"),
        ];

        $this->bookModel->addData('booking', $data);

        /*
        $idbooking = DB::getPdo()->lastInsertId();
        for ($i=0; $i < $qty; $i++) {
            $dataJadwal = [
                'jenis_jadwal' => "Booking",
                'id_booking' => $idbooking,
                'tgl_jadwal' => Request()->tgl_booking,
                'durasi' => Request()->lama_booking,
                'status_jadwal' => "Pending",
            ];

            $this->bookModel->addData('penjadwalan', $dataJadwal);
        }
        */
        //return response()->json(array('success' => true, 'last_insert_id' => $data->id), 200);

        return redirect()->route('booking')->with('pesan', 'Data Berhasil Ditambah');
    }
    public function edit($id, $table = 'booking'){

        if (!$this->bookModel->detailData($table,$id)) {
            abort(404);
        }

        $users = $this->bookModel->KaryawanRoleData();
        $role = $this->bookModel->allData('role');

        foreach ($users as $data){
            $arrayRole = explode(",",$data->id_role);

            for ($i=0; $i < count($arrayRole); $i++) {
                foreach ($role as $dataRole){
                    if ($dataRole->id==$arrayRole[$i]) {
                        if ($dataRole->role == "Marketing") {
                            $arrayMarketing[] = [
                                        'id_karyawan'=>$data->idKaryawan,
                                        'nama_karyawan'=>$data->nama,
                                        ];
                        }
                    }
                }
            }
        }
        $dataMarketing = $arrayMarketing;

        $data = [
            'booking' => $this->bookModel->detailData($table,$id),
            'tipe' => $this->bookModel->allData('tipe_kendaraan'),
            'mitra' => $this->bookModel->allData('mitra'),
            //'kostumer' => $this->bookModel->dataKostumerDesc(),
            'hargaTujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
            'marketing' => $dataMarketing,

        ];
        return view('booking.v_edit_booking', $data);
    }
    public function update($id, $table = 'booking'){

        //form Validation
        Request()->validate([
            'idbooking' => 'required',
            'tgl_booking' => 'required',
            'lama_booking' => 'required',
            'jenis_booking' => 'required',
            'nama_kostumer' => 'required',
            //'alamat_kostumer' => 'required',
            //'telp_kostumer' => 'required',
            'id_mitra' => 'nullable',
            'id_tipe' => 'required',
            'id_hargaTujuan' => 'required',
            'harga_nominal' => 'required',
            'qty' => 'required',
            'metode_bayar' => 'required',
            'bukti_bayar' => 'nullable',
            //'status_booking' => 'required',
            'id_karyawan' => 'required',
        ],[
            'idbooking.required' => 'No Booking Harus Diisi !!',
            'tgl_booking.required' => 'Tanggal Booking Harus Diisi !!',
            'lama_booking.required' => 'Durasi Booking Harus Diisi !!',
            'jenis_booking.required' => 'Jenis Booking Harus Diisi !!',
            'nama_kostumer.required' => 'Nama Kostumer Harus Diisi !!',
            //'alamat_kostumer.required' => 'Alamat Kostumer Harus Diisi !!',
            //'telp_kostumer.required' => 'Telepon Kostumer Harus Diisi !!',
            'id_hargaTujuan.required' => 'Tujuan Harus Diisi !!',
            'harga_nominal.required' => 'Harga Harus Diisi !!',
            'id_tipe.required' => 'Tipe Kendaraan Harus Diisi !!',
            'qty.required' => 'QTY Harus Diisi !!',
            'metode_bayar.required' => 'Metode Bayar Harus Diisi !!',
            //'status_booking.required' => 'Status Harus Diisi !!',
            //'id_user.required' => 'Penanggung Jawab Harus Diisi !!',
        ]);

       //$hargaTujuan = $this->bookModel->detailData('harga_tujuan',Request()->id_hargaTujuan);

        //$nominal = $hargaTujuan->harga;
        //$nominal = $hargaTujuan->harga;
        $nominal = Request()->harga_nominal;
        //$lamaBook = Request()->lama_booking;
        //$subtotal_hari = $nominal * $lamaBook;
        $qty = Request()->qty;
        $total =  $nominal;

        if (Request()->foto <> "") {
            $file = Request()->foto;
            $filename = Request()->nip. '.'. $file->extension();
            $file->move(public_path('img'), $filename);

            $data = [
                'tgl_booking' => Request()->tgl_booking,
                'lama_booking' => Request()->lama_booking,
                'jenis_booking' => Request()->jenis_booking,
                'nama_kostumer' => Request()->nama_kostumer,
                'alamat_kostumer' => Request()->alamat_kostumer,
                'telp_kostumer' => Request()->telp_kostumer,
                //'id_kostumer' => Request()->id_kostumer,
                'id_mitra' => Request()->id_mitra,
                'id_tipe' => Request()->id_tipe,
                'id_hargaTujuan' => Request()->id_hargaTujuan,
                'harga_nominal' => Request()->harga_nominal,
                'qty' => Request()->qty,
                'total' => $total,
                'metode_bayar' => Request()->metode_bayar,
                'bukti_bayar' => $filename,
                'status_booking' => Request()->status_booking,
                'alamat_jemput' => Request()->alamat_jemput,
                'keterangan' => Request()->keterangan,
                'id_karyawan' => Request()->id_karyawan,
                'created_at' => date("Y.m.d"),
            ];
        } else {
            $data = [
                'tgl_booking' => Request()->tgl_booking,
                'lama_booking' => Request()->lama_booking,
                'jenis_booking' => Request()->jenis_booking,
                'nama_kostumer' => Request()->nama_kostumer,
                'alamat_kostumer' => Request()->alamat_kostumer,
                'telp_kostumer' => Request()->telp_kostumer,
                //'id_kostumer' => Request()->id_kostumer,
                'id_mitra' => Request()->id_mitra,
                'id_tipe' => Request()->id_tipe,
                'id_hargaTujuan' => Request()->id_hargaTujuan,
                'harga_nominal' => Request()->harga_nominal,
                'qty' => Request()->qty,
                'total' => $total,
                'metode_bayar' => Request()->metode_bayar,
                'status_booking' => Request()->status_booking,
                'alamat_jemput' => Request()->alamat_jemput,
                'keterangan' => Request()->keterangan,
                'id_karyawan' => Request()->id_karyawan,
                'created_at' => date("Y.m.d"),
            ];
        }

        $this->bookModel->editData($table,$id,$data);

        if (Request()->status_booking == 'Sukses') {
            $jadwal = $this->bookModel->getJadwalBooking($id);
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
                        $dataJadwal = [
                           'id' => $idJadwal[$i],
                        ];
                        $this->bookModel->deleteData('penjadwalan',$idJadwal[$i]);
                        $a = $a -1;
                    }
                }else{
                    for ($i=count($jadwal); $i < $qty; $i++) {
                        $a = $a + 1;
                        //$dataJadwal[] =  $a;
                        $dataJadwal = [
                            'jenis_jadwal' => "Booking",
                            'id_booking' => $id,
                            'tgl_jadwal' => Request()->tgl_booking,
                            'durasi' => Request()->lama_booking,
                            'status_jadwal' => "Pending",
                        ];

                        $this->bookModel->addData('penjadwalan', $dataJadwal);
                    }
                }
               // $hasil = true;
            }else{
                $dataJadwal = [
                    'tgl_jadwal' => Request()->tgl_booking,
                    'durasi' => Request()->lama_booking,
                ];
            }
            // dd($jadwal, $idJadwal, count($jadwal), $qty, $a, $b);
            // $dataJadwal = [
            //    'tgl_jadwal' => Request()->tgl_booking,
            //    'durasi' => Request()->lama_booking,
            // ];

            $this->bookModel->editData('penjadwalan',$idJadwal,$dataJadwal);

            $event = $this->bookModel->getEventJadwal($idJadwal);
            if ($event != null) {

                    $id_event = $event->id;
                    //$unit = $this->bookModel->detailData('unit_kendaraan',$jadwal->id_unit);
                    $title = "Booking ".Request()->nama_kostumer;

                    $durasi = Request()->lama_booking;
                    $enddate=date_create(Request()->tgl_booking);
                    date_add($enddate,date_interval_create_from_date_string($durasi." days"));

                    $dataEvent = [
                        'title' => $title,
                        'status_event' => "Booking",
                        'id_status' => $idJadwal,
                        'start' => Request()->tgl_booking,
                        'end' => $enddate,
                    ];

                    $this->bookModel->editData('events',$id_event,$dataEvent);
            }
        }


        return redirect()->route('booking')->with('pesan', 'Data Berhasil Diubah');
    }

    public function payment($id, $table = 'booking'){

        $data = [
            'status_booking' => "Sukses",
            'updated_at' => date("Y.m.d"),
        ];
        $this->bookModel->editData($table,$id,$data);

        $booking = $this->bookModel->detailData($table,$id);
        for ($i=0; $i < $booking->qty; $i++) {
            $dataJadwal = [
                'jenis_jadwal' => "Booking",
                'id_booking' => $id,
                'tgl_jadwal' => $booking->tgl_booking,
                'durasi' => $booking->lama_booking,
                'status_jadwal' => "Pending",
            ];

            $this->bookModel->addData('penjadwalan', $dataJadwal);
        }
        return redirect()->action([BookingController::class, 'invoice'], ['id' => $id])->with('pesan', 'Pembayaran Berhasil');
    }
    public function invoice($id, $table = 'booking'){

        if (!$this->bookModel->detailData($table,$id)) {
            abort(404);
        }
        //$invoice_number = Str::padLeft('James', 10, '-=');
        $data = [
            'booking' => $this->bookModel->detailData($table,$id),
            'tipe' => $this->bookModel->allData('tipe_kendaraan'),
            'mitra' => $this->bookModel->allData('mitra'),
            'kostumer' => $this->bookModel->dataKostumer(),
            'hargaTujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
        ];
        return view('booking.v_invoice', $data);
    }

    public function invoice_print($id, $table = 'booking'){

        if (!$this->bookModel->detailData($table,$id)) {
            abort(404);
        }
        $data = [
            'booking' => $this->bookModel->detailData($table,$id),
            'tipe' => $this->bookModel->allData('tipe_kendaraan'),
            'mitra' => $this->bookModel->allData('mitra'),
            'kostumer' => $this->bookModel->dataKostumer(),
            'hargaTujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
        ];
        return view('booking.v_invoice_print', $data);
    }
    public function delete($id, $table = 'booking'){
        $jadwal = $this->bookModel->getJadwalBooking($id);
        foreach ($jadwal as $data){
            //for ($i=0; $i < count($jadwal); $i++) {
                $this->bookModel->deleteData('penjadwalan',$data->id);
                //}
        }
        $this->bookModel->deleteData($table,$id);
        return redirect()->route('booking')->with('pesan', 'Data Berhasil Dihapus');
    }
    public function GetHargaTujuan($id){
        echo json_encode($this->bookModel->dataHargaTujuan($id));

    }
    public function report(){

        $data = [
            'booking' => $this->bookModel->bookingData(),
            'mitra' => $this->bookModel->allData('mitra'),
            'kostumer' => $this->bookModel->dataKostumer(),
            'tipe_kend' => $this->bookModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
            'karyawan' => $this->bookModel->KaryawanData(),

        ];
        return view('booking.v_report_booking', $data);
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
            'booking' => $this->bookModel->bookingDataByRangeTgl($tglAwal,$tglAkhir),
            'mitra' => $this->bookModel->allData('mitra'),
            'kostumer' => $this->bookModel->dataKostumer(),
            'tipe_kend' => $this->bookModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->bookModel->hargaData(),
            'tujuan' => $this->bookModel->allData('tujuan'),
            'info_user' => $this->bookModel->KaryawanData(),
            'karyawan' => $this->bookModel->KaryawanData(),

        ];
        //dd($data);
        return view('booking.v_report_booking', $data);
    }
}
