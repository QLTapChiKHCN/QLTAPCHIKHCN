<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class APIGETHINHANH extends Controller
{
    //
    public function upload(Request $request)
    {
        try {
            // Kiểm tra xem có file được gửi lên không
            if (!$request->hasFile('image')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy file hình ảnh',
                ], 400);
            }

            $file = $request->file('image');

            // Kiểm tra định dạng file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'];
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Định dạng file không hợp lệ',
                ], 400);
            }

            // Tạo tên file ngẫu nhiên để tránh trùng lặp
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();

            // Tạo thư mục uploads nếu chưa tồn tại
            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Di chuyển file vào thư mục public/uploads
            $file->move($uploadPath, $fileName);

            // Trả về đường dẫn đến file
            return response()->json([
                'success' => true,
                'message' => 'Upload thành công',
                'data' => [
                    'path' => '/uploads/' . $fileName
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi upload: ' . $e->getMessage()
            ], 500);
        }
    }
}
