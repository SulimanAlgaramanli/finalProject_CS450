<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
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
            padding: 30px; /* زيادة padding */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* زيادة عرض الفورم */
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

        input, select {
            margin-bottom: 15px;
            padding: 15px; /* زيادة padding */
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px; /* تكبير حجم الخط */
        }

        button {
            padding: 15px; /* زيادة padding */
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px; /* تكبير حجم الخط */
        }

        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>تسجيل الدخول</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="user_type">نوع المستخدم</label>
            <select id="user_type" name="user_type" required>
                <option value="customer">زبون</option>
                <option value="employee">موظف</option>
            </select>
            
            <label for="email">البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">كلمة المرور</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">تسجيل الدخول</button>
        </form>
    </div>
    
    <?php
    session_start(); // تفعيل الجلسات

    // الكود PHP للتحقق من بيانات تسجيل الدخول والتحقق منها
    if ($_SERVER["REQUEST_METHOD"] == "POST"   &&     isset($_POST['email']) )
    {
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

        $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // تحديد الجدول بناءً على نوع المستخدم
        if ($user_type == 'customer') {
            $table = 'Customers';
            $id_field = 'CustomerId';
            $name_field = 'CustomerName';
        } else {
            $table = 'Employees';
            $id_field = 'employeeId';
            $name_field = 'employeeName';
        }
        
        // استعلام للتحقق من وجود المستخدم في قاعدة البيانات
        $sql = "SELECT * FROM $table WHERE email='$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                echo "<script>alert('تم تسجيل الدخول بنجاح');</script>";
                $_SESSION['user_id'] = $row[$id_field]; // تخزين معرف المستخدم في الجلسة
                $_SESSION['user_name'] = $row[$name_field]; // تخزين اسم المستخدم في الجلسة
                $_SESSION['user_type'] = $row['userType']; // تخزين اسم المستخدم في الجلسة
                
                header("Location: index.php");
                exit(); // تأكد من استخدام exit بعد header
            } else {
                echo "<script>alert('كلمة المرور غير صحيحة');</script>";
            }
        } else {
            echo "<script>alert('البريد الإلكتروني غير مسجل');</script>";
        }
        
        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
    }
    ?>
    <script src="script.js"></script>
</body>
</html>
