<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->homeModel = new HomeModel();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pendapatan_unit = $this->homeModel->pendapatanByUnit();
        //$pendapatan_month = $this->homeModel->pendapatanByMonth(11);
        $goal_pendapatan_unit = $this->homeModel->goalPendapatanByUnit();
        //$persen = $goal_pendapatan_unit->goal_pendapatan_unit / 100000000 * 100;
        //dd($goal_pendapatan_unit, $persen);

        //$arrayData[] = [1,2,3];
        for ($i=0; $i < count($pendapatan_unit) ; $i++) {
            if(is_null($pendapatan_unit[$i]->total_pendapatan) == true){
                $arrayData[$i] = 0;
            }else{
                $arrayData[$i] = $pendapatan_unit[$i]->total_pendapatan;
            }
        }
        $pendapatan = $arrayData;
        //$totalPemasukan = $this->homeModel->totalPemasukan();
        $a = 1;
        for ($i=0; $i <= 12 ; $i++) {
            if($this->homeModel->pendapatanByMonth($a) == 0){
                $arrayData2[$i] = 0;
            }else{
                $arrayData2[$i] = $this->homeModel->pendapatanByMonth($a);
            }
            $a++;
        }
        $pendapatanMonth = $arrayData2;
        //dd($pendapatanMonth,$pendapatan);

        $data = [
            'jadwal' => $this->homeModel->penjadwalanData(),
            'booking' => $this->homeModel->bookingData(),
            'mitra' => $this->homeModel->allData('mitra'),
            'tujuan' => $this->homeModel->allData('tujuan'),
            'tipe_kend' => $this->homeModel->allData('tipe_kendaraan'),
            'harga_tujuan' => $this->homeModel->hargaData(),
            'info_user' => $this->homeModel->KaryawanData(),
            'unit_kend' => $this->homeModel->tipeUnitKend(),
            'supir' => $this->homeModel->supirData(),
            'pendapatan_unit' => $pendapatan,
            'unit_tersedia' => $this->homeModel->unitTersedia(),
            'unit_jumlah' => $this->homeModel->jumlahUnit(),
            'jumlah_pending' => $this->homeModel->jumlahPending(),
            'jumlah_service' => $this->homeModel->jumlahService(),
            'jumlah_booking' => $this->homeModel->jumlahBooking(),
            'data_kostumer' => $this->homeModel->dataKostumerDesc(),
            'totalPemasukan' => $this->homeModel->totalPemasukan(),
            'totalPengeluaran' => $this->homeModel->totalPengeluaran(),
            'pendapatan_month' => $pendapatanMonth,
            'goal_pendapatan_unit' => $goal_pendapatan_unit,
        ];
       //dd($pendapatan);
        return view('v_home',$data);
    }

    public function about()
    {
        return view('v_about');
    }

    public function calendar()
    {
        return view('v_calendar');
    }
}
