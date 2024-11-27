<div class="container mt-5">
    <h2 class="mb-4">Kết quả phản biện</h2>
    <form action="{{route('post_PDF',$baiviet->MaBaiBao)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="result" class="form-label">Kết quả phản biện</label>
            <select id="result" name="result" class="form-select" required>
                <option value="" disabled selected>Chọn kết quả</option>
                <option value="{{ \App\Enums\TrangThaiChiTietPhanBien::DA_DUYET->value }}">Đồng ý</option>
                <option value="{{ \App\Enums\TrangThaiChiTietPhanBien::TU_CHOI->value }}">Từ chối</option>
                <option value="{{ \App\Enums\TrangThaiChiTietPhanBien::YEU_CAU_CHINH_SUA->value }}">Chỉnh sửa</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea id="content" name="content" class="form-control" rows="4" required placeholder="Nhập nội dung phản biện..."></textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Chọn file</label>
            <input type="file" id="file" name="file" class="form-control" accept=".pdf,.doc,.docx">
            <small class="form-text text-muted">Chỉ hỗ trợ các định dạng .pdf, .doc, .docx.</small>
        </div>

        <button type="submit" class="btn btn-primary">Xác nhận</button>
    </form>
</div>
