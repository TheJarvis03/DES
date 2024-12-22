<?php
    include '../data/db_connect.php';
    session_start();

    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            $error_message = "Mật khẩu không khớp.";
        } else {
            // Check if username already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error_message = "Tên người dùng đã tồn tại.";
            } else {
                // Insert new user
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $password_hashed);

                if ($stmt->execute()) {
                    $success_message = "Đăng ký thành công. <a href='./login.php'>Đăng nhập</a>";
                } else {
                    $error_message = "Đăng ký thất bại.";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Đăng ký</title>
        <link rel="stylesheet" href="../static/style.css">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/menu.php'; ?>
        <?php
            if (!empty($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            if (!empty($success_message)) {
                echo "<p style='color: green;'>$success_message</p>";
            }
        ?>
        <form action="register.php" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" required>
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit" class="btn btn-register">Đăng ký</button>
        </form>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>