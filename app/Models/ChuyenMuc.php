<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenMuc extends Model
{
    use HasFactory;
    protected $table = 'ChuyenMuc';

    protected $primaryKey = 'MaChuyenMuc';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaChuyenMuc',
        'TenChuyenMuc',
    ];

    public function baiViet()
    {
        return $this->hasMany(BaiViet::class, 'MaChuyenMuc');
    }
}
