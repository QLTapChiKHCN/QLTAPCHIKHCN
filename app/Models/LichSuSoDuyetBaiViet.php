<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuSoDuyetBaiViet extends Model
{
    use HasFactory;
    protected $table = 'LichSuSoDuyetBaiViet';
    protected $primaryKey = ['MaBaiBao', 'MaNguoiDung', 'NgayGuiYeuCau'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaBaiBao',
        'MaNguoiDung',
        'NgayGuiYeuCau',
        'NgayChinhSua',
        'NoiDungChinhSua'
    ];

    public function baiViet()
    {
        return $this->belongsTo(BaiViet::class, 'MaBaiBao');
    }

    public function nguoiDung()
    {
        return $this->belongsTo(NguoiDung::class, 'MaNguoiDung');
    }
}
