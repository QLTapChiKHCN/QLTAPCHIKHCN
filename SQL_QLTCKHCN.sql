-- Tạo CSDL
CREATE DATABASE QL_TCKHCN;
GO

USE QL_TCKHCN;
GO

-- Tạo bảng NgonNgu
CREATE TABLE NgonNgu (
    MaNgonNgu varchar(10) PRIMARY KEY,
    TenNgonNgu nvarchar(50)
);
GO	
-- Tạo bảng ChuyenMuc
CREATE TABLE ChuyenMuc (
    MaChuyenMuc varchar(10) PRIMARY KEY,
    TenChuyenMuc nvarchar(100)
);
GO
-- Tạo bảng SoTapChi
CREATE TABLE SoTapChi (
    MaSoTC varchar(10) PRIMARY KEY,
    TenSo nvarchar(100),
    AnhBia varchar(200),
    NgayXuatBan date
);
GO
-- Tạo bảng HocVi
CREATE TABLE HocVi (
    MaHocVi varchar(10) PRIMARY KEY,
    TenHocVi nvarchar(50)
);
GO
-- Tạo bảng HocHam
CREATE TABLE HocHam (
    MaHocHam varchar(10) PRIMARY KEY,
    TenHocHam nvarchar(50)
);
GO
-- Tạo bảng VaiTro
CREATE TABLE VaiTro (
    MaVaiTro varchar(10) PRIMARY KEY,
    TenVaiTro nvarchar(50)
);
GO
-- Tạo bảng LoaiTacGia
CREATE TABLE LoaiTacGia (
    MaLTacGia varchar(10) PRIMARY KEY,
    TenLoai nvarchar(50)
);
GO
CREATE TABLE ChuyenNganh(
   MaChuyenNganh varchar(10) Primary key,
   TenChuyenNganh varchar(50)
);
Go
CREATE TABLE DonVi(
	MaDonVi varchar(10) primary key,
	TenDonVi varchar(50)
	);
Go
CREATE TABLE QuocGia(
	MaQG varchar(10) primary key,
	TenQG varchar(50)
	);
go
-- Tạo bảng NguoiDung
CREATE TABLE NguoiDung (
    MaNguoiDung varchar(10) PRIMARY KEY,
    MaHocVi varchar(10) FOREIGN KEY REFERENCES HocVi(MaHocVi),
    MaHocHam varchar(10) FOREIGN KEY REFERENCES HocHam(MaHocHam),
    MaDonVi varchar(10) FOREIGN KEY REFERENCES DonVi(MaDonVi),
    MaChuyenNganh varchar(10) FOREIGN KEY REFERENCES ChuyenNganh(MaChuyenNganh),
    MaQG varchar(10) FOREIGN KEY REFERENCES QuocGia(MaQG),
    TenDangNhap varchar(50),
    MatKhau varchar(100),
    HoTen nvarchar(100),
    Email varchar(100),
    CCCD varchar(12),
    SoDienThoai varchar(15),
    DiaChi nvarchar(200),
    ChuyenNganh nvarchar(100),
    DonVi nvarchar(200),
    QuocGia nvarchar(50),
    GioiTinh nvarchar(10)
);
GO
-- Tạo bảng NguoiDung_VaiTro
CREATE TABLE NguoiDung_VaiTro (
    MaNguoiDung varchar(10),
    MaVaiTro varchar(10),
    PRIMARY KEY (MaNguoiDung, MaVaiTro),
    FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung),
    FOREIGN KEY (MaVaiTro) REFERENCES VaiTro(MaVaiTro)
);
GO
-- Tạo bảng BaiViet
CREATE TABLE BaiViet (
    MaBaiBao char(10) PRIMARY KEY,
    MaNgonNgu varchar(10) FOREIGN KEY REFERENCES NgonNgu(MaNgonNgu) NOT NULL,
    MaSoTC varchar(10) FOREIGN KEY REFERENCES SoTapChi(MaSoTC),
    MaChuyenMuc varchar(10) FOREIGN KEY REFERENCES ChuyenMuc(MaChuyenMuc),
    TieuDe nvarchar(200),
    TenBaiBao nvarchar(100),
	TenBaiBaoTiengAnh varchar(100),
	TomTat nvarchar(Max),
	TomTatTiengAnh varchar(Max),
    NgayXetDuyet date,
    NgayGui date,
    TuKhoa nvarchar(200),
	TuKhoaTiengAnh nvarchar(200),
    FileBaiViet varchar(255),
    TrangThai nvarchar(50)
);
-- Tạo bảng ChiTietBaiViet
CREATE TABLE ChiTietBaiViet (
    MaBaiBao char(10),
    MaNguoiDung varchar(10),
    MaLTacGia varchar(10),
    PRIMARY KEY (MaBaiBao, MaNguoiDung, MaLTacGia),
    FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao),
    FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung),
    FOREIGN KEY (MaLTacGia) REFERENCES LoaiTacGia(MaLTacGia)
);
GO
-- Tạo bảng ChiTietPhanBien
CREATE TABLE ChiTietPhanBien (
    MaBaiBao char(10),
    MaNguoiDung varchar(10),
    KetQuaPhanBien nvarchar(50),
    YKienPhanBien ntext,
    NgayPhanBien date,
    FilePhanBien varchar(255), -- Lưu trữ file phản biện dưới dạng dữ liệu nhị phân
    PRIMARY KEY (MaBaiBao, MaNguoiDung),
    FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao),
    FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung)
);
GO
-- Tạo bảng LichSuChonNguoiPhanBien
CREATE TABLE LichSuChonNguoiPhanBien (
    MaNguoiDung varchar(10),
    MaBaiBao char(10),
    TrangThai nvarchar(50),
    PRIMARY KEY (MaNguoiDung, MaBaiBao),
    FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung),
    FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao)
);
GO

