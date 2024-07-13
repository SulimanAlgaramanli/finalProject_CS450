<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الفنيين</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />
</head>
<body>
<div class="master">
    <div class="header">
        <div class="navbar">
            <div class="left-section">
                <div class="" onclick="toggleSidebar()">
                    <i class="fas fa-bars" id="bar"></i>
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
                            ><i class="fas fa-home"></i> الصفحة الرئيسية</a>
                        </li>

                        <li>
                            <a href="Projects_Table.php">
                            <i class="fas fa-project-diagram"></i>  المشاريع </a>
                        </li>

                        <li>
                            <a href="Customers_Payment_Table.php">
                            <i class="fas fa-dollar-sign"></i> دفعات الزبائن </a>
                        </li>

                        <li>
                            <a href="MaterialInvoices.php">
                            <i class="fas fa-shopping-cart"></i> فواتير المواد </a>
                        </li>

                        <li>
                            <a href="Technician_Invoices_Table.php">
                            <i class="fas fa-file-invoice"></i> فواتير الفنيين </a>
                        </li>

                        <li>
                            <a href="customers.php">
                            <i class="fas fa-user-friends"></i> الزبائن </a>
                        </li>

                        <li>
                            <a href="employees.php">
                            <i class="fas fa-user-tie"></i> الموظفين </a>
                        </li>

                        <li>
                            <a href="Technicians.php">
                            <i class="fas fa-tools"></i> الفنيين </a>
                        </li>

                        <li>
                            <a href="Control_Board.php">
                            <i class="fas fa-tachometer-alt"></i> لوحة التحكم </a>
                        </li>


                    </ul>
                </nav>
            </aside>
        </div>

        <h1>بيانات الفنيين</h1>
        <div class="min-contener"  style="margin-right: 160px;">
            <form class="form_fillter" method="GET" action="">
    
            <div class="filters-container">
    
            <div class="box_fillter1">
            
                <label class="fillter_label" for="year">اختر السنة:</label>
                <select class="fillter_label" name="year" id="year" onchange="this.form.submit()">
                    <option value="">الكل</option>
                    <option value="2024" <?php if(isset($_GET['year']) && $_GET['year'] == '2024') echo 'selected'; ?>>2024</option>
                    <option value="2023" <?php if(isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>2023</option>
                    <option value="2022" <?php if(isset($_GET['year']) && $_GET['year'] == '2022') echo 'selected'; ?>>2022</option>
                    <option value="2021" <?= isset($_GET['year']) && $_GET['year'] == '2021' ? 'selected' : '' ?>>2021</option>
                    <option value="2020" <?= isset($_GET['year']) && $_GET['year'] == '2020' ? 'selected' : '' ?>>2020</option>
                </select>

            </div>
        
            <div class="box_fillter3">
                <div class="search-container">
                    <input type="text" name="search_name" id="search_name" class="filtter_input_search" placeholder="ابحث عن اسم الفني" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
<div id="space" >
</div>
                    <input type="text" name="search_search_Nationality" id="search_search_Nationality" class="filtter_input_search" placeholder="ابحث عن اسم الجنسية" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                </div>
            </div>
        </div>

                    
                <!-- أزرار الطباعة والإضافة -->
                <div class="div_print_add_button">
                    <button class="button_print" onclick="printTable()">
                        <i class="fas fa-print"></i> طباعة
                    </button>

                    <button onclick="location.href='new_Technicians.php'" type="button" class="button_add" id="add-Btn">
                        <i class="fas fa-plus"></i> إضافة
                    </button>
                </div>
            </form>

                <div class="table-container">
                    <div class='table-wrapper'>
                        <table id="table_projects">
                            <thead>
                                <tr>
                                    <th>رقم الفني</th>
                                    <th>اسم الفني</th>
                                    <th>التخصص</th>
                                    <th>الجنسية</th>
                                    <th>الهاتف</th>
                                    <th>تاريخ الانضمام</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            
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

// استلام قيم الفلاتر من طلب GET
$filter_year = isset($_GET['year']) ? $_GET['year'] : '';
$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
$search_Nationality = isset($_GET['search_search_Nationality']) ? $_GET['search_search_Nationality'] : '';

// بناء استعلام SQL مع الفلاتر
$sql = "SELECT tech.TechnicianID, tech.TechnicianName, GROUP_CONCAT(sp.SpecializationName SEPARATOR ', ') AS Specializations, tech.Nationality, tech.PhoneNumber, tech.JoinDate
        FROM Technicians AS tech
        LEFT JOIN technician_specializations AS ts ON tech.TechnicianID = ts.TechnicianID
        LEFT JOIN specializations AS sp  ON ts.SpecializationID = sp.SpecializationID
";

// إضافة الفلاتر إذا كانت موجودة
$conditions = array();

if (!empty($filter_year)) {
    $conditions[] = "YEAR(tech.JoinDate) = '$filter_year'";
}

if (!empty($search_name)) {
    $conditions[] = "tech.TechnicianName LIKE '%$search_name%'";
}
if (!empty($search_Nationality)) {
    $conditions[] = "tech.Nationality LIKE '%$search_Nationality%'";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$sql .= " GROUP BY tech.TechnicianID, tech.TechnicianName, tech.Nationality, tech.PhoneNumber, tech.JoinDate";

// تنفيذ الاستعلام والتحقق من النتائج
$result = $conn->query($sql);

if ($result === false) {
    echo "خطأ في الاستعلام: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["TechnicianID"] . "</td>";
            echo "<td>" . $row["TechnicianName"] . "</td>";
            echo "<td>" . $row["Specializations"] . "</td>";
            echo "<td>" . $row["Nationality"] . "</td>";
            echo "<td>" . $row["PhoneNumber"] . "</td>";
            echo "<td>" . $row["JoinDate"] . "</td>";
            echo "<td>
                    <div class='action-buttons'>
                        <form class='botton_table' method='GET' action='edit_Technicians.php' style='display: inline-block;'>
                            <input type='hidden' name='project_id' value='" . $row["TechnicianID"] . "'>
                            <button class='button_edit' type='submit'>
                                <i id='i_edit' class='fas fa-edit'></i> تعديل
                            </button>
                        </form>
                        <form class='botton_table' method='POST' action='delete_Technicians.php'>
                            <input type='hidden' name='project_id' value='" . $row["TechnicianID"] . "'>
                            <button class='button_delet' type='submit' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>
                                <i id='i_del' class='fas fa-trash-alt'></i> حذف
                            </button>
                        </form>
                    </div>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>لا توجد بيانات</td></tr>";
    }
}

$conn->close();
?>

                            
                            

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="footer">
    <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
</div>
<script>
</script>
<script src="script.js"></script>

</body>
</html>
