<?php

namespace App\Http\Controllers;

use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use App\Models\TuSi;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $statistics_all = GiaoTinh::withCount(['giaoPhan','giaoXu','giaoDan', 'tuSi'])->get();
        $statistics_giao_phan = GiaoPhan::withCount(['giaoXu', 'giaoHat','giaoDan', 'tuSi'])->get();
        $count = array('giao_phan_count' => 0, 'giao_xu_count' => 0, 'giao_dan_count' => 0, 'tu_si_count' => 0);
        foreach($statistics_all as $gp){
            $count['giao_phan_count'] += $gp->giao_phan_count;
            $count['giao_xu_count'] += $gp->giao_xu_count;
            $count['giao_dan_count'] += $gp->giao_dan_count;
            $count['tu_si_count'] += $gp->tu_si_count;
        }
        return view('dashboard.main_dashboard', compact(
            'statistics_all', 'count', 'statistics_giao_phan'));
    }


}
