<?php
session_start();
//chưa đăng nhập
if ($_SESSION['role']!= 1) {
     header('Location: login.php');
}
?>
<!-- Trang chỉ dành cho admin -->