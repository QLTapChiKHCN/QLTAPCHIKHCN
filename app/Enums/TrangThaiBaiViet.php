<?php

namespace App\Enums;

enum TrangThaiBaiViet: string
{
    case CHO_XET_DUYET = 'Chờ xét duyệt';
    case DANG_XET_DUYET = 'Đang xét duyệt';
    case DA_DUYET = 'Đã duyệt';
    case TU_CHOI = 'Từ chối';
    case DANG_BAI='Đăng bài';
    case CHINH_SUA='Chỉnh sửa';
}
