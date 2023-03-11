<?php
include('../../config/config.php');

if (isset($_POST['themsanpham'])) {
} else if (isset($_POST['suasanpham'])) {
    if ($hinhanh != '') {
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        // Sua
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "',masp='" . $masp . "',giasp='" . $giasp . "',
        soluong='" . $soluong . "',hinhanh='" . $hinhanh . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',trangthai='" . $trangthai . "',id_danhmuc='" . $danhmuc . "'  
        WHERE id_sanpham='$_GET[idsanpham]' ";
        // Xoa hinh anh
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }
    } else {
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "',masp='" . $masp . "',giasp='" . $giasp . "',
        soluong='" . $soluong . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',trangthai='" . $trangthai . "',id_danhmuc='" . $danhmuc . "'  
        WHERE id_sanpham='$_GET[idsanpham]' ";
    }

    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlysanpham&query=them');
} else {
}
