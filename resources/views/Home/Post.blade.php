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
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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

        .form-select,
        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d5db;
            padding: 10px 15px;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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

        .helper-text {
            color: #6b7280;
            font-size: 13px;
            margin-top: 6px;
        }

        body {
            background-color: #f8f9fa;
        }

        .wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        #successModal .modal-content {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        #successModal .modal-header {
            border-bottom: none;
            padding: 20px 30px;
        }

        #successModal .modal-body {
            padding: 30px;
        }

        #successModal .modal-footer {
            border-top: none;
            justify-content: center;
            padding: 0 30px 20px;
        }

        #successModal .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px 30px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        #successModal .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
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
                        <form action="{{ route('submitArticle') }}" accept-charset="UTF-8" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Language and Category Selection -->
                            <div class="row g-4 mb-4 justify-content-center">
                                <div class="col-md-4 w-100">
                                    <label class="form-label">Ngôn ngữ</label>
                                    <select name="ngon_ngu" class="form-select" required>
                                        <option value="">Chọn ngôn ngữ</option>
                                        @foreach ($ngonngu as $item)
                                            <option value="{{ $item->MaNgonNgu }}">{{ $item->TenNgonNgu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 w-100">
                                    <label class="form-label">Chuyên mục</label>
                                    <select name="chuyen_muc" class="form-select" required>
                                        <option value="">Chọn Chuyên mục</option>
                                        @foreach ($chuyenmuc as $item)
                                            <option value="{{ $item->MaChuyenMuc }}">{{ $item->TenChuyenMuc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Requirements Section -->
                            <div class="section-title mt-4">Yêu cầu nộp bài</div>
                            <p class="helper-text">Vui lòng xác nhận các yêu cầu dưới đây trước khi tiếp tục</p>
                            <div class="requirements-box">
                                <label>
                                    <input type="checkbox" required>
                                    <span>Sự phù hợp với mục đích - phạm vi của Tạp chí</span>
                                </label>
                                <label>
                                    <input type="checkbox" required>
                                    <span>Sự tuân thủ các chính sách gửi bài, phản biện, biên tập của Tạp chí</span>
                                </label>
                                <label>
                                    <input type="checkbox" required>
                                    <span>Sự phù hợp với thể lệ bài viết của Tạp chí</span>
                                </label>
                                <label>
                                    <input type="checkbox" required>
                                    <span>Tác giả sử dụng mẫu bản thảo để chuẩn bị bài viết</span>
                                </label>
                                <label>
                                    <input type="checkbox" required>
                                    <span>Tác giả chịu trách nhiệm hoàn toàn trước pháp luật về Bản quyền đối với bài
                                        viết</span>
                                </label>
                                <label>
                                    <input type="checkbox" required>
                                    <span>Cam kết bài viết chưa từng được công bố và không gửi đến tạp chí khác trong thời
                                        gian xét duyệt</span>
                                </label>
                            </div>
                            <!-- Author Section -->
                            <div class="section-title">Thông tin tác giả</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tên tác giả</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Loại tác giả</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="authorList">
                                    <tr>
                                        <td><input type="text" name="ten_tac_gia[]" class="form-control"
                                                value="{{ $user->HoTen }}" required></td>
                                        <td><input type="email" name="email_tac_gia[]" class="form-control"
                                                value="{{ $user->Email }}" required></td>
                                        <td><input type="text" name="dia_chi_tac_gia[]" class="form-control"
                                                value="{{ $user->DiaChi }}"></td>
                                        <td><input type="text" name="sdt_tac_gia[]" class="form-control"
                                                value="{{ $user->SoDienThoai }}" pattern="^\d{10}$"
                                                title="Số điện thoại phải có 10 số" required></td>
                                        <td>
                                            <select name="loai_tac_gia[]" class="form-select" required>
                                                <option value="">Chọn loại tác giả</option>
                                                @foreach ($loaitacgia as $item)
                                                    <option value="{{ $item->MaLTacGia }}">{{ $item->TenLoai }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" id="addCoAuthorBtn">Thêm đồng tác
                                                giả</button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <!-- Article Information -->
                            <div class="section-title mt-4">Thông tin bài báo</div>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Tiêu Đề</label>
                                    <input type="text" name="tieu_de" class="form-control"
                                        placeholder="Nhập tiêu đề bài báo" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tên bài báo</label>
                                    <input type="text" name="ten_bai_viet" class="form-control"
                                        placeholder="Nhập tên bài báo..." required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tên bài báo (Tiếng Anh)</label>
                                    <input type="text" name="ten_bai_viet_en" class="form-control"
                                        placeholder="Enter article title...">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tóm tắt</label>
                                    <textarea name="tom_tat" id="summary" class="form-control" rows="4" placeholder="Nhập tóm tắt bài báo..."></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tóm tắt (Tiếng Anh)</label>
                                    <textarea name="tom_tat_en" id="abstract" class="form-control" rows="4" placeholder="Enter abstract..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Từ khóa</label>
                                    <input type="text" name="tu_khoa" class="form-control"
                                        placeholder="Nhập từ khóa bài báo..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Từ khóa (Tiếng Anh)</label>
                                    <input type="text" name="tu_khoa_en" class="form-control"
                                        placeholder="Enter keywords...">
                                </div>
                            </div>

                            <!-- File Upload Section -->
                            <div class="section-title mt-4">Tải tệp lên</div>
                            <div class="file-upload">
                                <label for="upload">
                                    <i class="bi bi-cloud-arrow-up-fill fs-1 mb-3"></i><br>
                                    <span>Tải tệp bản thảo</span><br>
                                    <small>Nhấn vào đây để chọn tệp</small>
                                </label>
                                <input type="file" name="file" id="upload" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">Gửi bài</button>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
        </div>

        <!-- Modal for Co-Author -->
        <div class="modal fade" id="coAuthorModal" tabindex="-1" aria-labelledby="coAuthorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="coAuthorModalLabel">Thêm đồng tác giả</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="coAuthorForm">
                            <div class="mb-3">
                                <label for="coAuthorEmail" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="email" class="form-control" id="coAuthorEmail" required>
                                    <button type="button" class="btn btn-primary" id="checkEmail">Kiểm tra</button>
                                </div>
                            </div>
                            <div id="authorInfoFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="coAuthorName" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="coAuthorName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="coAuthorPhone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="coAuthorPhone" pattern="^\d{10}$"
                                        title="Số điện thoại phải có 10 số" required>
                                </div>
                                <div class="mb-3">
                                    <label for="coAuthorAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="coAuthorAddress" required>
                                </div>
                                <button type="button" class="btn btn-primary" id="submitCoAuthor">Thêm đồng tác
                                    giả</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="successModalLabel">Thành công!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                        <p class="mt-3">Bài viết của bạn đã được gửi thành công và đang chờ xét duyệt.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkEmailBtn = document.getElementById('checkEmail');
            const authorInfoFields = document.getElementById('authorInfoFields');
            const coAuthorEmail = document.getElementById('coAuthorEmail');
            const coAuthorName = document.getElementById('coAuthorName');
            const coAuthorPhone = document.getElementById('coAuthorPhone');
            const coAuthorAddress = document.getElementById('coAuthorAddress');

            checkEmailBtn.addEventListener('click', function() {
                const email = coAuthorEmail.value;
                if (!email) {
                    alert('Vui lòng nhập email!');
                    return;
                }

                // Gửi request kiểm tra email
                fetch(`/check-email?email=${encodeURIComponent(email)}`)
                    .then(response => response.json())
                    .then(data => {
                        authorInfoFields.style.display = 'block';

                        if (data.exists) {
                            // Nếu email đã tồn tại, điền thông tin vào form
                            coAuthorName.value = data.user.HoTen;
                            coAuthorPhone.value = data.user.SoDienThoai;
                            coAuthorAddress.value = data.user.DiaChi;

                            // Disable các trường thông tin
                            coAuthorName.disabled = true;
                            coAuthorPhone.disabled = true;
                            coAuthorAddress.disabled = true;
                        } else {
                            // Nếu email chưa tồn tại, reset và enable form
                            coAuthorName.value = '';
                            coAuthorPhone.value = '';
                            coAuthorAddress.value = '';

                            coAuthorName.disabled = false;
                            coAuthorPhone.disabled = false;
                            coAuthorAddress.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi kiểm tra email!');
                    });
            });

            document.getElementById('submitCoAuthor').addEventListener('click', function() {
                const name = coAuthorName.value;
                const email = coAuthorEmail.value;
                const phone = coAuthorPhone.value;
                const address = coAuthorAddress.value;

                if (name && email && phone && address) {
                    const authorList = document.getElementById('authorList');
                    const newRow = authorList.insertRow(1);
                    newRow.innerHTML = `
            <td><input type="text" name="ten_tac_gia[]" class="form-control" value="${name}" readonly></td>
            <td><input type="email" name="email_tac_gia[]" class="form-control" value="${email}" readonly></td>
            <td><input type="text" name="dia_chi_tac_gia[]" class="form-control" value="${address}" readonly></td>
            <td><input type="text" name="sdt_tac_gia[]" class="form-control" value="${phone}" readonly></td>
            <td>
              <select name="loai_tac_gia[]" class="form-select" required>
                <option value="">Chọn loại tác giả</option>
                @foreach ($loaitacgia as $item)
                  <option value="{{ $item->MaLTacGia }}">{{ $item->TenLoai }}</option>
                @endforeach
              </select>
            </td>
            <td><button type="button" class="btn btn-danger removeAuthor">Xóa</button></td>
          `;

                    // Reset form và đóng modal
                    document.getElementById('coAuthorForm').reset();
                    authorInfoFields.style.display = 'none';
                    bootstrap.Modal.getInstance(document.getElementById('coAuthorModal')).hide();
                }
            });

            // Xử lý xóa tác giả
            document.getElementById('authorList').addEventListener('click', function(e) {
                if (e.target.classList.contains('removeAuthor')) {
                    const row = e.target.closest('tr');
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('addCoAuthorBtn').addEventListener('click', function() {
            const myModal = new bootstrap.Modal(document.getElementById('coAuthorModal'));
            myModal.show();
        });

        document.getElementById('submitCoAuthor').addEventListener('click', function() {
            const name = document.getElementById('coAuthorName').value;
            const email = document.getElementById('coAuthorEmail').value;
            const phone = document.getElementById('coAuthorPhone').value;
            const address = document.getElementById('coAuthorAddress').value;

            if (name && email && phone && address) {
                const authorList = document.getElementById('authorList');
                const newRow = authorList.insertRow(1);
                newRow.innerHTML = `
          <td><input type="text" name="ten_tac_gia[]" class="form-control" value="${name}" required></td>
          <td><input type="email" name="email_tac_gia[]" class="form-control" value="${email}" required></td>
          <td><input type="text" name="dia_chi_tac_gia[]" class="form-control" value="${address}"></td>
          <td><input type="text" name="sdt_tac_gia[]" class="form-control" value="${phone}"></td>
          <td>
            <select name="loai_tac_gia[]" class="form-select" required>
              <option value="">Chọn loại tác giả</option>
              @foreach ($loaitacgia as $item)
                <option value="{{ $item->MaLTacGia }}">{{ $item->TenLoai }}</option>
              @endforeach
            </select>
          </td>
          <td><button type="button" class="btn btn-danger removeAuthor">Xóa</button></td>
        `;

                // Clear the form
                document.getElementById('coAuthorForm').reset();

                // Close the modal
                bootstrap.Modal.getInstance(document.getElementById('coAuthorModal')).hide();
            } else {
                alert('Vui lòng điền đầy đủ thông tin đồng tác giả!');
            }
            document.getElementById('authorList').addEventListener('click', function(e) {
                if (e.target.classList.contains('removeAuthor')) {
                    // Xóa hàng tương ứng
                    const row = e.target.closest('tr');
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('{{ route('submitArticle') }}', {
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
                            form.reset();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while submitting the article.');
                    });
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#summary'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#abstract'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
