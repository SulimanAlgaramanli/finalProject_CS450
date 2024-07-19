<?php
include 'con_db.php';

// التحقق من وجود قيم في الطلب POST
if (isset($_POST['employee_id'], $_POST['employeeName'], $_POST['email'], $_POST['employeePhone'], $_POST['joinDate'], $_POST['userType'])) {
    $employeeID = $_POST['employee_id'];
    $employeeName = $_POST['employeeName'];
    $email = $_POST['email'];
    $employeePhone = $_POST['employeePhone'];
    $joinDate = $_POST['joinDate'];
    $userType = $_POST['userType'];

    // التأكد من أن معرف الموظف ليس فارغاً
    if (!empty($employeeID)) {
        // إعداد الاستعلام لتحديث بيانات الموظف
        $sql = "UPDATE employees SET employeeName = ?, email = ?, employeePhone = ?, joinDate = ?, userType = ? WHERE employeeId = ?";

        // إعداد وتنفيذ الاستعلام
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssii", $employeeName, $email, $employeePhone, $joinDate, $userType, $employeeID);

            if ($stmt->execute()) {
                // إغلاق الاتصال والانتقال إلى الصفحة الرئيسية مع رسالة نجاح
                $stmt->close();
                $conn->close();
                header("Location: employees.php?message=تم تحديث بيانات الموظف بنجاح");
                exit();
            } else {
                echo "خطأ في تنفيذ الاستعلام: " . $conn->error;
            }
        } else {
            echo "خطأ في إعداد الاستعلام: " . $conn->error;
        }
    } else {
        echo "معرف الموظف غير محدد.";
    }
} else {
    echo "لم يتم استلام البيانات.";
}
?>
