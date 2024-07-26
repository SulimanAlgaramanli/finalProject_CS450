<?php
include 'con_db.php';

// استرجاع معلومات المشروع بناءً على معرّف المشروع
$project_id = isset($_GET['project_id']) ? $_GET['project_id'] : '';
$project = null;

if ($project_id) {
    $sql = "SELECT * FROM projects WHERE ProjectID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
}

// التحقق من البيانات
$customer_id = isset($project['CustomerID']) ? $project['CustomerID'] : '';
$supervising_engineer_id = isset($project['SupervisingEngineerID']) ? $project['SupervisingEngineerID'] : '';
$contract_sign_date = isset($project['ContractSignDate']) ? $project['ContractSignDate'] : '';
$land_location = isset($project['LandLocation']) ? $project['LandLocation'] : '';
$is_in_plan = isset($project['IsInPlan']) ? $project['IsInPlan'] : '';
$has_building_permit = isset($project['HasBuildingPermit']) ? $project['HasBuildingPermit'] : '';
$property_type = isset($project['PropertyType']) ? $project['PropertyType'] : '';
$land_area = isset($project['LandArea']) ? $project['LandArea'] : '';
$project_start_date = isset($project['ProjectStartDate']) ? $project['ProjectStartDate'] : '';
$project_end_date = isset($project['ProjectEndDate']) ? $project['ProjectEndDate'] : '';
$project_status = isset($project['ProjectStatus']) ? $project['ProjectStatus'] : '';
$progress_percentage = isset($project['ProgressPercentage']) ? $project['ProgressPercentage'] : '';
$property_description = isset($project['PropertyDescription']) ? $project['PropertyDescription'] : '';
$rate_of_cost_plus = isset($project['rate_Of_CostPlus']) ? $project['rate_Of_CostPlus'] : '';


// جلب قائمة الزبائن
$sql_customers = "SELECT CustomerID, CustomerName FROM customers";
$result_customers = $conn->query($sql_customers);
if (!$result_customers) {
    die("Error fetching customers: " . $conn->error);
}

// جلب قائمة مديري المشاريع
$sql_engineers = "SELECT employeeID, employeeName FROM employees WHERE userType = 3";
$result_engineers = $conn->query($sql_engineers);
if (!$result_engineers) {
    die("Error fetching engineers: " . $conn->error);
}

// جلب قائمة أنواع العقارات
$sql_property_types = "SELECT id, TypeName FROM propertytype";
$result_property_types = $conn->query($sql_property_types);
if (!$result_property_types) {
    die("Error fetching property types: " . $conn->error);
}

// جلب قائمة حالات المشاريع
$sql_status = "SELECT id, StatusName FROM projectstatus";
$result_status = $conn->query($sql_status);
if (!$result_status) {
    die("Error fetching project status: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تعديل مشروع</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="../Css/main.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-container {
            width: 100%;
            padding: 20px;
            border-radius: 8px;
        }

        .form-container label {
            font-weight: bold;
            display: block;
            width: 30%;
            text-align: right;
            font-size: 16px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .form-container input[type=text],
        .form-container input[type=date],
        .form-container input[type=number],
        .form-container input[type=checkbox],
        .form-container input[type=radio],
        .form-container textarea,
        .form-container select {
            width: calc(70% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-container input[type=checkbox] {
            width: auto;
            display: inline-block;
        }

        .form-container select {
            width: calc(70% - 22px);
            padding-right: 20px;
        }

        .form-container .button_add {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .form-container .button_add:hover {
            background-color: #45a049;
        }

        .form-container input[type=checkbox] {
            width: auto;
            display: inline-block;
        }

        .form-container textarea {
            height: 100px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>تعديل مشروع</h1>
        <div class="form-container">
            <form method="POST" action="update_project.php">
                <input type="hidden" name="project_id" value="<?php echo htmlspecialchars($project_id); ?>" />
                
                <label for="customer_id">اسم الزبون:</label>
                <select name="customer_id" id="customer_id">
                    <option value="">اختيار الزبون</option>
                    <?php while ($row_customer = $result_customers->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row_customer['CustomerID']); ?>" <?php echo ($row_customer['CustomerID'] == $customer_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row_customer['CustomerName']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br />

                <label for="supervising_engineer_id">مدير المشروع:</label>
                <select name="supervising_engineer_id" id="supervising_engineer_id">
                    <option value="">اختيار مدير المشروع</option>
                    <?php while ($row_engineer = $result_engineers->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row_engineer['employeeID']); ?>" <?php echo ($row_engineer['employeeID'] == $supervising_engineer_id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row_engineer['employeeName']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br />

                <label for="contract_sign_date">تاريخ توقيع العقد:</label>
                <input type="date" name="contract_sign_date" id="contract_sign_date" value="<?php echo htmlspecialchars($contract_sign_date); ?>" />
                <br />

                <label for="land_location">الموقع:</label>
                <input type="text" name="land_location" id="land_location" value="<?php echo htmlspecialchars($land_location); ?>" />
                <br />

                <label for="is_in_plan">موجود في المخطط:</label>
                <input type="checkbox" name="is_in_plan" id="is_in_plan" value="1" <?php echo ($is_in_plan == '1') ? 'checked' : ''; ?> />
                <br />

                <label for="has_building_permit">ترخيص البناء:</label>
                <input type="checkbox" name="has_building_permit" id="has_building_permit" value="1" <?php echo ($has_building_permit == '1') ? 'checked' : ''; ?> />
                <br />

                <label for="property_type">نوع العقار:</label>
                <select name="property_type" id="property_type">
                    <option value="">اختيار نوع العقار</option>
                    <?php while ($row_property_type = $result_property_types->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row_property_type['id']); ?>" <?php echo ($row_property_type['id'] == $property_type) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row_property_type['TypeName']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br />

                <label for="land_area">مساحة الأرض:</label>
                <input type="text" name="land_area" id="land_area" value="<?php echo htmlspecialchars($land_area); ?>" />
                <br />

                <label for="ProjectStartDate">تاريخ بدء المشروع:</label>
                <input type="date" name="ProjectStartDate" id="ProjectStartDate" value="<?php echo htmlspecialchars($project_start_date); ?>" />
                <br />

                <label for="ProjectEndDate">تاريخ انتهاء المشروع:</label>
                <input type="date" name="ProjectEndDate" id="ProjectEndDate" value="<?php echo htmlspecialchars($project_end_date); ?>" />
                <br />

                <label for="project_status">حالة المشروع:</label>
                <select name="project_status" id="project_status">
                    <option value="">اختيار حالة المشروع</option>
                    <?php while ($row_status = $result_status->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row_status['id']); ?>" <?php echo ($row_status['id'] == $project_status) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row_status['StatusName']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br />

                <label for="progress_percentage">نسبة الإنجاز:</label>
                <input type="number" name="progress_percentage" id="progress_percentage" value="<?php echo htmlspecialchars($progress_percentage); ?>" />
                <br />

                <label for="property_description">وصف العقار:</label>
                <textarea name="property_description" id="property_description"><?php echo htmlspecialchars($property_description); ?></textarea>
                <br />

                <label for="rate_of_cost_plus">نسبة تكلفة الزائد:</label>
                <input type="text" name="rate_of_cost_plus" id="rate_of_cost_plus" value="<?php echo htmlspecialchars($rate_of_cost_plus); ?>" />
                <br />

                <input type="submit" class="button_add" value="تعديل المشروع" />
            </form>
        </div>
    </div>
</body>
</html>
