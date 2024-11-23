<?php

namespace App\Enums;

enum TrangThaiYeuCau: string
{
    case CHO_PHAN_HOI= 'Chờ phản hồi';
    case CHAP_NHAN = 'Chấp nhận phản biện';
    case TU_CHOI = 'Từ chối phản biện';
}
