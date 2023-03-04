<?php
$sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky ORDER BY tbl_cart.id_cart ASC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<style>
table,
th,
td {
    border: 1px solid black;
}
</style>

<p>Liệt kê đơn hàng</p>
<table width="100%">
    <tr>
        <th>Id</th>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Địa chỉ</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Tình trạng</th>
        <th>Quản lý</th>
    </tr>
    <?php
    $i = 1;
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['code_cart'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['diachi'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td>
            <?php
                if ($row['cart_status'] == 1) {
                    echo '<a href="modules/quanlydonhang/xuly.php?&code=' . $row['code_cart'] . '">Đơn hàng mới</a>';
                } else {
                    echo '<a>Đã xem</a>';
                }
                ?>
        </td>
        <td>
            <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart'] ?>">Xem đơn hàng</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>