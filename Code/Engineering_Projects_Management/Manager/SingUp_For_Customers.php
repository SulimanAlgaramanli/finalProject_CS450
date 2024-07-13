<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب زبون جديد</title>
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
        h2{
            text-align: center;
            justify-content: center;        
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
        input[type="tel"] {
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

    <form method="POST" action="SingUp_For_Customers.php">
    <h2>تسجيل حساب زبون جديد</h2>

        <label for="CustomerName">الاسم:</label>
        <input type="text" id="CustomerName" name="CustomerName" required>

        <label for="email">البريد الإلكتروني:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">كلمة المرور:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">تأكيد كلمة المرور:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <label for="CustomerPhone">رقم الهاتف:</label>
        <input type="tel" id="CustomerPhone" name="CustomerPhone" required>

        <button type="submit">تسجيل الحساب</button>
    </form>
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
    $customerName = $_POST['CustomerName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $customerPhone = $_POST['CustomerPhone'];
    $userType = 2; // تحديد نوع المستخدم للزبائن
    $joinDate = date("Y-m-d");

    // التحقق من تطابق كلمة المرور وتأكيد كلمة المرور
    if ($password !== $confirm_password) {
        echo "<script>alert('كلمة المرور وتأكيد كلمة المرور غير متطابقتين');</script>";
    } else {
        // التحقق من أن الاسم والبريد الإلكتروني فريدان
        $sql = "SELECT COUNT(*) AS count FROM customers WHERE CustomerName = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $customerName, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            echo "<script>alert('اسم الزبون أو البريد الإلكتروني موجود بالفعل');</script>";
        } else {
            // إدراج الزبون الجديد
            $sql = "INSERT INTO customers (CustomerName, email, password, CustomerPhone, userType, joinDate) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // تشفير كلمة المرور

            $stmt->bind_param("ssssss", $customerName, $email, $hashed_password, $customerPhone, $userType, $joinDate);

            if ($stmt->execute()) {
                header("HTTP/1.1 303 See Other");
                header("Location: Customers.php");
                exit();
            } else {
                echo "<script>alert('يرجى المحاولة مرة أخرى');</script>";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<script src="script.js"></script>

</body>
</html>


<!-- Done -->