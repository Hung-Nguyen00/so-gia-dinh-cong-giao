<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CrudTuSi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $giao_hat_id,
        $giao_xu_id,
        $ten_thanh_id,
        $ho_va_ten,
        $chuc_vu_id,
        $giao_phan_id,
        $paginate_number = 5;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten',
        'ten_thanh_id', 'giao_phan_id', 'giao_hat_id', 'giao_xu_id', 'chuc_vu_id'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->giao_phan_id = request()->query('giao_phan_id', $this->giao_phan_id);
        $this->giao_hat_id = request()->query('giao_hat_id', $this->giao_hat_id);
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->chuc_vu_id = request()->query('chuc_vu_id', $this->chuc_vu_id);

    }
    public function render()
    {

        $this->dispatchBrowserEvent('contentChanged');
        $tu_si = TuSi::with(['giaoPhan', 'giaoHat', 'giaoXu', 'tenThanh', 'chucVu'])
                        ->orderBy('created_at', 'DESC');
        // search
        if ($this->ten_thanh_id !== null && $this->ten_thanh_id !== ''){
            $tu_si->where('ten_thanh_id', $this->ten_thanh_id);
        }
        if ($this->giao_phan_id !== null && $this->giao_phan_id !== ''){
            $tu_si->where('giao_phan_id', $this->giao_phan_id);
        }
        if ($this->giao_hat_id !== null && $this->giao_hat_id !== ''){
            $tu_si->where('giao_hat_id', $this->giao_hat_id);
        }
        if ($this->giao_xu_id !== null && $this->giao_xu_id !== ''){
            $tu_si->where('giao_xu_id', $this->giao_xu_id);
        }
        if ($this->chuc_vu_id !== null && $this->chuc_vu_id !== ''){
            $tu_si->where('chuc_vu_id', $this->chuc_vu_id);
        }
        if ($this->ho_va_ten !== null){
            $tu_si->where('ho_va_ten','like', "%$this->ho_va_ten%");
        }
        if (Auth::user()->quanTri->ten_quyen !== 'admin'){
            return view('livewire.tu-si.crud-tu-si', [
                'all_tu_si' => $tu_si->where('giao_phan_id', Auth::user()->giao_phan_id)
                                    ->paginate($this->paginate_number),
                'all_chuc_vu' => ChucVu::all(),
                'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                'all_giao_hat' => GiaoHat::orderBy('ten_giao_hat')
                        ->where('giao_phan_id', Auth::user()->giao_phan_id)
                        ->get(),
                'all_giao_xu' => GiaoXu::orderBy('ten_giao_xu')
                        ->where('giao_hat_id', $this->giao_hat_id)
                        ->get(),
             ]
            );
        }else{
            return view('livewire.tu-si.crud-tu-si', [
                    'all_tu_si' => $tu_si->paginate($this->paginate_number),
                    'all_chuc_vu' => ChucVu::all(),
                    'all_ten_thanh' => TenThanh::orderBy('ten_thanh')->get(),
                    'all_giao_phan' => GiaoPhan::orderBy('ten_giao_phan')->get(),
                    'all_giao_hat' => GiaoHat::orderBy('ten_giao_hat')
                        ->where('giao_phan_id', $this->giao_phan_id)
                        ->get(),
                    'all_giao_xu' => GiaoXu::orderBy('ten_giao_xu')
                        ->where('giao_hat_id', $this->giao_hat_id)
                        ->get(),
                ]
            );
        }

    }
    // reset select option of GP and GX
    public function changeGiaoPhan(){
        $this->giao_hat_id = '';
        $this->giao_xu_id = '';
    }
}
