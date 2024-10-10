<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class NguoiDung extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'NguoiDung';
    protected $primaryKey = 'MaNguoiDung';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaNguoiDung',
        'MaHocVi',
        'MaHocHam',
        'TenDangNhap',
        'MatKhau',
        'HoTen',
        'Email',
        'CCCD',
        'SoDienThoai',
        'DiaChi',
        'ChuyenNganh',
        'DonVi',
        'QuocGia',
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


}
