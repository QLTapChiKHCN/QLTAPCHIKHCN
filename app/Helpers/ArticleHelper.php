<?php

namespace App\Helpers;

use App\Enums\TrangThaiBaiViet;

class ArticleHelper
{
    public static function getStatusText($status)
    {
        return match($status) {
            TrangThaiBaiViet::CHO_XET_DUYET->value => 'Chờ xét duyệt',
            TrangThaiBaiViet::DANG_XET_DUYET->value => 'Đang xét duyệt',
            TrangThaiBaiViet::CHINH_SUA->value => 'Cần chỉnh sửa',
            TrangThaiBaiViet::DA_DUYET->value => 'Đã duyệt',
            TrangThaiBaiViet::TU_CHOI->value => 'Từ chối',
            TrangThaiBaiViet::DANG_BAI->value => 'Đã đăng',
            default => 'Không xác định',
        };
    }

    public static function getStatusClass($status)
    {
        return match($status) {
            TrangThaiBaiViet::CHO_XET_DUYET->value => 'bg-warning text-dark',
            TrangThaiBaiViet::DANG_XET_DUYET->value => 'bg-info text-white',
            TrangThaiBaiViet::CHINH_SUA->value => 'bg-primary text-white',
            TrangThaiBaiViet::DA_DUYET->value => 'bg-success text-white',
            TrangThaiBaiViet::TU_CHOI->value => 'bg-danger text-white',
            TrangThaiBaiViet::DANG_BAI->value => 'bg-success text-white',
            default => 'bg-secondary text-white',
        };
    }

    public static function getStatusIcon($status)
    {
        return match($status) {
            TrangThaiBaiViet::CHO_XET_DUYET->value => 'bi-clock',
            TrangThaiBaiViet::CHINH_SUA->value => 'bi-pencil-square',
            TrangThaiBaiViet::DA_DUYET->value => 'bi-check-circle',
            TrangThaiBaiViet::TU_CHOI->value => 'bi-x-circle',
            TrangThaiBaiViet::DANG_BAI->value => 'bi-check-circle-fill',
            default => 'bi-question-circle',
        };
    }
}
