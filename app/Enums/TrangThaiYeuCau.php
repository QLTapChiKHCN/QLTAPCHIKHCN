<?php

namespace App\Enums;

enum TrangThaiYeuCau: string
{
    case CHO_PHAN_HOI= 'Chờ phản hồi';
    case CHAP_NHAN = 'Chấp nhận';
    case TU_CHOI = 'Từ chối';
}
