@if ($dsyc->isEmpty())
    <div class="empty-state">
        <i class="bi bi-journal-x"></i>
        <h5>Chưa có yêu cầu phản biện</h5>
        <p>Hiện tại không có yêu cầu nào!</p>
    </div>
@else
    @foreach ($dsyc as $item)
        <div class="article-card">
            <div class="article-header">
                <div>
                    <h5 class="article-title">Tên bài báo {{$item->BaiViet->TenBaiBao}}</h5>
                    <div class="article-meta">
                        <span class="meta-item">
                            <i class="bi bi-calendar3"> {{ $item->NgayGuiYeuCau }}</i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="article-body d-flex align-items-center justify-content-between">
                <div class="info-grid d-flex w-100">
                    <div class="info-item">
                        <span class="info-label">Ngôn ngữ:</span>
                        {{$item->BaiViet->ngonNgu->TenNgonNgu}}
                    </div>
                    <div class="info-item d-flex justify-content-center flex-grow-1">
                        <span class="info-label">Từ khóa:</span>
                        {{$item->BaiViet->TuKhoa}}
                    </div>
                    <div class="info-item">
                        <button type="button" class="btn btn-info toggle-summary" data-id="{{$item->MaBaiBao}}">
                            Xem Tóm Tắt
                        </button>
                    </div>
                </div>
                @if ($item->TrangThai == \App\Enums\TrangThaiYeuCau::CHO_PHAN_HOI->value)
                    <form action="{{ route('update_bv', $item->MaBaiBao) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="result" class="form-label">Kết quả phản biện</label>
                            <select id="result" name="result" class="form-select" required>
                                <option value="" disabled>Chọn kết quả</option>
                                <option value="{{ \App\Enums\TrangThaiYeuCau::CHAP_NHAN->value }}">Chấp nhận</option>
                                <option value="{{ \App\Enums\TrangThaiYeuCau::TU_CHOI->value }}">Từ chối</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </form>
                @else
                <div class="info-item border rounded p-3 bg-light d-flex align-items-center">
                    <span class="info-label text-muted fw-bold me-2">Kết quả:</span>
                    <span class="badge bg-primary text-white fs-6">{{ $item->TrangThai }}</span>
                </div>



                @endif
            </div>
        </div>
        <div class="summary-content d-none border rounded p-3 bg-light" id="summary{{$item->MaBaiBao}}">
            <h5 class="mt-3 fw-bold">Tóm Tắt Nội Dung</h5>
            <p>{{ $item->BaiViet->TomTat }}</p>
            <div class="border-top pt-3 mt-3">
                <h5 class="fw-bold">Summary</h5>
                <p>{{ $item->BaiViet->TomTatTiengAnh }}</p>
            </div>
        </div>
    @endforeach
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-summary').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const summaryDiv = document.getElementById(`summary${id}`);
            if (summaryDiv.classList.contains('d-none')) {
                summaryDiv.classList.remove('d-none');
            } else {
                summaryDiv.classList.add('d-none');
            }
        });
    });
});

</script>

