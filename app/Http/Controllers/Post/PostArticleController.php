<?php

namespace App\Http\Controllers\Post;

use App\Enums\TrangThaiBaiViet;
use App\Http\Controllers\Controller;
use App\Models\ChuyenMuc;
use App\Models\LoaiTacGia;
use App\Models\NgonNgu;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\ChiTietBaiViet;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PostArticleController extends Controller
{
    //
    public function showpost()
    {
        $ngonngu= NgonNgu::all();
        $chuyenmuc=ChuyenMuc::all();
        $loaitacgia=LoaiTacGia::all();

        $user=Auth::user();
        return view('Home.Post',compact('ngonngu','chuyenmuc','loaitacgia','user'));
    }

    public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $maBaiBao = $this->MaBaiBao();
        $path = 'public/storage/uploads/';
        $file = $request->file('file');
        if($file)
        {
            $get_name=$file->getClientOriginalName();
            $name_document= current(explode('.',$get_name));
            $new_file=$name_document.rand(0,99).'.'.$file->getClientOriginalExtension();
            $file->move($path,$new_file);

        }

        $baiViet = BaiViet::create([
            'MaBaiBao' => $maBaiBao,
            'MaNgonNgu' => $request->ngon_ngu,
            'MaChuyenMuc' => $request->chuyen_muc,
            'TenBaiBao' => $request->ten_bai_viet,
            'TieuDe' => $request->tieu_de,
            'TenBaiBaoTiengAnh' => $request->ten_bai_viet_en,
            'TomTat' => strip_tags($request->tom_tat),
            'TomTatTiengAnh' => strip_tags($request->tom_tat_en),
            'NgayGui' => now(),
            'TuKhoa' => $request->tu_khoa,
            'TuKhoaTiengAnh' => $request->tu_khoa_en,
            'FileBaiViet' => $new_file,
            'TrangThai' => TrangThaiBaiViet::CHO_XET_DUYET,
        ]);

        $tenTacGia = $request->ten_tac_gia;
        $emailTacGia = $request->email_tac_gia;
        $diaChiTacGia = $request->dia_chi_tac_gia;
        $sdtTacGia = $request->sdt_tac_gia;
        $loaiTacGia = $request->loai_tac_gia;

        for ($i = 0; $i < count($tenTacGia); $i++) {

            $nguoiDung = NguoiDung::where('Email', $emailTacGia[$i])->first();
            $ma = $this->generateMaNguoiDung();

            if (!$nguoiDung) {

                \Log::info("Tạo người dùng mới: " . $emailTacGia[$i]);
                $nguoiDung = NguoiDung::create([
                    'MaNguoiDung' => $ma,
                    'Email' => $emailTacGia[$i],
                    'HoTen' => $tenTacGia[$i],
                    'DiaChi' => $diaChiTacGia[$i],
                    'SoDienThoai' => $sdtTacGia[$i],
                ]);

            } else {
                \Log::info("Người dùng đã tồn tại: " . $emailTacGia[$i]);
            }

            ChiTietBaiViet::create([
                'MaBaiBao' => $maBaiBao,
                'MaNguoiDung' => $nguoiDung->MaNguoiDung,
                'MaLTacGia' => $loaiTacGia[$i],
            ]);
        }

        DB::commit();
        return response()->json(['success' => true, 'message' => 'Bài viết đã được gửi thành công và đang chờ xét duyệt.']);
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error("Lỗi khi lưu bài viết: " . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Lỗi khi lưu bài viết: ' . $e->getMessage()], 500);
    }
}

public function checkEmail(Request $request)
{
    $email = $request->query('email');

    $user = NguoiDung::where('Email', $email)->first();

    if ($user) {
        return response()->json([
            'exists' => true,
            'user' => [
                'HoTen' => $user->HoTen,
                'SoDienThoai' => $user->SoDienThoai,
                'DiaChi' => $user->DiaChi
            ]
        ]);
    }

    return response()->json([
        'exists' => false
    ]);
}

    private function MaBaiBao()
    {
        $prefix = 'BB';
        $counter = 0;


        $maBaiBao = $prefix  . str_pad($counter, 1, '0', STR_PAD_LEFT);


        while (BaiViet::where('MaBaiBao', $maBaiBao)->exists()) {
            $counter++;
            $maBaiBao = $prefix . str_pad($counter, 1, '0', STR_PAD_LEFT); // Tạo lại mã mới
        }

        return $maBaiBao;
    }


    private function generateMaNguoiDung()
    {
        $prefix = 'ND';
        $lastUser = NguoiDung::orderBy('MaNguoiDung', 'desc')->first();

        if ($lastUser) {
            $lastNumber = intval(substr($lastUser->MaNguoiDung, 2));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }

}
