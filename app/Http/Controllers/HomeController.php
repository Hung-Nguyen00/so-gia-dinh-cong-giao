<?php

namespace App\Http\Controllers;

use App\Models\GiaoPhan;
use App\Models\GiaoTinh;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $count_ts= DB::table('giao_tinh as gt')
            ->leftJoin('giao_phan as p', 'gt.id', '=', 'p.giao_tinh_id')
            ->leftJoin('tu_si as ts', 'ts.giao_phan_id', '=', 'p.id')
            ->leftJoin('chuc_vu as c', 'c.id', '=', 'ts.chuc_vu_id')
            ->select( DB::raw('count(ts.id) as TuSi'), 'c.ten_chuc_vu as chuc_vu')
            ->groupBy('gt.id', 'chuc_vu')
            ->get();
        $count_giam_muc = $count_ts->where('chuc_vu', 'Giám mục')->sum('TuSi');
        $count_linh_muc = $count_ts->where('chuc_vu', 'Linh mục')->sum('TuSi');
        $count_chung_sinh = $count_ts->where('chuc_vu', 'Chủng sinh')->sum('TuSi');
        $count_so = $count_ts->where('chuc_vu', 'Sơ')->sum('TuSi');

        $analytic_tu_si = ['Giám mục' => $count_giam_muc,
            'Linh mục' => $count_linh_muc,
            'Chủng sinh' => $count_chung_sinh,
            'Sơ' => $count_so];

        foreach($statistics_all as $gp){
            $count['giao_phan_count'] += $gp->giao_phan_count;
            $count['giao_xu_count'] += $gp->giao_xu_count;
            $count['giao_dan_count'] += $gp->giao_dan_count;
            $count['tu_si_count'] += $gp->tu_si_count;
        }
        return view('dashboard.main_dashboard', compact(
             'count', 'statistics_giao_phan'))
            ->with(['analytic_tu_si' => json_encode($analytic_tu_si)]);
    }

   public function  getGenderSinhOrTu($id){
       $get_current_year = Carbon::now()->format('Y');
       $gender_all_giao_phan = DB::table('giao_tinh as gt')
           ->leftJoin('giao_phan as p', 'gt.id', '=', 'p.giao_tinh_id')
           ->leftJoin('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
           ->leftJoin('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
           ->leftJoin('so_gia_dinh_cong_giao as sgd', 'x.id', '=', 'sgd.giao_xu_id')
           ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id');

       if ($id == 1){
           $gender_all_giao_phan = $gender_all_giao_phan->select(
               DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
               DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
               DB::raw('MONTH(tv.ngay_sinh) as ThangSinh')
           )
               ->orderBy(DB::raw("MONTH(tv.ngay_sinh)"))
               ->groupBy('tv.ngay_sinh')
               ->havingRaw('YEAR(tv.ngay_sinh) ='. $get_current_year)
               ->get();
       }else{
           $gender_all_giao_phan = $gender_all_giao_phan->select(
               DB::raw('count(IF(tv.gioi_tinh = 1,1,NULL)) as males'),
               DB::raw('count(IF(tv.gioi_tinh = 0,1,NULL)) as females'),
               DB::raw('MONTH(tv.ngay_mat) as ThangSinh')
           )
               ->orderBy(DB::raw("MONTH(tv.ngay_mat)"))
               ->groupBy('tv.ngay_mat')
               ->havingRaw('YEAR(tv.ngay_mat) ='. $get_current_year)
               ->get();
       }
       $res['month'] = ['Tháng 1',
           'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
           'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
       foreach ($res['month'] as $key=> $value){
           $count = 0 ;
           foreach ($gender_all_giao_phan as $keyI => $val) {
               if ('Tháng '.$val->ThangSinh == $value){
                   $res['males'][$key] = (int)$val->males;
                   $res['females'][$key] = (int)$val->females;
                   $count++;
               }
           }
           if ($count == 0){
               $res['males'][$key] = 0;
               $res['females'][$key] = 0;
           }
       }
       return response()->json(['data' => $res]);
   }


}
