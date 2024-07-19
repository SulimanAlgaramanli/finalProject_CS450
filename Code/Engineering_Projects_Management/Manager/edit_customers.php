<?php
include 'con_db.php';

// التحقق من وجود قيمة customer_id في الطلب GET
if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];

    // التأكد من أن معرف الزبون ليس فارغاً
    if (!empty($customerId)) {
        // إعداد الاستعلام لجلب بيانات الزبون
        $sql = "SELECT * FROM Customers WHERE CustomerId = ?";

        // إعداد وتنفيذ الاستعلام
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $customerId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $customer = $result->fetch_assoc();
            } else {
                echo "لم يتم العثور على الزبون.";
                exit();
            }
        } else {
            echo "خطأ في إعداد الاستعلام: " . $conn->error;
            exit();
        }
    } else {
        echo "معرف الزبون غير محدد.";
        exit();
    }
} else {
    echo "لم يتم استلام معرف الزبون.";
    exit();
}

// تحديث البيانات عند تقديم النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customerName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $joinDate = $_POST['joinDate'];

    // تحديث بيانات الزبون
    $updateSql = "UPDATE Customers SET CustomerName = ?, email = ?, CustomerPhone = ?, joinDate = ? WHERE CustomerId = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssi", $customerName, $email, $phone, $joinDate, $customerId);

    if ($updateStmt->execute()) {
        echo "<script>alert('تم تحديث بيانات الزبون بنجاح');</script>";
        header("Location: customers.php");
        exit(); 
    } else {
        echo "خطأ في التحديث: " . $conn->error;
    }

    $updateStmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Css/main.css" />

    <title>تعديل بيانات الزبون</title>
    <style>
        .container {
            width: 80%;
            max-width: 600px;
            /* height: 600px; */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تعديل بيانات الزبون</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="customerName">اسم الزبون:</label>
                <input type="text" name="customerName" id="customerName" value="<?php echo htmlspecialchars($customer['CustomerName']); ?>" required />
            </div>
            <div class="form-group">
                <label for="email">الايميل:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required />
            </div>
            <div class="form-group">
                <label for="phone">الهاتف:</label>
                <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($customer['CustomerPhone']); ?>" required />
            </div>
            <div class="form-group">
                <label for="joinDate">تاريخ الانضمام:</label>
                <input type="date" id="joinDate" name="joinDate" value="<?php echo htmlspecialchars($customer['joinDate']); ?>" required />
            </div>
            <div class="form-group">
                <button type="submit">تحديث</button>
            </div>
        </form>
    </div>
</body>
</html>
