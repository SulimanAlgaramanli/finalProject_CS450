<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

h2 {
    margin-bottom: 20px;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4cae4c;
}

</style>

    <div class="container">
        <h2>تسجيل حساب</h2>
        <form action="register.php" method="POST">
            <label for="username">اسم المستخدم</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required>
            
            <label for="phone">رقم الهاتف</label>
            <input type="tel" id="phone" name="phone" required>
            
            <button type="submit">تسجيل</button>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// الحصول على بيانات النموذج
$user = $_POST['username'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور
$phone = $_POST['phone'];
$userType = ''; // تحديد نوع المستخدم

// إدخال البيانات في قاعدة البيانات
$sql = "INSERT INTO users (Username, Email, Password, Phone, UserType) VALUES ('$user', '$email', '$pass', '$phone', '$userType')";

if ($conn->query($sql) === TRUE) {
    echo "تم تسجيل الحساب بنجاح";
} else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
}

// إغلاق الاتصال
$conn->close();
?>

