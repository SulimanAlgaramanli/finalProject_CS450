<?php
//  هذه الصفحة لإرجاع اخر رقم دفعه تم اضافته و +1 عليه واعتبار هذا رقم الدفعه الجديد

include 'con_db.php';

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
