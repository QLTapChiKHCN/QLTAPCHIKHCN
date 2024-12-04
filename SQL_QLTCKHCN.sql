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
    AnhBia nvarchar(200),
    AnhBiaLocal nvarchar(200),
    NgayXuatBan date,
	TrangThai bit
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
   TenChuyenNganh nvarchar(50)
);
Go
CREATE TABLE DonVi(
	MaDonVi varchar(10) primary key,
	TenDonVi nvarchar(50)
	);
Go
CREATE TABLE QuocGia(
	MaQG varchar(10) primary key,
	TenQG nvarchar(50)
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
    TenBaiBao nvarchar(300),
	TenBaiBaoTiengAnh varchar(300),
	TomTat nvarchar(Max),
	TomTatTiengAnh varchar(Max),
    NgayXetDuyet date,
    NgayGui date,
    TuKhoa nvarchar(200),
	TuKhoaTiengAnh nvarchar(200),
    FileBaiViet nvarchar(255),
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
    MaChiTietPhanBien INT IDENTITY(1,1) PRIMARY KEY,
    MaBaiBao char(10),
    MaNguoiDung varchar(10),
    KetQuaPhanBien nvarchar(50),
    YKienPhanBien ntext,
    NgayNhan date,
    NgayHetHan date,
    NgayTraKetQua date null,
    FilePhanBien varchar(255),
    FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao),
    FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung)
);
CREATE TABLE LichSuSoDuyetBaiViet(
	MaBaiBao char(10),
	MaNguoiDung varchar(10),
	NgayGuiYeuCau date,
	NgayChinhSua date,
	NoiDungChinhSua nvarchar(500),
	PRIMARY KEY(MaBaiBao, MaNguoiDung, NgayGuiYeuCau),
	FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao),
	FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung)
)
Go
CREATE TABLE PhanHoi(
	MaBaiBao char(10),
	MaNguoiDung varchar(10),
	NgayGui date,
	NoiDung nvarchar(500),
	FileBienSoan varchar(255),
	PRIMARY KEY(MaBaiBao, MaNguoiDung, NgayGui),
	FOREIGN KEY (MaBaiBao) REFERENCES BaiViet(MaBaiBao),
	FOREIGN KEY (MaNguoiDung) REFERENCES NguoiDung(MaNguoiDung)
	)
