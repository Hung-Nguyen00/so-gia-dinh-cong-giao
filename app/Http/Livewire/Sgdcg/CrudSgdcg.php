<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\SoGiaDinh;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CrudSgdcg extends Component
{
    public $all_so_gia_dinh,
        $sgdcg_id,
        $sgdcg_modal,
        $all_giao_xu,
        $ma_so,
        $ngay_tao_so,
        $giao_xu_id,
        $all_giao_phan,
        $all_giao_hat,
        $giao_phan_id,
        $giao_hat_id;

    public function render()
    {
        $this->all_giao_xu = GiaoXu::where('giao_hat_id', $this->giao_hat_id)
                                ->where('giao_xu_hoac_giao_ho', 0)
                                ->get();
         $get_giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])->where('id', Auth::user()->giao_xu_id)->first();
        //get ma_code from GP GH GX
        $last_sgdcg = SoGiaDinh::all()->last();
        $name_GP = $this->getUpperCase($get_giao_xu->giaoPhan->ten_giao_phan);
        $name_GH = $this->getUpperCase($get_giao_xu->giaoHat->ten_giao_hat);
        $name_GX = $this->getUpperCase($get_giao_xu->ten_giao_xu);

        if (!$last_sgdcg){
            $this->ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. 0;
        }else{
            $this->ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. ($last_sgdcg->id + 1);
        }
        $this->ngay_tao_so = Carbon::now()->format('Y-m-d');
        $this->all_giao_phan = GiaoPhan::orderBy('ten_giao_phan')->get();
        $this->all_giao_hat = GiaoHat::where('giao_phan_id', $this->giao_phan_id)->get();
        return view('livewire.sgdcg.crud-sgdcg');
    }

    public function mount($all_so_gia_dinh){
        $this->all_so_gia_dinh = $all_so_gia_dinh;
    }


    public function getUpperCase($name){
        preg_match_all('/[A-Z]/', $name, $matches, PREG_OFFSET_CAPTURE);
        $letter_uc = '';
        for ($i = 0 ; $i < sizeof($matches[0]); $i++){
            $letter_uc = $letter_uc . $matches[0][$i][0];
        }
        return $letter_uc;
    }

    protected $rules = [
        'ma_so' => 'required|max:15|unique:so_gia_dinh_cong_giao',
        'ngay_tao_so' => 'required|date',
    ];

    protected $messages = [
        'ma_so.required' => ':attribute không được phép trống',
        'ma_so.max'     => ':attribute không vợt quá 15',
        'ma_so.unique' => ':attribute đã tồn tại',
        'ngay_tao_so.required' => ':attribute không được phép trống',
        'ngay_tao_so.date' => ':attribute phải đúng dạng ngày tháng năm'
    ];

    protected $validationAttributes = [
        'ma_so' => 'Mã số của sổ',
        'ngay_tao_so' => 'Ngày lập sổ',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function store()
    {
        $validatedData = $this->validate();
        $sgdcg = SoGiaDinh::create(array_merge($validatedData,
            ['nguoi_khoi_tao' => Auth::id(),
             'giao_xu_id' => Auth::user()->giao_xu_id]));

        Toastr::success('Tạo mới thành công','Thành công');
        return redirect()->route('so-gia-dinh.createTV', $sgdcg->id);
    }

    public function changeGiaoHat(){
        $this->giao_hat_id = null;
        $this->giao_xu_id = null;

    }

    public function edit($id){
        $this->sgdcg_modal = SoGiaDinh::find($id);
        if ($this->sgdcg_modal){
            $this->ma_so = $this->sgdcg_modal->ma_so;
            $this->ngay_tao_so = $this->sgdcg_modal->ngay_tao_so;
            $this->giao_xu_id = $this->sgdcg_modal->giao_xu_id;

            $giao_xu = GiaoXu::with('giaoHat.giaoPhan')->find($this->sgdcg_modal->giao_xu_id);
            $this->giao_phan_id = $giao_xu->giaoHat->giaoPhan->id;
            $this->giao_hat_id = $giao_xu->giaoHat->id;
        }

    }

    public function update(){
        if (!$this->ma_so){
            throw ValidationException::withMessages(['ma_so' => 'Mã sổ không được phép để trống']);
        }else if (strlen($this->ma_so) > 15){
            throw ValidationException::withMessages(['ma_so' => 'Mã sổ không được phép quá 15 ký tự']);
        }
        if (SoGiaDinh::where('id', '<>', $this->sgdcg_modal->id)->where('ma_so', $this->ma_so))
        if (!$this->giao_xu_id){
            throw ValidationException::withMessages(['giao_xu_id' => 'Tên giáo xứ được phép để trống']);
        }
        if (!strtotime($this->ngay_tao_so)){
            throw ValidationException::withMessages(['giao_xu_id' => 'Ngày tạo sổ phải là giá trị ngày tháng năm']);
        }
        if (!$this->ngay_tao_so){
            throw ValidationException::withMessages(['ngay_tao_so' => 'Ngày tạo sổ không được phép trống']);
        }
        if ($this->sgdcg_modal){
            $this->sgdcg_modal->update([
                'ma_so' => $this->ma_so,
                'giao_xu_id' => $this->giao_xu_id,
                'ngay_tao_so' => $this->ngay_tao_so,
                'nguoi_khoi_tao' => Auth::id()
            ]);
        }
        Toastr::success('Cập nhập thành công','Thành công');
        return redirect()->route('so-gia-dinh.index');
    }

    public function delete(){
        if ($this->sgdcg_modal){
            $this->sgdcg_modal->delete();
            Toastr::success('Xóa thành công','Thành công');
            return redirect()->route('so-gia-dinh.index');
        }else{
            Toastr::error('Không tìm thấy','Lỗi');
            return redirect()->route('so-gia-dinh.index');
        }
    }
}
