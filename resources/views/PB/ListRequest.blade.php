@extends('LayoutHome.PBmaster')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

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
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
  }
  .card-header, .article-header {
    background: linear-gradient(to right, #2563eb, #1d4ed8);
    color: white;
    padding: 15px 20px;
  }
  .list-group-item {
    padding: 12px 20px;
    color: #4b5563;
  }
  .article-filters, .article-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
  }
  .article-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
  }
  .article-body, .article-summary {
    padding: 20px;
  }
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    padding: 20px;
  }
  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
  }
  @media (max-width: 768px) {
    .wrapper {
      padding: 10px;
    }
    .info-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

{{-- @dd($dsyc) --}}

<div class="wrapper">
  <div class="row g-4">
    <aside class="col-md-2">
      <div class="sidebar">
        <div class="card">
          <div class="list-group">
            <a href="#" class="list-group-item"><i class="bi bi-send me-2"></i>Quản lý danh sách yêu cầu</a>
          </div>
        </div>
      </div>
    </aside>

    <div class="col-md-10">
      <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="mb-0">Danh sách yêu cầu phản biện</h4>
        </div>
        {{-- code nút --}}
        <div class="article-filters" >
            <a href="{{ route('Request') }}"
            class="filter-item {{ request('status') == '' }}">
             Tất cả
         </a>
         <a href="{{ route('Request', ['status' => 'Chờ phản hồi']) }}"
            class="filter-item {{ request('status') == 'Chờ phản hồi' ? 'active' : '' }}">
             <i class="bi bi-clock me-1"></i>
             Chờ phản hồi
         </a>
         <a href="{{ route('Request', ['status' => 'Chấp nhận']) }}"
            class="filter-item {{ request('status') == 'Chấp nhận' ? 'active' : '' }}">
             <i class="bi bi-check-circle me-1"></i>
             Đã duyệt
         </a>
         <a href="{{ route('Request', ['status' => 'Từ chối']) }}"
            class="filter-item {{ request('status') == 'Từ chối' ? 'active' : '' }}">
             <i class="bi bi-x-circle me-1"></i>
             Từ chối
         </a>
        </div>
        @include('PB.RequestFolder.Request_detail')
      </div>
    </div>
  </div>
</div>
@endsection
