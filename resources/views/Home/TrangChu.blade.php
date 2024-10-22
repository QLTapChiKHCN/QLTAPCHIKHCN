@extends('LayoutHome.master')

@section('content')
<section class="journal-section">
    <div class="container py-4">
        <div class="row">
            <!-- Main Content -->
            <article class="col-lg-9">
                <div class="content-header">
                    <h2 class="section-title">SỐ MỚI NHẤT</h2>
                    <div class="divider"></div>
                </div>

                <div class="journal-list">
                    @foreach($sotapchi as $so)
                    <div class="journal-item">
                        <div class="journal-cover">
                            <img src="{{ asset('uploads/' . $so->AnhBia) }}" alt="{{ $so->TenSo }}" />
                        </div>
                        <div class="journal-details">
                            <h3 class="journal-title">{{ $so->TenSo }}</h3>
                            <div class="journal-meta">
                                <div class="journal-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($so->NgayXuatBan)->format('d/m/Y') }}</span>
                                </div>
                                <a href="{{ route('sotapchi.show', $so->MaSoTC) }}" class="read-more-btn">
                                    Đọc Thêm
                                    <svg class="arrow-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14m-7-7l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($sotapchi->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination">
                        @if($sotapchi->onFirstPage())
                            <span class="page-item disabled">←</span>
                        @else
                            <a href="{{ $sotapchi->previousPageUrl() }}" class="page-item">←</a>
                        @endif

                        @foreach($sotapchi->getUrlRange(1, $sotapchi->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="page-item {{ $page == $sotapchi->currentPage() ? 'active' : '' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        @if($sotapchi->hasMorePages())
                            <a href="{{ $sotapchi->nextPageUrl() }}" class="page-item">→</a>
                        @else
                            <span class="page-item disabled">→</span>
                        @endif
                    </div>
                </div>
                @endif
            </article>

            <!-- Sidebar giữ nguyên như cũ -->
            <aside class="col-lg-3">
                <!-- Search Card -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <h3>TÌM KIẾM</h3>
                    </div>
                    <div class="card-body">
                        <form class="search-form" role="search">
                            <input type="search" placeholder="Tìm kiếm..." aria-label="Search" />
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Links Card -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <h3>LIÊN KẾT</h3>
                    </div>
                    <div class="links-list">
                        <a href="#!/quanlykinhke" class="link-item">Quản lý kinh tế</a>
                        <a href="#" class="link-item">Khoa học - Công nghệ</a>
                        <a href="#" class="link-item">Google Scholar</a>
                        <a href="#" class="link-item">TCKH Việt Nam trực tuyến</a>
                        <a href="#" class="link-item">HĐ Chức danh Giáo sư</a>
                        <a href="#" class="link-item">Trường ĐH Công Thương</a>
                    </div>
                </div>

                <!-- Latest Issues Card -->
                <div class="sidebar-card">
                    <div class="card-header">
                        <h3>SỐ MỚI</h3>
                    </div>
                    <div class="links-list">
                        <a href="{{ route('Trangchu', ['filter' => 'latest']) }}" class="link-item {{ request('filter') == 'latest' ? 'active' : '' }}">
                            Mới nhất
                        </a>
                        <a href="{{ route('Trangchu', ['filter' => 'week']) }}" class="link-item {{ request('filter') == 'week' ? 'active' : '' }}">
                            Một tuần trước
                        </a>
                        <a href="{{ route('Trangchu', ['filter' => 'month']) }}" class="link-item {{ request('filter') == 'month' ? 'active' : '' }}">
                            Một tháng trước
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<style>

    .journal-section {
        background-color: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .content-header {
        margin-bottom: 2rem;
    }

    .section-title {
        color: #1a202c;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .divider {
        height: 3px;
        width: 50px;
        background: linear-gradient(to right, #3b82f6, #2563eb);
        margin: 0.5rem 0;
        border-radius: 2px;
    }

    /* New List View Styles */
    .journal-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .journal-item {
        display: flex;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .journal-item:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .journal-cover {
        flex: 0 0 150px;
        height: 200px;
    }

    .journal-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .journal-details {
        flex: 1;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .journal-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .journal-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .journal-date {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
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
    }

    .read-more-btn:hover {
        background: linear-gradient(to right, #2563eb, #1d4ed8);
        color: white;
        transform: translateX(4px);
    }

    .arrow-icon {
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .read-more-btn:hover .arrow-icon {
        transform: translateX(4px);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .journal-item {
            flex-direction: column;
        }

        .journal-cover {
            height: 200px;
            flex: none;
        }

        .journal-details {
            padding: 1rem;
        }

        .journal-meta {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }

    /* Sidebar Styles */
    .sidebar-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        padding: 1rem 1.5rem;
    }

    .card-header h3 {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 1rem;
    }

    .search-form {
        display: flex;
        gap: 0.5rem;
    }

    .search-form input {
        flex: 1;
        padding: 0.5rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        outline: none;
    }

    .search-form button {
        padding: 0.5rem;
        background: #3b82f6;
        border: none;
        border-radius: 6px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-form button:hover {
        background: #2563eb;
    }

    .links-list {
        padding: 0.5rem;
    }

    .link-item {
        display: block;
        padding: 0.75rem 1rem;
        color: #4b5563;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .link-item:hover, .link-item.active {
        background: #f3f4f6;
        color: #2563eb;
        transform: translateX(4px);
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
        .journal-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .section-title {
            font-size: 1.5rem;
        }

        .journal-content {
            padding: 1rem;
        }

        .sidebar-card {
            margin-top: 2rem;
        }
    }
</style>
@endsection
