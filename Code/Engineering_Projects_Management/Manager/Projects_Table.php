<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المشاريع</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../Css/main.css" />
    <!-- <link rel="stylesheet" href="../Css/style.css" /> -->

</head>
<body>

<style>
    /* .form_fillter {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    margin-bottom: 20px;
}

.filters-container {
    display: flex;
    justify-content: flex-start;
    gap: 20px;
    width: 100%;
}

.box_fillter1,
.box_fillter2,
.box_fillter3 {
    display: flex;
    align-items: center;
}

.fillter_label {
    margin-right: 10px;
}

.search-container {
    display: flex;
    align-items: center;
}

.filtter_input_search {
    margin-right: 5px;
}

.filtter_icon_search {
    cursor: pointer;
}

@media (max-width: 768px) {
    .filters-container {
        flex-direction: column;
        align-items: flex-end;
    }

    .box_fillter1,
    .box_fillter2,
    .box_fillter3 {
        width: 100%;
    }
} */

</style>

<div class="master">
    <div class="header">
        <div class="navbar">
            <div class="left-section">
                <div class="" onclick="toggleSidebar()">
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
        <h1 >بيانات المشاريع</h1>

        <div class="min-contener" style="margin-right: 160px;">
            
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
        <div class="box_fillter2">
            <label class="fillter_label" for="status">حالة المشروع:</label>
            <select class="fillter_label" name="status" id="status" onchange="this.form.submit()">
                <option value="">الكل</option>
                <option value="تحت التنفيذ" <?php if(isset($_GET['status']) && $_GET['status'] == 'تحت التنفيذ') echo 'selected'; ?>>تحت التنفيذ</option>
                <option value="مكتمل" <?php if(isset($_GET['status']) && $_GET['status'] == 'مكتمل') echo 'selected'; ?>>مكتمل</option>
                <option value="متوقف" <?php if(isset($_GET['status']) && $_GET['status'] == 'متوقف') echo 'selected'; ?>>متوقف</option>
            </select>
        </div>
        <div class="box_fillter3">
            <div class="search-container">
                <input type="text" name="search_cus" id="search_cus" class="filtter_input_search" placeholder="ابحث عن اسم الزبون" />
                <button type="submit" class="filtter_icon_search">&#128269;</button>
                <div id="space" >   </div>
                <input type="text" name="search_eng" id="search_eng" class="filtter_input_search" placeholder="ابحث عن اسم مدير المشروع" />
                <button type="submit" class="filtter_icon_search">&#128269;</button>
            </div>
        </div>
    </div>

                    
                <!-- أزرار الطباعة والإضافة -->
                <div class="div_print_add_button">
                <button class="button_print" onclick="printTable()">
                    <i class="fas fa-print"></i> طباعة
                </button>


                    <!-- <button class="button_print" onclick="window.print()">
                        <i class="fas fa-print"></i> طباعة
                    </button> -->

                        <button onclick="location.href='newProject.php'" type="button" class="button_add" id="add-Btn">
                            <i class="fas fa-plus"></i> إضافة
                        </button>
                </div>
            </form>

            <!-- <div class="home_container"> -->
            <div class="table-container">
                <div class='table-wrapper'>
                    <table  id="table_projects">
                        <thead >
                            <tr >
                                <th>رقم المشروع</th>
                                <th>اسم الزبون</th>
                                <th>مدير المشروع</th>
                                <th>الموقع</th>
                                <th>تاريخ البدء</th>
                                <th>تاريخ الانتهاء</th>
                                <th>حالة المشروع</th>
                                <th>نسبة الانجاز</th>
                                <!-- <th>إجمالي الدفعات د.ل</th>
                                <th>اجمالي المصروفات د.ل</th> -->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$servername = "localhost";
$username = "root";
$password = ""; // تحقق من كلمة المرور الصحيحة
$dbname = "Engineering_Projects_Management";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
echo "تم الاتصال بنجاح";

// الاستعلام وباقي الكود

