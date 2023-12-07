<?php
session_start();
require 'Connection/Connection.php';
$connect = new Connection();
$con = $connect->connect();

if (isset($_SESSION['logged-in'])) {
    // Hiển thị thông báo
    echo '<script>alert("Vui lòng đăng nhập để truy cập trang này!")</script>';

    // Xóa thông báo sau khi hiển thị
    unset($_SESSION['logged-in']);
}


$username = $password = "";

if (isset($_POST['login'])) {
    if ($_POST['username'] == null || $_POST['password'] == null) {
        echo '
        <script type="text/javascript">
            alert("Vui lòng nhập đầy đủ thông tin!");
            window.location="home.php";
        </script>';
        exit();
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    $query = "select * from user where username='$username' and password='$password'";
    $results = mysqli_query($con, $query);
    if ($rowscount = mysqli_num_rows($results) == 0) {
        echo '
        <script type="text/javascript">
            alert("Tên tài khoản hoặc mật khẩu chưa chính xác.Vui lòng nhập lại!!");
            window.location="home.php";
        </script>';
        exit();
    } else {
        $row = mysqli_fetch_assoc($results);
        if ($row['level'] == 1) {
            echo '<script>alert("Tài khoản admin!")</script>';
            header("location:Admin/index.php");
        } else if ($row['level'] == 2) {
            $_SESSION['MaGV'] = $row['username'];
            $_SESSION['session_passGV'] = $row['password'];
            header("location:GiaoVien/Dashboard.php");
        }
    }
    exit();
}

if (isset($_POST['checkPoint'])) {
    $MaHS = $_POST['MaHS'];

    if (empty($MaHS)) {
        echo '<script>alert("Nhập mã học sinh để tra cứu điểm!")</script>';
    } else {
        $query = "select * from hocsinh where MaHS = '$MaHS'";
        $results = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($results);
        if (mysqli_num_rows($results) > 0) {
            echo '<script>alert("Mã học sinh đã nhập: ' . $_POST['MaHS'] . '")</script>';
            $_SESSION['MaHS'] = $_POST['MaHS'];
            header("location:HocSinh/XemDiem.php");
        } else {
            echo '<script>alert("Không tìm thấy dữ liệu với MaHS đã nhập")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng Nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!--===============================================================================================-->
    <style>
        input {
            font-weight: bold;
        }
    </style>
</head>
<body style="font-family: Roboto, sans-serif">
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form id="login" method="POST" class="login100-form validate-form p-l-55 p-r-55
				p-t-178">
					<span class="login100-form-title">ĐĂNG NHẬP</span>
                <div class="wrap-input100 m-b-16">
                    <input class="input100" type="text" name="username" placeholder="Tên đăng nhập">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 m-b-16">
                    <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" name="login" class="login100-form-btn" style="margin-bottom: 0; font-weight: bold">
                        Đăng nhập
                    </button>
                </div>
            </form>

            <div class="flex-col-c p-t-30 p-b-10" style="text-align: center">
						<span>
							Là học sinh?
						</span>
                <form id="checkPoint" method="POST" class="login100-form validate-form p-l-55
                    p-r-55 p-t-10">
                    <div class="wrap-input100 m-b-16">
                        <input class="input100" type="text" name="MaHS" placeholder="Mã học sinh">
                        <span class="focus-input100"></span>
                    </div>
                    <button type="submit" name="checkPoint" class="txt3" style="margin-bottom: 20px; font-weight: bold">
                        TRA CỨU ĐIỂM
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/bootstrap/js/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/daterangepicker/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="assets/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="assets/js/main.js"></script>

</body>
</html>