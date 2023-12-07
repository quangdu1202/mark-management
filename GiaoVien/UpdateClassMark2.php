<?php
global $BangDiem;
session_start();

$MaGV = $_SESSION['MaGV'];
//unset($_SESSION['selectedAssignment']);
require "../Connection/Connection.php";
require "./control/log-out.php";
require "./control/check-user.php";
$connect = new Connection();
$conn = $connect->connect();

$query = "select MaPhanCong,TrangThai from assignment";
$result = mysqli_query($conn, $query);
for ($i = 0; $i < $row = mysqli_fetch_assoc($result); $i++) {
    if (isset($_POST[$row['MaPhanCong']])) {
        //echo '<script>alert("Mã phân công đã chọn: ' . $row['MaPhanCong'] . '")</script>';
        $_SESSION['selectedAssignment'] = $row['MaPhanCong'];
        $TrangThai = $row['TrangThai'];
        break;
    }
}
$selectedAssignment = $_SESSION['selectedAssignment'];

$queryGetTrangThai = "select TrangThai from assignment where MaPhanCong='$selectedAssignment'";
$resultGetTrangThai = mysqli_query($conn, $queryGetTrangThai);
$row = mysqli_fetch_assoc($resultGetTrangThai);
$TrangThai = $row['TrangThai'];
//echo '<script>alert("'.$TrangThai.'")</script>';
?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>GV UpdateMark</title>
    <link rel="stylesheet" type="text/css" href="./css/UpdateClassMark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
        .styled-table thead tr {
        <?php
            if($TrangThai != 1) {
                echo 'background-color: darkred;';
            }else {
                echo 'background-color: #009879;';
            }
        ?> color: #ffffff;
            text-align: left;
        }

        /*style đặt cho hàng được hover mouse*/
        .highlight-row {
            background-color: #e6ffe5 !important;
        }
    </style>
</head>
<body>
<header style="height: 230px; text-align: center; margin: 0; padding: 0">
    <img src="../assets/img/logo.png" alt="" width="1555">
</header>
<div style="margin: 15px 0; display:flex; justify-content: space-between; height: 50px; align-items: center">
    <?php
    $query = "select * from giaovien where MaGV = '$MaGV'";
    $results = mysqli_query($conn, $query);
    $ThongTinGV = mysqli_fetch_assoc($results);
    echo '
                <div id="user-info" style="margin-left: 65px"><i class="fas fa-user" style="margin-right: 7px"></i>' . $ThongTinGV['MaGV'] . ' | <span style="font-style: italic">' . $ThongTinGV['TenGV'] . '</span>' . '</div>
                ';
    require "./control/assignment-info.php"
    ?>
    <form method="post">
        <button style="margin-right: 67px" type="submit" class="logout-button" name="logout">Đăng xuất <i class="fas fa-sign-out-alt"
                                                                                                          style="margin-left: 5px"></i></button>
    </form>
</div>
<hr>
<!-- Popup -->
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h3 style="margin-top: 0">Xác nhận <span style="color: red">khoá</span> chức năng sửa điểm</h3>
        <p>Hành động này <span style="font-weight: bold;color: red">không thể</span> hoàn tác!</p>
        <button style="display: inline-block; width: 110px" class="confirm-btn" id="cancel-lock" onclick="closePopup()">Huỷ<i style="margin-left: 5px"
                                                                                                                              class="fas fa-times"></i></button>
        <form action="" method="post" style="display: inline-block; width: 110px">
            <button class="confirm-btn" onclick="closePopup()" name="confirmLock" type="submit">Xác nhận<i style="margin-left: 5px" class="fas fa-check"></i>
            </button>
        </form>
    </div>
</div>

<!--Popup upload file-->
<div id="fileUploadPopup" class="popup">
    <div class="popup-content">
        <h3 style="margin-top: 0">Chọn file <span style="color: red">CSV</span> để tải điểm lên</h3>
        <form action="" method="post" style="text-align: center" enctype="multipart/form-data">
            <input type="file" name="uploadedFile" value="import" style="display: block; width: 210px; margin: 10px auto">
            <button style="width: 110px;" class="confirm-btn" id="cancel-upload" onclick="cancelUploadFile(event)">Huỷ<i style="margin-left: 5px"
                                                                                                                         class="fas fa-times"></i></button>
            <button class="confirm-btn" onclick="submitUploadFile()" name="confirmUploadFile" type="submit">Xác nhận<i style="margin-left: 5px"
                                                                                                                       class="fas fa-check"></i></button>
        </form>
    </div>
</div>