$conn->close();
?>


                            // استلام قيم الفلاتر من طلب GET
                            $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                            $filter_status = isset($_GET['status']) ? $_GET['status'] : '';
                            $search_cus = isset($_GET['search_cus']) ? $_GET['search_cus'] : '';
                            $search_eng = isset($_GET['search_eng']) ? $_GET['search_eng'] : '';


                            // بناء استعلام SQL مع الفلاتر

                            $sql = "SELECT ProjectID, CustomerName, eng.employeeName AS engineer_username, LandLocation, ProjectStartDate, ProjectEndDate, statusname, ProgressPercentage
                            FROM projects
                            JOIN projectstatus ON projects.ProjectStatus = projectstatus.id
                            JOIN customers AS cus ON projects.CustomerID = cus.CustomerId 
                            JOIN employees AS eng ON projects.SupervisingEngineerID = eng.employeeId
                            ";



                            // إضافة الفلاتر إذا كانت موجودة
                            $conditions = array();

                            if (!empty($filter_year)) {
                                $sql .= " AND YEAR(ProjectStartDate) = '$filter_year'";
                            }
                            if (!empty($filter_status)) {
                                $sql .= " AND projectstatus.statusname = '$filter_status'";
                            }
                            if (!empty($search_cus)) {
                                $conditions[] = "CustomerName LIKE '%$search_cus%'";
                            }
                            if (!empty($search_eng)) {
                                $conditions[] = "employeeName LIKE '%$search_eng%'";
                            }
                            if (count($conditions) > 0) {
                                $sql .= " WHERE " . implode(' AND ', $conditions);
                            }
                            $sql .= " ORDER BY ProjectID ASC";


                             // تنفيذ الاستعلام والتحقق من النتائج
                            $result = $conn->query($sql);

                            if ($result === false) {
                                echo "خطأ في الاستعلام: " . $conn->error;
                            } else {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td><a href='project_details.php?project_id=" . $row["ProjectID"] . "' target='_blank' style='display: block; width: 100%; height: 100%;'>" . $row["ProjectID"] . "</a></td>";
                                        echo "<td>" . $row["CustomerName"] . "</td>";
                                        echo "<td>" . $row["engineer_username"] . "</td>";
                                        echo "<td>" . $row["LandLocation"] . "</td>";
                                        echo "<td>" . $row["ProjectStartDate"] . "</td>";
                                        echo "<td>" . $row["ProjectEndDate"] . "</td>";
                                        echo "<td>" . $row["statusname"] . "</td>";
                                        echo "<td>" . $row["ProgressPercentage"] . " %</td>";
                                        // echo "<td>" . number_format($row["TotalAmountPaid"]) . "</td>";
                                        // echo "<td>" . number_format($row["AmountSpent"]) . "</td>";
                                        
                                        echo    "<td>                                                    
                                                    <div class=\"action-buttons\">

                                                        <form class='botton_table' method='GET' action='edit_project.php' style='display: inline-block;'>
                                                            <input type='hidden' name='project_id' value='" . $row["ProjectID"] . "'>
                                                            <button class='button_edit' type='submit'>
                                                                <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                            </button>
                                                        </form>
                                                        <form class='botton_table' method='POST' action='delete_project.php'>
                                                            <input type='hidden' name='project_id' value='" . $row["ProjectID"] . "'>
                                                            <button class='button_delet' type='submit' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'><i id='i_del' class='fas fa-trash-alt'></i> حذف </button>
                                                        </form>
                                                    </div>
                                                </td>";
                                        echo "</tr>";    
                                    }
                                } else {
                                    echo "<tr><td colspan='11'>لا توجد بيانات</td></tr>";
                                }
                            }

                            $conn->close();
                            ?>
                        
                        </tbody>
                        
                    </table>    
                </div>    
            </div>
            <!-- Buttons Section -->
            <div class="buttons-section">
                
            </div>
        </div>
    </div>


    <div class="footer">
        <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
    </div>
</div>

<script src="script.js"></script>


</body>
</html>
