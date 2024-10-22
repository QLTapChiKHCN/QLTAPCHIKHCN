<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocVi extends Model
{
    use HasFactory;

    protected $table = 'HocVi';
    protected $primaryKey = 'MaHocVi';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaHocVi',
        'TenHocVi',
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(NguoiDung::class, 'MaHocVi', 'MaHocVi');
    }
}
