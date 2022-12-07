<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HomeModel extends Model
{
     public function allData($table){

        return DB::table($table)->get();
     }
     public function detailData($table,$id){

        return DB::table($table)->where('id', $id)->first();
     }
     public function addData($table,$data){
         DB::table($table)->insert($data);
     }

     public function editData($table,$id,$data){
         DB::table($table)->where('id', $id)->update($data);
     }

     public function deleteData($table,$id){
        DB::table($table)->where('id', $id)->delete();
    }
    public function allDataOrderBy($table,$field,$order){

        return DB::table($table)
                    ->orderBy($field, $order)
                    ->get();
     }
    /// USERS TABLE
    public function usersAkses(){

        return DB::table('users')
                    ->select('users.*', 'users.id as idUsers','role.id as idRole', 'role.role', 'users_profile.id as idProfile', 'users_profile.*')
                    ->leftJoin('role', 'users.id_role', '=', 'role.id')
                    ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->get();
     }
     public function detailAksesData($id){

        return DB::table('users')
        ->Join('level_akses', 'users.level', '=', 'level_akses.id')
        ->where('users.id', $id)->first();
     }

     public function editPasswordData($table,$id,$data){
        DB::table($table)->where('id', $id)->update($data);
    }
    /// KARYAWAN
    public function KaryawanData(){

        return DB::table('karyawan')
                    ->select('karyawan.*', 'karyawan.id as idKaryawan','users.id as idUsers', 'users.*', 'users_profile.id as idUserProfile', 'users_profile.*',)
                    ->Join('users', 'karyawan.id_users', '=', 'users.id')
                    ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->get();
     }
    public function KaryawanRoleData(){

        return DB::table('karyawan')
                    ->select('karyawan.*', 'karyawan.id as idKaryawan','users.id as idUsers', 'users.*', 'users_profile.id as idUserProfile', 'users_profile.*','role.id as idRole', 'role.role',)
                    ->Join('users', 'karyawan.id_users', '=', 'users.id')
                    ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->leftJoin('role', 'users.id_role', '=', 'role.id')
                    ->get();
     }

    /// KENDARAAN
    public function tipeUnitKend(){

        return DB::table('unit_kendaraan')
                    ->select('unit_kendaraan.*', 'unit_kendaraan.id as idunit', 'tipe_kendaraan.id as id_tipeKend', 'tipe_kendaraan.*')
                    ->Join('tipe_kendaraan', 'unit_kendaraan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->orderBy('tipe_kendaraan.id', 'asc')
                    ->get();
     }

     public function rolesSupir(){

        return DB::table('roles')
                    ->where('name', 'supir')
                    ->first();
     }
     /*
     public function detailTipeUnitKend($id){

        return DB::table('users')
        ->Join('level_akses', 'users.level', '=', 'level_akses.id')
        ->where('users.id', $id)->first();
     }
     */
     public function supirData(){

        return DB::table('karyawan')
        ->select('karyawan.*','karyawan.id as idSupir','users.*', 'users_profile.*')
        ->Join('users', 'karyawan.id_users', '=', 'users.id')
        ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
        ->join('unit_kendaraan', 'karyawan.id', '=', 'unit_kendaraan.id_supir')
        ->where('karyawan.jabatan','supir')
        ->get();
     }

     public function supirDataOther(){

        return DB::table('karyawan')
        ->select('karyawan.*','karyawan.id as idSupir','users.*', 'users_profile.*')
        ->Join('users', 'karyawan.id_users', '=', 'users.id')
        ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
        //->join('unit_kendaraan', 'karyawan.id', '=', 'unit_kendaraan.id_supir')
        ->where('karyawan.jabatan','supir')
        ->get();
     }

     public function dataSupirKend($id){
        return DB::table('karyawan')
        ->select('karyawan.*','karyawan.id as idSupir','users.*', 'users_profile.*')
        ->Join('users', 'karyawan.id_users', '=', 'users.id')
        ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
        ->join('unit_kendaraan', 'karyawan.id', '=', 'unit_kendaraan.id_supir')
        ->where('unit_kendaraan.id',$id)
        ->get();
     }
     public function dataOtherSupir($id){
        return DB::table('karyawan')
        ->select('karyawan.*','karyawan.id as idSupir','users.*', 'users_profile.*')
        ->Join('users', 'karyawan.id_users', '=', 'users.id')
        ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
        ->join('unit_kendaraan', 'karyawan.id', '=', 'unit_kendaraan.id_supir')
        ->where('karyawan.jabatan','Supir')
        ->WhereNull('unit_kendaraan.id')
        ->OrWhere('unit_kendaraan.id','<>',$id)
        ->get();
     }
     public function dataHelper($id){
        return DB::table('crew_pool')
        ->select('crew_pool.*','crew_pool.id as idCrew')
        ->join('unit_kendaraan', 'crew_pool.id', '=', 'unit_kendaraan.id_crew')
        ->where('unit_kendaraan.id',$id)
        ->get();
     }
     public function dataOtherHelper($id){
        return DB::table('crew_pool')
        ->select('crew_pool.*','crew_pool.id as idCrew')
        //->leftjoin('crew_pool', 'crew_pool.id', '=', 'unit_kendaraan.id_crew')
        ->WhereNull('crew_pool.id_unit')
        ->OrWhere('crew_pool.id_unit','<>',$id)
        ->get();
     }

     public function dataTipeUnitKend($id){
         return DB::table('unit_kendaraan')
                    ->where('id_tipe', $id)
                    ->get();
     }

     public function dataUnitBook($id){
        return DB::table('unit_kendaraan')
                   ->where('id_tipe', $id)
                   ->where('status_unit', 'Tersedia')
                   ->get();
    }

     public function dataUnitService($id){
        return DB::table('unit_kendaraan')
                   ->where('id_tipe', $id)
                   ->where('status_unit', 'Tersedia')
                   ->get();
    }
     /// OPERASIONAL
    public function KendOperasi(){

        return DB::table('operasional')
                    ->select('operasional.*','operasional.id as id_opr','item_operasional.id as id_item','item_operasional.*','penjadwalan.*','unit_kendaraan.*')
                    ->Join('penjadwalan', 'operasional.id_jadwal', '=', 'penjadwalan.id')
                    ->Join('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->leftJoin('item_operasional', 'operasional.item', '=', 'item_operasional.id')
                    ->orderBy('operasional.id', 'desc')
                    ->get();
     }
    public function KendOperasiByRangeTgl($tglAwal, $tglAkhir){

        return DB::table('operasional')
                    ->select('operasional.*','operasional.id as id_opr','item_operasional.id as id_item','item_operasional.*','penjadwalan.*','unit_kendaraan.*')
                    ->Join('penjadwalan', 'operasional.id_jadwal', '=', 'penjadwalan.id')
                    ->Join('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->leftJoin('item_operasional', 'operasional.item', '=', 'item_operasional.id')
                    ->whereBetween('penjadwalan.tgl_jadwal', [$tglAwal, $tglAkhir])
                    ->orderBy('operasional.id', 'desc')
                    ->get();
     }
     /*
     public function detailKendOperasi($id){

        return DB::table('users')
        ->Join('level_akses', 'users.level', '=', 'level_akses.id')
        ->where('users.id', $id)->first();
     }*/
     public function dataJadwalService(){
        return DB::table('penjadwalan')
                    ->select('penjadwalan.*','penjadwalan.id as id_jadwal', 'unit_kendaraan.*','tipe_kendaraan.*' )
                    ->Join('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->Join('tipe_kendaraan', 'unit_kendaraan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->where('jenis_jadwal', 'Service')
                    ->where('status_jadwal', 'Pending')
                    ->orderBy('penjadwalan.tgl_jadwal', 'desc')->get();
     }

     public function getOperasiJadwal($id){
        return DB::table('operasional')
                   ->where('id_jadwal', $id)
                   ->first();
     }


     /// PENGAJUAN DANA
    public function detailPengajuanDana($id){

        return DB::table('pengajuan_dana')
                    ->select('pengajuan_dana.*', 'karyawan.id as idKaryawan','karyawan.nip','karyawan_konfir.id as idKaryawan_konfir', 'karyawan_konfir.nip as nip_konfir', 'users.id as idUsers', 'users_profile.id as idUserProfile', 'users_profile.nama','users_profile_konfir.nama as nama_konfir')
                    ->Join('karyawan', 'pengajuan_dana.id_karyawan', '=', 'karyawan.id')
                    ->leftJoin('users', 'karyawan.id_users', '=', 'users.id')
                    ->leftJoin('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->leftJoin('karyawan as karyawan_konfir', 'pengajuan_dana.id_karyawan_konfir', '=', 'karyawan_konfir.id')
                    ->leftJoin('users as users_konfir', 'karyawan_konfir.id_users', '=', 'users_konfir.id')
                    ->leftJoin('users_profile as users_profile_konfir', 'users_konfir.id_profile', '=', 'users_profile_konfir.id')
                    ->where('pengajuan_dana.id', $id)->first();
     }
     public function PengajuaDana(){

        return DB::table('pengajuan_dana')
                    ->select('pengajuan_dana.*', 'karyawan.id as idKaryawan','karyawan.nip','karyawan_konfir.id as idKaryawan_konfir', 'karyawan_konfir.nip as nip_konfir', 'users.id as idUsers', 'users_profile.id as idUserProfile', 'users_profile.nama','users_profile_konfir.nama as nama_konfir')
                    ->Join('karyawan', 'pengajuan_dana.id_karyawan', '=', 'karyawan.id')
                    ->leftJoin('users', 'karyawan.id_users', '=', 'users.id')
                    ->leftJoin('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->leftJoin('karyawan as karyawan_konfir', 'pengajuan_dana.id_karyawan_konfir', '=', 'karyawan_konfir.id')
                    ->leftJoin('users as users_konfir', 'karyawan_konfir.id_users', '=', 'users_konfir.id')
                    ->leftJoin('users_profile as users_profile_konfir', 'users_konfir.id_profile', '=', 'users_profile_konfir.id')
                    ->orderBy('pengajuan_dana.tgl_pengajuan', 'desc')
                    ->get();
     }
     public function PengajuaDanaByRangeTgl($tglAwal, $tglAkhir){

        return DB::table('pengajuan_dana')
                    ->select('pengajuan_dana.*', 'karyawan.id as idKaryawan','karyawan.nip','karyawan_konfir.id as idKaryawan_konfir', 'karyawan_konfir.nip as nip_konfir', 'users.id as idUsers', 'users_profile.id as idUserProfile', 'users_profile.nama','users_profile_konfir.nama as nama_konfir')
                    ->Join('karyawan', 'pengajuan_dana.id_karyawan', '=', 'karyawan.id')
                    ->leftJoin('users', 'karyawan.id_users', '=', 'users.id')
                    ->leftJoin('users_profile', 'users.id_profile', '=', 'users_profile.id')
                    ->leftJoin('karyawan as karyawan_konfir', 'pengajuan_dana.id_karyawan_konfir', '=', 'karyawan_konfir.id')
                    ->leftJoin('users as users_konfir', 'karyawan_konfir.id_users', '=', 'users_konfir.id')
                    ->leftJoin('users_profile as users_profile_konfir', 'users_konfir.id_profile', '=', 'users_profile_konfir.id')
                    ->whereBetween('pengajuan_dana.tgl_pengajuan', [$tglAwal, $tglAkhir])
                    ->orderBy('pengajuan_dana.tgl_pengajuan', 'desc')
                    ->get();
     }
      /// PENJADWALAN
    public function detailPenjadwalan($id){

        return DB::table('penjadwalan')
                    ->select('penjadwalan.*' , 'penjadwalan.id as id_jadwal','penjadwalan.id_supir as idsupir','penjadwalan.id_crew as idcrew')
                    ->leftJoin('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->where('penjadwalan.id', $id)->first();
     }
     public function penjadwalanData(){

        return DB::table('penjadwalan')
                    ->select('penjadwalan.*','penjadwalan.id as id_jadwal','penjadwalan.id_crew as idcrew','penjadwalan.id_supir as idsupir','penjadwalan.id as id_jadwal', 'unit_kendaraan.*','tipe_kendaraan.*' )
                    ->leftJoin('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->leftJoin('tipe_kendaraan', 'unit_kendaraan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->orderBy('penjadwalan.id', 'desc')
                    ->get();
     }
     public function penjadwalanDataByRangeTgl($tglAwal, $tglAkhir){

        return DB::table('penjadwalan')
                    ->select('penjadwalan.*','penjadwalan.id as id_jadwal','penjadwalan.id_crew as idcrew','penjadwalan.id_supir as idsupir', 'unit_kendaraan.*','tipe_kendaraan.*' )
                    ->leftJoin('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->leftJoin('tipe_kendaraan', 'unit_kendaraan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->whereBetween('penjadwalan.tgl_jadwal', [$tglAwal, $tglAkhir])
                    ->orderBy('penjadwalan.id', 'desc')
                    ->get();
     }

     public function getJadwalBooking($id){
        return DB::table('penjadwalan')
                   ->where('id_booking', $id)
                   ->get();
     }
     public function getEventJadwal($id){
        return DB::table('events')
                   ->where('id_status', $id)
                   ->first();
     }

      /// HARGA TUJUAN
    public function detailPaket($id){

        return DB::table('penjadwalan')
                    ->select('penjadwalan.*' , 'penjadwalan.id as id_jadwal', 'users.*', 't_awal.*', 't_awal.nama_tujuan as tujuan_awal','t_akhir.*', 't_akhir.nama_tujuan as tujuan_akhir', 'unit_kendaraan.*', 'penjadwalan.status as status_jadwal')
                    ->Join('tujuan as t_awal', 'penjadwalan.id_tujuan_awal', '=', 't_awal.id')
                    ->Join('tujuan as t_akhir', 'penjadwalan.id_tujuan_akhir', '=', 't_akhir.id')
                    ->Join('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->Join('users', 'penjadwalan.id_user', '=', 'users.id')
                    ->where('penjadwalan.id', $id)->first();
     }
     public function hargaData(){

        return DB::table('harga_tujuan')
                    ->select('harga_tujuan.*','harga_tujuan.id as id_harga', 'tipe_kendaraan.*','tujuanAwal.id as id_awal','tujuanAwal.nama_tujuan as tujuan_awal','tujuanAwal.kode_tujuan as kodeTujuan_awal','tujuanAkhir.*','tujuanAkhir.id as id_akhir','tujuanAkhir.nama_tujuan as tujuan_akhir','tujuanAkhir.kode_tujuan as kodeTujuan_akhir')
                    ->Join('tipe_kendaraan', 'harga_tujuan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->Join('tujuan as tujuanAwal', 'harga_tujuan.idTujuan_awal', '=', 'tujuanAwal.id')
                    ->Join('tujuan as tujuanAkhir', 'harga_tujuan.idTujuan_akhir', '=', 'tujuanAkhir.id')
                    //->groupBy('harga_tujuan.id_tipe')
                    ->get();
     }

     public function itemBB(){
        return DB::table('item_operasional')
            ->where('tipe_item', 'Bahan Bakar')
            ->get();
     }
      /// BOOKING

      public function dataHargaTujuan($id){

        return DB::table('harga_tujuan')
                    ->select('harga_tujuan.*','harga_tujuan.id as id_harga', 'tipe_kendaraan.*','tujuanAwal.id as id_awal','tujuanAwal.nama_tujuan as tujuan_awal','tujuanAwal.kode_tujuan as kodeTujuan_awal','tujuanAkhir.*','tujuanAkhir.id as id_akhir','tujuanAkhir.nama_tujuan as tujuan_akhir','tujuanAkhir.kode_tujuan as kodeTujuan_akhir')
                    ->Join('tipe_kendaraan', 'harga_tujuan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->Join('tujuan as tujuanAwal', 'harga_tujuan.idTujuan_awal', '=', 'tujuanAwal.id')
                    ->Join('tujuan as tujuanAkhir', 'harga_tujuan.idTujuan_akhir', '=', 'tujuanAkhir.id')
                    ->where('harga_tujuan.id_tipe', $id)
                    ->get();
                    //->first();
     }
      public function dataHargaTujuan2($id){

        return DB::table('harga_tujuan')
                    ->select('harga_tujuan.*','harga_tujuan.id as id_harga', 'tipe_kendaraan.*','tujuanAwal.id as id_awal','tujuanAwal.nama_tujuan as tujuan_awal','tujuanAwal.kode_tujuan as kodeTujuan_awal','tujuanAkhir.*','tujuanAkhir.id as id_akhir','tujuanAkhir.nama_tujuan as tujuan_akhir','tujuanAkhir.kode_tujuan as kodeTujuan_akhir')
                    ->Join('tipe_kendaraan', 'harga_tujuan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->Join('tujuan as tujuanAwal', 'harga_tujuan.idTujuan_awal', '=', 'tujuanAwal.id')
                    ->Join('tujuan as tujuanAkhir', 'harga_tujuan.idTujuan_akhir', '=', 'tujuanAkhir.id')
                    ->where('harga_tujuan.id_tipe', $id)
                    ->where('harga_tujuan.idTujuan_akhir', 8)
                    ->get();
                    //->first();
     }
      public function getHargaTujuan($id){

        return DB::table('harga_tujuan')
                    ->select('harga_tujuan.*','harga_tujuan.id as id_harga', 'tipe_kendaraan.*','tujuanAwal.id as id_awal','tujuanAwal.nama_tujuan as tujuan_awal','tujuanAwal.kode_tujuan as kodeTujuan_awal','tujuanAkhir.*','tujuanAkhir.id as id_akhir','tujuanAkhir.nama_tujuan as tujuan_akhir','tujuanAkhir.kode_tujuan as kodeTujuan_akhir')
                    ->Join('tipe_kendaraan', 'harga_tujuan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->Join('tujuan as tujuanAwal', 'harga_tujuan.idTujuan_awal', '=', 'tujuanAwal.id')
                    ->Join('tujuan as tujuanAkhir', 'harga_tujuan.idTujuan_akhir', '=', 'tujuanAkhir.id')
                    ->where('harga_tujuan.id_tipe', $id)
                    //->get();
                    ->first();
     }
     public function getDataTujuan($id){

        return DB::table('harga_tujuan')
                    ->select('harga_tujuan.*','harga_tujuan.id as id_harga', 'tipe_kendaraan.*','tujuanAwal.id as id_awal','tujuanAwal.nama_tujuan as tujuan_awal','tujuanAwal.kode_tujuan as kodeTujuan_awal','tujuanAkhir.*','tujuanAkhir.id as id_akhir','tujuanAkhir.nama_tujuan as tujuan_akhir','tujuanAkhir.kode_tujuan as kodeTujuan_akhir')
                    ->Join('tipe_kendaraan', 'harga_tujuan.id_tipe', '=', 'tipe_kendaraan.id')
                    ->Join('tujuan as tujuanAwal', 'harga_tujuan.idTujuan_awal', '=', 'tujuanAwal.id')
                    ->Join('tujuan as tujuanAkhir', 'harga_tujuan.idTujuan_akhir', '=', 'tujuanAkhir.id')
                    ->where('harga_tujuan.id', $id)
                    //->get();
                    ->first();
     }
    public function detailBooking($id){

        return DB::table('penjadwalan')
                    ->select('penjadwalan.*' , 'penjadwalan.id as id_jadwal', 'users.*', 't_awal.*', 't_awal.nama_tujuan as tujuan_awal','t_akhir.*', 't_akhir.nama_tujuan as tujuan_akhir', 'unit_kendaraan.*', 'penjadwalan.status as status_jadwal')
                    ->Join('tujuan as t_awal', 'penjadwalan.id_tujuan_awal', '=', 't_awal.id')
                    ->Join('tujuan as t_akhir', 'penjadwalan.id_tujuan_akhir', '=', 't_akhir.id')
                    ->Join('unit_kendaraan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
                    ->Join('users', 'penjadwalan.id_user', '=', 'users.id')
                    ->where('penjadwalan.id', $id)->first();
     }
     public function bookingData(){

        return DB::table('booking')
                    ->select('booking.*','booking.id as idbooking','kostumer.*', 'kostumer.id as idkostumer','mitra.*', 'mitra.id as idmitra','tipe_kendaraan.*', 'tipe_kendaraan.id as idtipe','booking.keterangan as keterangan_book')
                    ->Join('tipe_kendaraan', 'booking.id_tipe', '=', 'tipe_kendaraan.id')
                    ->leftJoin('kostumer', 'booking.id_kostumer', '=', 'kostumer.id')
                    ->leftJoin('mitra', 'booking.id_mitra', '=', 'mitra.id')
                    ->orderBy('booking.id', 'desc')
                    ->orderBy('booking.tgl_booking', 'desc')
                    ->get();
     }
     public function bookingDataByRangeTgl($tglAwal, $tglAkhir){

        return DB::table('booking')
                    ->select('booking.*','booking.id as idbooking','kostumer.*', 'kostumer.id as idkostumer','mitra.*', 'mitra.id as idmitra','tipe_kendaraan.*', 'tipe_kendaraan.id as idtipe','booking.keterangan as keterangan_book')
                    ->Join('tipe_kendaraan', 'booking.id_tipe', '=', 'tipe_kendaraan.id')
                    ->leftJoin('kostumer', 'booking.id_kostumer', '=', 'kostumer.id')
                    ->leftJoin('mitra', 'booking.id_mitra', '=', 'mitra.id')
                    ->whereBetween('booking.tgl_booking', [$tglAwal, $tglAkhir])
                    ->orderBy('booking.tgl_booking', 'desc')
                    ->orderBy('booking.id', 'desc')
                    ->get();
     }
     public function rolePermissionData($id){

        return DB::table('role_has_permissions')
                ->select('permission_id')
                ->where('role_id', $id)
                ->get();
     }

     // KOSTUMER
     public function dataKostumer(){
         return DB::table('kostumer')
            ->select('kostumer.*','kostumer.id as idkostumer', 'kostumer.created_at as tgl_regis', 'users.*', 'users_profile.*')
            ->leftJoin('users', 'kostumer.id_users', '=', 'users.id')
            ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
            ->get();
     }

     public function dataKostumerDesc(){
         return DB::table('kostumer')
            ->select('kostumer.*','kostumer.id as idkostumer', 'kostumer.created_at as tgl_regis', 'users.*', 'users_profile.*')
            ->leftJoin('users', 'kostumer.id_users', '=', 'users.id')
            ->Join('users_profile', 'users.id_profile', '=', 'users_profile.id')
            ->orderBy('kostumer.id','desc')
            ->get();
     }

     // DASHBOARD

     public function pendapatanByUnit(){

        return DB::table('booking')
        ->select(DB::raw("SUM(booking.total) as total_pendapatan","tipe_kendaraan.nama_tipe"))
        ->rightJoin('tipe_kendaraan', 'booking.id_tipe', '=', 'tipe_kendaraan.id')
        ->groupBy(DB::raw('tipe_kendaraan.id'))
        ->get();
     }

     public function goalPendapatanByUnit(){

        return DB::table('unit_kendaraan')
        ->select("unit_kendaraan.id","unit_kendaraan.nama_unit","unit_kendaraan.no_lambung","unit_kendaraan.jumlah_seats","unit_kendaraan.no_plat", DB::raw("SUM(booking.total) as goal_pendapatan_unit"))
        //->rightJoin('tipe_kendaraan', 'booking.id_tipe', '=', 'tipe_kendaraan.id')
        ->leftjoin('penjadwalan', 'penjadwalan.id_unit', '=', 'unit_kendaraan.id')
        ->leftjoin('booking', 'booking.id', '=', 'penjadwalan.id_booking')
        ->groupBy('unit_kendaraan.id',"unit_kendaraan.nama_unit","unit_kendaraan.jumlah_seats","unit_kendaraan.no_lambung","unit_kendaraan.no_plat")
        ->orderBy('unit_kendaraan.id', 'asc')
        ->get();
     }

     public function pendapatanByMonth($month){
        return DB::table('booking')
        ->where('status_booking', 'Sukses')
        ->whereMonth('tgl_booking', '=', $month)
        ->sum("total");
     }

     public function totalPemasukan(){
        return DB::table('booking')
        ->where('status_booking', 'Sukses')
        ->sum("total");
     }

     public function totalPengeluaran(){
        return DB::table('penjadwalan')
        ->where('status_jadwal', 'Proses')
        ->orWhere('status_jadwal', 'Selesai')
        ->sum("total_kas_keluar");
     }

     public function unitTersedia(){
         return DB::table('unit_kendaraan')
                    ->where('status_unit', 'Tersedia')
                    ->count();
     }
     public function jumlahUnit(){
        return DB::table('unit_kendaraan')
                   ->count();
    }
    public function jumlahPending(){
        return DB::table('penjadwalan')
        ->where('status_jadwal', 'Pending')
        ->count();
    }
    public function jumlahBooking(){
        return DB::table('penjadwalan')
        ->where('status_jadwal', 'Proses')
        ->where('jenis_jadwal', 'Booking')
        ->count();
    }
    public function jumlahService(){
        return DB::table('penjadwalan')
        ->where('status_jadwal', 'Proses')
        ->where('jenis_jadwal', 'Service')
        ->count();
    }
}
