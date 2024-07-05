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

if (isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // جلب بيانات المشروع
    $sql = "SELECT ProjectID, CustomerID, SupervisingEngineerID, LandLocation, ProjectStartDate, ProjectEndDate, ProjectStatus, ProgressPercentage, TotalAmountPaid, AmountSpent
            FROM projects
            WHERE ProjectID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo "خطأ في الاستعلام: " . $conn->error;
    } else {
        $project = $result->fetch_assoc();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = $_POST['project_id'];
    $customer_id = $_POST['customer_id'];
    $supervising_engineer_id = $_POST['supervising_engineer_id'];
    $land_location = $_POST['land_location'];
    $project_start_date = $_POST['project_start_date'];
    $project_end_date = !empty($_POST['project_end_date']) ? $_POST['project_end_date'] : null;
    $project_status = $_POST['project_status'];
    $progress_percentage = $_POST['progress_percentage'];
    $total_amount_paid = $_POST['total_amount_paid'];
    $amount_spent = $_POST['amount_spent'];

    // تحديث بيانات المشروع باستخدام prepared statement
    $sql = "UPDATE projects
            SET CustomerID = ?,
                SupervisingEngineerID = ?,
                LandLocation = ?,
                ProjectStartDate = ?,
                ProjectEndDate = ?,
                ProjectStatus = ?,
                ProgressPercentage = ?,
                TotalAmountPaid = ?,
                AmountSpent = ?
            WHERE ProjectID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssdidi", $customer_id, $supervising_engineer_id, $land_location, $project_start_date, $project_end_date, $project_status, $progress_percentage, $total_amount_paid, $amount_spent, $project_id);

    if ($stmt->execute() === TRUE) {
        // تم التحديث بنجاح، قم بتوجيه المستخدم إلى صفحة المشاريع
        header("Location: Projects_Table.php");
        exit();
    } else {
        echo "خطأ في التحديث: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المشروع</title>
<style>
/* styles.css */
body {
    font-family: Arial, sans-serif;
    direction: rtl; /* توجيه النصوص إلى اليمين */
}

h1 {
    color: #333;
    text-align: center;
    padding: 30px;
}

form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="number"],
input[type="text"],
input[type="date"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 16px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
</style>

</head>
<body>
    <h1>تعديل المشروع</h1>
    <form method="POST" action="edit_project.php">
        <input type="hidden" name="project_id" value="<?php echo $project['ProjectID']; ?>">
        
        <label for="customer_id">رقم الزبون:</label>
        <input type="number" id="customer_id" name="customer_id" value="<?php echo $project['CustomerID']; ?>" required><br>

        <label for="supervising_engineer_id">رقم مدير المشروع:</label>
        <input type="number" id="supervising_engineer_id" name="supervising_engineer_id" value="<?php echo $project['SupervisingEngineerID']; ?>" required><br>

        <label for="land_location">الموقع:</label>
        <input type="text" id="land_location" name="land_location" value="<?php echo $project['LandLocation']; ?>" required><br>

        <label for="project_start_date">تاريخ البدء:</label>
        <input type="date" id="project_start_date" name="project_start_date" value="<?php echo $project['ProjectStartDate']; ?>" required><br>

        <label for="project_end_date">تاريخ الانتهاء:</label>
        <input type="date" id="project_end_date" name="project_end_date" value="<?php echo $project['ProjectEndDate']; ?>"><br>

        <label for="project_status">حالة المشروع:</label>
        <input type="text" id="project_status" name="project_status" value="<?php echo $project['ProjectStatus']; ?>" required><br>

        <label for="progress_percentage">نسبة التقدم:</label>
        <input type="number" id="progress_percentage" name="progress_percentage" value="<?php echo $project['ProgressPercentage']; ?>" required><br>

        <label for="total_amount_paid">المبلغ الكلي المدفوع:</label>
        <input type="number" id="total_amount_paid" name="total_amount_paid" value="<?php echo $project['TotalAmountPaid']; ?>" required><br>

        <label for="amount_spent">المبلغ المصروف:</label>
        <input type="number" id="amount_spent" name="amount_spent" value="<?php echo $project['AmountSpent']; ?>" required><br>


        <button type="submit">تحديث</button>
    </form>
</body>
</html>
