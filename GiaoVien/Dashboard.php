<?php
session_start();
require "./control/log-out.php";
require "./control/check-user.php";
unset($_SESSION['selectedAssignment']);
//echo '<script>alert("'.$_SESSION['selectedAssignment'].'")</script>';
$MaGV = $_SESSION['MaGV'];
require "../Connection/Connection.php";
$connect = new Connection();
$conn = $connect->connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="./css/Dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>GV Dashboard</title>
    <style type="text/css">
    </style>

</head>
<body>
<header style="height: 230px; text-align: center">
    <img src="../assets/img/logo.png" alt="" height="230px">
</header>

<div>
<!--    <div style="margin: 15px 77px; display:flex; justify-content: space-between; height: 50px; align-items: center">-->
    <div style="margin: 15px 77px; display:flex; justify-content: space-between; height: 50px; align-items: center">
        <?php
        $query = "select * from giaovien where MaGV = '$MaGV'";
        $results = mysqli_query($conn, $query);
        $ThongTinGV = mysqli_fetch_assoc($results);
        echo '
                <div class="user-info"><i class="fas fa-user" style="margin-right: 7px"></i>' . $ThongTinGV['MaGV'] . ' | <span style="font-style: italic">' . $ThongTinGV['TenGV'] . '</span>' . '</div>
                ';
        ?>
        <div id="dashboard-title">DANH SÁCH CÁC LỚP ĐƯỢC PHÂN CÔNG</div>
        <form method="post">
            <button type="submit" class="logout-button" name="logout">Đăng xuất <i class="fas fa-sign-out-alt" style="margin-left: 5px"></i></button>
        </form>
    </div>
    <hr>
    <form action="Dashboard.php" method="post">
        <div style="text-align:center; margin: 15px">
            <select name="filter-malop" style="width: 100px">
                <option value="">Lớp</option>
                <?php
                $query9 = "select * from assignment where MaGV='$MaGV' group by MaLopHoc";
                $results9 = mysqli_query($conn, $query9);
                while ($data = mysqli_fetch_assoc($results9)) {
                    if ($data['MaLopHoc'] == $_POST['filter-malop']) {
                        echo '<option value="' . $data['MaLopHoc'] . '" selected>' . $data['MaLopHoc'] . '</option>';
                    } else {
                        echo '<option value="' . $data['MaLopHoc'] . '">' . $data['MaLopHoc'] . '</option>';
                    }
                }
                ?>
            </select>
            <select name="filter-mamon" id="filter-mamon" style="width: 200px">
                <option value="">Môn Học</option>
                <?php
                $query8 = "select * from assignment,monhoc where assignment.MaMonHoc=monhoc.MaMonHoc && assignment.MaGV='$MaGV' group by monhoc.MaMonHoc";
                $results8 = mysqli_query($conn, $query8);
                while ($data2 = mysqli_fetch_assoc($results8)) {
                    if ($data2['MaMonHoc'] == $_POST['filter-mamon']) {
                        echo '<option value="' . $data2['MaMonHoc'] . '" selected>' . $data2['TenMonHoc'] . '</option>';
                    } else {
                        echo '<option value="' . $data2['MaMonHoc'] . '">' . $data2['TenMonHoc'] . '</option>';
                    }
                }
                ?>
            </select>
            <select name="filter-mahocky" style="width: 130px">
                <option value="">Học Kỳ</option>
                <?php
                $query7 = "select * from hocky";
                $results7 = mysqli_query($conn, $query7);
                while ($data3 = mysqli_fetch_assoc($results7)) {
                    if ($data3['MaHocKy'] == $_POST['filter-mahocky']) {
                        echo '<option value="' . $data3['MaHocKy'] . '" selected>' . $data3['TenHocKy'] . '</option>';
                    } else {
                        echo '<option value="' . $data3['MaHocKy'] . '">' . $data3['TenHocKy'] . '</option>';
                    }
                }
                ?>
            </select>
            <button type="submit" id="filter-select" name="filter" style="height: 30px; cursor: pointer; margin-left: 5px;padding: 0 10px 0 10px;"><i
                        class="fas fa-filter" style="margin-right: 5px"></i>Lọc
            </button>
        </div>
    </form>
    <div class="content">
        <form action="UpdateClassMark.php" method="post">
            <table class="styled-table" border="1" cellspacing="0" cellpadding="1">
                <thead style="font-weight: bold">
                <tr>
                    <th style="width:120px">Mã Phân Công</th>
                    <th style="width:100px">Mã Học Kỳ</th>
                    <th style="width:110px">Học Kỳ</th>
                    <th style="width:90px">Mã Môn Học</th>
                    <th style="width:170px">Tên Môn Học</th>
                    <th style="width:90px">Mã Lớp</th>
                    <th style="width:100px">Tên Lớp</th>
                    <th style="width:120px">Số Lượng HS</th>
                    <th style="width:150px">Trạng Thái</th>
                    <th style="width:100px">Chọn</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $query2 = "select * from assignment, giaovien, monhoc, lophoc, hocky where assignment.MaGV=giaovien.MaGV && assignment.MaMonHoc=monhoc.MaMonHoc && assignment.MaLopHoc=lophoc.MaLopHoc && assignment.MaHocKy=hocky.MaHocKy";

                if (isset($_POST['filter'])) {
                    $selectedMaLop = $_POST['filter-malop'];
                    $selectedMaMon = $_POST['filter-mamon'];
                    $selectedMaHocKy = $_POST['filter-mahocky'];

                    if (empty($selectedMaLop)) {
                        //echo '<script>alert("Mã lớp trống!")</script>';
                    } else {
                        $query2 .= " && assignment.MaLopHoc='$selectedMaLop'";
                    }

                    if (empty($selectedMaMon)) {
                        //echo '<script>alert("Mã lớp trống!")</script>';
                    } else {
                        $query2 .= " && assignment.MaMonHoc='$selectedMaMon'";
                    }

                    if (empty($selectedMaHocKy)) {
                        //echo '<script>alert("Mã lớp trống!")</script>';
                    } else {
                        $query2 .= " && assignment.MaHocKy='$selectedMaHocKy'";
                    }
                }

                $results2 = mysqli_query($conn, $query2);
                $hasRow = false;
                //                if(mysqli_num_rows($results2) == 1) {
                //                    $row=mysqli_fetch_assoc($results2);
                //                    $_SESSION['MaPhanCong'] = $row['MaPhanCong'];
                //                    header("Location: UpdateClassMark.php");
                //                }else {
                for ($i = 1; $i <= ($row = mysqli_fetch_assoc($results2)); $i++) {
                    if ($row['MaGV'] == $MaGV) {
                        $hasRow = true;
                        echo '<tr>';
                        echo '<td><input style="width:90px" name="maphancong" value="' . $row['MaPhanCong'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:50px" type="text" name="mahocky" value="' . $row['MaHocKy'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:90px" type="text" name="tenhocky" value="' . $row['TenHocKy'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:90px" type="text" name="mamonhoc" value="' . $row['MaMonHoc'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:170px" class="mark" type="text" name="tenmonhoc" value="' . $row['TenMonHoc'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:90px" class="mark" type="text" name="malop" value="' . $row['MaLopHoc'] . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:90px" class="mark" type="text" name="tenlop" value="' . $row['TenLop'] . '" readonly="readonly"/></td>';
                        $query3 = "select count(*) as 'SoLuong' from hocsinh where hocsinh.MaLopHoc = '" . $row['MaLopHoc'] . "'";
                        $results3 = mysqli_query($conn, $query3);
                        $SoLuongHS = mysqli_fetch_assoc($results3);
                        echo '<td><input style="width:70px" class="mark" type="text" name="soluonghs" value="' . $SoLuongHS['SoLuong'] . '" readonly="readonly"/></td>';
//                        echo '<td><input style="width:150px; font-weight: bold" class="status" type="text" name="trangthai" value="' . (($row['TrangThai'] == 0 ? 'Đã khoá' : $row['TrangThai'] == 1) ? 'Mở' : 'Access requested') . '" readonly="readonly"/></td>';
                        echo '<td><input style="width:150px; font-weight: bold" class="status" type="text" name="trangthai" value="' . ($row['TrangThai'] == 0 ? 'Đã khoá' : ($row['TrangThai'] == 1 ? 'Mở' : 'Access requested')) . '" readonly="readonly"/></td>';
                        echo '<td style="padding: 0; white-space: nowrap;"><button id="select-button" type="submit" name="' . $row['MaPhanCong'] . '"><i class="fas fa-chevron-circle-right"></i></button></td>';
                        echo '</tr>';
                    }
                }
                if (!$hasRow) {
                    echo '<tr>';
                    echo '<td colspan="13" style="text-align: center">Không có kết quả</td>';
                    echo '</tr>';
                }
                //                }
                ?>
                </tbody>
            </table>
            <hr>
        </form>
    </div>
    <div class="footer" style="margin: auto; text-align: center; width: 100%">
        <p>Copyright &copy; HaUI 2023 Nhóm 10 PHP (Quang - Đức - Kiều)</p>
    </div>
</body>
