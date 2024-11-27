<?php

namespace App\Http\Controllers\PhanBien;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\ChiTietPhanBien;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\TrangThaiBaiViet;
use Illuminate\Support\Facades\Auth;
use App\Enums\LichSuChonPhanBien;
use App\Enums\TrangThaiChiTietPhanBien;

class PhanBienController extends Controller
{
    //
    public function index()
    {
        return view('Home.Phanbien');
    }
    public function To_Do_List(Request $request)
{
    $stt = $request->input('status'); // Lấy trạng thái từ request
    $cv = Auth::id(); // Lấy ID người dùng hiện tại
    $nd = NguoiDung::find($cv); // Tìm thông tin người dùng
    $ctpb = ChiTietPhanBien::where('MaNguoiDung', $cv)->get(); // Lấy danh sách công việc
    $list_CV = []; // Danh sách công việc trả về

    if ($ctpb->isNotEmpty()) {
        // Nếu không có trạng thái (request rỗng), lấy toàn bộ
        if (!$stt) {
            foreach ($ctpb as $item) {
                $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->first();
                if ($baiViet) {
                    $list_CV[] = [
                        'MaBaiBao' => $item->MaBaiBao,
                        'TenBaiBao' => $baiViet->TenBaiBao,
                        'TrangThai' => $item->KetQuaPhanBien,
                        'NgayNhan' => $item->NgayNhan,
                        'NgayHetHan' => $item->NgayHetHan,
                        'FileBaiViet' => $baiViet->FileBaiViet
                    ];
                }
            }
        } else {
            // Nếu có trạng thái, lọc theo từng trường hợp
            switch ($stt) {
                case 'Chờ phản hồi':
                    foreach ($ctpb as $item) {
                        $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->first();
                        if ($baiViet && $item->KetQuaPhanBien == TrangThaiChiTietPhanBien::CHO_PHAN_HOI->value) {
                            $list_CV[] = [
                                'MaBaiBao' => $item->MaBaiBao,
                                'TenBaiBao' => $baiViet->TenBaiBao,
                                'TrangThai' => $item->KetQuaPhanBien,
                                'NgayNhan' => $item->NgayNhan,
                                'NgayHetHan' => $item->NgayHetHan,
                                'FileBaiViet' => $baiViet->FileBaiViet
                            ];
                        }
                    }
                    break;
                case 'Chấp nhận':
                    foreach ($ctpb as $item) {
                        $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->first();
                        if ($baiViet && $item->KetQuaPhanBien == TrangThaiChiTietPhanBien::DONG_Y->value) {
                            $list_CV[] = [
                                'MaBaiBao' => $item->MaBaiBao,
                                'TenBaiBao' => $baiViet->TenBaiBao,
                                'TrangThai' => $item->KetQuaPhanBien,
                                'NgayNhan' => $item->NgayNhan,
                                'NgayHetHan' => $item->NgayHetHan,
                                'FileBaiViet' => $baiViet->FileBaiViet
                            ];
                        }
                    }
                    break;
                case 'Từ chối':
                    foreach ($ctpb as $item) {
                        $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->first();
                        if ($baiViet && $item->KetQuaPhanBien == TrangThaiChiTietPhanBien::TU_CHOI->value) {
                            $list_CV[] = [
                                'MaBaiBao' => $item->MaBaiBao,
                                'TenBaiBao' => $baiViet->TenBaiBao,
                                'TrangThai' => $item->KetQuaPhanBien,
                                'NgayNhan' => $item->NgayNhan,
                                'NgayHetHan' => $item->NgayHetHan,
                                'FileBaiViet' => $baiViet->FileBaiViet
                            ];
                        }
                    }
                    break;
                case 'Chỉnh sửa':
                    foreach ($ctpb as $item) {
                        $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->first();
                        if ($baiViet && $item->KetQuaPhanBien == TrangThaiChiTietPhanBien::YEU_CAU_CHINH_SUA->value) {
                            $list_CV[] = [
                                'MaBaiBao' => $item->MaBaiBao,
                                'TenBaiBao' => $baiViet->TenBaiBao,
                                'TrangThai' => $item->KetQuaPhanBien,
                                'NgayNhan' => $item->NgayNhan,
                                'NgayHetHan' => $item->NgayHetHan,
                                'FileBaiViet' => $baiViet->FileBaiViet
                            ];
                        }
                    }
                    break;
            }
        }
    }

    return view('PB.ToDoList', compact('list_CV'));
}


    public function Art_Details(BaiViet $baiviet)
    {
        $ctpb = ChiTietPhanBien::where('MaBaiBao', $baiviet->MaBaiBao)->first();
        return view('PB.Articel-Details', compact('baiviet', 'ctpb'));
    }



    public function show_Pdf($fileName)
    {
        $filePath = public_path("public/storage/uploads/{$fileName}");
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function download_Pdf($fileName)
    {
        $filePath = public_path("public/storage/uploads/{$fileName}");
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        return response()->download($filePath);
    }

    public function post_PDF(Request $request, $baiviet)
    {
        $cv = Auth::id();
        DB::beginTransaction();
        try {
            $path = 'public/storage/uploads/';
            $file = $request->file('file');
            $new_file = null;

            if ($file) {
                $get_name = $file->getClientOriginalName();
                $name_document = current(explode('.', $get_name));
                $new_file = $name_document . rand(0, 99) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $new_file);
            }

            $ctpb = ChiTietPhanBien::where('MaBaiBao', $baiviet);
            if ($ctpb) {
                $ctpb->update([
                    'KetQuaPhanBien' => $request->input('result'),
                    'YKienPhanBien' => $request->content,
                    'NgayTraKetQua' => now(),
                    'FilePhanBien' => $new_file,
                ]);

            $bv = BaiViet::where('MaBaiBao',trim($baiviet))->first();

            $bv->update(
                [
                    'TrangThai' => $request->input('result')
                ]
                );
            }
            DB::commit();
            return redirect()->back()->with('success', 'Gửi file phản biện thành công');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Lỗi khi gửi kết quả');
        }
    }

}
