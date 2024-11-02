<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TrangThaiBaiViet;
class BaiViet extends Model
{
    // Khai báo tên bảng
    protected $table = 'BaiViet';

    protected $primaryKey = 'MaBaiBao';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaBaiBao',
        'MaNgonNgu',
        'MaSoTC',
        'MaChuyenMuc',
        'TieuDe',
        'TenBaiBao',
        'TenBaiBaoTiengAnh',
        'TomTat',
        'TomTatTiengAnh',
        'NgayXetDuyet',
        'NgayGui',
        'TuKhoa',
        'TuKhoaTiengAnh',
        'FileBaiViet',
        'TrangThai',
    ];

    public function ngonNgu()
    {
        return $this->belongsTo(NgonNgu::class, 'MaNgonNgu');
    }


    public function soTapChi()
    {
        return $this->belongsTo(SoTapChi::class, 'MaSoTC');
    }


    public function chuyenMuc()
    {
        return $this->belongsTo(ChuyenMuc::class, 'MaChuyenMuc');
    }


    public function chiTietBaiViet()
    {
        return $this->hasMany(ChiTietBaiViet::class, 'MaBaiBao');
    }
    public function isPublished(): bool
    {
        return $this->TrangThai === TrangThaiBaiViet::DANG_BAI->value;
    }

    public function LichSuChonNguoiPhanBien()
    {
        return $this->hasMany(LichSuChonNguoiPhanBien::class, 'MaBaiBao');
    }
}
