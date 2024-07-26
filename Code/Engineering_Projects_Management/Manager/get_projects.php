<?php


include 'con_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerId = $_POST['CustomerId'];
    $sql_projects = "SELECT ProjectID FROM projects WHERE CustomerId = $customerId";
    $result_projects = $conn->query($sql_projects);

    if ($result_projects->num_rows > 0) {
        echo "<option value='' disabled selected>اختر المشروع</option>";
        while ($row = $result_projects->fetch_assoc()) {
            echo "<option value='" . $row['ProjectID'] . "'>" . $row['ProjectID'] . "</option>";
        }
    } else {
        echo "<option value=''>لا توجد مشاريع متاحة</option>";
    }
}

$conn->close();
?>
