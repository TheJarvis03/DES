        <nav>
            <a href="../index.php">Trang chủ</a> |
            <a href="../students/students_list.php">Danh sách sinh viên</a>
            <?php
            if (isset($_SESSION['username'])) {
                echo "| <a href='../user/logout.php'>Đăng xuất</a>";
            } else {
                echo "| <a href='../user/login.php'>Đăng nhập</a>";
            }
            ?>
        </nav>