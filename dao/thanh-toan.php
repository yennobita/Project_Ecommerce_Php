<?php
function hoa_don_insert($ma_kh, $dia_chi, $ho_ten, $so_dien_thoai, $total, $ghi_chu, $trang_thai, $ngay_tao, $ngay_hoan_thanh)
{
    //INSERT INTO chèn 1 bản dữ liệu mới
    $sql = "INSERT INTO hoa_don(ma_kh,ho_ten,dia_chi,so_dien_thoai,total,ghi_chu,trang_thai,ngay_tao,ngay_hoan_thanh) VALUES(?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql, $ma_kh, $ho_ten, $dia_chi, $so_dien_thoai, $total, $ghi_chu, $trang_thai, $ngay_tao, $ngay_hoan_thanh);
    return true;
}
function hoa_don_chi_tiet_insert($don_gia, $size, $so_luong, $ma_hd, $ma_hh)
{
    $sql = "INSERT INTO hoa_don_chi_tiet(don_gia,size,so_luong,ma_hd,ma_hh) VALUES(?,?,?,?,?)";
    pdo_execute($sql, $don_gia, $size, $so_luong, $ma_hd, $ma_hh);
    return true;
}

function hoa_don_update($trang_thai, $ma_hd)
{
    $sql = "UPDATE hoa_don SET trang_thai=? WHERE ma_hd=? LIMIT 1"; // litmit cập nhật 1 bản ghi duy nhất nếu where thỏa mãn
    pdo_execute($sql, $trang_thai, $ma_hd);
}

function hoa_don_select_by_id($ma_kh)
{
    $sql = "SELECT * FROM hoa_don WHERE ma_kh =?";
    return pdo_query_one($sql, $ma_kh);//pdo_query_one truy vấn SQL và trả về một bản ghi duy nhất từ kết quả truy vấn
}
function hoa_don_chi_tiet_select_by_id($ma_hdct)
{
    $sql = "SELECT * FROM hoa_don_chi_tiet WHERE ma_hdct =?";
    return pdo_query_one($sql, $ma_hdct);
}

function hoa_don_select_all()
{
    $sql = "SELECT * FROM hoa_don";
    return pdo_query($sql);
}

function hoadonchitiet_select($ma_hd)
{
    $sql = "SELECT * FROM hoa_don_chi_tiet WHERE ma_hd =?";
    return pdo_query_one($sql, $ma_hd);
}

function hoa_don_chi_tiet_delete($ma_hd)
{
    $sql = "DELETE FROM hoa_don_chi_tiet WHERE ma_hd=?";
    if (is_array($ma_hd)) {
        foreach ($ma_hd as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $ma_hd);
    }
}

function hoa_don_delete($ma_hd)
{
    $sql = "DELETE FROM hoa_don WHERE ma_hd=?";
    if (is_array($ma_hd)) {
        foreach ($ma_hd as $ma) {
            pdo_execute($sql, $ma);
            hoa_don_chi_tiet_delete($ma_hd);
        }
    } else {
        pdo_execute($sql, $ma_hd);
        hoa_don_chi_tiet_delete($ma_hd);
    }
}
