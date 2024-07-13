<?php
// تعيين معلومات الاتصال بقاعدة البيانات
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

// التحقق مما إذا كان معرف الدفعة قد تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // إعداد استعلام الحذف
    $sql = "DELETE FROM Payments WHERE PaymentID = ?";

    // تحضير الاستعلام
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);

    // تنفيذ الاستعلام والتحقق من النجاح
    if ($stmt->execute()) {
        echo "تم حذف الدفعة بنجاح.";
    } else {
        echo "حدث خطأ أثناء حذف الدفعة: " . $stmt->error;
    }

    $stmt->close();
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();

// إعادة توجيه المستخدم إلى صفحة جدول المشاريع بعد الحذف
header("Location: Customers_Payment_Table.php");
exit();
?>
