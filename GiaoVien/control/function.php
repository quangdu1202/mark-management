<?php
//session_start();
//$MaGV = $_SESSION['MaGV'];
////unset($_SESSION['selectedAssignment']);
//require "../Connection/Connection.php";
global $selectedAssignment;
$connect = new Connection();
$conn = $connect->connect();
?>

<?php
if (isset($_POST['generateMark'])) {
    //echo '<script>alert("Đã chọn khởi tạo dữ liệu")</script>';
//        $MaMonHocGen = $BangDiem['MaMonHoc'];
//        $MaHocKyGen = $BangDiem['MaHocKy'];
//        $queryGen = "select MaLopHoc from assignment where MaPhanCong='$selectedAssignment' && MaGV='$MaGV' && MaHocKy='$MaHocKyGen' && MaMonHoc='$MaMonHocGen'";
//        $resultGen = mysqli_query($conn,$queryGen);
//        $MaLopHocGen2 = mysqli_fetch_assoc($resultGen);
    $MaLopHocGen = $_SESSION['MaLop'];
    $MaHocKyGen = $_SESSION['MaHocKy'];
    $MaMonHocGen = $_SESSION['MaMonHoc'];

//        echo '<script>alert("'.$MaMonHocGen.'")</script>';
    $queryGetHS = "select MaHS from hocsinh where MaLopHoc='$MaLopHocGen'";
    $resultGetHS = mysqli_query($conn, $queryGetHS);
//        for($i = 0; $i < $rowMHS = mysqli_fetch_assoc($resultGetHS); $i++) {
//            echo $rowMHS['MaHS'];
//        }
    
    $preparedQuery = "insert into diem (MaHocKy, MaMonHoc, MaHS, MaLopHoc)  values";
//        $stmt = mysqli_prepare($conn, $preparedQuery);
//        if (!$stmt) {
//            echo '<script>alert("Welcome to Geeks for Geeks")</script>';
//            exit();
//        }
    for ($i = 0; $i < $rowMHS = mysqli_fetch_assoc($resultGetHS); $i++) {
        $preparedQuery .= "('" . $MaHocKyGen . "','" . $MaMonHocGen . "','" . $rowMHS['MaHS'] . "','" . $MaLopHocGen . "'),";
    }
    $preparedQuery = rtrim($preparedQuery, ",");
    //echo $preparedQuery;
    $resultGen = mysqli_query($conn, $preparedQuery);
    if (!$resultGen) {
        echo '<script>alert("Khởi tạo dữ liệu điểm không thành công.")</script>';
    }
    //header("Location: ".$_SERVER['PHP_SELF']);
    echo "<meta http-equiv='refresh' content='0'>";
    exit();
}
?>


<?php
if (isset($_POST['updateMark'])) {
//        $MaLopHocGen = $BangDiem['MaLopHoc'];
//        $MaDiems = $_POST['madiem']; // is an array containing the submitted values
//
//        foreach ($MaDiems as $MaDiem) {
//            echo $MaDiem . "<br>";
//        }
//        echo '<script>alert("'.$MaDiems.'")</script>';
//        echo '<script>alert("Đã chọn cập nhật điểm")</script>';
//        $newValues = array();
    $MaDiems = $_POST['madiem'];
    $DiemMiengs = $_POST['diem0'];
    $Diem15P1s = $_POST['diem1'];
    $Diem15P2s = $_POST['diem2'];
    $Diem1Tiets = $_POST['diem3'];
    $DiemGiuaKys = $_POST['diem4'];
    $DiemThis = $_POST['diem5'];

    $MaLop = $_SESSION['MaLop'];
    $MaHocKy = $_SESSION['MaHocKy'];
    $MaMon = $_SESSION['MaMonHoc'];


    $updateSuccess = true;
    $queryGetHS = "select MaHS from hocsinh where MaLopHoc='$MaLop'";
    $resultGetHS = mysqli_query($conn, $queryGetHS);
    for ($i = 0; $i < mysqli_num_rows($resultGetHS); $i++) {
//        if (!empty($DiemMiengs[$i]) && !empty($Diem15P1s[$i]) && !empty($Diem15P2s[$i]) && !empty($Diem1Tiets[$i]) && !empty($DiemGiuaKys[$i]) && !empty($DiemThis[$i])) {
////                echo $DiemMiengs[$i] + $Diem15P1s[$i];
//            $DiemTBx = ($DiemMiengs[$i] + $Diem15P1s[$i] + $Diem15P2s[$i] + $Diem1Tiets[$i] + $DiemGiuaKys[$i] * 2 + $DiemThis[$i] * 3) / 9;
//            $updateQuery = "update diem set DiemMieng = '$DiemMiengs[$i]',
//                                        Diem15Phut1 = '$Diem15P1s[$i]',
//                                        Diem15Phut2='$Diem15P2s[$i]',
//                                        Diem1Tiet='$Diem1Tiets[$i]',
//                                        DiemGiuaKi='$DiemGiuaKys[$i]',
//                                        DiemThi='$DiemThis[$i]',
//                                        DiemTB='$DiemTBx'
//                                where MaDiem='$MaDiems[$i]'";
//            $resultsUpdate = mysqli_query($conn, $updateQuery);
//            if (!$resultsUpdate) {
//                $updateSuccess = false;
//            }
//            } else {
//                $updateQuery = "update diem set DiemMieng = '$DiemMiengs[$i]',
//                                            Diem15Phut1 = '$Diem15P1s[$i]',
//                                            Diem15Phut2='$Diem15P2s[$i]',
//                                            Diem1Tiet='$Diem1Tiets[$i]',
//                                            DiemGiuaKi='$DiemGiuaKys[$i]',
//                                            DiemThi='$DiemThis[$i]',
//                                            DiemTB='-1'
//                                where MaDiem='$MaDiems[$i]'";
//                $resultsUpdate = mysqli_query($conn, $updateQuery);
////            $updateDTB = "update diem set DiemTB=(DiemMieng+Diem15Phut1+Diem15Phut2+Diem1Tiet+DiemGiuaKi*2+DiemThi*3)/9";
//            if (!$resultsUpdate) {
//                $updateSuccess = false;
//            }
//        }
        $updateQuery = "update diem set DiemMieng = '$DiemMiengs[$i]',
                                            Diem15Phut1 = '$Diem15P1s[$i]',
                                            Diem15Phut2='$Diem15P2s[$i]',
                                            Diem1Tiet='$Diem1Tiets[$i]',
                                            DiemGiuaKi='$DiemGiuaKys[$i]',
                                            DiemThi='$DiemThis[$i]',
                                            DiemTB=(DiemMieng+Diem15Phut1+Diem15Phut2+Diem1Tiet+DiemGiuaKi*2+DiemThi*3)/9
                                where MaDiem='$MaDiems[$i]'";
        $resultsUpdate = mysqli_query($conn, $updateQuery);
//            $updateDTB = "update diem set DiemTB=(DiemMieng+Diem15Phut1+Diem15Phut2+Diem1Tiet+DiemGiuaKi*2+DiemThi*3)/9";
        if (!$resultsUpdate) {
            $updateSuccess = false;
        }
    }

    if ($updateSuccess) {
        echo '<script>alert("Cập nhật điểm thành công, vui lòng chờ dữ liệu được làm mới!")</script>';
    }
    echo "<meta http-equiv='refresh' content='2'>";
    exit();
}
?>


