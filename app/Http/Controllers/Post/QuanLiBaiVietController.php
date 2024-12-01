<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Enums\TrangThaiBaiViet;
use Illuminate\Support\Facades\Auth;
use App\Models\PhanHoi;

use App\Models\LichSuSoDuyetBaiViet;
class QuanLiBaiVietController extends Controller
{
    //
    public function quanlibaiviet(Request $request)
    {
        $status = $request->input('status');

        $query = BaiViet::whereHas('chiTietBaiViet', function ($query) {
            $query->where('MaNguoiDung', Auth::id());
        })
        ->with(['ngonNgu', 'chuyenMuc']);

        switch ($status) {
            case 'Cho_Duyet':
                $query->where('TrangThai', TrangThaiBaiViet::CHO_XET_DUYET->value);
                break;
            case 'Chinh_Sua':
                $query->where('TrangThai', TrangThaiBaiViet::CHINH_SUA->value);
                break;
            case 'Da_Duyet':
                $query->where('TrangThai', TrangThaiBaiViet::DA_DUYET->value);
                break;
            case 'Yeu_Cau_Chinh_Sua':
                $query->where('TrangThai', TrangThaiBaiViet::YEU_CAU_CHINH_SUA->value);
                break;
            case 'Tien_Hanh_Phan_Bien':
                $query->where('TrangThai', TrangThaiBaiViet::TIEN_HANH_PHAN_BIEN->value);
                break;
            case 'Tu_Choi':
                $query->where('TrangThai', TrangThaiBaiViet::TU_CHOI->value);
                break;
            case 'Dang_Bai':
                $query->where('TrangThai', TrangThaiBaiViet::DANG_BAI->value);
                break;
        }

        $articles = $query->orderBy('NgayGui', 'desc')->get();

        return view('Home.QuanLiBaiViet', compact('articles'));
    }
    public function show($id)
    {

        $article = BaiViet::with([
            'ngonNgu',
            'chuyenMuc',
            'chiTietBaiViet.nguoiDung',
            'chiTietBaiViet.loaiTacGia'
        ])->findOrFail($id);
        // Kiểm tra quyền xem bài viết (chỉ tác giả mới được xem)
        $canView = $article->chiTietBaiViet->contains(function($chiTiet) {
            return $chiTiet->MaNguoiDung === Auth::id();
        });

        if (!$canView) {
            return redirect()->route('quanlibaiviet')
                ->with('error', 'Bạn không có quyền xem bài viết này');
        }
        $feedbacks = PhanHoi::where('MaBaiBao', $id)
        ->with('nguoiDung')
        ->orderBy('NgayGui', 'desc')
        ->get();
        return view('Home.QuanLiChiTietBaiViet', compact('article','feedbacks'));
    }

    public function downloadFile($id) {
        $baiViet = BaiViet::where('MaBaiBao', $id)->first();

        if ($baiViet && $baiViet->FileBaiViet) {
            $filePath = public_path('public/storage/uploads/' . $baiViet->FileBaiViet);

            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
            return response()->json(['error' => 'File không tồn tại'], 404);
        }
        return response()->json(['error' => 'Bài viết không tồn tại'], 404);
    }

    public function edit($id)
{
    $article = BaiViet::with([
        'ngonNgu',
        'chuyenMuc',
        'chiTietBaiViet.nguoiDung',
        'chiTietBaiViet.loaiTacGia'
    ])->findOrFail($id);

    // Kiểm tra quyền chỉnh sửa
    $canEdit = $article->chiTietBaiViet->contains(function($chiTiet) {
        return $chiTiet->MaNguoiDung === Auth::id();
    }) && ($article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value ||$article->TrangThai === TrangThaiBaiViet::YEU_CAU_CHINH_SUA->value);

    if (!$canEdit) {
        return redirect()->route('quanlibaiviet')
            ->with('error', 'Bạn không có quyền chỉnh sửa bài viết này');
    }

    return view('Home.CapNhatBaiViet', compact('article'));
}

