<?php
    define('SECRET_KEY', 'your_secret_key_here');

    function generateKey($length = 8)   // DES key length is 8 bytes
    { 
        return bin2hex(random_bytes($length));
    }

    $newKey = generateKey();
?>