<div class="table-wrapper">
    <form action="UpdateClassMark.php" method="post">
        <table class="styled-table" style="margin-bottom: 30px">
            <thead style="font-weight: bold">
            <tr>
                <th style="width:30px">STT</th>
                <th style="width:55px">Mã điểm</th>
                <th style="width:120px">Mã Học Sinh</th>
                <th style="width:150px">Họ đệm</th>
                <th style="width:70px">Tên</th>
                <!--                    <th style="width:70px">Lớp</th>-->
                <!--                    <th style="width:90px">Môn Học</th>-->
                <!--                    <th style="width:100px">Học Kỳ</th>-->
                <th style="width:100px">Điểm Miệng</th>
                <th style="width:100px">Điểm 15P1</th>
                <th style="width:100px">Điểm 15P2</th>
                <th style="width:100px">Điểm 1 Tiết</th>
                <th style="width:110px">Điểm Giữa Kì</th>
                <th style="width:100px">Điểm Thi</th>
                <th style="width:100px">Điểm TB</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require "./control/table-diem.php";
            ?>
            </tbody>
        </table>
        <hr>
        <button class="control-button" style="height: 45px; width: 147px; padding: 0"><a href="Dashboard.php"
                                                                                         style="color: white; text-decoration:none;display: block;width: 100%;height: 100%;line-height: 45px"
                                                                                         onclick="checkReload()"><i style="margin-right: 7px"
                                                                                                                    class="fas fa-angle-left"></i>Trở lại</a>
        </button>
        <?php
        if ($TrangThai == 1) {
            echo '
                        <button class="control-button" name="updateMark" id="updateMark" type="submit">Cập nhật<i style="margin-left: 7px" class="fas fa-save"></i></button>
                        <button class="control-button" name="lockEdit" id="lockEdit" onclick="openPopup(event)">Khoá sửa điểm<i style="margin-left: 7px" class="fas fa-lock"></i></button>
                        <button class="control-button" name="uploadFile" id="uploadFile" onclick="openUploadFile(event)">Tải lên file điểm<i style="margin-left: 7px" class="fas fa-upload"></i></button>
                    ';
        } else if ($TrangThai == 0) {
            echo '<button class="control-button" name="unlockEdit" id="unlockEdit"">Yêu cầu mở khoá<i style="margin-left: 7px" class="fas fa-unlock"></i></button>';
        } else if ($TrangThai == 2) {
            echo '<button class="control-button" name="requestedUnlock" id="requestedUnlock" disabled>Đã yêu cầu mở khoá<i style="margin-left: 7px" class="fas fa-unlock"></i></button>';
        }
        ?>
        <button class="control-button" name="printData" id="printData" onclick="printPage()">Xuất PDF<i style="margin-left: 7px" class="fas fa-file-export"></i>
        </button>
    </form>
</div>
<script type="text/javascript">
    <?php
    if ($TrangThai != 1) {
        echo '
            let inputs3 = document.getElementsByClassName("mark");
            for (let i = 0; i < inputs3.length; i++) {
                inputs3[i].disabled = true;
            }
            ';
    }
    ?>
</script>
<script src="js/control.js"></script>
<form action="downloadFile.php" method="post">
    <button class="control-button" type="submit" name="downloadFile" id="downloadFile">Tải về file điểm<i style="margin-left: 7px" class="fas fa-download"></i>
    </button>
</form>

<?php
include "./control/loadChart.php";
?>
<!--<div class="mark-chart" id="placeHolder" style="width: 900px; height: 500px;">-->
<!--</div>-->
<div id="chart-wrapper">
    <select name="listDiem" id="listDiem" onchange="changeChart()">
        <option value="">Loại điểm</option>
        <?php
        $query = "select * from loaidiem";
        $results = mysqli_query($conn, $query);
        while ($data = mysqli_fetch_assoc($results)) {
            if ($data['id_Diem'] == $_POST['listDiem']) {
                echo '<option value="' . $data['id_Diem'] . '" selected>' . $data['LoaiDiem'] . '</option>';
            } else {
                echo '<option value="' . $data['id_Diem'] . '">' . $data['LoaiDiem'] . '</option>';
            }
        }
        ?>
    </select>
    <div id="chart-wrapper-content">
        <div class="mark-chart" id="DiemMieng" style="width: 1000px; height: 600px; /*display: flex; overflow: auto*/">
        </div>
        <div class="mark-chart" id="Diem15Phut1" style="width: 100%; height: 100%;">
        </div>
        <div class="mark-chart" id="Diem15Phut2" style="width: 100%; height: 100%;">
        </div>
        <div class="mark-chart" id="Diem1Tiet" style="width: 100%; height: 100%;">
        </div>
        <div class="mark-chart" id="DiemGiuaKi" style="width: 100%; height: 100%;">
        </div>
        <div class="mark-chart" id="DiemThi" style="width: 100%; height: 100%;">
        </div>
        <div class="mark-chart" id="DiemTB" style="width: 100%; height: 100%;">
        </div>
        <button id="close-chart" onclick="closeChart()"><i class="fas fa-times"></i></button>
    </div>
</div>
<button onclick="showChart()">Show Chart</button>
<script type="text/javascript">
    var divs = document.getElementsByClassName('mark-chart');
    for (var i = 0; i < divs.length; i++) {
        divs[i].style.display = "none";
    }
</script>
</body>

<?php
require "control/function.php";
?>