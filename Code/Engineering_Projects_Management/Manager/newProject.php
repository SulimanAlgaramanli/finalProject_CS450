<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>مشروع جديد</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../Css/main.css" />
    <!-- <link rel="stylesheet" href="../Css/style.css" /> -->

    <style>
      /* تنسيق النموذج */
.form-container {
    width: 80%;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


/* تنسيق الحقول والتسميات */
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
/* تنسيق التشيك بوكس */
.form-container input[type=checkbox] {
    display: inline-block;

}

.form-container select {
    width: calc(65% + 18px); /* لضمان تناسب اختيارات القائمة مع النص */
    padding-right: 18px; /* تعديل لاحتساب خلفية الاختيار */
}

/* تنسيق الزر */
.form-container .button_add {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    /* text-align: right; */
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
<div class="master">
    <div class="header">
        <div class="navbar">
            <div class="left-section">
                <div class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars" id="bar" ></i>
                </div>
            </div>
            <div class="search-box">
                <input type="text" placeholder="البحث..." />
                <span class="search-icon">&#128269;</span>
            </div>
            <div class="icons">
                <i class="fas fa-bell icon"></i>
                <i class="fas fa-cog icon"></i>
            </div>
            <span class="username">اسم المستخدم</span>
            <img src="../icons/user.png" class="img_user" alt="صورة المستخدم" />
        </div>
    </div>
    <div class="contener">
        <div class="sidebar hidden" id="sidebar">
            <aside class="sidebar-content">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php"
                            ><i class="fas fa-home"></i> الصفحة الرئيسية</a
                            >
                        </li>
                        <li>
                            <a href="customers.php"
                            ><i class="fas fa-users"></i> قسم الزبائن</a
                            >
                        </li>
                        <li class="has-submenu">
                            <span onclick="toggleSubmenu(this)">
                                <i class="fas fa-project-diagram"></i> قسم المشاريع
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <ul class="submenu">
                                <li><a href="Projects_Table.php">جدول المشاريع</a></li>
                                <li><a href="Engineers_Table.php">جدول المهندسين</a></li>
                                <li><a href="Technicians_Table.php">جدول الفنيين</a></li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <span onclick="toggleSubmenu(this)">
                                <i class="fas fa-dollar-sign"></i> القسم المالي
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <ul class="submenu">
                                <li>
                                    <a href="Customers_Payment_Table.php"
                                    >جدول دفعات الزبائن</a
                                    >
                                </li>
                                <li>
                                    <a href="Procurement_Covenant_Table.php"
                                    >جدول عهد المشتريات</a
                                    >
                                </li>
                                <li>
                                    <a href="Technician_Invoices_Table.php"
                                    >جدول فواتير الفنيين</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <span onclick="toggleSubmenu(this)">
                                <i class="fas fa-shopping-cart"></i> قسم المشتريات
                                <i class="fas fa-chevron-down"></i>
                            </span>
                            <ul class="submenu">
                                <li>
                                    <a href="Purchase_Invoices_Table.php"
                                    >جدول فواتير المشتريات</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="Control_Board.php"
                            ><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a
                            >
                        </li>
                    </ul>
                </nav>
            </aside>
        </div>
            <div class="min-contener">
            <h1>مشروع جديد</h1>
<form id="projectForm" action="newProject.php" method="POST">
    <div class="form-container">
        <div class="form-group">
            <label for="customerID">معرف الزبون:</label>
            <input type="number" id="customerID" name="CustomerID" required /><br />

            <label for="supervisingEngineerID">معرف المهندس المشرف:</label>
            <input type="number" id="supervisingEngineerID" name="SupervisingEngineerID" required /><br />

            <label for="contractSignDate">تاريخ توقيع العقد:</label>
            <input type="date" id="contractSignDate" name="ContractSignDate" required /><br />

            <label for="landLocation">موقع الأرض:</label>
            <input type="text" id="landLocation" name="LandLocation" required /><br />

            <label for="landArea">مساحة الأرض:</label>
            <input type="number" step="0.01" id="landArea" name="LandArea" required /><br />

            <label for="isInPlan">في المخطط:</label>
            <input type="checkbox" id="isInPlan" name="IsInPlan" value="1" /><br />

            <label for="hasBuildingPermit">رخصة بناء:</label>
            <input type="checkbox" id="hasBuildingPermit" name="HasBuildingPermit" value="1" /><br />
        </div>
        <div class="form-group">
            <hr />
        </div>
        <div class="form-group">
            <label for="typeProject">نوع العقار:</label>
            <select id="typeProject" name="PropertyType" required>
                <option value="" disabled selected>اختر نوع العقار</option>
                <option value="فيلا">فيلا</option>
                <option value="عمارة">عمارة</option>
                <option value="سوق">سوق</option>
                <option value="فندق">فندق</option>
                <option value="مستشفى">مستشفى</option>
                <option value="مدرسة">مدرسة</option>
                <option value="شركة">شركة</option>
            </select><br />

            <label for="propertyDescription">وصف للعقار:</label>
            <textarea id="propertyDescription" name="PropertyDescription"></textarea><br />

            <label for="coveredArea">مساحة المسقوف:</label>
            <input type="number" step="0.01" id="coveredArea" name="CoveredArea" required /><br />

            <label for="designerOfficeName">اسم مكتب المصمم:</label>
            <input type="text" id="designerOfficeName" name="DesignerOfficeName" required /><br />

            <label for="designMapsSoftwareVersion">نسخة من الخرائط والتصميم:</label>
            <input type="text" id="designMapsSoftwareVersion" name="DesignMapsSoftwareVersion" /><br />

            <label for="projectStartDate">تاريخ بدء المشروع:</label>
            <input type="date" id="projectStartDate" name="ProjectStartDate" required /><br />

            <label for="projectEndDate">تاريخ انتهاء المشروع:</label>
            <input type="date" id="projectEndDate" name="ProjectEndDate" /><br />

            <label for="projectStatus">حالة المشروع:</label>
            <select id="projectStatus" name="projectStatus" required>
                <option value="" disabled selected>اختر حالة المشروع</option>
                <option value="">تحت الانجاز</option>
                <option value="فيلا">متوقف</option>
                <option value="عمارة">مكتمل</option>
            </select><br />

            <label for="rate_Of_CostPlus">نسبة الارباح(CostPlus):</label>
            <input type="number" step="0.01" id="rate_Of_CostPlus" name="rate_Of_CostPlus" required /><br />

        </div>
    </div>
    <div class="button-container">
        <button type="submit" class="button_save"><i class="fas fa-save"></i>حفظ</button>
        <button type="button" class="button_cancel"><i class="fas fa-close"></i>إلغاء</button>
    </div>
</form>

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
    $customerID = isset($_POST['CustomerID']) ? $_POST['CustomerID'] : null;
    $supervisingEngineerID = isset($_POST['SupervisingEngineerID']) ? $_POST['SupervisingEngineerID'] : null;
    $contractSignDate = isset($_POST['ContractSignDate']) ? $_POST['ContractSignDate'] : null;
    $landLocation = isset($_POST['LandLocation']) ? $_POST['LandLocation'] : null;
    $propertyType = isset($_POST['PropertyType']) ? $_POST['PropertyType'] : null;
    $landArea = isset($_POST['LandArea']) ? $_POST['LandArea'] : null;
    $coveredArea = isset($_POST['CoveredArea']) ? $_POST['CoveredArea'] : null;
    $designerOfficeName = isset($_POST['DesignerOfficeName']) ? $_POST['DesignerOfficeName'] : null;
    $designMapsSoftwareVersion = isset($_POST['DesignMapsSoftwareVersion']) ? $_POST['DesignMapsSoftwareVersion'] : null;
    $projectStartDate = isset($_POST['ProjectStartDate']) ? $_POST['ProjectStartDate'] : null;
    $projectEndDate = isset($_POST['ProjectEndDate']) ? $_POST['ProjectEndDate'] : null;
    $projectStatus = isset($_POST['ProjectStatus']) ? $_POST['ProjectStatus'] : null;
    $rateOfCostPlus = isset($_POST['rate_Of_CostPlus']) ? $_POST['rate_Of_CostPlus'] : null;

    // تحضير جملة SQL
    $sql = "INSERT INTO projects (CustomerID, SupervisingEngineerID, ContractSignDate, LandLocation, PropertyType, LandArea, CoveredArea, DesignerOfficeName, DesignMapsSoftwareVersion, ProjectStartDate, ProjectEndDate, ProjectStatus, rate_Of_CostPlus)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // ربط المعلمات
    $stmt->bind_param("iisssisssssis", $customerID, $supervisingEngineerID, $contractSignDate, $landLocation, $propertyType, $landArea, $coveredArea, $designerOfficeName, $designMapsSoftwareVersion, $projectStartDate, $projectEndDate, $projectStatus, $rateOfCostPlus);

    // تنفيذ جملة SQL
    if ($stmt->execute()) {
        echo "Project added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

        
                
            </div>
        </div>
    </div>


    <div class="footer">
        <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
    </div>
</div>
<script>
    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        var sidebarToggle = document.querySelector(".sidebar-toggle i");
        if (sidebar.classList.contains("hidden")) {
            sidebar.classList.remove("hidden");
            sidebarToggle.classList.remove("fa-bars");
            sidebarToggle.classList.add("fa-times");
            document.body.style.marginRight = "300px";
        } else {
            sidebar.classList.add("hidden");
            sidebarToggle.classList.remove("fa-times");
            sidebarToggle.classList.add("fa-bars");
            document.body.style.marginRight = "0";
        }
    }

    function toggleSubmenu(element) {
        var submenu = element.nextElementSibling;
        element.querySelector(".fa-chevron-down").classList.toggle("rotate");
        submenu.classList.toggle("show");
    }


</script>
</body>
</html>


