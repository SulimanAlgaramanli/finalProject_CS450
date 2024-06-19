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

// استلام معرف المشروع من الطلب GET
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : '';

// إذا كان معرف المشروع غير فارغ، استعلام لاسترجاع تفاصيل المشروع
if (!empty($project_id)) {
    $sql = "SELECT * FROM projects WHERE ProjectID = '$project_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // عرض تفاصيل المشروع هنا، على سبيل المثال:
        echo "<h2>تفاصيل المشروع رقم " . $row["ProjectID"] . "</h2>";
        echo "<p>اسم الزبون: " . $row["CustomerID"] . "</p>";
        echo "<p>المهندس المشرف: " . $row["SupervisingEngineerID"] . "</p>";
        // استمر في عرض بقية التفاصيل كما ترغب
    } else {
        echo "لم يتم العثور على معلومات المشروع.";
    }
} else {
    echo "معرف المشروع غير محدد.";
}

// إغلاق اتصال قاعدة البيانات
$conn->close();
?>
