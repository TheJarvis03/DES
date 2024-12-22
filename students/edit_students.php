<?php
    session_start();
    include '../data/db_connect.php';
    include '../config/config.php';

    // Kiểm tra nếu người dùng chưa đăng nhập
    if (!isset($_SESSION['username'])) {
        header('Location: ../user/login.php');
        exit;
    }

    // Lấy ID sinh viên cần sửa
    if (!isset($_GET['id'])) {
        die("Không tìm thấy sinh viên.");
    }

    $id = intval($_GET['id']);

    // DES decryption function with a fixed IV
    function decryptData($data, $key) {
        $cipher = "des-ede3-cbc";
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher)); // IV cố định
        $ciphertext = base64_decode($data);
        return openssl_decrypt($ciphertext, $cipher, $key, 0, $iv);
    }

    // DES encryption function with a fixed IV
    function encryptData($data, $key) {
        $cipher = "des-ede3-cbc";
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher)); // IV cố định
        $ciphertext = openssl_encrypt($data, $cipher, $key, 0, $iv);
        return base64_encode($ciphertext);
    }

    // Sử dụng khóa bí mật từ tệp cấu hình
    $key = 'SECRET_KEY';

    // Lấy thông tin sinh viên từ database
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Không tìm thấy sinh viên.");
    }

    $row = $result->fetch_assoc();
    $id_stu = decryptData($row['id_stu'], $key);
    $name = decryptData($row['name'], $key);
    $email = decryptData($row['email'], $key);
    $dob = decryptData($row['dob'], $key);
    $class = decryptData($row['class'], $key);
    $major = decryptData($row['major'], $key);
    $faculty = decryptData($row['faculty'], $key);
    $gender = decryptData($row['gender'], $key);
    $phone = decryptData($row['phone'], $key);
    $address = decryptData($row['address'], $key);

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

        $sql = "UPDATE students SET id_stu = ?, name = ?, email = ?, dob = ?, class = ?, major = ?, faculty = ?, gender = ?, phone = ?, address = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $encrypted_id_stu, $encrypted_name, $encrypted_email, $encrypted_dob, $encrypted_class, $encrypted_major, $encrypted_faculty, $encrypted_gender, $encrypted_phone, $encrypted_address, $id);

        if ($stmt->execute()) {
            header('Location: ./students_list.php');
            exit;
        } else {
            echo "Lỗi: " . $stmt->error;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sửa thông tin sinh viên</title>
        <link rel="stylesheet" href="../static/style.css">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <?php include '../includes/menu.php'; ?>
        <h2>Sửa thông tin sinh viên</h2>
        <form method="post" action="">
            <label for="id_stu">Mã sinh viên:</label>
            <input type="text" id="id_stu" name="id_stu" value="<?php echo htmlspecialchars($id_stu); ?>" required>
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <label for="dob">Ngày sinh:</label>
            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
            <label for="class">Lớp:</label>
            <input type="text" id="class" name="class" value="<?php echo htmlspecialchars($class); ?>" required>
            <label for="major">Ngành:</label>
            <input type="text" id="major" name="major" value="<?php echo htmlspecialchars($major); ?>" required>
            <label for="faculty">Khoa:</label>
            <input type="text" id="faculty" name="faculty" value="<?php echo htmlspecialchars($faculty); ?>" required>
            <label for="gender">Giới tính:</label>
            <select id="gender" name="gender" required>
                <option value="Nam" <?php if ($gender == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if ($gender == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select>
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br>
            <input type="submit" value="Cập nhật">
        </form>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>