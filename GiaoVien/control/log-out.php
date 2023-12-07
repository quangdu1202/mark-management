<?php
// Kiểm tra nếu người dùng nhấp vào nút logout
if (isset($_POST['logout'])) {
    // Xóa tất cả các biến session
    session_unset();
    session_destroy();

    // Chuyển hướng người dùng đến trang đăng nhập
    header("Location: ../home.php");
    exit;
}
?>
