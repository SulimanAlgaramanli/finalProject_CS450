<?php
include 'con_db.php';

// استلام البيانات من النموذج
$project_id = isset($_POST['project_id']) ? $_POST['project_id'] : '';
$customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
$supervising_engineer_id = isset($_POST['supervising_engineer_id']) ? $_POST['supervising_engineer_id'] : '';
$contract_sign_date = isset($_POST['contract_sign_date']) ? $_POST['contract_sign_date'] : '';
$land_location = isset($_POST['land_location']) ? $_POST['land_location'] : '';
$is_in_plan = isset($_POST['is_in_plan']) ? '1' : '0';
$has_building_permit = isset($_POST['has_building_permit']) ? '1' : '0';
$property_type = isset($_POST['property_type']) ? $_POST['property_type'] : '';
$land_area = isset($_POST['land_area']) ? $_POST['land_area'] : '';
$project_start_date = isset($_POST['project_start_date']) ? $_POST['project_start_date'] : '';
$project_end_date = isset($_POST['project_end_date']) ? $_POST['project_end_date'] : '';
$project_status = isset($_POST['project_status']) ? $_POST['project_status'] : '';
$progress_percentage = isset($_POST['progress_percentage']) ? $_POST['progress_percentage'] : '';
$property_description = isset($_POST['property_description']) ? $_POST['property_description'] : '';
$rate_of_cost_plus = isset($_POST['rate_of_cost_plus']) ? $_POST['rate_of_cost_plus'] : '';

// تحديث المشروع
$sql = "UPDATE projects SET 
    CustomerID = ?, 
    SupervisingEngineerID = ?, 
    ContractSignDate = ?, 
    LandLocation = ?, 
    IsInPlan = ?, 
    HasBuildingPermit = ?, 
    PropertyType = ?, 
    LandArea = ?, 
    ProjectStartDate = ?, 
    ProjectEndDate = ?, 
    ProjectStatus = ?, 
    ProgressPercentage = ?, 
    PropertyDescription = ?, 
    rate_Of_CostPlus = ?
    WHERE ProjectID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissiiiiisisssi", $customer_id, $supervising_engineer_id, $contract_sign_date, $land_location, $is_in_plan, $has_building_permit, $property_type, $land_area, $project_start_date, $project_end_date, $project_status, $progress_percentage, $property_description, $rate_of_cost_plus, $project_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<script>alert('تم تحديث المشروع بنجاح');</script>";
    header("Location: Projects_Table.php");
    exit(); // تأكد من استخدام exit بعد header
} else {
    echo "لم يتم تحديث المشروع.";
}

$stmt->close();
$conn->close();
?>