Go
-- Tạo bảng LichSuChonNguoiPhanBien
CREATE TABLE LichSuChonNguoiPhanBien (
    MaLichSuChonPhanBien INT IDENTITY(1,1) PRIMARY KEY,
    MaNguoiDung varchar(10),
    MaBaiBao char(10),
    NgayGuiYeuCau date,
    TrangThai nvarchar(50),
    TrangThaiTBT nvarchar(50),
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
('HH02', N'Phó giáo sư');

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
('ND01', 'HV01', 'HH02', 'DV01', 'CN01', 'VN', 'user1', 'a722c63db8ec8625af6cf71cb8c2d939', N'Nguyễn Văn A', 'a@example.com', '123456789012', '0123456789', N'Hà Nội', N'Nam'),
('ND02', 'HV02', 'HH01', 'DV02', 'CN02', 'VN', 'user2', 'c1572d05424d0ecb2a65ec6a82aeacbf', N'Trần Thị B', 'b@example.com', '123456789013', '0123456788', N'Hồ Chí Minh', N'Nữ'),
('ND03', 'HV03', 'HH02', 'DV01', 'CN03', 'VN', 'user3', '$2y$10$9avnS2fYg7YHsFGcmq/5yOp72dSi3ty8Tfe02ETjog286rugZxWE', N'Lê Văn C', 'c@example.com', '123456789014', '0123456787', N'Đà Nẵng', N'Nam'),
('ND04', 'HV04', 'HH01', 'DV03', 'CN04', 'VN', 'user4', '$2y$10$9avnS2fYg7YHsFGcmq/5yOp72dSi3ty8Tfe02ETjog286rugZxWE', N'Phạm Thị D', 'd@example.com', '123456789015', '0123456786', N'Hải Phòng', N'Nữ'),
('ND05', 'HV01', 'HH02', 'DV01', 'CN05', 'VN', 'user5', '$2y$10$9avnS2fYg7YHsFGcmq/5yOp72dSi3ty8Tfe02ETjog286rugZxWE', N'Nguyễn Văn E', 'e@example.com', '123456789016', '0123456785', N'Cần Thơ', N'Nam');


INSERT INTO NguoiDung_VaiTro (MaNguoiDung, MaVaiTro) VALUES
('ND01', 'VT01'),  -- Nguyễn Văn A là Biên tập viên
('ND02', 'VT02'),  -- Trần Thị B là Tổng biên tập
('ND03', 'VT03'),  -- Lê Văn C là Tác giả
('ND03', 'VT04'),  -- Lê Văn C là Người phản biện
('ND05', 'VT04'),  -- Nguyễn Văn E là Người phản biện
('ND05', 'VT03'),
('ND04', 'VT03'),
('ND04', 'VT04');

INSERT INTO LoaiTacGia (MaLTacGia, TenLoai) VALUES
('LTG01', N'Tác giả chính + Tác giả liên hệ'),
('LTG02', N'Hỗ trợ'),
('LTG03', N'Tác giả chính'),
('LTG04', N'Tác giả liên hệ'),
('LTG05', N'Thành viên'),
('LTG06', N'Thư ký');

--fake data
-- Thêm dữ liệu vào bảng BaiViet

-- Thêm 5 bản ghi vào bảng BaiViet
INSERT INTO BaiViet (MaBaiBao, MaNgonNgu, MaSoTC, MaChuyenMuc, TieuDe, TenBaiBao, TenBaiBaoTiengAnh, TomTat, TomTatTiengAnh, NgayXetDuyet, NgayGui, TuKhoa, TuKhoaTiengAnh, FileBaiViet, TrangThai)
VALUES 
('B001', 'NN02',
'OPERATION OF FLYING-CAPACITOR MODULAR MULTILEVEL CONVERTER WITH FOUR-WINDING COUPLED INDUCTORS',
'CM01', N'Tiêu đề bài báo 1', null, 
'OPERATION OF FLYING-CAPACITOR MODULAR MULTILEVEL CONVERTER WITH FOUR-WINDING COUPLED INDUCTORS', 
N'Trong bài báo này, cuộn cảm kết nối với bốn cuộn dây cho bộ biến đổi đa bậc cấu hình mô-đun tụ điện bay (FC-MMC) đã được đề xuất để giảm thể tích và trọng lượng của thành phần từ tính. Trong FC-MMC thông thường, cần phải lắp ráp bốn cuộn cảm rời rạc cho một pha. Tuy nhiên, bốn cuộn cảm này có thể được thay thế bằng cách thiết kế một cuộn cảm kết nối với bốn cuộn dây. Bằng cách này, thể tích của lõi từ có thể giảm lần lượt là 47,3% và 8,2% so với các cuộn cảm rời rạc và cuộn cảm kết nối hai cuộn dây. Tính khả thi của phương pháp đề xuất đã được xác minh bằng kết quả mô phỏng cho hệ thống truyền động động cơ 4160-V/1-MW với cuộn cảm kết nối được sử dụng trong cấu hình của FC-MMC.', 
null, null, '2024-09-29', null, 'Coupled inductor, flying-capacitor modular multilevel converters, medium-voltage motor drive', 
N'1_2023030029.R1_four-winding_8p_3-10.pdf', N'Đang duyệt')

-- Thêm 5 bản ghi vào bảng ChiTietBaiViet
INSERT INTO ChiTietBaiViet (MaBaiBao, MaNguoiDung, MaLTacGia)
VALUES 
('B001', 'ND03', 'LTG01'),
('B001', 'ND02', 'LTG02'),
('B002', 'ND03', 'LTG03'),
('B003', 'ND04', 'LTG04'),
('B004', 'ND05', 'LTG05');

-- Thêm 5 bản ghi vào bảng ChiTietPhanBien
INSERT INTO ChiTietPhanBien (MaBaiBao, MaNguoiDung, KetQuaPhanBien, YKienPhanBien, NgayNhan, NgayTraKetQua, FilePhanBien)
VALUES 
('B001', 'ND01', null, null, '2024-10-30', null, 'review1.pdf'),
('B002', 'ND02',null, null, '2024-10-30', null, 'review2.pdf'),
('B003', 'ND03', null, null, '2024-10-29', null, 'review3.pdf'),
('B004', 'ND04', null, null, '2024-10-28', null, 'review4.pdf'),
('B005', 'ND05', null, null, '2024-10-29', null, 'review5.pdf');

select * from LichSuChonNguoiPhanBien

-- Thêm 5 bản ghi vào bảng LichSuChonNguoiPhanBien
INSERT INTO LichSuChonNguoiPhanBien (MaNguoiDung, MaBaiBao, NgayGuiYeuCau, TrangThai)
VALUES 
('ND01', 'B003', '2024-10-30', N'Chờ phản hồi'),
('ND02', 'B003', '2024-10-10', N'Chấp nhận'),
('ND03', 'B003', '2024-10-03', N'Từ chối'),
('ND04', 'B004', '2024-10-04', N'Chờ phản hồi'),
('ND05', 'B005', '2024-10-05', N'Chờ phản hồi');

-- trigger cập nhật ngày hết hạn
CREATE TRIGGER trg_SetNgayHetHan
ON ChiTietPhanBien
AFTER INSERT, UPDATE
AS
BEGIN
    UPDATE cp
    SET NgayHetHan = DATEADD(DAY, 10, i.NgayNhan)
    FROM ChiTietPhanBien cp
    JOIN inserted i ON cp.MaBaiBao = i.MaBaiBao AND cp.MaNguoiDung = i.MaNguoiDung
    WHERE i.NgayNhan IS NOT NULL;
END;
GO

-- Trigger cập nhật trạng thái nếu phản biện không trl 
CREATE TRIGGER trg_UpdateTrangThai
ON LichSuChonNguoiPhanBien
AFTER INSERT, UPDATE
AS
BEGIN
    -- Cập nhật TrangThai thành "Từ chối" nếu quá 3 ngày và vẫn là "Chờ phản hồi"
    UPDATE LichSuChonNguoiPhanBien
    SET TrangThai = N'Từ chối'
    WHERE TrangThai = N'Chờ phản hồi' 
      AND DATEDIFF(DAY, NgayGuiYeuCau, GETDATE()) > 3;
END;
GO

--trigger từ chối bài viết nếu quá hạn chỉnh sửa
CREATE OR ALTER TRIGGER trg_TuChoiBaiVietQuaHan
ON LichSuSoDuyetBaiViet
AFTER INSERT, UPDATE
AS
BEGIN
    -- Cập nhật trạng thái bài viết thành "Từ chối" 
    UPDATE BaiViet
    SET TrangThai = N'Từ chối'
    FROM BaiViet bv
    INNER JOIN LichSuSoDuyetBaiViet ls ON bv.MaBaiBao = ls.MaBaiBao
    WHERE 
        DATEDIFF(DAY, ls.NgayGuiYeuCau, GETDATE()) > 5  -- Quá 5 ngày từ ngày yêu cầu
        AND (
            ls.NgayChinhSua IS NULL  -- Chưa chỉnh sửa
            OR ls.NgayChinhSua < ls.NgayGuiYeuCau  -- Hoặc ngày chỉnh sửa cũ hơn ngày yêu cầu
        )
        AND bv.TrangThai = N'Chỉnh sửa';
END;
go

--trigger đồng ý duyệt phản biện nếu quá 3 ngày chưa 
CREATE OR ALTER TRIGGER trg_DongYDuyetPhanBien_TBT
ON LichSuChonNguoiPhanBien
AFTER INSERT, UPDATE
AS
BEGIN
    -- Cập nhật trạng thái bên lịch sử chọn người phản biện TrangThaiTBT thành đồng ý 
    UPDATE LichSuChonNguoiPhanBien
    SET TrangThaiTBT = N'Đồng ý'
    FROM LichSuChonNguoiPhanBien ls
    WHERE 
        DATEDIFF(DAY, ls.NgayGuiYeuCau, GETDATE()) > 3  -- Quá 3 ngày từ ngày yêu cầu
        AND ls.TrangThaiTBT IS NULL  -- Chưa duyệt
END;

select * from baiviet
select * from ChiTietBaiViet
select * from chitietphanbien
select * from LichSuChonNguoiPhanBien
select * from LichSuSoDuyetBaiViet
select * from PhanHoi
select * from sotapchi
select * from VaiTro
select * from NguoiDung_VaiTro
select * from NguoiDung


delete baiviet
delete ChiTietBaiViet
