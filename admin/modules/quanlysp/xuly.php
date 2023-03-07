<?php
include('../../config/config.php');

$tensanpham = $_POST['tensanpham'];
$masp = time() . mt_rand(0, 999);
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
// Handle images
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$image = time() . '_' . $hinhanh;
$giamgia = $_POST['giamgia'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$trangthai = $_POST['trangthai'];
$noibat = $_POST['noibat'];
$danhmuc = $_POST['danhmuc'];

if (isset($_POST['themsanpham'])) {
    // Them
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, soluong, hinhanh, giamgia, tomtat, noidung, trangthaisp, noibat, id_danhmuc, created_time, last_updated) 
    VALUE('" . $tensanpham . "','" . $masp . "','" . $giasp . "','" . $soluong . "','" . $image . "','" . $giamgia . "','" . $tomtat . "','" . $noidung . "',
    '" . $trangthai . "','" . $noibat . "','" . $danhmuc . "','" . time() . "','" . time() . "')";
    mysqli_query($mysqli, $sql_them);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $image);
    header('Location:../../index.php?action=quanlysanpham&query=lietke');
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
    $id = $_GET['idsanpham'];
    // Xoa hinh anh
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlysanpham&query=them');
}