---Insert dữ liệu
INSERT INTO NgonNgu (MaNgonNgu, TenNgonNgu) VALUES
('NN01', N'Tiếng Việt'),
('NN02', N'English')
go
INSERT INTO ChuyenMuc (MaChuyenMuc, TenChuyenMuc) VALUES
('CM01', N'KHOA HỌC - CÔNG NGHỆ'),
('CM02', N'QUẢN LÝ KINH TẾ')
INSERT INTO HocVi (MaHocVi, TenHocVi) VALUES
('HV01', N'Cử nhân'),
('HV02', N'Kỹ sư'),
('HV03', N'Thạc sĩ'),
('HV04', N'Tiến sĩ')
INSERT INTO HocHam (MaHocHam, TenHocHam) VALUES
('HH01', N'Giáo sư'),
('HH02', N'Phó giáo sư'),
('HH03', N'Tiến sĩ'),
('HH04', N'Thạc sĩ');

INSERT INTO VaiTro (MaVaiTro, TenVaiTro) VALUES
('VT01', N'Biên tập viên'),
('VT02', N'Tổng biên tập'),
('VT03', N'Tác giả'),
('VT04', N'Phản biện')
INSERT INTO ChuyenNganh (MaChuyenNganh, TenChuyenNganh) VALUES
('CN01', N'Công nghệ thông tin'),
('CN02', N'Y học'),
('CN03', N'Giáo dục'),
('CN04', N'Khoa học xã hội'),
('CN05', N'Văn hóa nghệ thuật');

-- Dữ liệu cho bảng DonVi
INSERT INTO DonVi (MaDonVi, TenDonVi) VALUES
('DV01', N'Trường Đại học'),
('DV02', N'Bệnh viện'),
('DV03', N'Trường Cao đẳng');

-- Dữ liệu cho bảng QuocGia
INSERT INTO QuocGia (MaQG, TenQG) VALUES
('VN', N'Việt Nam'),
('US', N'Hoa Kỳ');

INSERT INTO NguoiDung (MaNguoiDung, MaHocVi, MaHocHam, MaDonVi, MaChuyenNganh, MaQG, TenDangNhap, MatKhau, HoTen, Email, CCCD, SoDienThoai, DiaChi, GioiTinh) VALUES
('ND01', 'HV01', 'HH03', 'DV01', 'CN01', 'VN', 'user1', 'pass1', N'Nguyễn Văn A', 'a@example.com', '123456789012', '0123456789', N'Hà Nội', N'Nam'),
('ND02', 'HV02', 'HH01', 'DV02', 'CN02', 'VN', 'user2', 'pass2', N'Trần Thị B', 'b@example.com', '123456789013', '0123456788', N'Hồ Chí Minh', N'Nữ'),
('ND03', 'HV03', 'HH02', 'DV01', 'CN03', 'VN', 'user3', 'pass3', N'Lê Văn C', 'c@example.com', '123456789014', '0123456787', N'Đà Nẵng', N'Nam'),
('ND04', 'HV04', 'HH03', 'DV03', 'CN04', 'VN', 'user4', 'pass4', N'Phạm Thị D', 'd@example.com', '123456789015', '0123456786', N'Hải Phòng', N'Nữ'),
('ND05', 'HV01', 'HH02', 'DV01', 'CN05', 'VN', 'user5', 'pass5', N'Nguyễn Văn E', 'e@example.com', '123456789016', '0123456785', N'Cần Thơ', N'Nam');


INSERT INTO NguoiDung_VaiTro (MaNguoiDung, MaVaiTro) VALUES
('ND01', 'VT01'),  -- Nguyễn Văn A là Biên tập viên
('ND02', 'VT02'),  -- Trần Thị B là Tổng biên tập
('ND03', 'VT03'),  -- Lê Văn C là Tác giả
('ND03', 'VT04'),  -- Lê Văn C là Người phản biện
('ND05', 'VT04');  -- Nguyễn Văn E là Người phản biện

INSERT INTO LoaiTacGia (MaLTacGia, TenLoai) VALUES
('LTG01', N'Tác giả chính + Tác giả liên hệ'),
('LTG02', N'Hỗ trợ'),
('LTG03', N'Tác giả chính'),
('LTG04', N'Tác giả liên hệ'),
('LTG05', N'Thành viên'),
('LTG06', N'Thư ký');

