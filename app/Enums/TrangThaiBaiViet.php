<?php

namespace App\Enums;

enum TrangThaiBaiViet: string
{
    case CHO_XET_DUYET = 'Chờ xét duyệt';
    case DANG_XET_DUYET = 'Đang xét duyệt';
    case CHINH_SUA='Chỉnh sửa';
    case TIEN_HANH_PHAN_BIEN = 'Tiến hành phản biện';
    case DA_DUYET = 'Đồng ý';
    case YEU_CAU_CHINH_SUA= 'Yêu cầu chỉnh sửa';
    case TU_CHOI = 'Từ chối';
    case DANG_BAI='Đăng bài';

}
