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

// استعلام SQL لاسترجاع رقم الفاتورة الأخيرة بناءً على المشروع
$sql = "SELECT MAX(invoice_number) AS max_invoice FROM MaterialInvoices WHERE project_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $projectID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// تحويل النتيجة إلى JSON وإرجاعها
echo json_encode(array("invoiceNumber" => $row['max_invoice'] + 1)); // +1 للحصول على رقم الفاتورة التالي
$stmt->close();
$conn->close();
?>
