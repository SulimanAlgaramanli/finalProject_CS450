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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = $_POST['employeeName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $employeePhone = $_POST['employeePhone'];
    $userType = isset($_POST['userType']) ? $_POST['userType'] : null; // التأكد من وجود قيمة userType
    $joinDate = date("Y-m-d");

    // التحقق من تطابق كلمة المرور وتأكيد كلمة المرور
    if ($password !== $confirm_password) {
        echo "<script>alert('كلمة المرور وتأكيد كلمة المرور غير متطابقتين. يرجى المحاولة مرة أخرى.');</script>";
    } else {
        // التحقق من أن الاسم والبريد الإلكتروني فريدان
        $sql = "SELECT COUNT(*) AS count FROM employees WHERE employeeName = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $employeeName, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "<script>alert('اسم الموظف أو البريد الإلكتروني موجود بالفعل. يرجى اختيار اسم أو بريد إلكتروني آخر.');</script>";
        } else {
            // إدراج الموظف الجديد
            $sql = "INSERT INTO employees (employeeName, email, password, employeePhone, userType, joinDate) 
                    VALUES (?, ?, ?, ?, ?, NOW())";
            
            $stmt = $conn->prepare($sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // تشفير كلمة المرور

            $stmt->bind_param("sssss", $employeeName, $email, $hashed_password, $employeePhone, $userType);

            if ($stmt->execute()) {
                echo "<script>alert('تم تسجيل الحساب بنجاح.'); window.location.href = 'employees.php';</script>";
            } else {
                echo "<script>alert('حدث خطأ أثناء تسجيل الحساب. يرجى المحاولة مرة أخرى.');</script>";
            }
        }
        $stmt->close();
    }
}

// استعلام SQL لاسترجاع أرقام المشاريع
$sql_1 = "SELECT id, type FROM usertype 
where id <> 2
ORDER BY id";
$result = $conn->query($sql_1);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب موظف جديد</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* لجعل الصفحة تمتد إلى كامل ارتفاع النافذة */
            margin: 0;
            background-color: #f0f0f0; /* لون الخلفية للصفحة */
        }
        h2 {
            text-align: center;
        }
        form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form method="POST" action="SingUp_For_employees.php">
    <h2>تسجيل حساب موظف جديد</h2>

    <label for="employeeName">الاسم:</label>
    <input type="text" id="employeeName" name="employeeName" required>

    <label for="type">نوع الموظف:</label>
    <select id="type" name="userType" required>
        <option value="" disabled selected>اختر نوع الموظف</option>

        <?php
        if ($result->num_rows > 0) {
            // إنشاء خيارات القائمة المنسدلة
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['type'] . "</option>";
            }
        } else {
            echo "<option value=''>لا يوجد </option>";
        }
        $conn->close();
        ?>
    </select>

    <label for="email">البريد الإلكتروني:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">كلمة المرور:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">تأكيد كلمة المرور:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <label for="employeePhone">رقم الهاتف:</label>
    <input type="tel" id="employeePhone" name="employeePhone" required>

    <button type="submit">تسجيل الحساب</button>
</form>
<script src="script.js"></script>

</body>
</html>


<!-- Done -->