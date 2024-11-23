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
.feedback-item:last-child {
    border-bottom: none !important;
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

.feedback-content {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-top: 10px;
}
.revision-request {
    background-color: #fff3cd;
    border: 1px solid #ffeeba;
    border-left: 4px solid #ffc107;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border-radius: 4px;
}

.revision-request .revision-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.revision-request .revision-date {
    font-size: 0.875rem;
    color: #6c757d;
}

.revision-request .revision-content {
    color: #856404;
    font-size: 0.95rem;
    line-height: 1.5;
}
</style>

<div class="article-detail">
    <!-- Nút quay lại -->
    <div class="back-button">
        <a href="{{ route('quanlibaiviet') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Quay lại
        </a>
    </div>
 <!-- Hiển thị yêu cầu chỉnh sửa nếu đang ở trạng thái chỉnh sửa -->
 @if($article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value)
 @php
     $latestRevisionRequest = $article->lichSuSoDuyetBaiViet()
         ->orderBy('NgayGuiYeuCau', 'desc')
         ->first();
 @endphp
 @if($latestRevisionRequest)
 <div class="revision-request">
     <div class="revision-header">
         <h5 class="mb-0">
             <i class="bi bi-exclamation-circle me-2"></i>
             Yêu cầu chỉnh sửa
         </h5>
         <span class="revision-date">
             <i class="bi bi-clock me-1"></i>
             {{ \Carbon\Carbon::parse($latestRevisionRequest->NgayGuiYeuCau)->format('H:i d/m/Y') }}
         </span>
     </div>
     <div class="revision-content">
         {!! nl2br(e($latestRevisionRequest->NoiDungChinhSua)) !!}
     </div>
 </div>
 @endif
@endif

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
        @if($article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value||$article->TrangThai ===TrangThaiBaiViet::YEU_CAU_CHINH_SUA->value)
            <a href="{{ route('editArticle', $article->MaBaiBao) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-2"></i>Chỉnh sửa bài viết
            </a>
        @endif

        @if($article->TrangThai !== TrangThaiBaiViet::DA_DUYET->value &&
            $article->TrangThai !== TrangThaiBaiViet::DANG_BAI->value &&
            $article->TrangThai !== TrangThaiBaiViet::TU_CHOI->value)
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                <i class="bi bi-chat-dots me-2"></i>Gửi phản hồi
            </button>
        @endif
    </div>

    <!-- Modal Phản hồi -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('submitFeedback', $article->MaBaiBao) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Gửi phản hồi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feedbackContent" class="form-label">Nội dung phản hồi <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control"
                                id="feedbackContent"
                                name="NoiDung"
                                rows="5"
                                required
                            ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="feedbackFile" class="form-label">File biên soạn (không bắt buộc)</label>
                            <input
                                type="file"
                                class="form-control"
                                id="feedbackFile"
                                name="FileBienSoan"
                                accept=".doc,.docx,.pdf"
                            >
                            <div class="form-text">Chấp nhận file .doc, .docx, .pdf (tối đa 10MB)</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Gửi phản hồi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
</div>
<!-- Phần hiển thị phản hồi -->
@if(isset($feedbacks) && $feedbacks->isNotEmpty())
<div class="info-section mt-4">
    <div class="info-header">
        <i class="bi bi-chat-dots me-2"></i>Lịch sử phản hồi
    </div>
    <div class="info-content">
        @foreach($feedbacks as $feedback)
        <div class="feedback-item mb-4 pb-4 border-bottom">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <strong>{{ $feedback->nguoiDung->HoTen }}</strong>
                    <span class="text-muted ms-2">
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($feedback->NgayGui)->format('H:i d/m/Y') }}
                    </span>
                </div>
                @if($feedback->FileBienSoan)
                <a href="#"
                   class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-download me-1"></i>
                     file đính kèm
                </a>
                @endif
            </div>
            <div class="feedback-content">
                {{ $feedback->NoiDung }}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
<!-- Modal Thông báo thành công -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Thành công</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                    <p class="mt-3">{{ session('success') }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thông báo thất bại -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Thất bại</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="bi bi-x-circle text-danger" style="font-size: 3rem;"></i>
                    <p class="mt-3">{{ session('error') }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@if(session('success') || session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        @endif

        @if(session('error'))
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif
    });
</script>
@endif


@endsection
