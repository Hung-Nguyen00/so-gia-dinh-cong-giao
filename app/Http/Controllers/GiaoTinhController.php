<?php

namespace App\Http\Controllers;

use App\Models\GiaoTinh;
use Illuminate\Http\Request;

class GiaoTinhController extends Controller
{
    public function index(){
        $all_giao_tinh = GiaoTinh::with('getUser')
            ->withCount('giaoPhan')
            ->orderBy('created_at', 'DESC')
            ->get();;
        return view('giao_tinh.all_giao_tinh', compact('all_giao_tinh'));
    }
}
