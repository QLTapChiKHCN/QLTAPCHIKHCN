<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocHam extends Model
{
    use HasFactory;

    protected $table = 'HocHam';
    protected $primaryKey = 'MaHocHam';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'MaHocHam',
        'TenHocHam',
    ];

    public function nguoiDungs()
    {
        return $this->hasMany(NguoiDung::class, 'MaHocHam', 'MaHocHam');
    }
}
