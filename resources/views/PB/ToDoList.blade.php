@extends('LayoutHome.PBmaster')
@section('content')

    <body>
        <div class="container">
            <main>
                <!-- Tìm kiếm và Dropdown nằm ngang -->
                <!-- Ô tìm kiếm -->
                @include('PB.ViewArticel.search-pb')
                <h1 style="margin-top: 30px">Danh Sách Bài Báo Đang Phản Biện</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Mã bài báo</th>
                            <th>Tên bài báo</th>
                            <th>Ngày nhận</th>
                            <th>Trạng thái</th>
                            <th>Chi tiết bài viết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_CV as $list)
                            <tr>
                                <td>
                                    <p>{{ $list['MaBaiBao'] }}</p>
                                </td>
                                <td>
                                    <p>{{ $list['TenBaiBao'] }}</p>
                                </td>
                                <td>
                                    <p>{{ $list['NgayNhan'] }}</p>
                                </td>
                                <td>
                                    <p>{{ $list['TrangThai'] }}</p>
                                </td>
                                <td><a class="detail-link" href="{{route('show',$list['MaBaiBao'])}}">Xem chi tiết</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </body>
@endsection
