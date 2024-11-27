<?php
namespace App\Http\Controllers\PhanBien;

use App\Enums\TrangThaiChiTietPhanBien;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LichSuChonNguoiPhanBien;
use App\Enums\TrangThaiYeuCau;
use App\Models\ChiTietPhanBien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class RequestController extends Controller
{
    public function List_Request(Request $request)
    {
        $stt = $request->input('status');
        $query = LichSuChonNguoiPhanBien::where('MaNguoiDung', Auth::id())->where('TrangThaiTBT', 'Đồng ý')->with('BaiViet');
        // dd($query);
        if ($stt === 'Chờ phản hồi') {
            $query->where('TrangThai', TrangThaiYeuCau::CHO_PHAN_HOI->value);
        } elseif ($stt === 'Chấp nhận') {
            $query->where('TrangThai', TrangThaiYeuCau::CHAP_NHAN->value);
        } elseif ($stt === 'Từ chối') {
            $query->where('TrangThai', TrangThaiYeuCau::TU_CHOI->value);
        }

        $dsyc = $query->get();
        // dump($dsyc);
        return view('PB.ListRequest', compact('dsyc'));
    }
    public function update_stt(Request $request, $maBaibao)
    {
        try {
            $rs = $request->input('result');
            $updated = LichSuChonNguoiPhanBien::where('MaBaiBao', trim($maBaibao))
                ->where('MaNguoiDung', Auth::id())
                ->update(['TrangThai' => $rs]);
            if ($rs == TrangThaiYeuCau::CHAP_NHAN->value && !$updated) {
                $kq = ChiTietPhanBien::create([
                    'MaBaiBao' => trim($maBaibao),
                    'MaNguoiDung' => Auth::id(),
                    'NgayNhan' => new \DateTime(),
                    'KetQuaPhanBien' => TrangThaiChiTietPhanBien::CHO_PHAN_HOI->value,
                ]);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu có lỗi xảy ra
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

}
