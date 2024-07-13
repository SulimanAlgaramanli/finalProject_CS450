<?php
// تفاصيل الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استلام معرف المشروع من البيانات المرسلة عبر POST
$projectID = $_POST['projectID'];

// استعلام للحصول على أعلى رقم دفعة وزيادته بواحد
$sql_max_payment = "SELECT MAX(paymentNumber) AS max_payment FROM payments WHERE ProjectID = $projectID";
$result_max_payment = $conn->query($sql_max_payment);

if ($result_max_payment->num_rows > 0) {
    $row = $result_max_payment->fetch_assoc();
    $next_payment_number = $row['max_payment'] + 1;
} else {
    // إذا لم يكن هناك أي دفعات سابقة، يمكنك تعيين القيمة الأولى كما تشاء
    $next_payment_number = 1;
}

// إغلاق الاتصال
$conn->close();

// إرجاع القيمة كاستجابة JSON
echo json_encode($next_payment_number);
?>
