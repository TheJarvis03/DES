<?php
    include '../data/db_connect.php';
    include '../config/config.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: ../user/login.php');
        exit;
    }
    
    // DES encryption function with a fixed IV
    function encryptData($data, $key) {
        $cipher = "des-ede3-cbc";
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher)); // IV cố định
        $ciphertext = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($ciphertext);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_stu = $_POST['id_stu'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $class = $_POST['class'];
        $major = $_POST['major'];
        $faculty = $_POST['faculty'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Sử dụng khóa bí mật từ tệp cấu hình
        $key = 'SECRET_KEY';

        // Mã hóa dữ liệu
        $encrypted_id_stu = encryptData($id_stu, $key);
        $encrypted_name = encryptData($name, $key);
        $encrypted_email = encryptData($email, $key);
        $encrypted_dob = encryptData($dob, $key);
        $encrypted_class = encryptData($class, $key);
        $encrypted_major = encryptData($major, $key);
        $encrypted_faculty = encryptData($faculty, $key);
        $encrypted_gender = encryptData($gender, $key);
        $encrypted_phone = encryptData($phone, $key);
        $encrypted_address = encryptData($address, $key);

        $sql = "INSERT INTO students (id_stu, name, email, dob, class, major, faculty, gender, phone, address) VALUES ('$encrypted_id_stu', '$encrypted_name', '$encrypted_email', '$encrypted_dob', '$encrypted_class', '$encrypted_major', '$encrypted_faculty', '$encrypted_gender', '$encrypted_phone', '$encrypted_address')";

        if ($conn->query($sql) === TRUE) {
            header('Location: ./students_list.php');
            exit;
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thêm sinh viên</title>
        <link rel="stylesheet" href="../static/style.css">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/menu.php'; ?>
        <h2>Thêm sinh viên</h2>
        <form method="post" action="">
            <label for="id_stu">Mã sinh viên:</label>
            <input type="text" id="id_stu" name="id_stu" required>
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="dob">Ngày sinh:</label>
            <input type="date" id="dob" name="dob" required>
            <label for="class">Lớp:</label>
            <input type="text" id="class" name="class" required>
            <label for="major">Ngành:</label>
            <input type="text" id="major" name="major" required>
            <label for="faculty">Khoa:</label>
            <input type="text" id="faculty" name="faculty" required>
            <label for="gender">Giới tính:</label>
            <select id="gender" name="gender" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required>
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required><br>
            <input type="submit" value="Thêm">
        </form>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>