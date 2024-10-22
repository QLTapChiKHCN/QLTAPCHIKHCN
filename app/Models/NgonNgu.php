<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgonNgu extends Model
{
    use HasFactory;
    protected $table = 'NgonNgu';

    protected $primaryKey = 'MaNgonNgu';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaNgonNgu',
        'TenNgonNgu',
    ];

    public function baiViet()
    {
        return $this->hasMany(BaiViet::class, 'MaNgonNgu');
    }
}
