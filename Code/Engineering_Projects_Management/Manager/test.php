<?php
session_start();
include 'config.php'; // تضمين ملف الاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['usertype'] = $user['usertype'];
        header('Location: index.php');
        exit();
    } else {
        echo "اسم المستخدم أو كلمة المرور غير صحيحة";
    }
}
?>
<form method="post" action="login.php">
    <label for="username">اسم المستخدم:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">كلمة المرور:</label>
    <input type="password" id="password" name="password">
    <br>
    <button type="submit">تسجيل الدخول</button>
</form>
