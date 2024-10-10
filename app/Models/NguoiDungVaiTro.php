<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NguoiDungVaiTro extends Model
{
    use HasFactory;

    protected $table = 'NguoiDung_VaiTro';
    public $timestamps = false;


    public $incrementing = false;

    protected $fillable = [
        'MaNguoiDung',
        'MaVaiTro',
    ];
}
