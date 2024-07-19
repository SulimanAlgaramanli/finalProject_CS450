<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
