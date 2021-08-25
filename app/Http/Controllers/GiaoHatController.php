<?php

namespace App\Http\Controllers;

use App\Models\GiaoHat;
use App\Models\GiaoXu;
use Illuminate\Http\Request;

class GiaoHatController extends Controller
{
    public function index(){

        $all_giao_hat = GiaoHat::withCount('giaoXu')->orderBy('created_at', 'DESC')
            ->get();
        return view('giao_hat.all_giao_hat', compact('all_giao_hat'));
    }

    public function getGiaoHat($id){
        $data = GiaoHat::where('giao_phan_id', $id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }

    public function getGiaoXu($id){
        $data = GiaoXu::where('giao_hat_id', $id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }

    public function getGiaoHo($id){
        $data = GiaoXu::where('giao_xu_hoac_giao_ho', $id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }
}
