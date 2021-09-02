<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\BiTich;
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
        $paginate_number = 5,
        $ten_thanh;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten', 'ten_thanh_id', 'start_date', 'end_date', 'sinh_or_tu'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->start_date = Carbon::parse(request()->query('start_date', $this->start_date))->format('Y-m-d');
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->sinh_or_tu = request()->query('sinh_or_tu', $this->sinh_or_tu);
        if ($this->ho_va_ten == null){
            $this->start_date = null;
            $this->end_date = null;
        }
    }


    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $this->ten_thanh = TenThanh::get('id')->toArray();
        if ($this->ten_thanh_id !== null && $this->ten_thanh_id !== ''){
            $this->ten_thanh = TenThanh::where('id', $this->ten_thanh_id)->first('id')->toArray();
        }
        if ($this->sinh_or_tu == 1){
            return view('livewire.sgdcg.all-thanh-vien', [
                    'all_thanh_vien' => ThanhVien::with(['soGiaDinh', 'tenThanh'])
                        ->whereHas('soGiaDinh', function ($q){
                            $q->where('giao_xu_id', Auth::user()->giao_xu_id);
                        })
                        ->search(trim($this->ho_va_ten))
                        ->whereBetween('ngay_sinh', [$this->start_date, $this->end_date])
                        ->WhereIn('ten_thanh_id', array_values($this->ten_thanh))
                        ->paginate($this->paginate_number),
                    'all_bi_tich' => BiTich::all(),
                    'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                ]
            );
        }elseif($this->sinh_or_tu == 2){
            return view('livewire.sgdcg.all-thanh-vien', [
                    'all_thanh_vien' => ThanhVien::with(['soGiaDinh', 'tenThanh'])
                        ->whereHas('soGiaDinh', function ($q){
                            $q->where('giao_xu_id', Auth::user()->giao_xu_id);
                        })
                        ->search(trim($this->ho_va_ten))
                        ->whereBetween('ngay_mat', [$this->start_date, $this->end_date])
                        ->WhereIn('ten_thanh_id', array_values($this->ten_thanh))
                        ->paginate($this->paginate_number),
                    'all_bi_tich' => BiTich::all(),
                    'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                ]
            );
        }else{
            return view('livewire.sgdcg.all-thanh-vien', [
                    'all_thanh_vien' => ThanhVien::with(['soGiaDinh', 'tenThanh'])
                        ->whereHas('soGiaDinh', function ($q){
                            $q->where('giao_xu_id', Auth::user()->giao_xu_id);
                        })
                        ->search(trim($this->ho_va_ten))
                        ->WhereIn('ten_thanh_id', array_values($this->ten_thanh))
                        ->paginate($this->paginate_number),
                    'all_bi_tich' => BiTich::all(),
                    'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                ]
            );
        }
    }


}
