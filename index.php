<?php
    include './data/db_connect.php';
    include './config/config.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản lý sinh viên</title>
        <link rel="stylesheet" href="./static/style.css">
    </head>
    <body>
        <header>
            <h1>Hệ thống quản lý sinh viên</h1>
        </header>
        <nav>
            <a href="./index.php">Trang chủ</a> |
            <a href="./students/students_list.php">Danh sách sinh viên</a>
            <?php
            if (isset($_SESSION['username'])) {
                echo "| <a href='./user/logout.php'>Đăng xuất</a>";
            } else {
                echo "| <a href='./user/login.php'>Đăng nhập</a>";
            }
            ?>
        </nav>
        <?php
            if (isset($_SESSION['username'])) {
                echo "<p>Chào, " . htmlspecialchars($_SESSION['username']) . "! </p>";
            } else {
                echo "<p>Vui lòng đăng nhập để quản lý sinh viên.</p>";
            }
        ?>
        <footer>
            <p>&copy; 2024 Quản lý sinh viên.</p>
        </footer>
    </body>
</html>
