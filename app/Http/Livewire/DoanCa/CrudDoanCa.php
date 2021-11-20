<?php

namespace App\Http\Livewire\DoanCa;

use App\Models\DoanCa;
use App\Models\GiaoXu;
use App\Models\TenThanh;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CrudDoanCa extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ten_doan_ca, $ngay_bon_mang, $all_giao_xu, $giao_xu_id, $ten_thanh_id, $doan_ca, $ten_ca_doan, $paginate_number=20;
    protected $queryString = ['ten_ca_doan','giao_xu_id', 'paginate_number'];


    public function mount(){
        $this->ten_ca_doan = request()->query('ten_ca_doan', $this->ten_ca_doan);
        $this->giao_xu_id = request()->query('giao_xu_id', $this->giao_xu_id);
        $this->paginate_number = request()->query('paginate_number', $this->paginate_number);
        $this->all_giao_xu = GiaoXu::with('giaoHat')->get();
        if (!$this->giao_xu_id && Auth::user()->giao_xu_id){
            $this->giao_xu_id = Auth::user()->giao_xu_id;
        }
    }

    public function render()
    {

        $this->dispatchBrowserEvent('contentChanged');
        $all_doan_ca = DoanCa::with(['tenThanh', 'thanhVien' => function($q) {
            $q->wherePivot('truong_doan', 1)->select('ho_va_ten')->first();
        }])->withCount('thanhVien')
            ->orderBy('created_at', 'DESC')
            ->where('giao_xu_id', $this->giao_xu_id);

        if ($this->ten_ca_doan != '' && $this->ten_ca_doan != null){
            $all_doan_ca->where('ten_doan_ca', 'like', "%$this->ten_ca_doan%");
        }
        $all_ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        return view('livewire.doan-ca.crud-doan-ca')->with(
            [
                'all_doan_ca' => $all_doan_ca ? $all_doan_ca->paginate($this->paginate_number) : null,
                'all_ten_thanh' => $all_ten_thanh
            ]
        );
    }



    protected $rules = [
        'ten_doan_ca' => 'required|max:50',
        'ngay_bon_mang' => 'required:date',
        'ten_thanh_id' => 'required'
    ];

    protected $messages = [
        'ten_doan_ca.required' => ':attribute không được phép trống',
        'ten_doan_ca.max' => ':attribute không được vượt quá :max kí tự',
        'ngay_bon_mang.required' => 'Ngày bổn mạng không được trống',
        'ngay_bon_mang.date' =>  'Ngày bổn mạng phải đúng dạng ngày tháng năm',
        'ten_thanh_id' => 'Tên bổn mạng không được trống'
    ];

    protected $validationAttributes = [
        'ten_doan_ca' => 'Tên ca đoàn',
    ];


    public function cancel(){
        $this->ten_doan_ca = '';
        $this->ten_thanh_id = '';
        $this->ngay_bon_mang = '';
    }

    public function edit($id){

       $this->doan_ca = DoanCa::find($id);
       $this->ten_doan_ca = $this->doan_ca->ten_doan_ca;
       $this->ngay_bon_mang = $this->doan_ca->ngay_bon_mang;
       $this->ten_thanh_id = $this->doan_ca->ten_thanh_id;
    }

    public function store(){
        $validatedData = $this->validate();
        DoanCa::create(array_merge($validatedData, ['giao_xu_id' => Auth::user()->giao_xu_id]));
        Toastr::success('Tạo ca đoàn mới thành công','Thành công');
        $this->emit('add');
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Thêm thành công']);
    }

    public function update(){
        $validatedData = $this->validate();
        if ($this->doan_ca){
            $this->doan_ca->update($validatedData);
        }
        Toastr::success('Cập nhập thành công','Thành công');
        $this->emit('edit');
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Cập nhập thành công']);
    }

    public function delete(){
        if ($this->doan_ca){
            $this->doan_ca->delete();
        }
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Xóa thành công']);
        $this->emit('delete');
    }
}
