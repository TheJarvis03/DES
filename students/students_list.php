<?php
    include '../data/db_connect.php';
    include '../config/config.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: ../user/login.php');
        exit;
    }
    
    // DES decryption function with a fixed IV
    function decryptData($data, $key) {
        $cipher = "des-ede3-cbc";
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher)); // IV cố định
        $ciphertext = base64_decode($data);
        return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
    }

    // Sử dụng khóa bí mật từ tệp cấu hình
    $key = 'SECRET_KEY';

    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách sinh viên</title>
        <link rel="stylesheet" href="../static/style.css">
        <script>
            function confirmDelete(studentId) {
                if (confirm("Bạn có chắc chắn muốn xóa sinh viên này không?")) {
                    window.location.href = 'delete_students.php?id=' + studentId;
                }
            }
        </script>
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/menu.php'; ?>
        <h2>Danh sách sinh viên</h2>
        <a href="add_students.php" class="btn btn-add">Thêm sinh viên</a>
        <table border="1">
            <tr>
                <th>Mã sinh viên</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Lớp</th>
                <th>Ngành</th>
                <th>Khoa</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $id_stu = decryptData($row['id_stu'], $key);
                        $name = decryptData($row['name'], $key);
                        $dob = decryptData($row['dob'], $key);
                        $class = decryptData($row['class'], $key);
                        $major = decryptData($row['major'], $key);
                        $faculty = decryptData($row['faculty'], $key);
                        $gender = decryptData($row['gender'], $key);
                        $email = decryptData($row['email'], $key);
                        $phone = decryptData($row['phone'], $key);
                        $address = decryptData($row['address'], $key);
                        // Hiển thị dữ liệu đã giải mã
                        echo "<tr>
                            <td>{$id_stu}</td>
                            <td>{$name}</td>
                            <td>{$dob}</td>
                            <td>{$class}</td>
                            <td>{$major}</td>
                            <td>{$faculty}</td>
                            <td>{$gender}</td>
                            <td>{$email}</td>
                            <td>{$phone}</td>
                            <td>{$address}</td>
                            <td>
                                <a href='edit_students.php?id={$row['id']}' class='btn btn-edit'>Sửa</a>
                                <br>
                                <a href='javascript:void(0);' class='btn btn-delete' onclick='confirmDelete({$row['id']})'>Xóa</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Không có sinh viên nào trong danh sách.</td></tr>";
                }
            ?>
        </table>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>