<?php
if (isset($_POST['confirmLock'])) {
    $updateQuery = "update assignment set TrangThai = '0' where MaPhanCong='$selectedAssignment'";
    $resultsUpdate = mysqli_query($conn, $updateQuery);
    echo '<script>alert("Đã khoá chức năng nhập điểm!")</script>';
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php
if (isset($_POST['confirmUploadFile'])) {
    if ($_FILES['uploadedFile']['name']) {
        $filename = explode('.', $_FILES['uploadedFile']['name']);
        if ($filename[1] == 'csv') {
            $handle = fopen($_FILES['uploadedFile']['tmp_name'], 'r');
            $successfullUpdate = true;
            while ($data = fgetcsv($handle)) {
                $MaDiemx = mysqli_real_escape_string($conn, $data[0]);
                $MaHocKyx = mysqli_real_escape_string($conn, $data[1]);
                $MaMonHocx = mysqli_real_escape_string($conn, $data[2]);
                $MaHSx = mysqli_real_escape_string($conn, $data[3]);
                $MaLopHocx = mysqli_real_escape_string($conn, $data[4]);
                $DiemMiengx = mysqli_real_escape_string($conn, $data[5]);
                $Diem15P1x = mysqli_real_escape_string($conn, $data[6]);
                $Diem15P2x = mysqli_real_escape_string($conn, $data[7]);
                $Diem1Tietx = mysqli_real_escape_string($conn, $data[8]);
                $DiemGiuaKix = mysqli_real_escape_string($conn, $data[9]);
                $DiemThix = mysqli_real_escape_string($conn, $data[10]);
//                    $DiemTBx = mysqli_real_escape_string($conn, $data[11]);
//                    echo '<script>alert("'.$MaHocKy.' '.$MaMonHoc.' '.$MaHS.' '.$MaLopHoc.' '.$DiemMieng.' '.$Diem15P1.' '.$Diem15P2.' '.$Diem1Tiet.' '.$DiemGiuaKi.' '.$DiemThi.'")</script>';
                $sql_query = "update diem set DiemMieng='$DiemMiengx',
                                            Diem15Phut1='$Diem15P1x',
                                            Diem15Phut2='$Diem15P2x',
                                            Diem1Tiet='$Diem1Tietx',
                                            DiemGiuaKi='$DiemGiuaKix',
                                            DiemThi='$DiemThix'
                                            where MaDiem='$MaDiemx'";
//                    $sql_query = "update diem set DiemMieng='1',
//                                            Diem15Phut1='2',
//                                            Diem15Phut2='3',
//                                            Diem1Tiet='4',
//                                            DiemGiuaKi='5',
//                                            DiemThi='6'
//                                            where MaHocKy='12016' && MaMonHoc='A' && MaHS='100101' && MaLopHoc='10A1'";
                $executeQuery = mysqli_query($conn, $sql_query);
                if (!$executeQuery) {
                    $successfullUpdate = false;
                }
            }
            fclose($handle);
            if (!$successfullUpdate) {
                echo '<script>alert("Có lỗi trong quá trình tải điểm lên!")</script>';
                echo "<meta http-equiv='refresh' content='1'>";
                exit();
            } else {
                echo '<script>alert("Tải điểm lên thành công, vui lòng chờ dữ liệu được làm mới!")</script>';
                echo "<meta http-equiv='refresh' content='1'>";
                exit();
            }
        }
    } else {
        echo '<script>alert("Chưa chọn file tải lên!")</script>';
    }
}

?>

<?php
if (isset($_POST['unlockEdit'])) {
    //Thêm request đến admin
    $updateQuery = "update assignment set TrangThai = '2' where MaPhanCong='$selectedAssignment'";
    $resultsUpdate = mysqli_query($conn, $updateQuery);
    echo '<script>alert("Đã yêu cầu mở khoá chức năng sửa điểm, vui lòng chờ xét duyệt!")</script>';
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
