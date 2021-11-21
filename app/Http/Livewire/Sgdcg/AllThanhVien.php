<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\BiTich;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\ThanhVien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AllThanhVien extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $start_date,
        $end_date,
        $ten_thanh_id,
        $ho_va_ten,
        $sinh_or_tu = null,
        $paginate_number,
        $all_ten_thanh,
        $all_bi_tich,
        $giao_xu_id,
        $all_giao_xu,
        $ten_thanh;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten', 'ten_thanh_id', 'giao_xu_id','start_date', 'paginate_number','end_date', 'sinh_or_tu'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->start_date = Carbon::parse(request()->query('start_date', $this->start_date))->format('Y-m-d');
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_or_tu = request()->query('sinh_or_tu', $this->sinh_or_tu);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        if ($this->ho_va_ten == null){
            $this->start_date = null;
            $this->end_date = null;
        }
        if (!$this->paginate_number){
            $this->paginate_number = 20;
        }
        $this->all_ten_thanh = TenThanh::orderBy('ten_thanh')->get('id');
        $this->all_bi_tich = BiTich::all();
        $this->all_giao_xu = GiaoXu::with('giaoHat')->where('giao_xu_hoac_giao_ho', 0)->get();

    }


    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $this->ten_thanh = $this->all_ten_thanh->toArray();

        if ($this->giao_xu_id){
            $giao_xu_id = $this->giao_xu_id;
        }else{
            $giao_xu_id = Auth::user()->giao_xu_id;
        }

        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', $giao_xu_id)
            ->orWhere('id', $giao_xu_id)
            ->pluck('id');

        if ($this->ten_thanh_id !== null && $this->ten_thanh_id !== ''){
            $this->ten_thanh = TenThanh::where('id', $this->ten_thanh_id)->first('id')->toArray();
        }

        $all_thanh_vien = ThanhVien::with(['soGiaDinh', 'soGiaDinh2','tenThanh'])
            ->whereHas('soGiaDinh', function ($q) use ($giao_ho){
                $q->whereIn('giao_xu_id', $giao_ho);
            })
            ->orWhereHas('soGiaDinh2', function ($q) use ($giao_ho){
                $q->whereIn('giao_xu_id', $giao_ho);
            })
            ->search(trim($this->ho_va_ten))
            ->WhereIn('ten_thanh_id', array_values($this->ten_thanh));

        if ($this->sinh_or_tu == 1){
            $all_thanh_vien = $all_thanh_vien->whereBetween('ngay_sinh', [$this->start_date, $this->end_date]);

        }elseif ($this->sinh_or_tu == 2){
            $all_thanh_vien = $all_thanh_vien->whereBetween('ngay_mat', [$this->start_date, $this->end_date]);
        }
        return view('livewire.sgdcg.all-thanh-vien', [
                'all_thanh_vien' => $all_thanh_vien->simplePaginate($this->paginate_number),
                'all_bi_tich' => $this->all_bi_tich,
                'all_ten_thanh' => $this->all_ten_thanh,
                'all_giao_xu' => $this->all_giao_xu
            ]
        );
    }
}
