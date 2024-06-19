<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// إنشاء اتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// تجميع البيانات من النموذج
$CustomerID = $_POST['CustomerID'];
$SupervisingEngineerID = $_POST['SupervisingEngineerID'];
$ContractSignDate = $_POST['ContractSignDate'];
$LandLocation = $_POST['LandLocation'];
$IsInPlan = isset($_POST['IsInPlan']) ? 1 : 0;
$HasBuildingPermit = isset($_POST['HasBuildingPermit']) ? 1 : 0;
$PropertyType = $_POST['PropertyType'];
$LandArea = $_POST['LandArea'];
$CoveredArea = $_POST['CoveredArea'];
$DesignerOfficeName = $_POST['DesignerOfficeName'];
$DesignMapsSoftwareVersion = $_POST['DesignMapsSoftwareVersion'];
$ProjectStartDate = $_POST['ProjectStartDate'];
$ProjectEndDate = $_POST['ProjectEndDate'];
$ProjectStatus = $_POST['ProjectStatus'];
$ProgressPercentage = $_POST['ProgressPercentage'];
$TotalAmountPaid = $_POST['TotalAmountPaid'];
$AmountSpent = $_POST['AmountSpent'];
$PropertyDescription = $_POST['PropertyDescription']; // إضافة وصف العقار

// استخدام prepared statements لحماية من هجمات حقن SQL
$stmt = $conn->prepare("INSERT INTO projects (CustomerID, SupervisingEngineerID, ContractSignDate, LandLocation, IsInPlan, HasBuildingPermit, PropertyType, LandArea, CoveredArea, DesignerOfficeName, DesignMapsSoftwareVersion, ProjectStartDate, ProjectEndDate, ProjectStatus, ProgressPercentage, TotalAmountPaid, AmountSpent, PropertyDescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisiiisddsssssdss", $CustomerID, $SupervisingEngineerID, $ContractSignDate, $LandLocation, $IsInPlan, $HasBuildingPermit, $PropertyType, $LandArea, $CoveredArea, $DesignerOfficeName, $DesignMapsSoftwareVersion, $ProjectStartDate, $ProjectEndDate, $ProjectStatus, $ProgressPercentage, $TotalAmountPaid, $AmountSpent, $PropertyDescription);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "تم إضافة المشروع بنجاح";
} else {
    $response['success'] = false;
    $response['message'] = "خطأ: " . $stmt->error;
}

$stmt->close();
$conn->close();

// إرجاع الرد بصيغة JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
