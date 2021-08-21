<?php

namespace App\Imports;

use App\Models\GiaoHat;
use App\Models\GiaoXu;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoXuSheetImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    private $giao_hats;

    public function __construct()
    {
        $this->giao_hats = GiaoHat::select('id', 'ten_giao_hat')->get();
    }


    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $giao_hat = $this->giao_hats->where('ten_giao_hat', $row['ten_giao_hat'])->first();
            GiaoXu::create([
                'ten_giao_xu' => $row['ten_giao_xu'],
                'dia_chi'    => $row['dia_chi'],
                'ngay_thanh_lap' => Carbon::parse($row['ngay_thanh_lap'])->toDate(),
                'nguoi_khoi_tao'=> Auth::id(),
                'giao_hat_id' => $giao_hat->id
            ]);
        }

    }
}
