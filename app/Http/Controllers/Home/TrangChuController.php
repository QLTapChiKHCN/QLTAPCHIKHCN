<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\SoTapChi;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use App\Enums\TrangThaiBaiViet;
use Carbon\Carbon;
class TrangChuController extends Controller
{
    public function index(Request $request)
    {
        $query = SoTapChi::where('TrangThai', 1);

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'latest':
                    $query->latest('NgayXuatBan');
                    break;
                case 'week':
                    $query->where('NgayXuatBan', '>=', Carbon::now()->subWeek());
                    break;
                case 'month':
                    $query->where('NgayXuatBan', '>=', Carbon::now()->subMonth());
                    break;
            }
        }

        $sotapchi = $query->paginate(3);

        return view('Home.TrangChu', compact('sotapchi'));
    }
    public function showBaiVietTheoTapChi($id)
    {
        $soTapChi = SoTapChi::findOrFail($id);

        $baiViet = BaiViet::where('MaSoTC', $id)
            ->where('TrangThai',TrangThaiBaiViet::DANG_BAI->value )
            ->paginate(5);

        return view('Home.ShowBaiViet', compact('soTapChi', 'baiViet'));
    }

    public function showChiTietBaiViet($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        return view('Home.BaiVietDetail', compact('baiViet'));
    }


}
