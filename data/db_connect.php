<?php
    $host = 'localhost';    
    $user = 'root';    
    $password = '';          
    $database = 'student_management'; 

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
?>