<div class="col-lg-3">
    <div class="p-0 bg-light">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <p class="card-text">Thông tin phản biện</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Ngày nhận bài: {{$ctpb->NgayNhan}}</li>
                <li class="list-group-item">Ngày đến hạn: {{$ctpb->NgayHetHan}}</li>
                <li class="list-group-item">Trạng thái: {{$ctpb->KetQuaPhanBien}}</li>
            </ul>
            <div class="card-body">
                @if($baiviet->FileBaiViet)
                    <a href="{{ route('PDF', $baiviet->FileBaiViet) }}" class="card-link" target="_blank">PDF</a>
                    <a href="{{ route('downloadPDF', $baiviet->FileBaiViet) }}" class="card-link">Download</a>
                    <a href="{{ route('downloadPDF', 'BieuMau.docx') }}" class="card-link">Tải biểu mẫu</a>
                @else
                    <span>Không có file PDF</span>
                @endif
            </div>
        </div>
    </div>
</div>
