<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiTacGia extends Model
{
    use HasFactory;
    protected $table = 'LoaiTacGia';
    protected $primaryKey = 'MaLTacGia';
    public $timestamps = false;

    public function chiTietBaiViets()
    {
        return $this->hasMany(ChiTietBaiViet::class, 'MaLTacGia', 'MaLTacGia');
    }
}
