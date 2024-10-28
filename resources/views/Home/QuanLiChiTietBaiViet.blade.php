@extends('LayoutHome.master')
@section('content')
@php
use App\Helpers\ArticleHelper;

use App\Enums\TrangThaiBaiViet;
@endphp
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<style>
.article-detail {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}

.back-button {
    margin-bottom: 20px;
}

.article-header {
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    padding: 30px;
    border-radius: 12px;
    color: white;
    margin-bottom: 30px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 15px;
}

.info-section {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.info-header {
    padding: 15px 20px;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 600;
}

.info-content {
    padding: 20px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
}

.info-label {
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 4px;
}

.info-value {
    color: #1f2937;
    font-weight: 500;
}

.keyword-tag {
    display: inline-block;
    padding: 4px 12px;
    background: #f3f4f6;
    border-radius: 20px;
    margin: 0 8px 8px 0;
    font-size: 14px;
    color: #4b5563;
}

.authors-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.author-item {
    padding: 10px 0;
    border-bottom: 1px solid #e5e7eb;
}

.author-item:last-child {
    border-bottom: none;
}

.author-role {
    font-size: 14px;
    color: #6b7280;
}

.action-section {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    margin-top: 30px;
}

.file-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    color: #4b5563;
    text-decoration: none;
    transition: all 0.3s;
}

.file-link:hover {
    background: #f1f5f9;
    color: #2563eb;
}

@media (max-width: 768px) {
    .article-detail {
        padding: 0 15px;
        margin: 20px auto;
    }

    .article-header {
        padding: 20px;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="article-detail">
    <!-- Nút quay lại -->
    <div class="back-button">
        <a href="{{ route('quanlibaiviet') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Quay lại
        </a>
    </div>

    <!-- Header bài viết -->
    <div class="article-header">
        <div class="status-badge {{ ArticleHelper::getStatusClass($article->TrangThai) }}">
            <i class="bi {{ ArticleHelper::getStatusIcon($article->TrangThai) }} me-2"></i>
            {{ ArticleHelper::getStatusText($article->TrangThai) }}
        </div>
        <h2 class="mb-3">{{ $article->TenBaiBao }}</h2>
        <h5 class="text-white-50 mb-4">{{ $article->TenBaiBaoTiengAnh }}</h5>
        <div class="d-flex flex-wrap gap-3">
            <span class="text-white-50">
                <i class="bi bi-folder2 me-2"></i>
                {{ $article->chuyenMuc->TenChuyenMuc }}
            </span>
            <span class="text-white-50">
                <i class="bi bi-calendar3 me-2"></i>
                Gửi ngày: {{ \Carbon\Carbon::parse($article->NgayGui)->format('d/m/Y') }}
            </span>
        </div>
    </div>

    <!-- Thông tin cơ bản -->
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-info-circle me-2"></i>Thông tin cơ bản
        </div>
        <div class="info-content">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Ngôn ngữ</span>
                    <span class="info-value">
                        <i class="bi bi-translate me-1"></i>
                        {{ $article->ngonNgu->TenNgonNgu }}
                    </span>
                </div>
                @if($article->NgayXetDuyet)
                <div class="info-item">
                    <span class="info-label">Ngày xét duyệt</span>
                    <span class="info-value">
                        <i class="bi bi-calendar-check me-1"></i>
                        {{ \Carbon\Carbon::parse($article->NgayXetDuyet)->format('d/m/Y') }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tóm tắt -->
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-text-paragraph me-2"></i>Tóm tắt
        </div>
        <div class="info-content">
            <div class="mb-4">
                <h6 class="mb-2">Tiếng Việt:</h6>
                <p>{{ $article->TomTat }}</p>
            </div>
            <div>
                <h6 class="mb-2">English:</h6>
                <p>{{ $article->TomTatTiengAnh }}</p>
            </div>
        </div>
    </div>

    <!-- Từ khóa -->
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-tags me-2"></i>Từ khóa
        </div>
        <div class="info-content">
            <div class="mb-4">
                <h6 class="mb-2">Tiếng Việt:</h6>
                <div>
                    @foreach(explode(',', $article->TuKhoa) as $keyword)
                    <span class="keyword-tag">{{ trim($keyword) }}</span>
                    @endforeach
                </div>
            </div>
            <div>
                <h6 class="mb-2">English:</h6>
                <div>
                    @foreach(explode(',', $article->TuKhoaTiengAnh) as $keyword)
                    <span class="keyword-tag">{{ trim($keyword) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách tác giả -->
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-people me-2"></i>Danh sách tác giả
        </div>
        <div class="info-content">
            <ul class="authors-list">
                @foreach($article->chiTietBaiViet as $chiTiet)
                <li class="author-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-medium">{{ $chiTiet->nguoiDung->HoTen }}</div>
                            <span class="author-role">{{ $chiTiet->loaiTacGia->TenLoai }}</span>
                        </div>
                        @if($chiTiet->nguoiDung->Email)
                        <a href="mailto:{{ $chiTiet->nguoiDung->Email }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-envelope me-1"></i>Liên hệ
                        </a>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Ghi chú từ ban biên tập -->
    @if($article->GhiChu)
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-pencil me-2"></i>Ghi chú từ ban biên tập
        </div>
        <div class="info-content">
            <p class="mb-0">{{ $article->GhiChu }}</p>
        </div>
    </div>
    @endif

    <!-- File bài viết -->
    <div class="info-section">
        <div class="info-header">
            <i class="bi bi-file-earmark-text me-2"></i>File bài viết
        </div>
        <div class="info-content">
            @if($article->FileBaiViet)
            <a href="{{ route('downloadFile', $article->MaBaiBao) }}"
               class="file-link"
               onclick="handleDownload(event, {{ $article->MaBaiBao }})">
                <i class="bi bi-download"></i>
                Tải xuống file bài viết
            </a>
        @else
            <p class="text-muted mb-0">Không có file đính kèm</p>
        @endif
        </div>
    </div>

    <!-- Các nút hành động -->
    <div class="action-section">
        @if($article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value)
        <a href="{{ route('editArticle', $article->MaBaiBao) }}" class="btn btn-primary">
            <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa bài viết
        </a>
        @endif

    </div>
</div>


@endsection
