<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhanBien extends Model
{
    use HasFactory;
    protected $table = 'ChiTietPhanBien';
    protected $primaryKey = ['MaBaiBao', 'MaNguoiDung', 'NgayNhan'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'MaBaiBao',
        'MaNguoiDung',
        'KetQuaPhanBien',
         'NgayNhan',
         'NgayHetHan',
        'YKienPhanBien',
        'NgayPhanBien',
        'FilePhanBien'
    ];
}
