<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\PhanHoi;
class APIGETBAIVIETCotroller extends Controller
{

     public function getFiles()
     {
         $baiViets = BaiViet::select('MaBaiBao', 'TenBaiBao', 'FileBaiViet')->get();
         return response()->json($baiViets);
     }


     public function downloadFile($id)
     {
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
     public function downloadFilePhanHoi($maBaiBao, $maNguoiDung, $ngayGui)
{
    try {
        // Tìm phản hồi dựa trên khóa chính phức hợp
        $phanHoi = PhanHoi::where([
            'MaBaiBao' => $maBaiBao,
            'MaNguoiDung' => $maNguoiDung,
            'NgayGui' => $ngayGui
        ])->first();

        if (!$phanHoi || !$phanHoi->FileBienSoan) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy file phản hồi'
            ], 404);
        }

        $filePath = storage_path('app/public/storage/feedbacks/' . $phanHoi->FileBienSoan);

        if (!file_exists($filePath)) {
            return response()->json([
                'success' => false,
                'message' => 'File không tồn tại trong hệ thống'
            ], 404);
        }

        // Lấy extension của file để xác định Content-Type
        $extension = pathinfo($phanHoi->FileBienSoan, PATHINFO_EXTENSION);
        $contentType = 'application/octet-stream';

        switch(strtolower($extension)) {
            case 'pdf':
                $contentType = 'application/pdf';
                break;
            case 'doc':
                $contentType = 'application/msword';
                break;
            case 'docx':
                $contentType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                break;
        }

        return response()->download(
            $filePath,
            $phanHoi->FileBienSoan,
            [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'attachment; filename="' . $phanHoi->FileBienSoan . '"'
            ]
        );

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra khi tải file: ' . $e->getMessage()
        ], 500);
    }
}
}
