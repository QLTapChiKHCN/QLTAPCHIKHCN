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
                    <div class="info-item">
                        <span class="info-label">Kết quả phản biện:</span>
                        <span>{{ $item->TrangThai }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endif
