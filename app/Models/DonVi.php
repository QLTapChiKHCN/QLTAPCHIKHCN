<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    use HasFactory;

    protected $table = 'DonVi';
    protected $primaryKey = 'MaDonVi';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaDonVi',
        'TenDonVi',
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(NguoiDung::class, 'MaDonVi', 'MaDonVi');
    }
}
