<?php

namespace App\Http\Controllers;

use App\Models\GiaoXu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiaoHoController extends Controller
{
    public function index(){
        $all_giao_ho = GiaoXu::with(['giaoHo', 'getUser', 'tuSi' => function($q){
            $q->with(['tenThanh', 'chucVu'])->first();
        }])
                ->withCount('giaoDan')
                ->orderBy('created_at', 'DESC')
                ->where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)->get();
        return view('giao_ho.all_giao_ho', compact('all_giao_ho'));
    }

    public function statistic(){
        return view('giao_ho.statistic');
    }
}
