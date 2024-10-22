<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuocGia extends Model
{
    use HasFactory;

    protected $table = 'QuocGia';
    protected $primaryKey = 'MaQG';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaQG',
        'TenQG',
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(NguoiDung::class, 'MaQG', 'MaQG');
    }
}
