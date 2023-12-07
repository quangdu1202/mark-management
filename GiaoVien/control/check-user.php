<?php
if (!isset($_SESSION['MaGV'])) {
    // Chuyển hướng người dùng về trang home.php
    $_SESSION['logged-in'] = false;
    header("Location: ../home.php");
    exit;
}
?>