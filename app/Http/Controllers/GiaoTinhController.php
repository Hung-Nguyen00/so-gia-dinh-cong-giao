<?php

namespace App\Http\Controllers;

use App\Models\GiaoTinh;
use Illuminate\Http\Request;

class GiaoTinhController extends Controller
{
    public function index(){
        $all_giao_tinh = GiaoTinh::withCount('giaoPhan')->get();
        return view('giao_tinh.all_giao_tinh', compact('all_giao_tinh'));
    }
}
