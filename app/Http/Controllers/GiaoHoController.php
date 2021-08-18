<?php

namespace App\Http\Controllers;

use App\Models\GiaoXu;
use Illuminate\Http\Request;

class GiaoHoController extends Controller
{
    public function index(){
        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', '<>', 0)->get();
        return view('giao_ho.all_giao_ho', compact('all_giao_ho'));
    }
}
