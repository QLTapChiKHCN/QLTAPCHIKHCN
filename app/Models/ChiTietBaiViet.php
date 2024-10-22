<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietBaiViet extends Model
{
    protected $table = 'ChiTietBaiViet';
    protected $primaryKey = ['MaBaiBao', 'MaNguoiDung', 'MaLTacGia'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaBaiBao',
        'MaNguoiDung',
        'MaLTacGia',
    ];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'MaBaiBao');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung');
    }

    public function loaiTacGia()
    {
        return $this->belongsTo(LoaiTacGia::class, 'MaLTacGia');
    }
}
