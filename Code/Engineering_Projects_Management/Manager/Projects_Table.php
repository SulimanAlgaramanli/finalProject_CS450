<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>قسم المشاريع / المشاريع</title>
    <link rel="icon" href="../icons/engineer (1).png" type="image/x-icon" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../Css/style.css" />

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
            <img src="../img/user.png" class="img_user" alt="صورة المستخدم" />
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

        <div>
            <h1 >بيانات المشاريع</h1>
            <form method="GET" action="">
                <label class="fillter_label" for="year">اختر السنة:</label>
                <select name="year" id="year" onchange="this.form.submit()">
                    <option value="">الكل</option>
                    <option value="2024" <?php if(isset($_GET['year']) && $_GET['year'] == '2024') echo 'selected'; ?>>2024</option>
                    <option value="2023" <?php if(isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>2023</option>
                    <option value="2022" <?php if(isset($_GET['year']) && $_GET['year'] == '2022') echo 'selected'; ?>>2022</option>
                    <option value="2021" <?= isset($_GET['year']) && $_GET['year'] == '2021' ? 'selected' : '' ?>>2021</option>
                    <option value="2020" <?= isset($_GET['year']) && $_GET['year'] == '2020' ? 'selected' : '' ?>>2020</option>
                </select>
                <label class="fillter_label" for="status">حالة المشروع:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">الكل</option>
                    <option value="قيد التنفيذ" <?php if(isset($_GET['status']) && $_GET['status'] == 'قيد التنفيذ') echo 'selected'; ?>>قيد التنفيذ</option>
                    <option value="مكتمل" <?php if(isset($_GET['status']) && $_GET['status'] == 'مكتمل') echo 'selected'; ?>>مكتمل</option>
                    <option value="متوقف" <?php if(isset($_GET['status']) && $_GET['status'] == 'متوقف') echo 'selected'; ?>>متوقف</option>
                </select>
            </form>
            <table  >
                <thead >
                    <tr >
                        <th>رقم المشروع</th>
                        <th>اسم الزبون</th>
                        <th>مدير المشروع</th>
                        <th>موقع</th>
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتهاء</th>
                        <th>حالة المشروع</th>
                        <th>نسبة الانجاز</th>
                        <th>إجمالي الدفعات</th>
                        <th>اجمالي المصروفات</th>
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
                    $filter_status = isset($_GET['status']) ? $_GET['status'] : '';

                    // بناء استعلام SQL مع الفلاتر
                    $sql = "SELECT ProjectID, cus.username AS customer_username, eng.username AS engineer_username, LandLocation, ProjectStartDate, ProjectEndDate, statusname, ProgressPercentage, TotalAmountPaid, AmountSpent
                            FROM projects
                            JOIN projectstatus ON projects.ProjectStatus = projectstatus.id
                            JOIN users AS cus ON projects.CustomerID = cus.userId
                            JOIN users AS eng ON projects.SupervisingEngineerID = eng.userId
                            WHERE 1=1";

                    if (!empty($filter_year)) {
                        $sql .= " AND YEAR(ProjectStartDate) = '$filter_year'";
                    }

                    if (!empty($filter_status)) {
                        $sql .= " AND projectstatus.statusname = '$filter_status'";
                    }
                    $sql .= " ORDER BY ProjectID ASC";
                    // $sql .= " ORDER BY ProjectStartDate ASC";


                    // تنفيذ الاستعلام والتحقق من النتائج
                    $result = $conn->query($sql);

                    if ($result === false) {
                        echo "خطأ في الاستعلام: " . $conn->error;
                    } else {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                // echo "<td>" . $row["ProjectID"] . "</td>";
                                echo "<td><a  href='project_details.php?project_id=" . $row["ProjectID"] . "' target='_blank'>" . $row["ProjectID"] . "</a></td>";
                                echo "<td>" . $row["customer_username"] . "</td>";
                                echo "<td>" . $row["engineer_username"] . "</td>";
                                echo "<td>" . $row["LandLocation"] . "</td>";
                                echo "<td>" . $row["ProjectStartDate"] . "</td>";
                                echo "<td>" . $row["ProjectEndDate"] . "</td>";
                                echo "<td>" . $row["statusname"] . "</td>";
                                echo "<td>" . $row["ProgressPercentage"] . "%</td>";
                                echo "<td>" . number_format($row["TotalAmountPaid"]) . "</td>";
                                echo "<td>" . number_format($row["AmountSpent"]) . "</td>";
                                
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>لا توجد بيانات</td></tr>";
                        }
                    }

                    $conn->close();
                    ?>
                     
                </tbody>
            </table>
            <!-- Buttons Section -->
            <div class="buttons-section">
                <button class="action-button print-button" onclick="printTable()" >  
                <!-- <button class="action-button print-button" onclick="window.print()" >   -->
                    <i class="fas fa-print"></i> طباعة
                </button>
                <button class="action-button add-button">
                    <i class="fas fa-plus"></i> إضافة مشروع
                </button>
                <button class="action-button edit-button">
                    <i class="fas fa-edit"></i> تعديل مشروع
                </button>
                <button class="action-button delete-button">
                    <i class="fas fa-trash-alt"></i> حذف مشروع
                </button>
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
