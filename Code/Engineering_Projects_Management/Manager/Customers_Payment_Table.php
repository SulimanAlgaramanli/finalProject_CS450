<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>القسم المالي / دفعات الزبائن</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../Css/main.css" />

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

        <h1 >بيانات دفعات الزبائن</h1>
        <div class="min-contener">
            <div  style="    margin-right: 400px;">    
                <form method="GET" action="">
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
                            <label class="fillter_label" for="year">التسويه</label>
                            <select class="fillter_label" name="year" id="year" onchange="this.form.submit()">
                                <option value="">الكل</option>
                                <option value="2024" <?php if(isset($_GET['year']) && $_GET['year'] == '2024') echo 'selected'; ?>>تمت تسويتها</option>
                                <option value="2023" <?php if(isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>لم تتم التسويه بعد</option>
                            </select>
                        </div>
                        
                        <div class="box_fillter3">
                            
                        </div>
                </form> 

                <!-- Display table of payments -->
                <div class="table-container" >
                    <div class='table-wrapper'>
                        <table id="table_projects">
                            <thead>
                                <tr>
                                    <th>رقم الدفعة</th>
                                    <th>اسم الزبون</th>
                                    <th>القيمة</th>
                                    <th>تاريخ الدفعة</th>
                                    <th>تاريخ التسوية</th>
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

                                $filter_year = isset($_GET['year']) ? $_GET['year'] : '';

                                // بناء استعلام SQL مع الشروط المطلوبة
                                $sql = "SELECT 
                                            py.PaymentID, 
                                            u.username, 
                                            py.Amount, 
                                            py.PaymentDate, 
                                            py.SettlementDate
                                FROM payments AS py 
                                JOIN projects AS p ON py.ProjectID = p.ProjectID 
                                JOIN users AS u ON p.CustomerID = u.userId 
                                WHERE u.usertype = 2
                                ORDER BY py.PaymentDate ASC";

                                if (!empty($filter_year)) {
                                    $sql .= " AND YEAR(ProjectStartDate) = '$filter_year'";
                                }

                                // تنفيذ الاستعلام والتحقق من النتائج
                                $result = $conn->query($sql);

                                if ($result === false) {
                                    echo "خطأ في الاستعلام: " . $conn->error;
                                } else {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["PaymentID"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
                                            echo "<td>" . $row["Amount"] . "</td>";
                                            echo "<td>" . $row["PaymentDate"] . "</td>";
                                            echo "<td>" . $row["SettlementDate"] . "</td>";
                                            echo "</tr>";                                                   
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>لا توجد بيانات</td></tr>";
                                    }
                                }

                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <!-- Buttons Section -->
                <div class="big-buttons-section">
                    <div class="action-button-print-button">
                            <button   onclick="window.print()" >
                                <i class="fas fa-print"></i> طباعة
                            </button>
                        </div>
                            
                    <div class="buttons-section">
                        
                        <div class="action-button">
                            <div class="action-button-add-button" >
                                <button class="projects_button" id="addProjectBtn">
                                    <i class="fas fa-plus"></i> إضافة 
                                </button>
                            </div>  
                        </div>
                        
                        <div class="action-button">
                            <div class="action-button-edit-button">
                            <button class="projects_button">
                                <i class="fas fa-edit"></i> تعديل 
                            </button>
                            </div>
                        </div>
                        
                        <div class="action-button">
                            <div class="action-button-delete-button">
                            <button >
                                <i class="fas fa-trash-alt"></i> حذف 
                            </button>
                            </div> 
                        </div>

                    </div>
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














