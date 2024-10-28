@extends('LayoutHome.master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<style>
  /* Reuse existing styles from the original form */
  body { background-color: #f8f9fa; }
  .wrapper { max-width: 1400px; margin: 0 auto; padding: 20px; }
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
  .form-control:disabled {
    background-color: #f3f4f6;
  }
</style>

<section>
  <div class="wrapper">
    <div class="main-content">
      <h2 class="mb-4">Chỉnh sửa bài viết</h2>

      <form id="editArticleForm" action="{{ route('updateArticle', $article->MaBaiBao) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Thông tin không được phép chỉnh sửa -->
        <div class="section-title">Thông tin cơ bản</div>
        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label class="form-label">Ngôn ngữ</label>
            <input type="text" class="form-control" value="{{ $article->ngonNgu->TenNgonNgu }}" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Chuyên mục</label>
            <input type="text" class="form-control" value="{{ $article->chuyenMuc->TenChuyenMuc }}" disabled>
          </div>
        </div>

        <!-- Thông tin có thể chỉnh sửa -->
        <div class="section-title">Thông tin bài viết</div>
        <div class="row g-4">
          <div class="col-12">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="tieu_de" class="form-control" value="{{ $article->TieuDe }}" required>
          </div>
          <div class="col-12">
            <label class="form-label">Tên bài viết</label>
            <input type="text" name="ten_bai_viet" class="form-control" value="{{ $article->TenBaiBao }}" required>
          </div>
          <div class="col-12">
            <label class="form-label">Tên bài viết (Tiếng Anh)</label>
            <input type="text" name="ten_bai_viet_en" class="form-control" value="{{ $article->TenBaiBaoTiengAnh }}" required>
          </div>
          <div class="col-12">
            <label class="form-label">Tóm tắt</label>
            <textarea name="tom_tat" id="summary" class="form-control" rows="4" required>{{ $article->TomTat }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Tóm tắt (Tiếng Anh)</label>
            <textarea name="tom_tat_en" id="abstract" class="form-control" rows="4" required>{{ $article->TomTatTiengAnh }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Từ khóa</label>
            <input type="text" name="tu_khoa" class="form-control" value="{{ $article->TuKhoa }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Từ khóa (Tiếng Anh)</label>
            <input type="text" name="tu_khoa_en" class="form-control" value="{{ $article->TuKhoaTiengAnh }}" required>
          </div>
        </div>

        <!-- File upload -->
        <div class="section-title mt-4">Tệp bài viết</div>
        <div class="mb-4">
          <p class="mb-2">Tệp hiện tại: {{ $article->FileBaiViet }}</p>
          <label class="form-label">Tải lên tệp mới (không bắt buộc)</label>
          <input type="file" name="file" class="form-control" accept=".doc,.docx,.pdf">
        </div>

        <!-- Submit buttons -->
        <div class="text-end mt-4">
          <a href="{{ route('quanlibaiviet') }}" class="btn btn-secondary me-2">Hủy</a>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Thành công!</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body text-center">
          <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
          <p class="mt-3">Bài viết đã được cập nhật thành công.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('quanlibaiviet') }}'">
            Quay lại danh sách
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize CKEditor
  ClassicEditor
    .create(document.querySelector('#summary'))
    .catch(error => console.error(error));

  ClassicEditor
    .create(document.querySelector('#abstract'))
    .catch(error => console.error(error));

  // Handle form submission
  const form = document.getElementById('editArticleForm');
  const successModal = new bootstrap.Modal(document.getElementById('successModal'));

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        successModal.show();
      } else {
        alert(data.message || 'Có lỗi xảy ra khi cập nhật bài viết.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Có lỗi xảy ra khi cập nhật bài viết.');
    });
  });
});
</script>
@endsection
