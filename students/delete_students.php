<?php
    session_start();
    include '../data/db_connect.php';

    // Kiểm tra nếu người dùng chưa đăng nhập
    if (!isset($_SESSION['username'])) {
        header('Location: ../user/login.php');
        exit;
    }

    // Lấy ID sinh viên cần xóa
    if (!isset($_GET['id'])) {
        die("Không tìm thấy sinh viên.");
    }

    $id = intval($_GET['id']);

    // Xử lý xóa sinh viên
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: ./students_list.php'); // Chuyển hướng sau khi xóa thành công
        exit;
    } else {
        echo "Xóa thất bại: " . $stmt->error;
    }
?>
