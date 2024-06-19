<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
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
        <h2>تسجيل الدخول</h2>
        <form action="login.php" method="POST">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">تسجيل الدخول</button>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer_management";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// الحصول على بيانات النموذج
$email = $_POST['email'];
$pass = $_POST['password'];

// البحث عن المستخدم في قاعدة البيانات
$sql = "SELECT * FROM users WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // الحصول على بيانات المستخدم
    $row = $result->fetch_assoc();
    // التحقق من كلمة المرور
    if (password_verify($pass, $row['Password'])) {
        echo "تم تسجيل الدخول بنجاح";
        // يمكن إعادة توجيه المستخدم إلى صفحة أخرى
        // header("Location: dashboard.php");
    } else {
        echo "كلمة المرور غير صحيحة";
    }
} else {
    echo "البريد الإلكتروني غير مسجل";
}

// إغلاق الاتصال
$conn->close();
?>

