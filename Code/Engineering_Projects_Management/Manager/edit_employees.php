<?php
include 'con_db.php';

// التحقق من وجود قيمة employee_id في الطلب GET
if (isset($_GET['employee_id'])) {
    $employeeID = $_GET['employee_id'];

    // التأكد من أن معرف الموظف ليس فارغاً
    if (!empty($employeeID)) {
        // إعداد الاستعلام لجلب بيانات الموظف
        $sql = "SELECT * FROM employees WHERE employeeId = ?";

        // إعداد وتنفيذ الاستعلام
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $employeeID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $employee = $result->fetch_assoc();
            } else {
                echo "لم يتم العثور على الموظف.";
                exit();
            }
        } else {
            echo "خطأ في إعداد الاستعلام: " . $conn->error;
            exit();
        }
    } else {
        echo "معرف الموظف غير محدد.";
        exit();
    }
} else {
    echo "لم يتم استلام معرف الموظف.";
    exit();
}

// تحديث البيانات عند تقديم النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeName = $_POST['employeeName'];
    $email = $_POST['email'];
    $employeePhone = $_POST['employeePhone'];
    $joinDate = $_POST['joinDate'];
    $userType = $_POST['userType'];

    // تحديث بيانات الموظف
    $updateSql = "UPDATE employees SET employeeName = ?, email = ?, employeePhone = ?, joinDate = ?, userType = ? WHERE employeeId = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssii", $employeeName, $email, $employeePhone, $joinDate, $userType, $employeeID);

    if ($updateStmt->execute()) {
        echo "<script>alert('تم تحديث بيانات الموظف بنجاح');</script>";
        header("Location: employees.php");
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
    <title>تعديل بيانات الموظف</title>
    <link rel="stylesheet" href="../Css/main.css" />
    <style>
.container {
    width: 80%;
    max-width: 600px;
    height: 600px;
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
        <h1 style="text-align: center;">تعديل بيانات الموظف</h1>
        <form method="POST" action="">
            <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employee['employeeId']); ?>">

            <div class="form-group">
                <label for="employeeName">اسم الموظف:</label>
                <input type="text" id="employeeName" name="employeeName" value="<?php echo htmlspecialchars($employee['employeeName']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="employeePhone">الهاتف:</label>
                <input type="text" id="employeePhone" name="employeePhone" value="<?php echo htmlspecialchars($employee['employeePhone']); ?>" required>
            </div>

            <div class="form-group">
                <label for="joinDate">تاريخ الانضمام:</label>
                <input type="date" id="joinDate" name="joinDate" value="<?php echo htmlspecialchars($employee['joinDate']); ?>" required>
            </div>

            <div class="form-group">
                <label for="userType">نوع الموظف:</label>
                <select id="userType" name="userType" required>
                    <?php
                    // استعلام للحصول على أنواع المستخدمين
                    $sql = "SELECT id, type FROM usertype";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['id'] == $employee['userType']) ? 'selected' : '';
                            echo "<option value='" . $row['id'] . "' $selected>" . htmlspecialchars($row['type']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>لا توجد أنواع</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">تحديث</button>
            </div>
        </form>
    </div>
</body>
</html>
