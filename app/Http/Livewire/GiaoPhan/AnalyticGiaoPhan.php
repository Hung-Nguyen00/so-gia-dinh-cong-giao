<?php

namespace App\Http\Livewire\GiaoPhan;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\TuSi;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AnalyticGiaoPhan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $giao_phan_id = 1, $giam_muc, $paginate_number = 5, $giao_hat_id, $sinh_hoac_tu = 1;
    protected $queryString = ['giao_phan_id'];



    public function mount()
    {
        $this->giao_phan_id = request()->query('giao_phan_id', $this->giao_phan_id);
        $this->giam_muc = TuSi::with('tenThanh')->whereHas('chucVu', function ($q){
            $q->where('ten_chuc_vu', 'Giám mục');
        })->where('giao_phan_id',$this->giao_phan_id)
            ->first();
        if (!$this->giam_muc){
            Toastr::warning('Không có dữ liệu', 'Cảnh báo');
            return redirect()->route('home');
        }
    }

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $statistics_giao_phan = GiaoPhan::select('id')
            ->withCount(['giaoXu', 'giaoHat','giaoDan'])
            ->where('id', $this->giao_phan_id)
            ->first();
        // draw chart
        $analytic_gender = $this->getGender($this->sinh_hoac_tu);
        $analytic_tu_si = $this->getTuSi();

        // show GiaoHat to table
        $all_giao_hat = GiaoHat::withCount(['giaoXu', 'giaoDan'])
                        ->where('giao_phan_id', $this->giao_phan_id);
        // search GiaoHat By Id
        if ($this->giao_hat_id){
            $all_giao_hat = $all_giao_hat->where('id', $this->giao_hat_id)->get();
        }

        return view('livewire.giao-phan.analytic-giao-phan',
            compact('statistics_giao_phan'))
            ->with(['all_giao_phan' => GiaoPhan::all(),
                'giam_muc' => $this->giam_muc,
                'all_giao_hat' => $this->giao_hat_id ? $all_giao_hat : $all_giao_hat->paginate($this->paginate_number),
                'analytic_gender' => json_encode($analytic_gender),
                'analytic_tu_si' => json_encode($analytic_tu_si)]);
    }

    // get gender to Chart
    public function getGender($id){
        $get_current_year = Carbon::now()->format('Y');
        $gender_all_giao_phan = DB::table('giao_phan as p')
            ->leftJoin('giao_hat as h', 'p.id', '=', 'h.giao_phan_id')
            ->leftJoin('giao_xu as x', 'h.id', '=', 'x.giao_hat_id')
            ->leftJoin('so_gia_dinh_cong_giao as sgd', 'x.id', '=', 'sgd.giao_xu_id')
            ->leftJoin('thanh_vien as tv', 'sgd.id', '=', 'tv.so_gia_dinh_id')
            ->where('p.id', $this->giao_phan_id);
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
        return $res;
    }

    public function getTuSi(){
        $count_ts= DB::table('giao_phan as p')
            ->leftJoin('tu_si as ts', 'ts.giao_phan_id', '=', 'p.id')
            ->leftJoin('chuc_vu as c', 'c.id', '=', 'ts.chuc_vu_id')
            ->select( DB::raw('count(ts.id) as TuSi'), 'c.ten_chuc_vu as chuc_vu')
            ->groupBy( 'chuc_vu')
            ->where('p.id', $this->giao_phan_id)
            ->get();
        $count_giam_muc = $count_ts->where('chuc_vu', 'Giám mục')->sum('TuSi');
        $count_linh_muc = $count_ts->where('chuc_vu', 'Linh mục')->sum('TuSi');
        $count_chung_sinh = $count_ts->where('chuc_vu', 'Chủng sinh')->sum('TuSi');
        $count_so = $count_ts->where('chuc_vu', 'Sơ')->sum('TuSi');

        $analytic_tu_si = ['Giám mục' => $count_giam_muc,
            'Linh mục' => $count_linh_muc,
            'Chủng sinh' => $count_chung_sinh,
            'Sơ' => $count_so];

        return $analytic_tu_si;
    }
}
