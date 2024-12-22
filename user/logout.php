<?php
    session_start();

    // Hủy toàn bộ session
    session_unset(); // Xóa tất cả các biến session
    session_destroy(); // Hủy phiên làm việc

    // Chuyển hướng về trang index hoặc login
    header('Location: ../index.php');
    exit;
?>
