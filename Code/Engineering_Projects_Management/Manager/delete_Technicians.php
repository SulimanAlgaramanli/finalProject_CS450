<?php
include 'con_db.php';

// التحقق من استلام قيمة TechnicianID من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $technicianID = $_POST['project_id'];

    // التحقق من وجود القيمة
    if (!empty($technicianID)) {
        // تحضير استعلام الحذف
        $sql = "DELETE FROM Technicians WHERE TechnicianID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $technicianID);

        if ($stmt->execute()) {
            // إعادة التوجيه إلى الصفحة الرئيسية بعد الحذف بنجاح
            header("Location: Technicians.php");
            exit();
        } else {
            echo "خطأ في الحذف: " . $conn->error;
        }
    } else {
        echo "لا توجد قيمة لحذفها.";
    }
    $stmt->close();
}

$conn->close();
?>
