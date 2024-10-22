@extends('LayoutHome.master')

@section('content')
<section class="article-list-section py-5">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h1 class="section-title">{{ $soTapChi->TenSo }}</h1>
            <div class="divider mx-auto"></div>
        </div>

        <div class="row justify-content-center g-3">
            @foreach($baiViet as $bai)
                <div class="col-12 mb-3">
                    <article class="article-card">
                        <div class="card-inner">
                            <div class="content-wrapper">
                                <div class="article-meta">
                                    <span class="article-number">#{{ ($baiViet->currentPage() - 1) * $baiViet->perPage() + $loop->iteration }}</span>
                                </div>
                                <div class="article-content">
                                    <h2 class="article-title">{{ $bai->TenBaiBao }}</h2>
                                    <p class="article-subtitle">{{ $bai->TieuDe }}</p>
                                    <p class="article-excerpt">{{ Str::limit($bai->TomTat, 150) }}</p>
                                </div>
                            </div>
                            <div class="action-wrapper">
                                <a href="{{ route('bai-viet.show', $bai->MaBaiBao) }}" class="read-more-btn">
                                    Đọc thêm
                                    <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7-7l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>

        <!-- Phân trang -->
        @if($baiViet->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination">
                    @if($baiViet->onFirstPage())
                        <span class="page-item disabled">←</span>
                    @else
                        <a href="{{ $baiViet->previousPageUrl() }}" class="page-item">←</a>
                    @endif

                    @for($i = 1; $i <= $baiViet->lastPage(); $i++)
                        <a href="{{ $baiViet->url($i) }}"
                           class="page-item {{ $baiViet->currentPage() == $i ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @endfor

                    @if($baiViet->hasMorePages())
                        <a href="{{ $baiViet->nextPageUrl() }}" class="page-item">→</a>
                    @else
                        <span class="page-item disabled">→</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</section>

<style>
    .article-list-section {
        background-color: #f8fafc;
        min-height: 100vh;
        padding: 3rem 0;
    }

    .section-header {
        margin-bottom: 2rem;
    }

    .section-title {
        color: #1a202c;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .divider {
        height: 3px;
        width: 50px;
        background: linear-gradient(to right, #3b82f6, #2563eb);
        margin: 0.5rem auto;
        border-radius: 2px;
    }

    .article-card {
        background: #ffffff;
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-inner {
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .content-wrapper {
        flex: 1;
    }

    .article-meta {
        margin-bottom: 0.5rem;
    }

    .article-number {
        background: #f3f4f6;
        padding: 0.2rem 0.6rem;
        border-radius: 15px;
        font-size: 0.8rem;
        color: #4b5563;
        font-weight: 500;
    }

    .article-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 0.3rem;
        line-height: 1.4;
    }

    .article-subtitle {
        font-size: 0.95rem;
        color: #4b5563;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .article-excerpt {
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .read-more-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .read-more-btn:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
        color: white;
        transform: translateX(2px);
    }

    .arrow-icon {
        margin-left: 0.3rem;
        transition: transform 0.3s ease;
    }

    .read-more-btn:hover .arrow-icon {
        transform: translateX(2px);
    }

    /* Pagination Styles */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: inline-flex;
        background: white;
        padding: 0.3rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        gap: 0.3rem;
    }

    .page-item {
        min-width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0 0.7rem;
        border-radius: 6px;
        color: #4b5563;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .page-item:hover:not(.disabled) {
        background: #f3f4f6;
        color: #1a202c;
    }

    .page-item.active {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        color: white;
    }

    .page-item.disabled {
        color: #9ca3af;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 1.5rem;
        }

        .card-inner {
            flex-direction: column;
            padding: 1rem;
            text-align: center;
        }

        .action-wrapper {
            width: 100%;
            margin-top: 1rem;
        }

        .read-more-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
