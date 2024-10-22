<?php

namespace App\Http\Controllers\PhanBien;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\ChiTietBaiViet;
use App\Models\ChiTietPhanBien;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PhanBienController extends Controller
{
    //
    public function show()
    {

        return view('Home.Phanbien');
    }
    public function To_Do_List()
    {
        $cv = session('maNguoiDung');
        $nd = NguoiDung::find($cv);
        $ctpb = ChiTietPhanBien::where('MaNguoiDung', $cv)->get();
        if ($ctpb->isNotEmpty() && request()->has('search')) {
            $list_CV = [];
            foreach ($ctpb as $item) {
                $baiViet = BaiViet::where('MaBaiBao', $item->MaBaiBao)->where('TrangThai','Đang duyệt')->first();
                if ($baiViet) {
                    $list_CV[] = [
                        'MaBaiBao' => $item->MaBaiBao,
                        'TenBaiBao' => $baiViet->TenBaiBao,
                        'TrangThai' => $baiViet->TrangThai,
                        'NgayXetDuyet' => $baiViet->NgayXetDuyet
                    ];
                }
            }
        }
        return view('PB.ToDoList', compact('list_CV'));
    }

    public function Art_Details()
    {
    }

    public function List_Request()
    {
        return view('PB.ListRequest');
    }

}
