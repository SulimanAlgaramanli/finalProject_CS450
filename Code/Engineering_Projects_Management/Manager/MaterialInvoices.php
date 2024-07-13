<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>فواتير المواد</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />
</head>
<body>
<div class="master">
    <div class="header">
        <div class="navbar">
            <div class="left-section">
            
            <!-- <div class="sidebar-toggle" onclick="toggleSidebar()"> -->

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

        <h1>بيانات فواتير المواد</h1>
        <div class="min-contener">
            <form class="form_fillter" method="GET" action="">
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
                <div class="search-container">
                        <input type="text" name="search_project" id="search_project" class="filtter_input_search" placeholder="ابحث عن رقم المشروع" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                    </div>
                </div>
                <div class="box_fillter3">
                    <div class="search-container">
                        <input type="text" name="search_name" id="search_name" class="filtter_input_search" placeholder="ابحث عن اسم المحل" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                    </div>
                </div>

                <div class="div_print_add_button">
                    <button class="button_print" onclick="printTable()">
                        <i class="fas fa-print"></i> طباعة
                    </button>
                    <button onclick="location.href='new_MaterialInvoices.php'" type="button" class="button_add" id="add-Btn">
                        <i class="fas fa-plus"></i> إضافة
                    </button>
                </div>
            </form>

            <div>
                <div class="table-container">
                    <div class='table-wrapper'>
                        <table id="table_projects">
                            <thead>
                                <tr>
                                    <th>رقم تسلسلي</th>
                                    <th>رقم المشروع</th>
                                    <th>رقم الفاتورة</th>
                                    <th>التخصص</th>
                                    <th>البيان</th>
                                    <th>القيمة د.ل</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th>طريقة الدفع</th>
                                    <th>اسم المحل</th>
                                    <th>صورة الفاتورة</th>
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

                                $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                                $search_project = isset($_GET['search_name']) ? $_GET['search_name'] : '';
                                $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

                                // بناء استعلام SQL مع الشروط المطلوبة
                                $sql = "SELECT * FROM MaterialInvoices WHERE 1=1";

                                // إضافة الفلاتر إذا كانت موجودة
                                if (!empty($filter_year)) {
                                    $sql .= " AND YEAR(InvoiceDate) = '$filter_year'";
                                }

                                if (!empty($search_project)) {
                                    $sql .= " AND ProjectID = $search_project";
                                }
                                
                                if (!empty($search_name)) {
                                    $sql .= " AND StoreName LIKE '%$search_name%'";
                                }

                                $sql .= " ORDER BY InvoiceID  ASC";

                                // تنفيذ الاستعلام وجلب النتائج
                                $result = $conn->query($sql);
                                if (!$result) {
                                    die("خطأ في الاستعلام: " . $conn->error);
                                }

                                // عرض النتائج في الجدول
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["InvoiceID "] . "</td>";
                                        echo "<td>" . $row["ProjectID"] . "</td>";
                                        echo "<td>" . $row["InvoiceNumber"] . "</td>";
                                        echo "<td>" . $row["Specialty"] . "</td>";
                                        echo "<td>" . $row["Description"] . "</td>";
                                        echo "<td>" . $row["Amount"] . "</td>";
                                        echo "<td>" . $row["InvoiceDate"] . "</td>";
                                        echo "<td>" . $row["PaymentMethod"] . "</td>";
                                        echo "<td>" . $row["StoreName"] . "</td>";
                                        echo "<td><a href='" . $row["InvoiceImage"] . "' target='_blank'>عرض الصورة</a></td>";
                                        echo "<td class='control_buttons'>
                                                <button class='edit-btn' onclick=\"location.href='edit_invoice.php?id=" . $row["PaymentID"] . "'\">تعديل</button>
                                                <button class='delete-btn' onclick=\"confirmDelete(" . $row["PaymentID"] . ")\">حذف</button>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='11'>لا توجد بيانات</td></tr>";
                                }

                                // غلق الاتصال بقاعدة البيانات
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>حقوق النشر &copy; 2023 جميع الحقوق محفوظة</p>
        </div>
    </div>
</div>

<script src="../Js/main.js"></script>
<script>
    function confirmDelete(paymentId) {
        if (confirm("هل أنت متأكد أنك تريد حذف هذا العنصر؟")) {
            window.location.href = "delete_invoice.php?id=" + paymentId;
        }
    }

    function toggleSidebar() {
        var sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("hidden");
    }

    function toggleSubmenu(element) {
        var submenu = element.nextElementSibling;
        submenu.classList.toggle("visible");
    }

</script>
<script src="script.js"></script>

</body>
</html>
