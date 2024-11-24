<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuChonNguoiPhanBien extends Model
{
    use HasFactory;
    protected $table = 'LichSuChonNguoiPhanBien';
    protected $primaryKey = ['MaNguoiDung', 'MaBaiBao'];
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'MaNguoiDung',
        'MaBaiBao',
        'NgayGuiYeuCau',
        'TrangThai',
        'TrangThaiTBT'
    ];
    public function BaiViet()
    {
        return $this->belongsTo(BaiViet::class, 'MaBaiBao', 'MaBaiBao');

    }

}
