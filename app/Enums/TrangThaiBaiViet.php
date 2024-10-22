<?php

namespace App\Enums;

enum TrangThaiBaiViet: string
{
    case CHO_XET_DUYET = 'Chờ Xét Duyệt';
    case DANG_XET_DUYET = 'Đang Xét Duyệt';
    case DA_DUYET = 'Đã Duyệt';
    case TU_CHOI = 'Từ chối';
    case DANG_BAI='Đăng Bài';
}
