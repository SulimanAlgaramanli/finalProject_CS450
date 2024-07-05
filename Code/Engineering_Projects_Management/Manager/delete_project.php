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

// التحقق مما إذا كان معرف المشروع قد تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // إعداد استعلام الحذف
    $sql = "DELETE FROM projects WHERE ProjectID = ?";

    // تحضير الاستعلام
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);

    // تنفيذ الاستعلام والتحقق من النجاح
    if ($stmt->execute()) {
        echo "تم حذف المشروع بنجاح.";
    } else {
        echo "حدث خطأ أثناء حذف المشروع: " . $stmt->error;
    }

    $stmt->close();
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();

// إعادة توجيه المستخدم إلى صفحة جدول المشاريع بعد الحذف
header("Location: Projects_Table.php");
exit();
?>
