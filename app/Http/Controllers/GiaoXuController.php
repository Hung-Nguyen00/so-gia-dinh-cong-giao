<?php

namespace App\Http\Controllers;

use App\Models\GiaoXu;
use Illuminate\Http\Request;

class GiaoXuController extends Controller
{
    public  function index(){
        $all_giao_xu = GiaoXu::withCount('giaoHo')->where('giao_xu_hoac_giao_ho', 0)->get();
        return view('giao_xu.all_giao_xu', compact('all_giao_xu'));
    }
}
