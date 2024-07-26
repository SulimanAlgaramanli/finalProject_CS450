
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
    <title>دفعات الزبائن</title>
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

        <h1 >بيانات دفعات الزبائن</h1>
        <div class="min-contener">
        
        <div>
            <form class="form_fillter" method="GET" action="">
                <div class="search-container">
                            <label class="fillter_label" for="year">اختر السنة:</label>
                            <select class="fillter_label" name="year" id="year" onchange="this.form.submit()">
                                <option value="">الكل</option>
                                <option value="2024" <?php if(isset($_GET['year']) && $_GET['year'] == '2024') echo 'selected'; ?>>2024</option>
                                <option value="2023" <?php if(isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>2023</option>
                                <option value="2022" <?php if(isset($_GET['year']) && $_GET['year'] == '2022') echo 'selected'; ?>>2022</option>
                                <option value="2021" <?= isset($_GET['year']) && $_GET['year'] == '2021' ? 'selected' : '' ?>>2021</option>
                                <option value="2020" <?= isset($_GET['year']) && $_GET['year'] == '2020' ? 'selected' : '' ?>>2020</option>
                            </select>

                            <label class="fillter_label" for="Settlement">التسويه:</label>
                            <select class="fillter_label" name="Settlement" id="Settlement" onchange="this.form.submit()">
                            <option value="">الكل</option>
                            <option value="settled" <?php if(isset($_GET['Settlement']) && $_GET['Settlement'] == 'settled') echo 'selected'; ?>>تمت تسويتها</option>
                            <option value="not_settled" <?php if(isset($_GET['Settlement']) && $_GET['Settlement'] == 'not_settled') echo 'selected'; ?>>لم تتم التسوية بعد</option>
                            </select>

                            <div id="space" ></div>
                            <div id="space" ></div>

                    <label class="fillter_label" for="search_name"> الزبون:</label>
                    <input type="text" name="search_name" id="search_name" class="filtter_input_search" placeholder="ابحث عن اسم الزبون" value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                    <div id="space" ></div>

                    <label class="fillter_label" for="search_project"> المشروع:</label>
                    <input type="text" name="search_project" id="search_project" class="filtter_input_search" placeholder="ابحث عن رقم المشروع" value="<?php echo isset($_GET['search_project']) ? htmlspecialchars($_GET['search_project']) : ''; ?>" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                    <div id="space" ></div>
                                
                    <label class="fillter_label" for="search_accounter"> المحاسب:</label>
                    <input type="text" name="search_accounter" id="search_accounter" class="filtter_input_search" placeholder="ابحث عن اسم المحاسب" value="<?php echo isset($_GET['search_accounter']) ? htmlspecialchars($_GET['search_accounter']) : ''; ?>" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                    <div id="space" ></div>

                    <label class="fillter_label" for="paymentNumber"> الدفعة:</label>
                    <input type="text" name="paymentNumber" id="paymentNumber" class="filtter_input_search" placeholder="ابحث عن رقم الدفعة" value="<?php echo isset($_GET['paymentNumber']) ? htmlspecialchars($_GET['paymentNumber']) : ''; ?>" />
                    <button type="submit" class="filtter_icon_search">&#128269;</button>
                </div>


                        
                            
                            
                    
                    
                <!-- أزرار الطباعة والإضافة -->
                <div class="div_print_add_button">
                    <button type="reset" class="button_reset" onclick="window.location.href='Customers_Payment_Table.php'">
                            <i class="fas fa-refresh"></i>الفلترة 
                    </button>

                    <div id="space"></div>

                    <?php
                if (hasPermission($user_type, 31)) {
                echo '
                <button class="button_print" onclick="printTable()">
                    <i class="fas fa-print"></i> طباعة
                </button>
                ';
                }

                if (hasPermission($user_type, 6)) {
                    echo '
                        <button onclick="location.href=\'new_payment.php\'" type="button" class="button_add" id="add-Btn">
                            <i class="fas fa-plus"></i> إضافة
                        </button>
                    ';
                }
                ?>

                </div>
            </form>

            <div  >    
                
                <!-- Display table of payments -->
                <div class="table-container" >
                    <div class='table-wrapper'>
                        <table id="table_projects">
                            <thead>
                                <tr>

                                    <th>رقم تسلسلي</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم المشروع</th>
                                    <th>رقم الدفعة</th>
                                    <th>القيمة د.ل</th>
                                    <th>طريقة الدفع</th>
                                    <th class='date-cell'>تاريخ الدفعة</th>
                                    <th class='date-cell'>تاريخ التسوية</th>
                                    <th >فواتير المواد د.ل</th>
                                    <th >فواتير الفنيين د.ل</th>
                                    <th >أتعاب المكتب د.ل</th>
                                    <th >إجمالي المصروف د.ل</th>
                                    <th >المتبقي د.ل</th>
                                    <th>اسم المحاسب</th>
                                    <?php
                                    if (hasPermission($user_type, 7)) {
                                    echo "
                                        <th>الإجراءات</th>
                                    ";
                                    }
                                "
                            </tr>
                        </thead>
                        <tbody>";

                                
                            $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                            $filter_settlement = isset($_GET['Settlement']) ? $_GET['Settlement'] : '';
                            $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
                            $search_project = isset($_GET['search_project']) ? $_GET['search_project'] : '';
                            $search_accounter = isset($_GET['search_accounter']) ? $_GET['search_accounter'] : '';
                            $search_paymentNumber = isset($_GET['paymentNumber']) ? $_GET['paymentNumber'] : '';



                            
                            // بناء استعلام SQL مع الشروط المطلوبة
                            $sql = "SELECT 
                            py.PaymentID, 
                            py.ProjectID, 
                            c.CustomerName, 
                            py.PaymentNumber, 
                            py.Amount, 
                            pm.PaymentMethodName, 
                            py.PaymentDate, 
                            py.SettlementDate, 
                            py.PaymentMethodID,
                            -- جمع مجموع الفواتير للمواد باستخدام الاستعلام الفرعي
                            IFNULL((SELECT SUM(mi.amount) FROM materialinvoices AS mi WHERE mi.project_id = py.ProjectID AND mi.payment_id = py.paymentNumber), 0) AS MaterialInvoices_m,
                            -- جمع مجموع الفواتير للفنيين باستخدام الاستعلام الفرعي
                            IFNULL((SELECT SUM(ti.amount) FROM technicianinvoices AS ti WHERE ti.ProjectID = py.ProjectID AND ti.PaymentID = py.paymentNumber), 0) AS TechnicianInvoices_t,
                            -- حساب مبلغ الرسوم
                            py.Amount - (py.Amount / (1 + (p.rate_Of_CostPlus / 100))) AS FeesAmount,
                            -- حساب المصروفات الإجمالية بجمع مجموع الفواتير ومبلغ الرسوم
                            (py.Amount - (py.Amount / (1 + (p.rate_Of_CostPlus / 100))) 
                                + IFNULL((SELECT SUM(mi.amount) FROM materialinvoices AS mi WHERE mi.project_id = py.ProjectID AND mi.payment_id = py.paymentNumber), 0) 
                                + IFNULL((SELECT SUM(ti.amount) FROM technicianinvoices AS ti WHERE ti.ProjectID = py.ProjectID AND ti.PaymentID = py.paymentNumber), 0)) AS TotalExpenses,
                            -- حساب المبلغ المتبقي بطرح المصروفات الإجمالية من المبلغ الأصلي
                            (py.Amount 
                                - IFNULL((SELECT SUM(mi.amount) FROM materialinvoices AS mi WHERE mi.project_id = py.ProjectID AND mi.payment_id = py.paymentNumber), 0) 
                                - IFNULL((SELECT SUM(ti.amount) FROM technicianinvoices AS ti WHERE ti.ProjectID = py.ProjectID AND ti.PaymentID = py.paymentNumber), 0) 
                                - (py.Amount - (py.Amount / (1 + (p.rate_Of_CostPlus / 100))))) AS RemainingAmount, 
                            e.EmployeeName 
                        FROM 
                            payments AS py 
                        JOIN 
                            PaymentMethods AS pm ON py.PaymentMethodID = pm.PaymentMethodID 
                        JOIN 
                            projects AS p ON py.ProjectID = p.ProjectID 
                        JOIN 
                            customers AS c ON p.CustomerID = c.CustomerID 
                        JOIN 
                            employees AS e ON py.AccountantID = e.EmployeeId 
                        WHERE 
                            1=1";
                

                            // إضافة الفلاتر إذا كانت موجودة
                            $conditions = array();

                            if (!empty($filter_year)) {
                                $sql .= " AND YEAR(py.PaymentDate) = '$filter_year'";
                            }

                            if ($filter_settlement == 'settled') {
                                $sql .= " AND py.SettlementDate IS NOT NULL";
                            } elseif ($filter_settlement == 'not_settled') {
                                $sql .= " AND py.SettlementDate IS NULL";
                            }


                            $where_clauses = [];
                                        if (($_SESSION['user_type']) == 2 )
                                        {
                                            $conditions[] = "c.CustomerId  =  ". $_SESSION['user_id'];
                                        }else if (($_SESSION['user_type']) == 3 )
                                        {
                                            $conditions[] =" p.SupervisingEngineerID   =  ". $_SESSION['user_id'];
                                        }

                            if (!empty($search_name)) {
                                $conditions[] = "c.CustomerName LIKE '%$search_name%'";
                            }
                            
                            if (!empty($search_accounter)) {
                                $conditions[] = "e.EmployeeName LIKE '%$search_accounter%'";
                            }
                            if (isset($_GET['search_project']) && !empty($_GET['search_project'])) {
                                $conditions[] = "py.ProjectID LIKE '%$search_project%'";
                            }
                            
                            if (!empty($search_paymentNumber)) {
                                $conditions[] = "py.paymentNumber LIKE '%$search_paymentNumber%'";
                            }
                            if (count($conditions) > 0) {
                                $sql .= " AND " . implode(' AND ', $conditions);
                            }

                            $sql .= " ORDER BY py.PaymentID ASC";


                            // تنفيذ الاستعلام وجلب النتائج
                            $result = $conn->query($sql);
                            if (!$result) {
                                die("خطأ في الاستعلام: " . $conn->error);
                            }

                            // عرض النتائج في الجدول
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["PaymentID"] . "</td>";
                                    echo "<td>" . $row["CustomerName"] . "</td>";
                                    echo "<td>" . $row["ProjectID"] . "</td>";
                                    echo "<td>" . $row["PaymentNumber"] . "</td>";  
                                    echo "<td>" . myFormatNumber($row["Amount"]) . "</td>";
                                    echo "<td>" . $row["PaymentMethodName"] . "</td>";
                                    echo "<td class='date-cell'>" . $row["PaymentDate"] . "</td>";
                                    echo "<td class='date-cell'>" . $row["SettlementDate"] . "</td>";
                                    echo "<td>" . myFormatNumber($row["MaterialInvoices_m"]) . "</td>";
                                    echo "<td>" . myFormatNumber($row["TechnicianInvoices_t"]) . "</td>";
                                    echo "<td>" . myFormatNumber($row["FeesAmount"]) . "</td>";
                                    echo "<td>" . myFormatNumber($row["TotalExpenses"]) . "</td>";
                                    echo "<td>" . myFormatNumber($row["RemainingAmount"]) . "</td>";
                                    echo "<td>" . $row["EmployeeName"] . "</td>";
                                    
                                    
                                    if (hasPermission($user_type, 7)) {
                                        echo    "<td>                                                    
                                                    <div class=\"action-buttons\">

                                                        <form class='botton_table' method='GET' action='edit_payment.php' style='display: inline-block;'>
                                                        <input type='hidden' name='project_id' value='" . $row["PaymentID"] . "'>
                                                            <button class='button_edit' type='submit'>
                                                                <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                            </button>
                                                        ";
                                                        }
                                                        "    
                                                        </form>
                                                        <form class='botton_table' method='POST' action='delete_payment.php'>
                                                        <input type='hidden' name='project_id' value='" . $row["PaymentID"] . "'>
                                                            ";
                                                            if (hasPermission($user_type, 8)) {
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
                                echo "<tr><td colspan='16'>لا توجد بيانات للعرض</td></tr>";
                            }

                            // إغلاق الاتصال بقاعدة البيانات
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
    </div>


    <div class="footer">
        <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
    </div>
</div>
<script src="script.js"></script>


</body>
</html>
