<?php

namespace App\Imports;

use App\Models\GiaoHat;
use App\Models\GiaoPhan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoHatSheetImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    private $giao_phans;

    public function __construct()
    {
        $this->giao_phans = GiaoPhan::select('id', 'ten_giao_phan')->get();
    }

    public function collection(Collection  $rows)
    {
        foreach ($rows as $row)
        {
            $giao_phan = $this->giao_phans->where('ten_giao_phan', $row['ten_giao_phan'])->first();
                GiaoHat::create([
                    'ten_giao_hat' => $row['ten_giao_hat'],
                    'ngay_thanh_lap' => Carbon::parse($row['ngay_thanh_lap'])->toDate(),
                    'nguoi_khoi_tao'=> Auth::id(),
                    'giao_phan_id' => $giao_phan->id
                ]);
        }

    }
}
