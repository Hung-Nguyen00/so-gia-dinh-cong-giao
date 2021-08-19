<?php

namespace App\Http\Controllers;

use App\Models\GiaoHat;
use Illuminate\Http\Request;

class GiaoHatController extends Controller
{
    public function index(){

        $all_giao_hat = GiaoHat::withCount('giaoXu')->get();
        return view('giao_hat.all_giao_hat', compact('all_giao_hat'));
    }

    public function getGiaoHat($id){
        $data = GiaoHat::where('giao_phan_id', $id)->get();
        \Log::info($data);
        return response()->json(['data' => $data]);
    }
}
