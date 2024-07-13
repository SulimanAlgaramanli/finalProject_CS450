<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php"); // تغيير "index.php" إلى صفحة الدعاية أو صفحة تسجيل الدخول
exit();
?>