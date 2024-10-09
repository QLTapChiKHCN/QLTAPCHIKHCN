@extends('LayoutHome.master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
  body {
    background-color: #f8f9fa;
  }

  .wrapper {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
  }

  .sidebar {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
  }

  .sidebar .card {
    border: none;
  }

  .sidebar .card-header {
    background: #2563eb;
    color: white;
    border-radius: 8px 8px 0 0;
    padding: 15px;
  }

  .sidebar .card-header h6 {
    margin: 0;
    font-size: 16px;
  }

  .sidebar .list-group-item {
    border: none;
    padding: 12px 20px;
    color: #4b5563;
    transition: all 0.3s;
  }

  .sidebar .list-group-item:hover {
    background: #eff6ff;
    color: #2563eb;
  }

  .main-content {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
  }

  .section-title {
    color: #1e40af;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
  }

  .form-label {
    color: #374151;
    font-weight: 500;
    margin-bottom: 8px;
  }

  .form-select, .form-control {
    border-radius: 8px;
    border: 1px solid #d1d5db;
    padding: 10px 15px;
  }

  .form-select:focus, .form-control:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
  }

  .requirements-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
  }

  .requirements-box label {
    display: flex;
    align-items: start;
    gap: 10px;
    margin-bottom: 10px;
    color: #4b5563;
    font-size: 14px;
  }

  .requirements-box input[type="checkbox"] {
    margin-top: 4px;
  }

  .table {
    border-radius: 8px;
    overflow: hidden;
  }

  .table thead th {
    background: #f1f5f9;
    font-weight: 600;
    color: #374151;
    padding: 12px 16px;
  }

  .btn-primary {
    background: #2563eb;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s;
  }

  .btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
  }

  .btn-danger {
    background: #ef4444;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
  }

  .file-upload {
    border: 2px dashed #e5e7eb;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    background: #f8fafc;
    transition: all 0.3s;
  }

  .file-upload:hover {
    border-color: #2563eb;
    background: #eff6ff;
  }

  .file-upload .form-control {
    display: none;
  }

  .file-upload label {
    cursor: pointer;
    color: #2563eb;
    font-weight: 500;
  }

  .helper-text {
    color: #6b7280;
    font-size: 13px;
    margin-top: 6px;
  }


</style>

<section>
    <div class="wrapper">
      <div class="row g-4">
        <!-- Sidebar -->
        <aside class="col-md-2">
          <div class="sidebar">
            <div class="card">
              <div class="card-header">
                <h6><i class="bi bi-brush-fill me-2"></i>Tác giả</h6>
              </div>
              <div class="list-group">
                <a href="{{ route('ShowPost') }}" class="list-group-item">
                  <i class="bi bi-send me-2"></i>Gửi bài
                </a>
                <a href="#" class="list-group-item">
                  <i class="bi bi-journal-text me-2"></i>Quản lý bài viết
                </a>
              </div>
            </div>
          </div>
        </aside>

        <!-- Main Content -->
        <article class="col-md-10">
          <div class="main-content">
            <!-- Language and Category Selection -->
            <div class="row g-4 mb-4">
              <div class="col-md-4">
                <label class="form-label">Ngôn ngữ</label>
                <select class="form-select">
                  <option value="vi">Tiếng Việt</option>
                  <option value="en">Tiếng Anh</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Chuyên mục</label>
                <select class="form-select">
                  <option>QUẢN LÝ KINH TẾ</option>
                  <option>KHOA HỌC CÔNG NGHỆ</option>
                </select>
              </div>

            </div>

            <!-- Requirements Section -->
            <div class="section-title">Yêu cầu nộp bài</div>
            <p class="helper-text">Vui lòng xác nhận các yêu cầu dưới đây trước khi tiếp tục</p>

            <div class="requirements-box">
              <label>
                <input type="checkbox">
                <span>Sự phù hợp với mục đích - phạm vi của Tạp chí</span>
              </label>
              <label>
                <input type="checkbox">
                <span>Sự tuân thủ các chính sách gửi bài, phản biện, biên tập của Tạp chí</span>
              </label>
              <label>
                <input type="checkbox">
                <span>Sự phù hợp với thể lệ bài viết của Tạp chí</span>
              </label>
              <label>
                <input type="checkbox">
                <span>Tác giả sử dụng mẫu bản thảo để chuẩn bị bài viết</span>
              </label>
              <label>
                <input type="checkbox">
                <span>Tác giả chịu trách nhiệm hoàn toàn trước pháp luật về Bản quyền đối với bài viết</span>
              </label>
              <label>
                <input type="checkbox">
                <span>Cam kết bài viết chưa từng được công bố và không gửi đến tạp chí khác trong thời gian xét duyệt</span>
              </label>
            </div>

            <!-- Article Information -->
            <div class="section-title mt-4">Thông tin bài báo</div>
            <div class="row g-4">
              <div class="col-12">
                <label class="form-label">Tên bài báo</label>
                <input type="text" class="form-control" placeholder="Nhập tên bài báo...">
              </div>
              <div class="col-12">
                <label class="form-label">Tên bài báo (Tiếng Anh)</label>
                <input type="text" class="form-control" placeholder="Enter article title...">
              </div>
              <div class="col-12">
                <label class="form-label">Tóm tắt</label>
                <textarea class="form-control" rows="4" placeholder="Nhập tóm tắt bài báo..."></textarea>
              </div>
              <div class="col-12">
                <label class="form-label">Tóm tắt (Tiếng Anh)</label>
                <textarea class="form-control" rows="4" placeholder="Enter abstract..."></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Từ khóa</label>
                <input type="text" class="form-control" placeholder="Nhập và nhấn Enter sau mỗi từ khóa">
                <div class="helper-text">Thêm thông tin bổ sung cho bài nộp của bạn</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Từ khóa (Tiếng Anh)</label>
                <input type="text" class="form-control" placeholder="Enter keywords and press Enter">
                <div class="helper-text">Add supplementary information for your submission</div>
              </div>
            </div>

            <!-- Co-authors Section -->
            <div class="section-title mt-4">Danh sách đồng tác giả</div>
            <div class="d-flex justify-content-end mb-3">
              <button class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Thêm đồng tác giả
              </button>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Đơn vị công tác</th>
                    <th class="text-center">Tác giả chính</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Lê Bùi Thiên Đức</td>
                    <td>ducancut@gmail.com</td>
                    <td>0987654321</td>
                    <td>Đại học công thương</td>
                    <td class="text-center">
                      <input type="radio" name="main-author">
                    </td>
                    <td class="text-center">
                      <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3-fill"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- File Upload Section -->
            <div class="section-title mt-4">Tệp đính kèm</div>
            <div class="file-upload mb-4">
              <input type="file" class="form-control" id="file-upload" multiple>
              <label for="file-upload">
                <i class="bi bi-cloud-upload me-2"></i>
                Kéo thả file vào đây hoặc click để chọn file
              </label>
              <div class="helper-text">Hỗ trợ các định dạng: DOC, DOCX, PDF (Tối đa 10MB)</div>
            </div>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Tên file</th>
                    <th>Người tạo</th>
                    <th>Ngày tạo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- File list will be displayed here -->
                </tbody>
              </table>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-send-fill me-2"></i>Gửi bài
              </button>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>


<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

@endsection
