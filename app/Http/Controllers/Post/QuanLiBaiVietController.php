<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Enums\TrangThaiBaiViet;
use Illuminate\Support\Facades\Auth;

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

        return view('Home.QuanLiChiTietBaiViet', compact('article'));
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
    }) && $article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value;

    if (!$canEdit) {
        return redirect()->route('quanlibaiviet')
            ->with('error', 'Bạn không có quyền chỉnh sửa bài viết này');
    }

    return view('Home.CapNhatBaiViet', compact('article'));
}

public function update(Request $request, $id)
{
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
    $article->TrangThai = TrangThaiBaiViet::CHO_XET_DUYET->value;
    dd($article);
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/storage/uploads/', $fileName);
        if ($article->FileBaiViet) {
            Storage::delete('public/storage/uploads/' . $article->FileBaiViet);
        }

        $article->FileBaiViet = $fileName;
    }

    $article->save();

    return response()->json([
        'success' => true,
        'message' => 'Bài viết đã được cập nhật thành công'
    ]);
}

}
