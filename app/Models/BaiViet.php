<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    use HasFactory;
    protected $table = 'BaiViet';
    protected $primaryKey = 'MaBaiBao';
    public $timestamps = false;

    public function chiTietBaiViets()
    {
        return $this->hasMany(ChiTietBaiViet::class, 'MaBaiBao', 'MaBaiBao');
    }
}
