<?php

namespace App\Http\Controllers;

use App\Models\DoanCa;
use Illuminate\Http\Request;

class DoanCaController extends Controller
{

    public function  index(){
        return view('doan_ca.index');
    }

    public function indexThanhVien($ca_doan_id){
        $ca_doan = DoanCa::find($ca_doan_id);
        return view('doan_ca.index_thanh_vien', compact('ca_doan'));
    }

    public function addThanhVien($ca_doan_id){
        $ca_doan = DoanCa::find($ca_doan_id);
        return view('doan_ca.add_thanh_vien', compact('ca_doan'));
    }


}
