<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{

    use HasFactory;

    protected $table = 'VaiTro';
    protected $primaryKey = 'MaVaiTro';
    public $timestamps = false;

    public function nguoiDungs()
    {
        return $this->belongsToMany(NguoiDung::class, 'NguoiDung_VaiTro', 'MaVaiTro', 'MaNguoiDung');
    }
}
