<?php
session_start();
?>
<?php
    
    include 'con_db.php';
    include 'formatNumber.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>الزبائن</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />
</head>
<body>
<div class="master">
    <div class="header">
        <div class="navbar">
        
        <?php
            if (isset($_SESSION['user_name'])) {
                echo '
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
                        <div class="settings-dropdown">
                            <i class="fas fa-cog icon"></i>
                            <div class="settings-dropdown-content">
                                <a href="change_password.php">تغيير كلمة المرور</a>
                                <a href="logout.php">تسجيل الخروج</a>
                            </div>
                        </div>
                    </div>
                    <span class="username">' . htmlspecialchars($_SESSION['user_name']) . '</span>
                    <img src="../icons/user.png" class="img_user" alt="صورة المستخدم" />
            </div>
        </div>
                <div class="contener">';            
                // استدعاء الـ Sidebar
                include 'sidebar.php';
            }else {
                header("Location: index.php");
                exit();
                }
        ?>

        <h1>بيانات الزبائن</h1>
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
                    <input type="text" name="search_name" id="search_name" class="filtter_input_search" placeholder="ابحث عن اسم الزبون" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                </div>
            </div>
        </div>

                    
                <!-- أزرار الطباعة والإضافة -->
                <div class="div_print_add_button">
                <?php
                if (hasPermission($user_type, 34)) {
                echo '
                <button class="button_print" onclick="printTable()">
                    <i class="fas fa-print"></i> طباعة
                </button>
                ';
                }

                if (hasPermission($user_type, 18)) {
                    echo '
                        <button onclick="location.href=\'SingUp_For_Customers.php\'" type="button" class="button_add" id="add-Btn">
                            <i class="fas fa-plus"></i> إضافة
                        </button>
                    ';
                }
                ?>

                </div>
            </form>



                <div class="table-container">
                    <div class='table-wrapper'>
                        <table id="table_projects">
                            <thead>
                                <tr>
                                    <th>رقم الزبون</th>
                                    <th>اسم الزبون</th>
                                    <th>الايميل</th>
                                    <th>الهاتف</th>
                                    <th>تاريخ الانضمام</th>
                                    <?php
                                    if (hasPermission($user_type, 19)) {
                                    echo "
                                        <th>الإجراءات</th>
                                    ";
                                    }
                                "
                            </tr>
                        </thead>
                        <tbody>";

                                // استلام قيم الفلاتر من طلب GET
                                $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                                $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

                                // بناء استعلام SQL مع الفلاتر
                                $sql = "SELECT DISTINCT c.CustomerName, 
                                            c.CustomerId, 
                                            c.email, 
                                            c.CustomerPhone, 
                                            c.joinDate
                                        FROM Customers AS c
                                        LEFT JOIN projects AS p ON p.CustomerID = c.CustomerId
                                        ";

                                $conditions = [];

                                if ($_SESSION['user_type'] == 3) {
                                    $conditions[] = "p.SupervisingEngineerID = " . $_SESSION['user_id'];
                                }

                                if (!empty($filter_year)) {
                                    $conditions[] = "YEAR(joinDate) = '$filter_year'";
                                }

                                if (!empty($search_name)) {
                                    $conditions[] = "CustomerName LIKE '%$search_name%'";
                                }

                                if (count($conditions) > 0) {
                                    $sql .= " WHERE " . implode(' AND ', $conditions);
                                }

                                // تنفيذ الاستعلام والتحقق من النتائج
                                $result = $conn->query($sql);

                                if ($result === false) {
                                    echo "خطأ في الاستعلام: " . $conn->error;
                                } else {
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["CustomerId"] . "</td>";
                                            echo "<td>" . $row["CustomerName"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["CustomerPhone"] . "</td>";
                                            echo "<td>" . $row["joinDate"] . "</td>";

                                            
                                        if (hasPermission($user_type, 19)) {
                                            echo    "<td>                                                    
                                                        <div class=\"action-buttons\">
                                                            <form class='botton_table' method='GET' action='edit_customers.php' style='display: inline-block;'>
                                                                <input type='hidden' name='customer_id' value='" . $row["CustomerId"] . "'>
                                                                <button class='button_edit' type='submit'>
                                                                    <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                                </button>
                                                            ";
                                                            }
                                                            "    
                                                            </form>
                                                            <form class='botton_table' method='POST' action='delete_customers.php'>
                                                            <input type='hidden' name='project_id' value='" . $row["CustomerId"] . "'>
                                                                ";
                                                                if (hasPermission($user_type, 20)) {
                                                                echo "
                                                                    <button class='button_delet' type='submit' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>
                                                                        <i id='i_del' class='fas fa-trash-alt'></i> حذف 
                                                                    </button>
                                                                ";
                                                                }
                                                                "
                                                                </form>
                                                    </div>
                                                </td>";
                                                echo "</tr>";
                                            }
                                    
                                    } else {
                                        echo "<tr><td colspan='6'>لا توجد بيانات</td></tr>";
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
