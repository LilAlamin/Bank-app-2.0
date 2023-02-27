<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class peminjamancontroller extends Controller
{
    public function list_peminjam(Request $req){
        $title = "Peminjaman";
        $data = DB::select("select peminjaman.id,nasabah.nama,peminjaman.jumlah_pinjam,peminjaman.tanggal_pinjam,peminjaman.tanggal_kembali from peminjaman
        inner join nasabah on nasabah.kode = peminjaman.kode_nasabah");
        return view("peminjaman.peminjaman",['data'=>$data,'title'=>$title,'tambah'=>$req->tambah? true : false]);
    }
    public function form_tambah(){
        $nasabah = DB::select("select kode from nasabah");
        $title = "Peminjaman";
        return view("peminjaman.tambah",['title'=>$title,'nasabah'=>$nasabah]);
    }
    public function tambah_pinjam(Request $req){
        DB::insert("insert into peminjaman values(null,?,?,?,?)",
        [$req->kode_nasabah,$req->jumlah_pinjam,$req->tanggal_pinjam,$req->tanggal_kembali]);
        return redirect("/peminjaman?tambah=1");
    }
    public function pengembalian(Request $req){
        $peminjaman = DB::select("select timestampdiff(day,tanggal_kembali,now()) As bedo,tanggal_pinjam,kode_nasabah,jumlah_pinjam from peminjaman where id=?",
    [$req->id]);
    $peminjaman=$peminjaman[0];
    $nama_nasabah = DB::select("select nama from nasabah where kode=?",[$peminjaman->kode_nasabah]);
    $bedo = $peminjaman->bedo;
    $denda = 0;
    if($bedo > 0){
        $denda = 15000 *$bedo;
    }
    DB::insert("insert into pengembalian values(null,?,?,?,date(now()),?)",
    [$nama_nasabah[0]->nama,$peminjaman->jumlah_pinjam,$peminjaman->tanggal_pinjam,$denda]);
    DB::delete("delete from peminjaman where id=?",[$req->id]);
    return redirect("/pengembalian");
    }

    public function list_kembali(){
        $title = "Pengembalian";
        $data=DB::select("select nama_nasabah,jumlah_pinjam,tanggal_pinjam,tanggal_kembali,denda,denda + jumlah_pinjam as total from pengembalian");
        return view("peminjaman.pengembalian",['data'=>$data,'title'=>$title]);
    }
}
