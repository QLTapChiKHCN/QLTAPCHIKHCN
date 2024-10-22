<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTacGia extends Model
{

    protected $table = 'LoaiTacGia';
    protected $primaryKey = 'MaLTacGia';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaLTacGia',
        'TenLoai',
    ];

    public function chiTietBaiViet()
    {
        return $this->hasMany(ChiTietBaiViet::class, 'MaLTacGia');
    }
}