    public function update(Request $request, $id)
    {
        try {
            $article = BaiViet::findOrFail($id);

            // Validate các input
            $request->validate([
                'tieu_de' => 'required',
                'ten_bai_viet' => 'required',
                'ten_bai_viet_en' => 'required',
                'tom_tat' => 'required',
                'tom_tat_en' => 'required',
                'tu_khoa' => 'required',
                'tu_khoa_en' => 'required',
                'file' => 'nullable|mimes:doc,docx,pdf|max:10240',
            ]);

            // Cập nhật bài viết
            $article->TieuDe = $request->tieu_de;
            $article->TenBaiBao = $request->ten_bai_viet;
            $article->TenBaiBaoTiengAnh = $request->ten_bai_viet_en;
            $article->TomTat = strip_tags($request->tom_tat);
            $article->TomTatTiengAnh = strip_tags($request->tom_tat_en);
            $article->TuKhoa = $request->tu_khoa;
            $article->TuKhoaTiengAnh = $request->tu_khoa_en;
            $article->TrangThai = TrangThaiBaiViet::CHO_XET_DUYET->value;

            // Xử lý file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'public/storage/uploads/';

                // Tạo tên file mới
                $get_name = $file->getClientOriginalName();
                $name_document = current(explode('.', $get_name));
                $new_file = $name_document . rand(0, 99) . '.' . $file->getClientOriginalExtension();

                // Xóa file cũ nếu có
                if ($article->FileBaiViet) {
                    $old_file_path = $path . $article->FileBaiViet;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                // Di chuyển file mới vào thư mục
                $file->move($path, $new_file);
                $article->FileBaiViet = $new_file;
            }
            LichSuSoDuyetBaiViet::where('MaBaiBao', $id)
            ->where('NgayGuiYeuCau', function ($query) use ($id) {
                $query->selectRaw('MAX(NgayGuiYeuCau)')
                      ->from('LichSuSoDuyetBaiViet')
                      ->where('MaBaiBao', $id);
            })
            ->whereNull('NgayChinhSua')
            ->update([
                'NgayChinhSua' => now()
            ]);

            // Lưu bài viết
            $article->save();



            return response()->json([
                'success' => true,
                'message' => 'Bài viết đã được cập nhật thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }


    public function updatePhanBien(Request $request, $id) {
        try {
            $article = BaiViet::findOrFail($id);


            $request->validate([
                'tieu_de' => 'required',
                'ten_bai_viet' => 'required',
                'ten_bai_viet_en' => 'required',
                'tom_tat' => 'required',
                'tom_tat_en' => 'required',
                'tu_khoa' => 'required',
                'tu_khoa_en' => 'required',
                'file' => 'nullable|mimes:doc,docx,pdf|max:10240',
            ]);


            $article->TieuDe = $request->tieu_de;
            $article->TenBaiBao = $request->ten_bai_viet;
            $article->TenBaiBaoTiengAnh = $request->ten_bai_viet_en;
            $article->TomTat = strip_tags($request->tom_tat);
            $article->TomTatTiengAnh = strip_tags($request->tom_tat_en);
            $article->TuKhoa = $request->tu_khoa;
            $article->TuKhoaTiengAnh = $request->tu_khoa_en;
            $article->TrangThai = TrangThaiBaiViet::TIEN_HANH_PHAN_BIEN->value;

            // Xử lý upload file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = 'public/storage/uploads/';

                // Tạo tên file mới
                $get_name = $file->getClientOriginalName();
                $name_document = current(explode('.', $get_name));
                $new_file = $name_document . rand(0, 99) . '.' . $file->getClientOriginalExtension();

                // Xóa file cũ nếu có
                if ($article->FileBaiViet) {
                    $old_file_path = $path . $article->FileBaiViet;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                // Di chuyển file mới vào thư mục
                $file->move($path, $new_file);
                $article->FileBaiViet = $new_file;
            }


            $article->save();




            return response()->json([
                'success' => true,
                'message' => 'Bài viết đã được cập nhật thành công'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
    public function submitFeedback(Request $request, $id)
    {
        $request->validate([
            'NoiDung' => 'required|string',
            'FileBienSoan' => 'nullable|file|mimes:doc,docx,pdf|max:10240'
        ], [
            'NoiDung.required' => 'Vui lòng nhập nội dung phản hồi',
            'FileBienSoan.mimes' => 'File phải có định dạng .doc, .docx hoặc .pdf',
            'FileBienSoan.max' => 'File không được vượt quá 10MB'
        ]);

        try {
            $feedback = new PhanHoi();
            $feedback->MaBaiBao = $id;
            $feedback->MaNguoiDung = auth()->id();
            $feedback->NgayGui = now();
            $feedback->NoiDung = $request->NoiDung;

            if ($request->hasFile('FileBienSoan')) {
                $file = $request->file('FileBienSoan');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/storage/feedbacks/', $fileName);
                $feedback->FileBienSoan = $fileName;
            }


            $feedback->save();


                return redirect()
                ->route('showArticle', $id)
                ->with('success', 'Phản hồi đã được gửi thành công');


        } catch (\Exception $e) {
            return redirect()->back();
        }
    }


}
