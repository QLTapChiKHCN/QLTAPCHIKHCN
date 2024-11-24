<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<style>
  .wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px;
    background-color: #f9fafb;
    border-radius: 16px;
  }
  .sidebar {
    position: sticky;
    top: 20px;
  }
  .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
  }
  .card-header, .article-header {
    background: linear-gradient(45deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 15px 25px;
    font-weight: bold;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
  }
  .list-group-item {
    padding: 14px 25px;
    color: #374151;
    font-weight: 500;
    transition: color 0.3s, background-color 0.3s;
  }
  .list-group-item:hover {
    background-color: #f3f4f6;
    color: #1d4ed8;
  }
  .article-filters {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
    justify-content: center;
  }
  .filter-item {
    padding: 8px 15px;
    color: #1e3a8a;
    border-radius: 6px;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
  }
  .filter-item.active {
    background-color: #3b82f6;
    color: white;
    font-weight: bold;
  }
  .filter-item:hover {
    background-color: #e0e7ff;
    color: #1d4ed8;
  }
  .article-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 18px rgba(0, 0, 0, 0.1);
    margin-bottom: 25px;
  }
  .article-body, .article-summary {
    padding: 25px;
  }
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    padding: 25px;
  }
  .empty-state {
    text-align: center;
    padding: 80px 25px;
    background: #f3f4f6;
    border-radius: 12px;
    color: #6b7280;
  }
  .empty-state i {
    font-size: 3em;
    color: #9ca3af;
    margin-bottom: 15px;
  }
  @media (max-width: 768px) {
    .wrapper {
      padding: 15px;
    }
    .info-grid {
      grid-template-columns: 1fr;
    }
    .article-filters {
      flex-direction: column;
      align-items: center;
    }
  }
</style>

<div class="wrapper">
  <div class="main-content">
    <div class="article-filters">
      <a href="{{ route('Working', ['status' => 'Chờ phản hồi']) }}"
         class="filter-item {{ request('status') == 'Chờ phản hồi' ? 'active' : '' }}">
        <i class="bi bi-clock me-1"></i>
        Chờ phản hồi
      </a>
      <a href="{{ route('Working', ['status' => 'Chấp nhận']) }}"
         class="filter-item {{ request('status') == 'Chấp nhận' ? 'active' : '' }}">
        <i class="bi bi-check-circle me-1"></i>
        Đã duyệt
      </a>
      <a href="{{ route('Working', ['status' => 'Từ chối']) }}"
         class="filter-item {{ request('status') == 'Từ chối' ? 'active' : '' }}">
        <i class="bi bi-x-circle me-1"></i>
        Từ chối
      </a>
      <a href="{{ route('Working', ['status' => 'Chỉnh sửa']) }}"
        class="filter-item {{ request('status') == 'Chỉnh sửa' ? 'active' : '' }}">
       <i class="bi bi-x-circle me-1"></i>
       Chỉnh sửa
     </a>
    </div>
  </div>
</div>
