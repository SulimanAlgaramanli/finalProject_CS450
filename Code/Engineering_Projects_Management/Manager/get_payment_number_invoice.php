<?php
// هذه الصفحة لإرجاع اخر دفعه تم ادخالها لعرضها في صفحة اضافة فاتورة (فنية او مواد)

include 'con_db.php';


// استقبال معرف المشروع من الطلب القادم
$projectID = $_POST['projectID'];

// استعلام SQL لاسترجاع رقم الدفعة الأخيرة بناءً على المشروع
$sql = "SELECT MAX(paymentNumber) AS max_payment FROM payments WHERE ProjectID  = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $projectID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// تحويل النتيجة إلى JSON وإرجاعها
echo json_encode(array("paymentNumber" => $row['max_payment'] )); 

$stmt->close();
$conn->close();
?>
