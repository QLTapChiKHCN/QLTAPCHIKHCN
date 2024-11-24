<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietPhanBien;
class ApiKetQuaController extends Controller
{
    public function downloadFilePhanBien($maBaiBao, $maNguoiDung, $ngayNhan)
    {
        try {
            $ngayNhan = \Carbon\Carbon::parse($ngayNhan)->format('Y-m-d');

            $ctpb = ChiTietPhanBien::where([
                'MaBaiBao' => $maBaiBao,
                'MaNguoiDung' => $maNguoiDung,
                'NgayNhan' => $ngayNhan,
            ])->first();

            if (!$ctpb || !$ctpb->FilePhanBien) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Không tìm thấy file phản biện',
                    ],
                    404,
                );
            }
            $filePath = storage_path('app/public/uploads/' . $ctpb->FilePhanBien);
            if (!file_exists($filePath)) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'File không tồn tại trong hệ thống',
                    ],
                    404,
                );
            }
            return response()->download($filePath);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi tải file: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }

}
