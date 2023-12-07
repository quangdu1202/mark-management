<?php
//session_start();
//$MaGV = $_SESSION['MaGV'];
////unset($_SESSION['selectedAssignment']);
//require "../Connection/Connection.php";
global $BangDiem;
$connect = new Connection();
$conn = $connect->connect();
?>

<?php
$query4 = "select * from diem, hocsinh, monhoc WHERE diem.MaHS=hocsinh.MaHS && diem.MaMonHoc=monhoc.MaMonHoc";
$results4 = mysqli_query($conn, $query4);
$hasRow = false;
$STT = 1;
for ($i = 0; $i < ($row = mysqli_fetch_assoc($results4)); $i++) {
    if ($row['MaLopHoc'] == $BangDiem['MaLopHoc'] && $row['MaMonHoc'] == $BangDiem['MaMonHoc'] &&
        $row['MaHocKy'] == $BangDiem['MaHocKy']) {
        $hasRow = true;
        echo '<tr>';
        echo '<td class="mark-info" style="font-weight: bold">' . ($STT) . '</td>';
        $STT++;
        echo '<td><input class="mark-info" style="width:55px" name="madiem[]" value="' . $row['MaDiem'] . '" readonly="readonly"/></td>';
        echo '<td><input class="mark-info" style="width:90px" type="text" name="mahocsinh[]" value="' . $row['MaHS'] . '" readonly="readonly"/></td>';
        echo '<td><input class="mark-info" style="width:150px; text-align: left; margin: 0 10px" type="text" name="hodem[]" value="' . $row['HoDem'] . '" readonly="readonly"/></td>';
        echo '<td><input class="mark-info" style="width:70px; text-align: left; margin: 0 10px" type="text" name="ten[]" value="' . $row['TenHS'] . '" readonly="readonly"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem0[]" 
                                value="' . ($row['DiemMieng'] == 0 ? '' : $row['DiemMieng']) . '"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px;" type="number" step="0.01" name="diem1[]"
                                value="' . ($row['Diem15Phut1'] == 0 ? '' : $row['Diem15Phut1']) . '"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem2[]" 
                                value="' . ($row['Diem15Phut2'] == 0 ? '' : $row['Diem15Phut2']) . '"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem3[]" 
                                value="' . ($row['Diem1Tiet'] == 0 ? '' : $row['Diem1Tiet']) . '"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem4[]" 
                                value="' . ($row['DiemGiuaKi'] == 0 ? '' : $row['DiemGiuaKi']) . '"/></td>';
        echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem5[]" 
                                value="' . ($row['DiemThi'] == 0 ? '' : $row['DiemThi']) . '"/></td>';
        echo '<td style="background: #ffe5ff"><input style="width:90px" type="number" class="final-mark" step="0.01" name="diem6[]" value="' . ($row['DiemTB'] == -1 ? '' : round($row['DiemTB'], 1)) . '" readonly="readonly"/></td>';
        echo '</tr>';
    }
}
if (!$hasRow) {
    echo '<tr>';
    echo '<td colspan="13" style="text-align: center">Chưa có dữ liệu điểm cho tổ hợp đã chọn!' .
        '<form action="UpdateClassMark.php" method="post">
                               <button class="control-button" name="generateMark" type="submit">Khởi tạo dữ liệu<i style="margin-left: 7px" class="fas fa-sync"></i></button>
                              </form>' .
        '</td>';
    echo '</tr>';
}
?>