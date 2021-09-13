<?php

namespace App\Http\Controllers;

use App\Models\GiaoXu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiaoHoController extends Controller
{
    public function index(){
        $giao_xu = GiaoXu::with(['giaoHo', 'getUser'])
                ->orderBy('created_at', 'DESC')
                ->where('id', Auth::user()->giao_xu_id)->first();
        $all_giao_ho = $giao_xu->giaoHo;
        return view('giao_ho.all_giao_ho', compact('all_giao_ho'));
    }

    public function statistic(){
        return view('giao_ho.statistic');
    }
}
