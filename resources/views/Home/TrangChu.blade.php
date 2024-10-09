@extends('LayoutHome.master')
@section('content')
 <!-- Article -->
 <section class="mt-3">
    <div class="container">
      <div class="row">
        <article class="col-md-9 bg-white" ng-controller="myCtrl">
          <div
            class="mt-2 mb-2 body-title"
            style="font-weight: 600; margin-left: 60px; font-size: 25px; color: var(--background-header);"
          >
            SỐ MỚI NHẤT
          </div>

          <div class="row justify-content-center d-flex">
            <div class="col-md-3 m-md-4 mt-3 mb-3 card" ng-repeat="ls in list_index">
              <div class="card-body">
                <img
                  ng-src=""
                  width="380px"
                  class="img-fluid mb-2"
                />
                <br />
                <span class="text-black-50"
                  >aaaa</span
                >
                <br />
                <button class="btn btn-danger mt-2">Đọc Thêm</button>
              </div>
            </div>
          </div>
        </article>
        <aside class="col-md-3 mt-3 aside-toggle">
          <div class="card">
            <div class="card-header bg-title">
              <strong>TÌM KIẾM</strong>
            </div>
            <form class="d-flex card-body" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-outline-success" type="submit">
                Search
              </button>
            </form>
          </div>
          <div class="card mt-5">
            <div class="card-header bg-title">
              <strong>LIÊN KẾT</strong>
            </div>
            <div class="list-group">
              <a
                href="#!/quanlykinhke"
                class="list-group-item bg-info-subtle"
                >Quản lý kinh tế</a
              >
              <a href="#" class="list-group-item">Khoa học - Công nghệ</a>
              <a href="#" class="list-group-item bg-info-subtle"
                >Google Scholar</a
              >
              <a href="#" class="list-group-item"
                >TCKH Việt Nam trực tuyến</a
              >
              <a href="#" class="list-group-item bg-info-subtle"
                >HĐ Chức danh Giáo sư</a
              >
              <a href="#" class="list-group-item">Trường ĐH Công Thương</a>
            </div>
          </div>
          <div class="card mt-5">
            <div class="card-header bg-title">
              <strong>SỐ MỚI</strong>
            </div>
            <div class="list-group">
              <a href="#" class="list-group-item bg-info-subtle"
                >Mới nhất</a
              >
              <a href="#" class="list-group-item bg-info-subtle"
                >Một tuần trước</a
              >
              <a href="#" class="list-group-item">Một tháng trước</a>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </section>
@endsection
