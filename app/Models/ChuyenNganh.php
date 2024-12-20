<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    use HasFactory;

    protected $table = 'ChuyenNganh';
    protected $primaryKey = 'MaChuyenNganh';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaChuyenNganh',
        'TenChuyenNganh',
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(NguoiDung::class, 'MaChuyenNganh', 'MaChuyenNganh');
    }
}
