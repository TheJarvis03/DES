<?php
    include '../data/db_connect.php';
    session_start();

    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: ../index.php');
                exit;
            } else {
                $error_message = "Sai mật khẩu.";
            }
        } else {
            $error_message = "Không tìm thấy người dùng.";
        }
    }
?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản lý sinh viên - Đăng nhập</title>
        <link rel="stylesheet" href="../static/style.css">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/menu.php'; ?>
        <?php
            if (!empty($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
        ?>
        <form method="POST">
            <label>Tên đăng nhập:</label>
            <input type="text" name="username" required>
            <label>Mật khẩu:</label>
            <input type="password" name="password" required>
            <button type="submit" class="btn btn-login">Đăng nhập</button>
        </form>
        <p class="p-register">Bạn chưa có tài khoản? <a href="../user/register.php">Đăng ký ngay</a></p>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>
