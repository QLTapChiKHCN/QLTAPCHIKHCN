<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoTapChi extends Model
{
    use HasFactory;
    // Khai báo tên bảng
    protected $table = 'SoTapChi';

    protected $primaryKey = 'MaSoTC';
    protected $keyType ='string';
    public $timestamps = false;

    protected $fillable = [
        'MaSoTC',
        'TenSo',
        'AnhBia',
        'NgayXuatBan',
        'TrangThai',
    ];

    public function baiViet()
    {
        return $this->hasMany(BaiViet::class, 'MaSoTC');
    }
}
