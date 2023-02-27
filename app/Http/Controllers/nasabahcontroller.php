<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class nasabahcontroller extends Controller
{
    public function list_nasabah(Request $req){
        $title = "Nasabah";
        $data = DB::select("select *from nasabah");
        return view('nasabah.nasabah',["data" =>$data,"title"=>$title]);
    }
    public function form_tambah(){
        $title = "Nasabah";
        return view('nasabah.tambah',['title'=>$title]);
    }
    public function tambah_nasabah(Request $req){
        DB::insert("insert into nasabah values(?,?,?,?)",
        [$req->kode,$req->nama,$req->alamat,$req->no_telp]);
        return redirect("/nasabah?tambah=1");
    }
    public function form_edit(Request $req){
        $title = "Nasabah";
        return view('nasabah.edit',['kode'=>$req->kode,'title'=>$title]);
    }
    public function edit_nasabah(Request $req){
        DB::update("update nasabah set kode=?,nama=?,alamat=?,no_telp=? where kode=?",
        [$req->kode,$req->nama,$req->alamat,$req->no_telp,$req->code]);
        return redirect("/nasabah");
    }
    public function hapus_nasabah(Request $req){
        DB::delete("delete from nasabah where kode=?",[$req->kode]);
        return redirect("/nasabah");
    }
    public function search(Request $req){
        $title = "Nasabah";
        $data = DB::select("select * from nasabah where nama LIKE concat('%',?,'%')",[$req->search]);//kata req ->search berasal dari nama input search di blade 
        return view('nasabah.nasabah',['data'=>$data,'title'=>$title,]);
    }
}
