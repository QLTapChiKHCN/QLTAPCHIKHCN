@extends('LayoutHome.master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
@php
use App\Helpers\ArticleHelper;

use App\Enums\TrangThaiBaiViet;
@endphp
<style>
 .wrapper {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
  }

  .sidebar {
    position: sticky;
    top: 20px;
  }

  .card {
    border: none;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    border-radius: 12px;
    overflow: hidden;
  }

  .card-header {
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    color: white;
    border: none;
    padding: 15px 20px;
  }

  .list-group-item {
    border: none;
    padding: 12px 20px;
    color: #4b5563;
    transition: all 0.3s;
  }

  .list-group-item:hover {
    background: #f3f4f6;
    color: #2563eb;
  }

  .list-group-item.active {
    background: #eff6ff;
    color: #2563eb;
    font-weight: 500;
  }

  .article-filters {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
  }

  .filter-item {
    padding: 8px 16px;
    border-radius: 20px;
    background: #f3f4f6;
    color: #4b5563;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
  }

  .filter-item:hover {
    background: #e5e7eb;
  }

  .filter-item.active {
    background: #2563eb;
    color: white;
  }

  .article-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 20px;
    transition: all 0.3s;
  }

  .article-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
  }

  .article-header {
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .article-title {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .article-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 8px;
    font-size: 14px;
    color: rgba(255,255,255,0.8);
  }

  .meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .status-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .status-badge i {
    font-size: 14px;
  }

  .article-body {
    padding: 20px;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
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

  .article-summary {
    background: #f8fafc;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
  }

  .article-actions {
    padding: 15px 20px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }

  .btn {
    padding: 8px 20px;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s;
  }

  .btn:hover {
    transform: translateY(-1px);
  }

  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
  }

  .empty-state i {
    font-size: 48px;
    color: #9ca3af;
    margin-bottom: 16px;
  }

  .empty-state h5 {
    color: #4b5563;
    margin-bottom: 8px;
  }

  .empty-state p {
    color: #6b7280;
    margin-bottom: 24px;
  }

  @media (max-width: 768px) {
    .wrapper {
      padding: 10px;
    }

    .article-header {
      flex-direction: column;
      gap: 10px;
    }

    .article-meta {
      flex-wrap: wrap;
    }

    .info-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="wrapper">
  <div class="row g-4">
    <aside class="col-md-2">
      <div class="sidebar">
        <div class="card">
          <div class="card-header">
            <h6 class="mb-0"><i class="bi bi-brush-fill me-2"></i>Tác giả</h6>
          </div>
          <div class="list-group">
            <a href="{{ route('ShowPost') }}" class="list-group-item">
              <i class="bi bi-send me-2"></i>Gửi bài
            </a>
            <a href="{{ route('quanlibaiviet') }}" class="list-group-item active">
              <i class="bi bi-journal-text me-2"></i>Quản lý bài viết
            </a>
          </div>
        </div>
      </div>
    </aside>

    <div class="col-md-10">
      <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">Quản lý bài viết của tôi</h4>
          <a href="{{ route('ShowPost') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Gửi bài viết mới
          </a>
        </div>

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="article-filters">
            <a href="{{ route('quanlibaiviet') }}"
               class="filter-item {{ !request('status') ? 'active' : '' }}">
                Tất cả
            </a>
            <a href="{{ route('quanlibaiviet', ['status' => 'Cho_Duyet']) }}"
               class="filter-item {{ request('status') == 'Cho_Duyet' ? 'active' : '' }}">
                <i class="bi bi-clock me-1"></i>
                Chờ xét duyệt
            </a>
            <a href="{{ route('quanlibaiviet', ['status' => 'Chinh_Sua']) }}"
               class="filter-item {{ request('status') == 'Chinh_Sua' ? 'active' : '' }}">
                <i class="bi bi-pencil-square me-1"></i>
                Cần chỉnh sửa
            </a>
            <a href="{{ route('quanlibaiviet', ['status' => 'Da_Duyet']) }}"
               class="filter-item {{ request('status') == 'Da_Duyet' ? 'active' : '' }}">
                <i class="bi bi-check-circle me-1"></i>
                Đã duyệt
            </a>
            <a href="{{ route('quanlibaiviet', ['status' => 'Tu_Choi']) }}"
               class="filter-item {{ request('status') == 'Tu_Choi' ? 'active' : '' }}">
                <i class="bi bi-x-circle me-1"></i>
                Từ chối
            </a>
            <a href="{{ route('quanlibaiviet', ['status' => 'Dang_Bai']) }}"
               class="filter-item {{ request('status') == 'Dang_Bai' ? 'active' : '' }}">
                <i class="bi bi-check-circle-fill me-1"></i>
                Đã đăng
            </a>
        </div>

        @if($articles->isEmpty())
        <div class="empty-state">
          <i class="bi bi-journal-x"></i>
          <h5>Chưa có bài viết nào</h5>
          <p>Bạn chưa gửi bài viết nào. Hãy bắt đầu bằng cách gửi bài viết đầu tiên!</p>
          <a href="{{ route('ShowPost') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Gửi bài viết
          </a>
        </div>
        @else
          @foreach($articles as $article)
          <div class="article-card">
            <div class="article-header">
              <div>
                <h5 class="article-title">{{ $article->TenBaiBao }}</h5>
                <div class="article-meta">
                  <span class="meta-item">
                    <i class="bi bi-folder2"></i>
                    {{ $article->chuyenMuc->TenChuyenMuc }}
                  </span>
                  <span class="meta-item">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::parse($article->NgayGui)->format('d/m/Y') }}
                  </span>
                </div>
              </div>
              <div class="status-badge {{ ArticleHelper::getStatusClass($article->TrangThai) }}">
                <i class="bi {{ ArticleHelper::getStatusIcon($article->TrangThai) }} me-2"></i>
                {{ ArticleHelper::getStatusText($article->TrangThai) }}
            </div>
            </div>

            <div class="article-body">
              <div class="info-grid">
                <div class="info-item">
                  <span class="info-label">Ngôn ngữ</span>
                  <span class="info-value">
                    <i class="bi bi-translate me-1"></i>
                    {{ $article->ngonNgu->TenNgonNgu }}
                  </span>
                </div>
                <div class="info-item">
                  <span class="info-label">Từ khóa</span>
                  <span class="info-value">
                    <i class="bi bi-tags me-1"></i>
                    {{ count(explode(',', $article->TuKhoa)) }} từ khóa
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

              @if($article->GhiChu)
              <div class="article-summary">
                <h6 class="mb-2">Ghi chú từ ban biên tập:</h6>
                {{ $article->GhiChu }}
              </div>
              @endif

              <div class="article-actions">
                @if($article->TrangThai === TrangThaiBaiViet::CHINH_SUA->value)
                <a href="{{ route('editArticle', $article->MaBaiBao) }}" class="btn btn-primary">
                  <i class="bi bi-pencil-square"></i>
                  Chỉnh sửa
                </a>
                @endif
                <a href="{{ route('chitietbaiviet', $article->MaBaiBao) }}" class="btn btn-outline-secondary">
                  <i class="bi bi-eye"></i>
                  Xem chi tiết
                </a>
              </div>
            </div>
          </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</div>




@endsection
