<?php
session_start();
$MaGV = $_SESSION['MaGV'];
$selectedAssignment = $_SESSION['selectedAssignment'];

$MaLop = $_SESSION['MaLop'];
$MaHocKy = $_SESSION['MaHocKy'];
$MaMon = $_SESSION['MaMonHoc'];

//unset($_SESSION['selectedAssignment']);
require "../Connection/Connection.php";
$connect = new Connection();
$conn = $connect->connect();

if (isset($_POST['downloadFile'])) {
    $select = "select * from diem where MaLopHoc='$MaLop' && MaMonHoc='$MaMon' && MaHocKy='$MaHocKy'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        $separator = ",";
        $filename = "markData_" . date('Y-m-d') . ".csv";
        // Set header content-type to CSV and filename
        header('Content-Encoding: UTF-8');
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        echo "\xEF\xBB\xBF"; // UTF-8 BOM - by Daniel Magliola/https://stackoverflow.com/questions/4348802/how-can-i-output-a-utf-8-csv-in-php-that-excel-will-read-properly
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        //set CSV column headers
        $fields = array('Mã điểm', 'Ma Hoc ki', 'Ma Mon hoc', 'Ma Hoc sinh', 'Ma lop', 'Diem mieng', 'Diem 15p1', 'Diem 15p2', 'Diem 1 tiet', 'Diem giua ki', 'Diem thi', 'DTB');
        fputcsv($output, $fields, $separator);
        while ($rowx = mysqli_fetch_assoc($result)) {
            $lineData = array($rowx['MaDiem'], $rowx['MaHocKy'], $rowx['MaMonHoc'], $rowx['MaHS'], $rowx['MaLopHoc'], $rowx['DiemMieng'], $rowx['Diem15Phut1'], $rowx['Diem15Phut2'], $rowx['Diem1Tiet'], $rowx['DiemGiuaKi'], $rowx['DiemThi']);
            fputcsv($output, $lineData, $separator);
        }
        fclose($output);
        exit();
    }
}
?>