<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\ChucVu;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTuSiByGiaoXu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $giao_ho_id,
        $ten_thanh_id,
        $ho_va_ten,
        $chuc_vu_id,
        $date_of_birth,
        $paginate_number = 20;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten',
        'ten_thanh_id', 'giao_ho_id', 'chuc_vu_id', 'paginate_number', 'date_of_birth'];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->giao_ho_id = request()->query('giao_ho_id', $this->giao_ho_id);
        $this->chuc_vu_id = request()->query('chuc_vu_id', $this->chuc_vu_id);
        $this->date_of_birth = request()->query('date_of_birth', $this->date_of_birth);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        if (!$this->paginate_number){
            $this->paginate_number = 20;
        }

    }
    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)
            ->orWhere('id',  Auth::user()->giao_xu_id)
            ->pluck('id');
        $tu_si = TuSi::with(['chucVu', 'tenThanh', 'viTri', 'nhaDong', 'getUser', 'giaoXu'])
            ->whereIn('giao_xu_id', $giao_ho)
            ->orderBy('created_at', 'DESC');
        if ($this->ten_thanh_id !== null && $this->ten_thanh_id !== ''){
            $tu_si->where('ten_thanh_id', $this->ten_thanh_id);
        }
        if ($this->giao_ho_id !== null && $this->giao_ho_id !== ''){
            $tu_si->where('giao_xu_id', $this->giao_ho_id);
        }
        if ($this->chuc_vu_id !== null && $this->chuc_vu_id !== ''){
            $tu_si->where('chuc_vu_id', $this->chuc_vu_id);
        }
        if ($this->ho_va_ten !== null){
            $tu_si->where('ho_va_ten','like', "%$this->ho_va_ten%");
        }
        if ($this->date_of_birth){
            $tu_si->where('ngay_sinh',$this->date_of_birth);
        }
        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)->get();
        return view('livewire.giao-xu.show-tu-si-by-giao-xu')->with([
            'all_tu_si' => $tu_si->paginate(10),
            'all_giao_ho' => $all_giao_ho,
            'all_ten_thanh'=> TenThanh::select('id', 'ten_thanh')->get(),
            'all_chuc_vu' => ChucVu::select('id', 'ten_chuc_vu')->get(),
        ]);
    }
}
