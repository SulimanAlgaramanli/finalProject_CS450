<?php
include 'con_db.php';

// التحقق من وجود قيمة employee_id في الطلب POST
if (isset($_POST['employee_id'])) {
    $employeeID = $_POST['employee_id'];

    // التأكد من أن معرف الموظف ليس فارغاً
    if (!empty($employeeID)) {
        // إعداد الاستعلام لحذف الموظف
        $sql = "DELETE FROM employees WHERE employeeId = ?";

        // إعداد وتنفيذ الاستعلام
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $employeeID);

            if ($stmt->execute()) {
                // إغلاق الاتصال والانتقال إلى الصفحة الرئيسية مع رسالة نجاح
                $stmt->close();
                $conn->close();
                header("Location: employees.php?message=تم حذف الموظف بنجاح");
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
    echo "لم يتم استلام معرف الموظف.";
}
?>
