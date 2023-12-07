<?php
global $BangDiem, $selectedAssignment;
//session_start();
//$MaGV = $_SESSION['MaGV'];
////unset($_SESSION['selectedAssignment']);
//require "../Connection/Connection.php";
$connect = new Connection();
$conn = $connect->connect();
?>

<?php
$query = "select * from giaovien where MaGV = 'gv1'";
$results = mysqli_query($conn, $query);
$ThongTinGV = mysqli_fetch_assoc($results);

$query2 = "select * from assignment, lophoc, monhoc, hocky where assignment.MaLopHoc=lophoc.MaLopHoc && monhoc.MaMonHoc=assignment.MaMonHoc && assignment.MaHocKy=hocky.MaHocKy && assignment.MaPhanCong='$selectedAssignment'";
$results2 = mysqli_query($conn, $query2);
$BangDiem = mysqli_fetch_assoc($results2);

$_SESSION['MaLop'] = $BangDiem['MaLopHoc'];
$_SESSION['MaHocKy'] = $BangDiem['MaHocKy'];
$_SESSION['MaMonHoc'] = $BangDiem['MaMonHoc'];

echo '
            <div id="assignment-info">
                <span class="assignment-info" style="padding: 0 10px; color: red">Mã phân công: ' . $BangDiem['MaPhanCong'] . '</span>
                <span class="assignment-info" style="padding: 0 10px; color: #009879">' . $BangDiem['TenLop'] . '</span>
                <span class="assignment-info" style="padding: 0 10px; color: #009879">' . $BangDiem['TenMonHoc'] . '</span>
                <span class="assignment-info" style="padding: 0 10px; color: #009879; border: none">' . $BangDiem['TenHocKy'] . '</span>
            </div>
            ';
?>