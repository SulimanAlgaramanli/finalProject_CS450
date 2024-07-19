


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

// استقبال معرف المشروع من الطلب POST
$projectID = $_POST['projectID'];

// استعلام SQL للحصول على آخر رقم دفعة
$sql = "SELECT MAX(paymentNumber) AS lastPaymentNumber FROM payments WHERE ProjectID = '$projectID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastPaymentNumber = $row['lastPaymentNumber'] ? $row['lastPaymentNumber'] + 1 : 1;
    // إعداد البيانات للرجوع بها كاستجابة JSON
    $response = array('paymentNumber' => $lastPaymentNumber);
    echo json_encode($response);
} else {
    $response = array('paymentNumber' => 1); // إذا لم يكن هناك دفعات سابقة
    echo json_encode($response);
}

$conn->close();
?>
