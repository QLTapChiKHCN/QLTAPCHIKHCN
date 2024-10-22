<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietPhanBien extends Model
{
    use HasFactory;
    protected $table = 'ChiTietPhanBien';
    protected $primaryKey = 'MaNguoiDung';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'MaBaiBao',
        'MaNguoiDung',
        'KetQuaPhanBien',
        'YKienPhanBien',
        'NgayPhanBien',
        'FilePhanBien'
    ];
}
