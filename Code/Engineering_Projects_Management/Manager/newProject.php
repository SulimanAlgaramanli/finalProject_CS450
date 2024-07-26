<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerID = isset($_POST['customerName']) ? $_POST['customerName'] : null;
    $supervisingEngineerID = isset($_POST['employeeName']) ? $_POST['employeeName'] : null;
    $contractSignDate = isset($_POST['ContractSignDate']) ? $_POST['ContractSignDate'] : null;
    $landLocation = isset($_POST['LandLocation']) ? $_POST['LandLocation'] : null;
    $propertyType = isset($_POST['PropertyType']) ? $_POST['PropertyType'] : null;
    $landArea = isset($_POST['LandArea']) ? $_POST['LandArea'] : null;
    $IsInPlan = isset($_POST['IsInPlan']) ? $_POST['IsInPlan'] : 0; 
    $HasBuildingPermit = isset($_POST['HasBuildingPermit']) ? $_POST['HasBuildingPermit'] : 0; 
    $projectStartDate = isset($_POST['ProjectStartDate']) ? $_POST['ProjectStartDate'] : null;
    $rateOfCostPlus = isset($_POST['rate_Of_CostPlus']) ? $_POST['rate_Of_CostPlus'] : null;
    $projectStatus = isset($_POST['ProjectStatus']) ? $_POST['ProjectStatus'] : 1;
    $PropertyDescription =  null;
    $ProgressPercentage = 0;


    // تحضير جملة SQL
    $sql = "INSERT INTO projects (CustomerID, SupervisingEngineerID, ContractSignDate, IsInPlan, HasBuildingPermit, LandLocation, PropertyType, LandArea, ProjectStartDate, ProjectStatus, rate_Of_CostPlus, ProgressPercentage, PropertyDescription)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // ربط المعلمات
    $stmt->bind_param("iisiisiisiiis", $customerID, $supervisingEngineerID, $contractSignDate, $IsInPlan, $HasBuildingPermit, $landLocation, $propertyType, $landArea, $projectStartDate, $projectStatus, $rateOfCostPlus, $ProgressPercentage, $PropertyDescription);

    // تنفيذ جملة SQL
    if ($stmt->execute()) {
        // echo "Project added successfully";

        header("Location: projects_Table.php");
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// استرداد أنواع العقارات
$sql_1 = "SELECT id, TypeName FROM propertytype";
$result_1 = $conn->query($sql_1);

// استرداد حالات المشروع
$sql_2 = "SELECT id, StatusName FROM projectstatus";
$result_2 = $conn->query($sql_2);

// استرداد أسماء الزبائن
$sql_3 = "SELECT CustomerID, CustomerName FROM customers";
$result_3 = $conn->query($sql_3);

// استرداد أسماء المهندسين
$sql_4 = "SELECT employeeId, employeeName FROM employees WHERE userType = 3";
$result_4 = $conn->query($sql_4);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة مشروع</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />

    <style>
        .form-container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 900px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .form-container label {
            font-weight: bold;
            display: block;
            width: 30%;
            text-align: right;
            font-size: 20px; 
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
            width: 65%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            display: inline-block;
            box-sizing: border-box;
        }
        .form-container input[type=checkbox] {
            display: inline-block;
            width: auto; /* تغييرت هنا */
        }
        .form-container select {
            width: calc(65% + 18px);
            padding-right: 18px;
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

    </style>
</head>
<body>

<div class="min-contener">
    <form id="projectForm" action="newProject.php" method="POST">
        <div class="form-container">
        <h1 style="text-align: center;">إضافة مشروع جديد</h1><br>
            <div class="form-group">
                <label for="customerName">اسم الزبون:</label>
                <select id="customerName" name="customerName" required>
                    <option value="" disabled selected>اختر الزبون</option>
                    <?php
                    if ($result_3->num_rows > 0) {
                        while($row = $result_3->fetch_assoc()) {
                            echo '<option value="'.$row["CustomerID"].'">'.$row["CustomerName"].'</option>';
                        }
                    } else {
                        echo '<option value="" disabled>لا يوجد زبائن  </option>';
                    }
                    ?>
                </select><br />

                <label for="employeeName">اسم المهندس :</label>
                <select id="employeeName" name="employeeName" required>
                    <option value="" disabled selected>اختر مدير المشروع</option>
                    <?php
                    if ($result_4->num_rows > 0) {
                        while($row = $result_4->fetch_assoc()) {
                            echo '<option value="'.$row["employeeId"].'">'.$row["employeeName"].'</option>';
                        }
                    } else {
                        echo '<option value="" disabled>لا يوجد مهندسين  </option>';
                    }
                    ?>
                </select><br />

                <label for="ContractSignDate">تاريخ توقيع العقد:</label>
                <input type="date" id="ContractSignDate" name="ContractSignDate" required><br />

                <label for="rate_Of_CostPlus">نسبة الربح :</label>
                <input type="number" step="0.01" id="rate_Of_CostPlus" name="rate_Of_CostPlus" required /><br />


                <label for="LandLocation">الموقع :</label>
                <input type="text" id="LandLocation" name="LandLocation" required><br />



                <label for="landArea">المساحة :</label>
                <input type="number" step="0.01" id="landArea" name="LandArea" required /><br />

                <label for="PropertyType">نوع العقار:</label>
                <select id="PropertyType" name="PropertyType" required>
                    <option value="" disabled selected>اختر نوع العقار</option>
                    <?php
                    if ($result_1->num_rows > 0) {
                        while($row = $result_1->fetch_assoc()) {
                            echo '<option value="'.$row["id"].'">'.$row["TypeName"].'</option>';
                        }
                    } else {
                        echo '<option value="" disabled selected>لا توجد أنواع عقارات  </option>';
                    }
                    ?>
                </select><br />

                <label for="IsInPlan">داخل المخطط:</label>
                <input type="checkbox" id="IsInPlan" name="IsInPlan" value="1"><br />

                <label for="HasBuildingPermit">تصريح البناء:</label>
                <input type="checkbox" id="HasBuildingPermit" name="HasBuildingPermit" value="1"><br />

                <label for="ProjectStartDate">تاريخ بداية المشروع:</label>
                <input type="date" id="ProjectStartDate" name="ProjectStartDate" required><br />

                <label for="ProjectStatus">حالة المشروع:</label>
                <select id="ProjectStatus" name="ProjectStatus" required>
                    <option disabled selected>اختر حالة المشروع</option>
                    <?php
                    if ($result_2->num_rows > 0) {
                        while($row = $result_2->fetch_assoc()) {
                            echo '<option value="'.$row["id"].'">'.$row["StatusName"].'</option>';
                        }
                    } else {
                        echo '<option value="" disabled>لا توجد حالات مشروع</option>';
                    }
                    ?>
                </select><br />
                <br />

                <label for="PropertyDescription">وصف العقار:</label>
                <textarea id="PropertyDescription" name="PropertyDescription" rows="4" cols="50"></textarea><br />

                <div class="button-container" style="  text-align: center; ">
                    <button type="submit" class="button_save"><i class="fas fa-save"></i>حفظ</button>
                    <button type="button" class="button_cancel"  onclick="window.location.href='Projects_Table.php';"><i class="fas fa-close"></i>إلغاء</button>
                </div>
        </div>
    </form>
</div>

<script>
    
</script>
<script src="script.js"></script>

</body>
</html>

<?php
// إغلاق اتصال قاعدة البيانات
$conn->close();
?>
