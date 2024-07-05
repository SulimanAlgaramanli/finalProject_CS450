<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب موظف جديد</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
            direction: rtl;
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
</head>
<body>
    <div class="container">
        <h2>تسجيل حساب موظف جديد</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">الاسم</label>
            <input type="text" id="name" name="name" required>

            <label for="type">نوع الموظف</label>
            <input type="text" id="type" name="type" required>

            <label for="phone">رقم الهاتف</label>
            <input type="number" id="phone" name="phone" required>
            
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">تسجيل الحساب</button>
        </form>
    </div>
    
    <?php
    // الكود PHP لمعالجة بيانات النموذج وإدخالها إلى قاعدة البيانات
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        
        // الحصول على البيانات من النموذج
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $userType = $_POST['type']; // افترضت هنا أن النوع يدخل عبر حقل النوع
        
        // تشفير كلمة المرور
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        
        // إدخال البيانات إلى قاعدة البيانات
        $sql = "INSERT INTO employees (employeeName, email, password, employeePhone, userType, joinDate) 
                VALUES ('$name', '$email', '$password', '$phone', '$userType', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p>تم تسجيل الحساب بنجاح</p>";
        } else {
            echo "خطأ في تسجيل الحساب: " . $conn->error;
        }
        
        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
    }
    ?>
</body>
</html>
