<?php

namespace App\Http\Livewire\Sgdcg;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\LichSuSgdcg;
use App\Models\SoGiaDinh;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class CrudSgdcg extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public
        $sgdcg_id,
        $sgdcg_modal,
        $all_giao_xu,
        $ma_so,
        $la_nhap_xu,
        $ngay_tao_so,
        $giao_xu_id,
        $giao_ho_id,
        $start_date,
        $end_date,
        $ngay_chuyen_xu,
        $note,
        $ten_chu_ho,
        $chuyen_xu,
        $all_giao_phan,
        $all_giao_hat,
        $giao_phan_id,
        $page_number,
        $giao_hat_id;
    public  $queryString = ['giao_ho_id', 'ten_chu_ho', 'chuyen_xu','start_date', 'end_date', 'page_number'];

    public function mount()
    {
        $this->giao_ho_id = request()->query('giao_ho_id', $this->giao_ho_id);
        $this->ten_chu_ho = request()->query('ten_chu_ho', $this->ten_chu_ho);
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->page_number = request()->query('page_number', $this->page_number);
        $this->ngay_tao_so = Carbon::now()->format('Y-m-d');
        $this->chuyen_xu = request()->query('chuyen_xu', $this->chuyen_xu);
        if (!$this->page_number){
            $this->page_number = 20;
        }
    }

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');

        $this->all_giao_xu = GiaoXu::where('giao_hat_id', $this->giao_hat_id)
                                ->where('giao_xu_hoac_giao_ho', 0)
                                ->get();
        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)
            ->orWhere('id', Auth::user()->giao_xu_id)
            ->pluck('id')->toArray();
        $giao_ho = array_values($giao_ho);

        $get_giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])
            ->where('id', Auth::user()->giao_xu_id)->first();
        //get ma_code from GP GH GX
        if (!$this->ma_so){
            $last_sgdcg = SoGiaDinh::latest()->withTrashed()->first()->id;
            $name_GP = $this->getUpperCase($get_giao_xu->giaoPhan->ten_giao_phan);
            $name_GH = $this->getUpperCase($get_giao_xu->giaoHat->ten_giao_hat);
            $name_GX = $this->getUpperCase($get_giao_xu->ten_giao_xu);

            if (!$last_sgdcg){
                $this->ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. 0;
            }else{
                $this->ma_so = $name_GP. '-'.$name_GH. '-'. $name_GX .'-'. ($last_sgdcg + 1);
            }
        }

        $this->all_giao_phan = GiaoPhan::orderBy('ten_giao_phan')->get();
        $this->all_giao_hat = GiaoHat::where('giao_phan_id', $this->giao_phan_id)->get();
        // get value match GiaoXu because Account has role which is GiaoXU and then only see it's data
        // thanhVienSo2 is ThanhVien from a existing SoGiaDinh and He or she will have new SoGiDinh.
        // Thus, We need show number of thanhvien from that SogiaDinh by so_gia_dinh_id_2
        if (!$this->ten_chu_ho){
            $all_so_gia_dinh = SoGiaDinh::with(['getUser', 'lichSuChuyenXu','giaoXu', 'thanhVien' => function($q){
                $q->with('tenThanh')
                    ->where('chuc_vu_gd', 'Cha');
            }, 'thanhVienSo2' => function($q){
                $q->with('tenThanh')
                    ->where('chuc_vu_gd_2', 'Cha');
            } ])
                ->withCount(['thanhVien', 'thanhVienSo2'])
                ->orderBy('created_at', 'DESC');
        }else{
            $chu_ho = $this->ten_chu_ho;
            $all_so_gia_dinh = SoGiaDinh::with(['getUser','giaoXu',
            'thanhVien' => function($q) use($chu_ho){
                $q->with('tenThanh')
                    ->where('ho_va_ten','like',  '%'.$chu_ho . '%')
                    ->where('chuc_vu_gd', 'Cha');
            }, 'thanhVienSo2' => function($q) use($chu_ho){
                $q->with('tenThanh')
                    ->where('ho_va_ten','like',  '%'.$chu_ho . '%')
                    ->where('chuc_vu_gd_2', 'Cha');
            } ])
                ->withCount(['thanhVien', 'thanhVienSo2'])
                ->orderBy('created_at', 'DESC');
        }
        if (!$this->giao_ho_id){
            if ($this->chuyen_xu == 'true'){
                $all_so_gia_dinh = $all_so_gia_dinh
                    ->WhereHas('lichSuChuyenXu', function ($q) use($giao_ho){
                        $q->whereIn('giao_xu_id', $giao_ho);
                    })->where('giao_xu_id', '<>', Auth::user()->giao_xu_id);
            }else{
                $all_so_gia_dinh = $all_so_gia_dinh
                    ->whereIn('giao_xu_id', $giao_ho)
                    ->orWhereHas('lichSuChuyenXu', function ($q) use($giao_ho){
                        $q->whereIn('giao_xu_id', $giao_ho);
                });
            }
        }else{
            if ($this->chuyen_xu == 'true'){
                $giao_ho_id = $this->giao_ho_id;
                $all_so_gia_dinh = $all_so_gia_dinh
                    ->WhereHas('lichSuChuyenXu', function ($q) use($giao_ho_id){
                        $q->where('giao_xu_id', $giao_ho_id);
                    })->where('giao_xu_id', '<>', Auth::user()->giao_xu_id);
            }else{
                $giao_ho_id = $this->giao_ho_id;
                $all_so_gia_dinh = $all_so_gia_dinh->where('giao_xu_id', $this->giao_ho_id)
                    ->orWhereHas('lichSuChuyenXu', function ($q) use($giao_ho_id){
                        $q->where('giao_xu_id', $giao_ho_id);
                    });
            }
        }
        if ($this->start_date && $this->end_date){
            $all_so_gia_dinh = $all_so_gia_dinh->whereBetween('ngay_tao_so',[$this->start_date, $this->end_date]);
        }


        $all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', Auth::user()->giao_xu_id)->select('ten_giao_xu', 'id')->get();
        return view('livewire.sgdcg.crud-sgdcg')->with([
            'all_so_gia_dinh' => $all_so_gia_dinh->paginate($this->page_number),
            'all_giao_ho' => $all_giao_ho,
        ]);
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
        'ma_so' => 'required|max:20|unique:so_gia_dinh_cong_giao',
        'ngay_tao_so' => 'required|date',
        'note' => 'max:1000',
    ];

    protected $messages = [
        'ma_so.required' => ':attribute không được phép trống',
        'ma_so.max'     => ':attribute không vợt quá 20',
        'ma_so.unique' => ':attribute đã tồn tại',
        'ngay_tao_so.required' => ':attribute không được phép trống',
        'ngay_tao_so.date' => ':attribute phải đúng dạng ngày tháng năm',
        'note.max' => 'Chú thích không được vượt quá 1000 ký tự',
    ];

    protected $validationAttributes = [
        'ma_so' => 'Mã số của sổ',
        'ngay_tao_so' => 'Ngày lập sổ',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function clearData(){
        $this->ma_so = null;
        $this->sgdcg_modal = null;
        $this->ngay_tao_so = '';
        $this->giao_hat_id = '';
        $this->giao_phan_id = '';
        $this->note = '';
        $this->ngay_chuyen_xu = null;
    }
    public function store()
    {
        $validatedData = $this->validate();
        $this->la_nhap_xu == 'true' ? $this->la_nhap_xu = 1 : $this->la_nhap_xu = 0;
        $sgdcg = SoGiaDinh::create(array_merge($validatedData,
            ['nguoi_khoi_tao' => Auth::id(),
             'la_nhap_xu' => $this->la_nhap_xu,
             'giao_xu_id' => Auth::user()->giao_xu_id]));
        Toastr::success('Tạo mới thành công','Thành công');
        return redirect()->route('so-gia-dinh.createTV', $sgdcg->id);
    }

    public function setCurrentTime(){
        $this->ma_so =  null;
        $this->ngay_tao_so = Carbon::now()->format('Y-m-d');
    }

    public function changeGiaoHat(){
        $this->giao_hat_id = null;
        $this->giao_xu_id = null;

    }

    public function edit($id){
        $this->clearData();
        $this->sgdcg_modal = SoGiaDinh::with(['lichSuChuyenXu' => function ($q){
            $q->where('giao_xu_id', Auth::user()->giao_xu_id);
        }])->find($id);

     if ($this->sgdcg_modal){
            $this->ma_so = $this->sgdcg_modal->ma_so;
            $this->ngay_tao_so = $this->sgdcg_modal->ngay_tao_so;
            $this->giao_xu_id = $this->sgdcg_modal->giao_xu_id;
            $giao_xu = GiaoXu::with('giaoHat.giaoPhan')->find($this->sgdcg_modal->giao_xu_id);
            $this->giao_phan_id = $giao_xu->giaoHat->giaoPhan->id;
            $this->giao_hat_id = $giao_xu->giaoHat->id;
            foreach($this->sgdcg_modal->lichSuChuyenXu as $ls){
                $this->ngay_chuyen_xu = Carbon::parse($ls->pivot->created_at)->format('Y-m-d');
                $this->note = $ls->pivot->note;
            }
            $this->la_nhap_xu = $this->sgdcg_modal->la_nhap_xu;
        }
    }

    public function update(){
        if ($this->sgdcg_modal){
            // Save info to LichSusgdcg when Chuyen Xu
            if ($this->sgdcg_modal->giao_xu_id !== $this->giao_xu_id){
               $this->sgdcg_modal->lichSuChuyenXu()->attach($this->sgdcg_modal->giao_xu_id, [
                   'note' => $this->note,
                   'created_at' => $this->ngay_chuyen_xu,
               ]);
            }else{
            // update Info sgdcg when chuyen xu.
                $ls = LichSuSgdcg::where('sgdcg_id', $this->sgdcg_modal->id)
                    ->where('giao_xu_id', Auth::user()->id)->first();
                if ($ls){
                    $ls->update([
                        'note' => $this->note,
                        'created_at'  => $this->ngay_chuyen_xu,
                    ]);
                }
            }
            $this->sgdcg_modal->update([
                'ma_so' => $this->ma_so,
                'giao_xu_id' => $this->giao_xu_id,
                'ngay_tao_so' => $this->ngay_tao_so,
                'nguoi_khoi_tao' => Auth::id()
            ]);
            Toastr::success('Cập nhập thành công','Thành công');
            return redirect()->route('so-gia-dinh.index');
        }
    }

    public function updateSGD(){
        if ($this->sgdcg_modal) {
            $this->la_nhap_xu == 'true' || $this->la_nhap_xu == 1 ? $this->la_nhap_xu = 1 : $this->la_nhap_xu = 0;
            $this->sgdcg_modal->update([
                'la_nhap_xu' => $this->la_nhap_xu,
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
