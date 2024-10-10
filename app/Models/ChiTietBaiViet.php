<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietBaiViet extends Model
{
    use HasFactory;
    protected $table = 'ChiTietBaiViet';
    public $timestamps = false;

    protected $primaryKey = ['MaBaiBao', 'MaNguoiDung', 'MaLTacGia'];
    public $incrementing = false;

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'MaBaiBao', 'MaBaiBao');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    public function loaiTacGia()
    {
        return $this->belongsTo(LoaiTacGia::class, 'MaLTacGia', 'MaLTacGia');
    }
}
