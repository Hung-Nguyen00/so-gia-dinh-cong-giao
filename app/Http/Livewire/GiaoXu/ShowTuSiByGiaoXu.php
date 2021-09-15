<?php

namespace App\Http\Livewire\GiaoXu;

use App\Models\ChucVu;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use App\Models\TuSi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowTuSiByGiaoXu extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $giao_ho_id,
        $start_date,
        $end_date,
        $ten_thanh_id,
        $ho_va_ten,
        $sinh_hoac_tu,
        $avatar,
        $ten_thanh_tu_si,
        $ten_tu_si,
        $chuc_vu_id,
        $tu_si_id,
        $active = false,
        $date_of_birth,
        $paginate_number = 20;

    // can use $updatesQueryString to encode url
    protected $queryString  = ['ho_va_ten',
        'ten_thanh_id', 'giao_ho_id', 'chuc_vu_id',
        'paginate_number', 'date_of_birth', 'sinh_hoac_tu', 'start_date', 'end_date', 'active'];
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
        if ($this->sinh_hoac_tu == 1 && $this->start_date && $this->end_date){
            $tu_si->whereBetween('ngay_sinh', [$this->start_date, $this->end_date]);
        }
        if($this->sinh_hoac_tu == 2 && $this->start_date && $this->end_date){
            $tu_si->whereBetween('ngay_mat', [$this->start_date, $this->end_date]);
        }
        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)->get();
        return view('livewire.giao-xu.show-tu-si-by-giao-xu')->with([
            'all_tu_si' => $tu_si->paginate(10),
            'all_giao_ho' => $all_giao_ho,
            'all_ten_thanh'=> TenThanh::select('id', 'ten_thanh')->get(),
            'all_chuc_vu' => ChucVu::select('id', 'ten_chuc_vu')->get(),
        ]);
    }
    public function changeView(){
        $this->active = !$this->active;
    }

    public function edit($id){
        $tu_si = TuSi::with('tenThanh')->whereId($id)
            ->select('id', 'ten_thanh_id', 'ho_va_ten')->first();
        $this->tu_si_id = $id;
        $this->ten_thanh_tu_si  = $tu_si->tenThanh->ten_thanh;
        $this->ten_tu_si = $tu_si->ho_va_ten;
    }

    public function changeAvatar(){
        $this->validate([
            'avatar' => 'image|max:5120|required',
        ], [
                'avatar.max' => 'Kích thước hình ảnh không được quá lớn hơn 5 Mb',
                'avatar.image' => 'Ảnh đại diện phải mà file hình ảnh',
                'avatar.required' => 'Ảnh đại diện không được phép trống',
            ]
        );
        $tu_si = TuSi::find($this->tu_si_id);
        if ($tu_si){
            $avatar = $this->avatar->store('images', 'public');
            $tu_si->update([
                'avatar' => $avatar,
            ]);
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Cập nhập thành công']);
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Không tìm thấy tu sĩ']);
        }

    }
    public function delete(){
        $tu_si = TuSi::find($this->tu_si_id);
        if ($tu_si){
            $tu_si->delete();
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Xóa thành công']);
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Không tìm thấy']);
        }
    }
}
