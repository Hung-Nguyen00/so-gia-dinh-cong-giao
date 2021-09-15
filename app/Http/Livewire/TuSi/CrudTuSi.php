<?php

namespace App\Http\Livewire\TuSi;

use App\Models\ChucVu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\NhaDong;
use App\Models\TenThanh;
use App\Models\TuSi;
use Carbon\Carbon;
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
        $active = false,
        $chuc_vu_id,
        $date_of_birth,
        $giao_phan_id,
        $nha_dong_id,
        $paginate_number = 20;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten',
        'ten_thanh_id', 'giao_phan_id', 'giao_hat_id','date_of_birth', 'nha_dong_id','active',
        'giao_xu_id', 'chuc_vu_id', 'paginate_number' ];


    public function mount()
    {
        $this->ho_va_ten = request()->query('ho_va_ten', $this->ho_va_ten);
        $this->ten_thanh_id = request()->query('ten_thanh_id', $this->ten_thanh_id);
        $this->giao_phan_id = request()->query('giao_phan_id', $this->giao_phan_id);
        $this->giao_hat_id = request()->query('giao_hat_id', $this->giao_hat_id);
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->chuc_vu_id = request()->query('chuc_vu_id', $this->chuc_vu_id);
        $this->date_of_birth =  request()->query('date_of_birth', $this->date_of_birth);
        $this->nha_dong_id =  request()->query('nha_dong_id', $this->nha_dong_id);
        $this->active =  request()->query('active', $this->active);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        if (!$this->paginate_number){
            $this->paginate_number = 20;
        }

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
        if ($this->date_of_birth){
            $tu_si->where('ngay_sinh', $this->date_of_birth);
        }
        if ($this->nha_dong_id){
            $tu_si->where('nha_dong_id', $this->nha_dong_id);
        }
        $all_nha_dong = NhaDong::select('id', 'ten_nha_dong')->get();
        $all_chuc_vu = ChucVu::select('id', 'ten_chuc_vu')->get();
        $all_ten_thanh = TenThanh::orderBy('ten_thanh')->select('id', 'ten_thanh')->get();
        if (Auth::user()->quanTri->ten_quyen !== 'admin'){
            return view('livewire.tu-si.crud-tu-si', [
                'all_tu_si' => $tu_si->where('giao_phan_id', Auth::user()->giao_phan_id)
                                    ->paginate($this->paginate_number),
                'all_chuc_vu' => $all_chuc_vu,
                'all_ten_thanh' => $all_ten_thanh,
                'all_nha_dong' => $all_nha_dong,
                'all_giao_hat' => GiaoHat::orderBy('ten_giao_hat')
                        ->select('id', 'ten_giao_hat', 'giao_phan_id')
                        ->where('giao_phan_id', Auth::user()->giao_phan_id)
                        ->get(),
                'all_giao_xu' => GiaoXu::orderBy('ten_giao_xu')
                        ->select('id', 'ten_giao_xu', 'giao_hat_id')
                        ->where('giao_hat_id', $this->giao_hat_id)
                        ->get(),
             ]
            );
        }else{
            return view('livewire.tu-si.crud-tu-si', [
                    'all_tu_si' => $tu_si->paginate($this->paginate_number),
                    'all_chuc_vu' => $all_chuc_vu,
                    'all_ten_thanh' => $all_ten_thanh,
                    'all_nha_dong' => $all_nha_dong,
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
    public function changeView(){
       $this->active = !$this->active;
    }
}
