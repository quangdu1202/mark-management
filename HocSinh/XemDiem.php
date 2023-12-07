<?php
session_start();
$MaHS = $_SESSION['MaHS'];
require "../Connection/Connection.php";
$connect = new Connection();
$conn = $connect->connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>XEM ĐIỂM</title>
    <style type="text/css">
        td, th {
            padding: 5px;
            text-align: center;
        }

        #student-info {
            margin: auto;
            width: 650px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            line-height: 30px;
            border-radius: 20px;
            padding: 7px 15px;
            background-color: whitesmoke;
        }

        .student-info {
            border-right: 2px solid black;
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
        }

        td, th {
            padding: 5px;
            text-align: center;
        }

        input {
            margin: 0;
            text-align: center;
            font-size: 12pt;
            background-color: transparent;
            border: none;
            outline: none;
            font-weight: 500;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .table-wrapper {
            text-align: center;
        }

        .styled-table {
            border-collapse: collapse;
            margin: auto;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead {
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
            border: 1px solid black;
        }

        .mark-cell {
            padding: 0 !important;
        }

        .mark {
            line-height: 45px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:nth-of-type(odd) {
            background-color: white;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr:hover .mark-info {
            font-weight: bold;
            color: mediumvioletred;
        }

        .control-button {
            border: none;
            background: darkred;
            border-radius: 42px;
            display: inline-block;
            cursor: pointer;
            color: #ffffff;
            font-size: 17px;
            font-weight: bold;
            padding: 13px 34px;
            margin: auto;
            text-decoration: none;
            text-shadow: 0px 0px 0px #2f6627;
            position: sticky;
            bottom: 15px;
            z-index: 100;
            transition: transform 0.2s;
        }

        .control-button:hover {
            transform: scale(1.05);
        }

        @media print {
            header {
                display: none;
            }
            button {
                visibility: hidden;
            }

            th {
                color: black;
            }

            .styled-table thead {
                padding-bottom: 10px;
                position: relative;
                /*top: -10px;*/
                z-index: 100;
            }
        }
    </style>

    <script type="text/javascript">
        function printPage() {
            let style = document.createElement('style');
            style.innerHTML = '@page { size: landscape; orientation: landscape;}';
            document.head.appendChild(style);
            window.print();
        }
    </script>

</head>
<body style="font-family: Arial, sans-serif; background: #d1edff; margin: 0; padding: 0;">
<header style="height: 230px; text-align: center; margin: 0; padding: 0">
    <img src="../assets/img/logo.png" alt="" width="1555">
</header>
<div>
    <br/>
    <div class="content">
        <table class="styled-table" style="margin-bottom: 30px">
            <thead style="font-weight: bold">
            <tr>
                <th style="width:90px">Mã điểm</th>
                <th style="width:100px">Học Kỳ</th>
                <th style="width:90px">Môn Học</th>
                <th style="width:100px">Điểm Miệng</th>
                <th style="width:100px">Điểm 15P1</th>
                <th style="width:100px">Điểm 15P2</th>
                <th style="width:100px">Điểm 1 Tiết</th>
                <th style="width:110px">Điểm Giữa Kì</th>
                <th style="width:100px">Điểm Thi</th>
                <th style="width:100px">Điểm TB</th>
            </tr>
            </thead>

            <?php
            $query = "select * from hocsinh where MaHS = '$MaHS'";
            $results = mysqli_query($conn, $query);
            $ThongTinHS = mysqli_fetch_assoc($results);
            echo '
                <div id="student-info">
                    <span class="student-info" style="padding: 0 10px; color: red">Mã học sinh: ' . $ThongTinHS['MaHS'] . '</span>
                    <span class="student-info" style="padding: 0 10px; color: #009879">Tên học sinh: ' . $ThongTinHS['TenHS'] . '</span>
                    <span class="student-info" style="padding-left: 10px; color: #009879; border: none">Lớp: ' . $ThongTinHS['MaLopHoc'] . '</span>
                </div>
                <hr>';
            $query2 = "select * from hocsinh, lophoc, diem, monhoc where hocsinh.MaLopHoc=lophoc.MaLopHoc && hocsinh.MaHS=diem.MaHS && monhoc.MaMonHoc=diem.MaMonHoc order by MaHocKy";
            $results2 = mysqli_query($conn, $query2);
            $hasRow = false;
            for ($i = 1; $i <= ($row = mysqli_fetch_assoc($results2)); $i++) {
                if ($row['MaHS'] == $MaHS) {
                    $hasRow = true;
                    echo '<tr>';
                    echo '<td><input style="width:50px" name="madiem[]" value="' . $row['MaDiem'] . '" readonly="readonly"/></td>';
                    echo '<td><input style="width:50px" type="text" name="mahocky[]" value="' . $row['MaHocKy'] . '" readonly="readonly"/></td>';
                    echo '<td><input style="width:90px" type="text" name="mon[]" value="' . $row['TenMonHoc'] . '" readonly="readonly"/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem0[]" 
                                value="' . ($row['DiemMieng'] == 0 ? '' : $row['DiemMieng']) . '" disabled/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px;" type="number" step="0.01" name="diem1[]"
                                value="' . ($row['Diem15Phut1'] == 0 ? '' : $row['Diem15Phut1']) . '" disabled/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem2[]" 
                                value="' . ($row['Diem15Phut2'] == 0 ? '' : $row['Diem15Phut2']) . '" disabled/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem3[]" 
                                value="' . ($row['Diem1Tiet'] == 0 ? '' : $row['Diem1Tiet']) . '" disabled/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem4[]" 
                                value="' . ($row['DiemGiuaKi'] == 0 ? '' : $row['DiemGiuaKi']) . '" disabled/></td>';
                    echo '<td class="mark-cell"><input class="mark" oninput="changeColor(this)" style="width:90px" type="number" step="0.01" name="diem5[]" 
                                value="' . ($row['DiemThi'] == 0 ? '' : $row['DiemThi']) . '" disabled/></td>';
                    echo '<td style="background: #ffe5ff"><input style="width:90px" type="number" class="final-mark" step="0.01" name="diem6[]" value="' . ($row['DiemTB'] == -1 ? '' : round($row['DiemTB'], 1)) . '" readonly="readonly"/></td>';
                    echo '</tr>';
                    //                    echo '<tr>';
                    //                    echo '<td><input style="width:90px" name="madiem[]" value="'.$row['MaDiem'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:120px" type="text" name="ma[]" value="'.$row['MaHS'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:170px" type="text" name="ten[]" value="'.$row['TenHS'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:70px" type="text" name="lop[]" value="'.$_POST['day'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:90px" type="text" name="mon[]" value="'.$row['MaMonHoc'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="hk[]" value="'.$row['MaHocKy'].'" readonly="readonly"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem[]" value="'.$row['DiemMieng'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem1[]" value="'.$row['Diem15Phut1'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem2[]" value="'.$row['Diem15Phut2'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem3[]" value="'.$row['Diem1Tiet1'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem4[]" value="'.$row['DiemGiuaKi'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem5[]" value="'.$row['DiemThi'].'"/></td>';
                    //                    echo '<td><input style="width:100px" type="text" name="diem6[]" readonly="readonly"/></td>';
                    //                    echo '</tr>';
                }
            }
            if (!$hasRow) {
                echo '<tr>';
                echo '<td colspan="13" style="text-align: center">Không có kết quả</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <div style="text-align: center">
            <button class="control-button" name="printData" id="printData" onclick="printPage()">Xuất PDF<i style="margin-left: 7px" class="fas fa-file-export"></i>
            </button>
        </div>
        <hr>
    </div>
</body>
