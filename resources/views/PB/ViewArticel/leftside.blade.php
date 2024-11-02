<div class="col-lg-3">
    <div class="p-0 bg-light">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                {{-- <h5 class="card-title">Card title</h5> --}}
                <p class="card-text">Thông tin phản biện</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Ngày nhận bài: {{$baiviet->ngaynhan}}</li>
                <li class="list-group-item">Ngày đến hạn:</li>
                <li class="list-group-item">Trạng thái: {{$baiviet->TrangThai}}</li>
            </ul>
            <div class="card-body">
                <a href="{{ route('PDF', $baiviet->FileBaiViet) }}" class="card-link" target="_blank">PDF</a>
                <a href="{{ route('downloadPDF', $baiviet->FileBaiViet) }}" class="card-link">Download</a>
            </div>
        </div>
    </div>
</div>

