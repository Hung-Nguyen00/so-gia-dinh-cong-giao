<?php

namespace App\Http\Livewire\Sgdcg;

use App\Events\SendingEmailAfterChuyenXu;
use App\Jobs\SendEmailAfterChuyenXu;
use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use App\Models\GiaoXu;
use App\Models\LichSuSgdcg;
use App\Models\SoGiaDinh;
use App\Models\TenThanh;
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
        $show_history_sgdcg = null,
        $end_date,
        $ngay_chuyen_xu,
        $note,
        $is_giao_ho_id,
        $giao_xu,
        $search_ten_thanh_id,
        $giao_xu_id_old,
        $ten_chu_ho,
        $gx_id_search,
        $chuyen_xu_nhap_xu = 1,
        $all_giao_phan,
        $all_giao_hat,
        $giao_phan_id,
        $all_giao_xu_search,
        $page_number,
        $all_ten_thanh,
        $loading = 0,
        $all_giao_ho,
        $giao_hat_id;
    public  $queryString = ['giao_ho_id', 'ten_chu_ho',
        'search_ten_thanh_id', 'gx_id_search',
        'chuyen_xu_nhap_xu','start_date', 'end_date', 'page_number'];

    public function mount()
    {
        $this->giao_ho_id = request()->query('giao_ho_id', $this->giao_ho_id);
        $this->ten_chu_ho = request()->query('ten_chu_ho', $this->ten_chu_ho);
        $this->start_date = request()->query('start_date', $this->start_date);
        $this->gx_id_search = request()->query('gx_id_search', $this->gx_id_search);
        $this->search_ten_thanh_id = request()->query('search_ten_thanh_id', $this->search_ten_thanh_id);
        $this->end_date = request()->query('end_date', $this->end_date);
        $this->page_number = request()->query('page_number', $this->page_number);
        $this->ngay_tao_so = Carbon::now()->format('Y-m-d');
        $this->chuyen_xu_nhap_xu = request()->query('chuyen_xu_nhap_xu', $this->chuyen_xu_nhap_xu);
        if (!$this->page_number){
            $this->page_number = 20;
        }
        $this->all_giao_xu_search = GiaoXu::with('giaoHat')
                            ->where('giao_xu_hoac_giao_ho', 0)
                            ->get();
        $this->all_giao_phan = GiaoPhan::orderBy('ten_giao_phan')->get();
        $this->all_ten_thanh = TenThanh::select('id', 'ten_thanh')->get();
        $this->all_giao_xu = GiaoXu::where('giao_xu_hoac_giao_ho', 0)->get();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        if($this->giao_hat_id){
            $this->all_giao_xu = GiaoXu::where('giao_xu_hoac_giao_ho', 0)->where('giao_hat_id', $this->giao_hat_id)->get();
        }
        if ($this->gx_id_search){
            $giao_xu_id = $this->gx_id_search;
        }else{
            $giao_xu_id = Auth::user()->giao_xu_id;
        }
        $giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', $giao_xu_id)
            ->orWhere('id', $giao_xu_id)
            ->pluck('id')->toArray();
        $giao_ho = array_values($giao_ho);

        $this->createSoGiaDinh($giao_xu_id);
        $this->all_giao_hat = GiaoHat::where('giao_phan_id', $this->giao_phan_id)->get();
        // get value match GiaoXu because Account has role which is GiaoXU and then only see it's data
        // thanhVienSo2 is ThanhVien from a existing SoGiaDinh and He or she will have new SoGiDinh.
        // Thus, We need show number of thanhvien from that SogiaDinh by so_gia_dinh_id_2
        // search By Chu Ho or not

        // search By GiaoHo or not

        $all_so_gia_dinh = $this->getSoGiaDinh($giao_xu_id, $giao_ho);

        $this->all_giao_ho = GiaoXu::where('giao_xu_hoac_giao_ho', $giao_xu_id)->select('ten_giao_xu', 'id')->get();
        return view('livewire.sgdcg.crud-sgdcg')->with([
            'all_so_gia_dinh' => $all_so_gia_dinh ? $all_so_gia_dinh->paginate($this->page_number) : null,
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
        'ma_so' => 'required',
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
        $this->loading = 0;
        $this->ngay_chuyen_xu = null;
    }

    public function getSoGiaDinh($giao_xu_id, $giao_ho){
        $all_so_gia_dinh = SoGiaDinh::with(['getUser' => function ($q){
            $q->select('id', 'giao_xu_id');
        }, 'lichSuChuyenXu','giaoXu' => function($q){
            $q->select('id', 'ten_giao_xu');
        }, 'thanhVien' => function($q){
            $q->with('tenThanh')
                ->where('chuc_vu_gd', 'Cha');
        }, 'thanhVienSo2' => function($q){
            $q->with('tenThanh')
                ->where('chuc_vu_gd_2', 'Cha');
        }])
            ->withCount(['thanhVien', 'thanhVienSo2'])
            ->where('giao_xu_id', $giao_xu_id)
            ->orderBy('created_at', 'DESC');

        if (!$this->giao_ho_id){
            // search by All
            if ($this->chuyen_xu_nhap_xu == 2){
                $all_so_gia_dinh = $all_so_gia_dinh
                    ->whereIn('giao_xu_id', $giao_ho)
                    ->Where('la_nhap_xu',  1)
                    ->orWhereHas('lichSuChuyenXu', function ($q) use($giao_xu_id){
                        $q->where('so_gia_dinh_cong_giao.giao_xu_id', $giao_xu_id);
                    });
            }
            if ($this->chuyen_xu_nhap_xu == 3){
                $all_so_gia_dinh = $all_so_gia_dinh->WhereHas('lichSuChuyenXu', function ($q) use($giao_xu_id){
                    $q->where('lich_su_sgdcg.giao_xu_id',$giao_xu_id);
                })->whereNotIn('giao_xu_id', $giao_ho);
            }
        }

        if ($this->start_date && $this->end_date){
            $all_so_gia_dinh = $all_so_gia_dinh->whereBetween('ngay_tao_so',[$this->start_date, $this->end_date]);
        }
        if ($this->chuyen_xu_nhap_xu == 1 && !$this->ten_chu_ho ){
            $all_so_gia_dinh = $all_so_gia_dinh->orWhereHas('lichSuChuyenXu', function ($q) use($giao_xu_id){
                $q->where('giao_xu_id', $giao_xu_id);
            })->orWhereIn('giao_xu_id', $giao_ho);
        }
        if ($this->ten_chu_ho || $this->search_ten_thanh_id){
            $chu_ho = $this->ten_chu_ho;
            $search_ten_thanh = $this->search_ten_thanh_id;
            if (!$this->giao_ho_id){
                $all_so_gia_dinh = $all_so_gia_dinh->WhereIn('giao_xu_id', $giao_ho);
            }else{
                $all_so_gia_dinh = $all_so_gia_dinh->where('giao_xu_id', $this->giao_ho_id);
            }

            $all_so_gia_dinh = $all_so_gia_dinh
                    ->whereHas('thanhVien', function($q) use($chu_ho, $search_ten_thanh){
                    $q->with('tenThanh')
                        ->where('ho_va_ten','like',  '%'.$chu_ho . '%')
                        ->where('chuc_vu_gd', 'Cha');
                    if ($search_ten_thanh){
                        $q->where('ten_thanh_id', $search_ten_thanh);
                    }
                })
                ->orWhereHas('thanhVienSo2',function($q) use($chu_ho, $search_ten_thanh){
                    $q->with('tenThanh')
                        ->where('ho_va_ten', 'like', '%' . $chu_ho . '%')
                        ->where('chuc_vu_gd_2', 'Cha');
                    if ($search_ten_thanh) {
                        $q->where('ten_thanh_id', $search_ten_thanh);
                    }
                })
                ->orderBy('created_at', 'DESC');
        }
        if ($this->giao_ho_id){
            $giao_ho_id = $this->giao_ho_id;
            $all_so_gia_dinh = $all_so_gia_dinh->where('giao_xu_id', $giao_ho_id);
        }
        return $all_so_gia_dinh;
    }

    public function createSoGiaDinh($giao_xu_id){
        $get_giao_xu = GiaoXu::with(['giaoPhan', 'giaoHat'])
            ->where('id', $giao_xu_id)->first();

        //create ma_code from GP GH GX
        if (!$this->ma_so){
            $name_GP = $this->getUpperCase($get_giao_xu->giaoPhan->ten_giao_phan);
            $name_GH = $this->getUpperCase($get_giao_xu->giaoHat->ten_giao_hat);
            $name_GX = $this->getUpperCase($get_giao_xu->ten_giao_xu);

            $ma_giao_xu = $name_GP. '-'.$name_GH. '-'. $name_GX .'-';
            $last_sgdcg = SoGiaDinh::latest('id')->withTrashed()
                ->where('ma_so', 'like', $ma_giao_xu.'%')
                ->orderBy('created_at', 'ASC')
                ->first();
            // get number max ma_code
            $max_number = null;
            if($last_sgdcg){
                preg_match_all('!\d+!', $last_sgdcg->ma_so, $matches);
                $max_number = $matches[0][0];
            }
            $number = $max_number ? $max_number : 0;
            $this->ma_so = $ma_giao_xu.($number + 1);
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->la_nhap_xu == 'true' ? $this->la_nhap_xu = 1 : $this->la_nhap_xu = 0;
        if (SoGiaDinh::where('ma_so', $this->ma_so)->exists()){
            Toastr::error('Mã sổ đã tồn tại','error');
        }
        // if this sgdcg is own GiaoHo, then save is_giao_ho_id to sgcg
        //if this sgdcg is  null, it means it's own GiaoXu and save id of user.
        if ($this->is_giao_ho_id){
            $sgdcg = SoGiaDinh::create(array_merge($validatedData,
                ['nguoi_khoi_tao' => Auth::id(),
                    'la_nhap_xu' => $this->la_nhap_xu,
                    'giao_xu_id' => $this->is_giao_ho_id]));
        }else{
            $sgdcg = SoGiaDinh::create(array_merge($validatedData,
                ['nguoi_khoi_tao' => Auth::id(),
                    'la_nhap_xu' => $this->la_nhap_xu,
                    'giao_xu_id' => Auth::user()->giao_xu_id]));
        }
        Toastr::success('Tạo mới thành công','Thành công');
        return redirect()->route('so-gia-dinh.createTV', $sgdcg->id);
    }

    public function setCurrentTime(){
        $this->clearData();
        $this->ma_so =  null;
        $this->ngay_tao_so = Carbon::now()->format('Y-m-d');
    }

    public function changeGiaoHat(){
        $this->giao_hat_id = null;
        $this->giao_xu_id = null;

    }

    public function getHistory($id){
        $this->show_history_sgdcg = SoGiaDinh::with(['lichSuChuyenXu' => function($q){
            $q->with('giaoPhan');
        },'thanhVien' => function($q){
            $q->with('tenThanh')
                ->where('chuc_vu_gd', 'Cha');
        }, 'thanhVienSo2' => function($q){
            $q->with('tenThanh')
                ->where('chuc_vu_gd_2', 'Cha');
        }])->whereId($id)->first();
        $this->edit($id);
    }

    public function edit($id){
        $this->loading = 1;
        $this->clearData();
        $this->sgdcg_modal = SoGiaDinh::with(['lichSuChuyenXu' => function ($q){
            $q->where('giao_xu_id', Auth::user()->giao_xu_id);
        }])->find($id);
     if ($this->sgdcg_modal){
            $this->ma_so = $this->sgdcg_modal->ma_so;
            $this->ngay_tao_so = $this->sgdcg_modal->ngay_tao_so;
            $this->is_giao_ho_id = $this->sgdcg_modal->giao_xu_id;
            //get GiaoXu from SGDC. If  giao_xu_hoac_giao_ho == 0 then this is of GX
            // If  giao_xu_hoac_giao_ho == 0 then this is of GH, we must find GX's id from GH's id
            $this->giao_xu = GiaoXu::with('giaoHat.giaoPhan')->find($this->sgdcg_modal->giao_xu_id);
            if ($this->giao_xu->giao_xu_hoac_giao_ho !== 0){
                // get Giao xu of giaoHo
                $this->giao_xu = GiaoXu::with('giaoHat.giaoPhan')
                    ->find($this->giao_xu->giao_xu_hoac_giao_ho);
                $this->giao_xu_id = $this->giao_xu->id;
                $this->giao_xu_id_old =  $this->giao_xu->id;
                $this->giao_phan_id = $this->giao_xu->giaoHat->giaoPhan->id;
                $this->giao_hat_id = $this->giao_xu->giaoHat->id;
            }else{
                $this->giao_xu_id =  $this->giao_xu->id;
                $this->giao_xu_id_old =  $this->giao_xu->id;
                $this->giao_phan_id =  $this->giao_xu->giaoHat->giaoPhan->id;
                $this->giao_hat_id =  $this->giao_xu->giaoHat->id;
            }
            // get created_at from LichSu_sgdcg. Because when convert GX ngay_chuyen_xu will be Created_at
            // and when this sgdcg of other GX. We will find record in LichSu_sgdcg which has old GX's id
            // and then show to interface.
            foreach($this->sgdcg_modal->lichSuChuyenXu as $ls){
                $this->ngay_chuyen_xu = Carbon::parse($ls->pivot->created_at)->format('Y-m-d');
                $this->note = $ls->pivot->note;
            }
            // if don't have any lich su chuyen xu. We will set default time
            if ($this->ngay_chuyen_xu == null){
                $this->ngay_chuyen_xu = Carbon::now()->format('Y-m-d');
            }
            $this->la_nhap_xu = $this->sgdcg_modal->la_nhap_xu;
        }
    }

    public function update(){
        if ($this->sgdcg_modal){
            // Save info to LichSusgdcg when Chuyen Xu
            // $this->giao_xu->id get from edit().
            if ($this->giao_xu->id !== $this->giao_xu_id && $this->giao_xu_id_old == Auth::user()->giao_xu_id){
               $this->sgdcg_modal->lichSuChuyenXu()->attach($this->giao_xu->id, [
                   'note' => $this->note,
                   'created_at' => $this->ngay_chuyen_xu,
               ]);
                // convert GiaoXU
                $this->sgdcg_modal->update([
                    'ma_so' => $this->ma_so,
                    'giao_xu_id' => $this->giao_xu_id,
                    'ngay_tao_so' => $this->ngay_tao_so,
                    'nguoi_khoi_tao' => Auth::id()
                ]);
                dispatch( new SendEmailAfterChuyenXu($this->sgdcg_modal->id, $this->giao_xu_id));
                Toastr::success('Cập nhập thành công','Thành công');
                return redirect()->route('so-gia-dinh.index');
            }else{
            // update Info sgdcg when chuyen xu.
                $ls = LichSuSgdcg::where('sgdcg_id', $this->sgdcg_modal->id)
                    ->where('giao_xu_id', Auth::user()->giao_xu_id)->first();
                if ($ls){
                    $ls->update([
                        'note' => $this->note,
                        'created_at'  => $this->ngay_chuyen_xu,
                    ]);
                }
                Toastr::success('Cập nhập thành công','Thành công');
                return redirect()->route('so-gia-dinh.index');
            }
            Toastr::error('Không có quyền chỉnh sửa','error');
            return redirect()->route('so-gia-dinh.index');
        }
    }

    public function updateSGD(){
        if ($this->sgdcg_modal) {
            $this->la_nhap_xu == 'true' || $this->la_nhap_xu == 1 ? $this->la_nhap_xu = 1 : $this->la_nhap_xu = 0;
            if ($this->is_giao_ho_id){
                $this->sgdcg_modal->update([
                    'la_nhap_xu' => $this->la_nhap_xu,
                    'ngay_tao_so' => $this->ngay_tao_so,
                    'giao_xu_id' => $this->is_giao_ho_id,
                    'nguoi_khoi_tao' => Auth::id()
                ]);
            }else{
                $this->sgdcg_modal->update([
                    'la_nhap_xu' => $this->la_nhap_xu,
                    'ngay_tao_so' => $this->ngay_tao_so,
                    'nguoi_khoi_tao' => Auth::id()
                ]);
            }
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
