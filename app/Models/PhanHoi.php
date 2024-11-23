<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanHoi extends Model
{
    use HasFactory;
    protected $table = 'PhanHoi';
    protected $primaryKey = ['MaBaiBao', 'MaNguoiDung', 'NgayGui'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaBaiBao',
        'MaNguoiDung',
        'NgayGui',
        'NoiDung',
        'FileBienSoan'
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
