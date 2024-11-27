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
     background: linear-gradient(to right, #3b82f6, #2563eb);
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
   .table {
     background: white;
     border-radius: 12px;
     box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
   }
   .table th {
     background: linear-gradient(to right, #3b82f6, #2563eb);
     color: white;
   }
   .detail-link {
     color: #2563eb;
     text-decoration: none;
     font-weight: 500;
   }
   .detail-link:hover {
     color: #1d4ed8;
     text-decoration: underline;
   }
   @media (max-width: 768px) {
     .wrapper {
       padding: 10px;
     }
   }
</style>

<div class="wrapper">
   <div class="row g-4">
     <aside class="col-md-2">
       <div class="sidebar">
         <div class="card">
           <div class="list-group">
             <a href="#" class="list-group-item">
               <i class="bi bi-list-ul me-2"></i>Danh sách bài báo
             </a>
           </div>
         </div>
       </div>
     </aside>

     <div class="col-md-10">
       <div class="main-content">
         <div class="d-flex justify-content-between align-items-center mb-4">
           <h4 class="mb-0">Danh Sách Bài Báo Đang Phản Biện</h4>
         </div>

         @include('PB.ViewArticel.search-pb')

         <div class="table-responsive">
           <table class="table table-hover">
             <thead>
               <tr>
                 <th>Mã bài báo</th>
                 <th>Tên bài báo</th>
                 <th>Ngày nhận</th>
                 <th>Trạng thái</th>
                 <th>Chi tiết bài viết</th>
               </tr>
             </thead>
             <tbody>
               @foreach ($list_CV as $list)
                 <tr>
                   <td>{{ $list['MaBaiBao'] }}</td>
                   <td>{{ $list['TenBaiBao'] }}</td>
                   <td>{{ $list['NgayNhan'] }}</td>
                   <td>{{ $list['TrangThai'] }}</td>
                   <td>
                     <a class="detail-link" href="{{ route('show', $list['MaBaiBao']) }}">
                       <i class="bi bi-eye me-1"></i>Xem chi tiết
                     </a>
                   </td>
                 </tr>
               @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection
