<?php

namespace App\Enums;

enum TrangThaiChiTietPhanBien: string
{
    case DA_DUYET = 'Đồng ý';
    case TU_CHOI = 'Từ chối';
    case YEU_CAU_CHINH_SUA= 'Yêu cầu chỉnh sửa';
    case CHO_PHAN_HOI = 'Chờ phản hồi';
}
