<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'NguoiDung';
    protected $primaryKey = 'MaNguoiDung';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'MaNguoiDung',
        'MaHocVi',
        'MaHocHam',
        'MaDonVi',
        'MaChuyenNganh',
        'MaQG',
        'TenDangNhap',
        'MatKhau',
        'HoTen',
        'Email',
        'CCCD',
        'SoDienThoai',
        'DiaChi',
        'GioiTinh',
    ];

    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    public function vaiTros()
    {
        return $this->belongsToMany(VaiTro::class, 'NguoiDung_VaiTro', 'MaNguoiDung', 'MaVaiTro');
    }

    public function baiViets()
    {
        return $this->hasMany(ChiTietBaiViet::class, 'MaNguoiDung', 'MaNguoiDung');
    }

    // Quan hệ với bảng HocVi
    public function hocVi()
    {
        return $this->belongsTo(HocVi::class, 'MaHocVi', 'MaHocVi');
    }

    // Quan hệ với bảng HocHam
    public function hocHam()
    {
        return $this->belongsTo(HocHam::class, 'MaHocHam', 'MaHocHam');
    }

    // Quan hệ với bảng DonVi
    public function donVi()
    {
        return $this->belongsTo(DonVi::class, 'MaDonVi', 'MaDonVi');
    }

    // Quan hệ với bảng ChuyenNganh
    public function chuyenNganh()
    {
        return $this->belongsTo(ChuyenNganh::class, 'MaChuyenNganh', 'MaChuyenNganh');
    }

    // Quan hệ với bảng QuocGia
    public function quocGia()
    {
        return $this->belongsTo(QuocGia::class, 'MaQG', 'MaQG');
    }
}
