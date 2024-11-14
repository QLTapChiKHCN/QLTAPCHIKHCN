<?php
namespace App\Http\Controllers\PhanBien;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LichSuChonNguoiPhanBien;
use App\Enums\TrangThaiYeuCau;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function List_Request(Request $request)
    {
        $stt = $request->input('status');
        $dsyc = LichSuChonNguoiPhanBien::where('MaNguoiDung', Auth::id())->with('BaiViet');
        // dd($dsyc);
        switch ($stt) {
            case 'Chờ phản hồi':
                $dsyc = $dsyc->where('TrangThai', TrangThaiYeuCau::CHO_PHAN_HOI->value);
                break;

            case 'Chấp nhận':
                $dsyc = $dsyc->where('TrangThai', TrangThaiYeuCau::CHAP_NHAN->value);
                break;

            case 'Từ chối':
                $dsyc = $dsyc->where('TrangThai', TrangThaiYeuCau::TU_CHOI->value);
                break;
        }

        $dsyc = $dsyc->get();

        return view('PB.ListRequest', compact('dsyc'));
    }
    public function update_stt(Request $request, $maBaibao)
    {
        $rs = $request->input('result');
        $updated = LichSuChonNguoiPhanBien::where('MaBaiBao', trim($maBaibao))
                                       ->where('MaNguoiDung', Auth::id())
                                       ->update(['TrangThai' => $rs]);

    if ($updated) {
        return redirect()->back()->with('success', 'Cập nhật thành công.');
    } else {
        return redirect()->back()->with('error', 'Cập nhật không thành công.');
    }
    }

}
