<div class="col-lg-9">
    <div class="article-summary mb-4">
        <div class="d-flex align-items-center">
            <div>
                <h3 class="h5">Abstract</h3>
                <p>{{$baiviet->TomTatTiengAnh}}</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="mt-3">
                <h3 class="h5">Tóm tắt</h3>
                <p>{{$baiviet->TomTat}}</p>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-5">
            <?php if ($baiviet->TrangThai == \App\Enums\TrangThaiBaiViet::CHO_XET_DUYET->value):?>
                <a class="btn btn-primary" id="openFormButton">Tiến hành phản biện</a>
            <?php else: ?>
                <button class="btn btn-secondary" disabled>Không thể phản biện</button>
            <?php endif; ?>
        </div>
        <div id="formContainer" style="display: none;">
            @include('PB.ViewArticel.form_submit')
        </div>
    </div>
</div>
<script>
    document.getElementById('openFormButton').addEventListener('click', function() {
        var formContainer = document.getElementById('formContainer');
        if (formContainer.style.display === 'none') {
            formContainer.style.display = 'block'; // Hiện form
        } else {
            formContainer.style.display = 'none'; // Ẩn form
        }
    });
</script>
