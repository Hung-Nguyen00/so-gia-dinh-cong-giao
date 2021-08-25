<?php

namespace App\Http\Controllers;

use App\Models\GiaoXu;
use App\Models\TuSi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiaoXuController extends Controller
{
    public  function index(){
        $all_giao_xu = GiaoXu::withCount('giaoHo')
            ->where('giao_xu_hoac_giao_ho', 0)
            ->orderBy('created_at', 'DESC')
            ->get();;
        return view('giao_xu.all_giao_xu', compact('all_giao_xu'));
    }

    public function showTuSiByGiaoXu(){
        $all_tu_si = TuSi::with(['chucVu', 'tenThanh', 'viTri'])
            ->where('giao_xu_id', Auth::user()->giao_xu_id)->get();
        return view('giao_xu.show_tu_si_by_user', compact('all_tu_si'));
    }

}
