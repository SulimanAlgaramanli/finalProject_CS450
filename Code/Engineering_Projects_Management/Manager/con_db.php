<?php

    $servername = "localhost";
    $username = "root";
    $password = ""; // تحقق من كلمة المرور الصحيحة
    $dbname = "Engineering_Projects_Management";

    // إنشاء الاتصال
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }


?>