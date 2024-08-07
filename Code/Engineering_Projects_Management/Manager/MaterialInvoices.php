<?php
session_start();
?>
<?php
    
    include 'con_db.php';
    include 'formatNumber.php';

    $sql_stores = "SELECT * FROM  stores";
    $sql_specializations = "SELECT * FROM  specializations";
    $sql_paymentmethods = "SELECT * FROM  paymentmethods";


    $result_stores =$conn->query($sql_stores);
    $result_specializations =$conn->query($sql_specializations);
    $result_paymentmethods =$conn->query($sql_paymentmethods);

    // var_dump($result_stores);
    // var_dump($result_specializations);
    // var_dump($result_paymentmethods);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> فواتير المواد</title>
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
        <h1>بيانات فواتير المواد</h1>
        <div class="min-contener">
            <div>

                <form class="form_fillter" method="GET" action="">
                    <div class="box_fillter1">
                        <label class="fillter_label" for="year">السنة:</label>
                        <select class="fillter_label" name="year" id="year" onchange="this.form.submit()">
                            <option value="">الكل</option>
                            <option value="2024" <?php if(isset($_GET['year']) && $_GET['year'] == '2024') echo 'selected'; ?>>2024</option>
                            <option value="2023" <?php if(isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>2023</option>
                            <option value="2022" <?php if(isset($_GET['year']) && $_GET['year'] == '2022') echo 'selected'; ?>>2022</option>
                            <option value="2021" <?php if(isset($_GET['year']) && $_GET['year'] == '2021') echo 'selected'; ?>>2021</option>
                            <option value="2020" <?php if(isset($_GET['year']) && $_GET['year'] == '2020') echo 'selected'; ?>>2020</option>
                        </select>

                        <label class="fillter_label" for="store">المحل:</label>
                        <select class="fillter_label" name="store" id="store" onchange="this.form.submit()">
                            <option value="">الكل</option>
                            <?php
                            if ($result_stores->num_rows > 0) {
                                while ($row_store = $result_stores->fetch_assoc()) {
                                    $selected = isset($_GET['store']) && $_GET['store'] == $row_store['StoreID'] ? 'selected' : '';
                                    echo "<option value='" . $row_store['StoreID'] . "' $selected>" . $row_store['StoreName'] . "</option>";
                                }
                            }
                            ?>
                        </select>

                        <label class="fillter_label" for="specialization">التخصص:</label>
                        <select class="fillter_label" name="specialization" id="specialization" onchange="this.form.submit()">
                            <option value="">الكل</option>
                            <?php
                            if ($result_specializations->num_rows > 0) {
                                while ($row_specialization = $result_specializations->fetch_assoc()) {
                                    $selected = isset($_GET['specialization']) && $_GET['specialization'] == $row_specialization['SpecializationID'] ? 'selected' : '';
                                    echo "<option value='" . $row_specialization['SpecializationID'] . "' $selected>" . $row_specialization['SpecializationName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <label class="fillter_label" for="paymentmethods">طريقة الدفع:</label>
                        <select class="fillter_label" name="paymentmethods" id="paymentmethods" onchange="this.form.submit()">
                            <option value="">الكل</option>
                            <?php
                            if ($result_paymentmethods->num_rows > 0) {
                                while ($row_paymentmethods = $result_paymentmethods->fetch_assoc()) {
                                    $selected = isset($_GET['paymentmethods']) && $_GET['paymentmethods'] == $row_paymentmethods['PaymentMethodID'] ? 'selected' : '';
                                    echo "<option value='" . $row_paymentmethods['PaymentMethodID'] . "' $selected>" . $row_paymentmethods['PaymentMethodName'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

        
                </div>

                <div class="box_fillter1">
                    <div class="search-container">

                        <label class="fillter_label" for="search_cus"> الزبون:</label>
                        <input type="text" name="search_cus" id="search_cus" class="filtter_input_search" placeholder="ابحث عن اسم الزبون"  value="<?php echo isset($_GET['search_cus']) ? htmlspecialchars($_GET['search_cus']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                        <div id="space"></div>
                        
                        <label class="fillter_label" for="search_project"> المشروع:</label>
                        <input type="text" name="search_project" id="search_project" class="filtter_input_search" placeholder="ابحث عن رقم المشروع" value="<?php echo isset($_GET['search_project']) ? htmlspecialchars($_GET['search_project']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                        <div id="space"></div>

                        <label class="fillter_label" for="payment_id"> الدفعة:</label>
                        <input type="text" name="payment_id" id="payment_id" class="filtter_input_search" placeholder="ابحث عن رقم الدفعة" value="<?php echo isset($_GET['payment_id']) ? htmlspecialchars($_GET['payment_id']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>

                    </div>
                </div>

                <div class="div_print_add_button">
                <button type="reset" class="button_reset" onclick="window.location.href='MaterialInvoices.php'">
                            <i class="fas fa-refresh"></i>الفلترة 
                        </button>
                        <div id="space"></div>
                        <div id="space"></div>
                        <?php
                if (hasPermission($user_type, 32)) {
                echo '
                <button class="button_print" onclick="printTable()">
                    <i class="fas fa-print"></i> طباعة
                </button>
                ';
                }

                if (hasPermission($user_type, 10)) {
                    echo '
                        <button onclick="location.href=\'new_MaterialInvoices.php\'" type="button" class="button_add" id="add-Btn">
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
                                <th >رقم تسلسلي</th>
                                <th >اسم الزبون</th>
                                <th >رقم المشروع</th>
                                <th >الدفعة الجارية</th>
                                <th >رقم الفاتورة</th>
                                <th >التخصص</th>
                                <th >البيان</th>
                                <th >القيمة د.ل</th>
                                <th class='date-cell'>تاريخ الفاتورة</th>
                                <th >طريقة الدفع</th>
                                <th >اسم المحل</th>
                                <th >صورة الفاتورة</th>
                                <?php
                                    if (hasPermission($user_type, 11)) {
                                    echo "
                                        <th>الإجراءات</th>
                                    ";
                                    }
                                "
                            </tr>
                        </thead>
                        <tbody>";

                                // Initialize variables for filters
                                $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                                $filter_store = isset($_GET['store']) ? $_GET['store'] : '';
                                $filter_specialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';
                                $filter_paymentmethods = isset($_GET['paymentmethods']) ? $_GET['paymentmethods'] : '';
                                $search_cus = isset($_GET['search_cus']) ? $_GET['search_cus'] : '';
                                $search_project = isset($_GET['search_project']) ? $_GET['search_project'] : '';
                                $search_payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : '';


                                // Build SQL query with necessary joins
                                $sql = "SELECT mi.invoice_id, cus.CustomerName, mi.project_id, mi.payment_id,  mi.invoice_number, s.SpecializationName, mi.description, mi.amount, mi.invoice_date, pm.PaymentMethodName, st.StoreName, mi.invoice_image
                                        FROM MaterialInvoices mi
                                        LEFT JOIN projects ON projects.ProjectID  = mi.project_id 
                                        LEFT JOIN customers AS cus ON projects.CustomerID = cus.CustomerId
                                        LEFT JOIN stores st ON mi.store_id = st.StoreID
                                        LEFT JOIN specializations s ON mi.specialization_id = s.SpecializationID
                                        LEFT JOIN paymentmethods pm ON mi.payment_method_id = pm.PaymentMethodID
                                        ";
                                $where_clauses = [];
                                if (($_SESSION['user_type']) == 2 )
                                {
                                    $where_clauses[] = "cus.CustomerId  =  ". $_SESSION['user_id'];
                                }else if (($_SESSION['user_type']) == 3 ){
                                    $where_clauses[] =" projects.SupervisingEngineerID   =  ". $_SESSION['user_id'];
                                }
                                if (isset($_GET['year']) && !empty($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $where_clauses[] = "YEAR(mi.invoice_date) = '$year'";
                                }
                                if (isset($_GET['store']) && !empty($_GET['store'])) {
                                    $store = $_GET['store'];
                                    $where_clauses[] = "mi.store_id = '$store'";
                                }
                                if (isset($_GET['specialization']) && !empty($_GET['specialization'])) {
                                    $specialization = $_GET['specialization'];
                                    $where_clauses[] = "mi.specialization_id = '$specialization'";
                                }
                                if (isset($_GET['paymentmethods']) && !empty($_GET['paymentmethods'])) {
                                    $paymentmethods = $_GET['paymentmethods'];
                                    $where_clauses[] = "mi.payment_method_id = '$paymentmethods'";
                                }
                                if (isset($_GET['search_cus']) && !empty($_GET['search_cus'])) {
                                    $search_cus = $_GET['search_cus'];
                                    $where_clauses[] = "cus.CustomerName LIKE '%$search_cus%'";
                                }
                                if (isset($_GET['search_project']) && !empty($_GET['search_project'])) {
                                    $search_project = $_GET['search_project'];
                                    $where_clauses[] = "mi.project_id LIKE '%$search_project%'";
                                }

                                if (!empty($search_payment_id)) {
                                    $where_clauses[] = "mi.payment_id LIKE '%$search_payment_id%'";
                                }

                                if (!empty($where_clauses)) {
                                    $sql .= " WHERE " . implode(" AND ", $where_clauses);
                                }
                                $sql .= " ORDER BY mi.Invoice_id  ASC";
                                
                                
                                // Execute SQL query
                                $result = $conn->query($sql);
                                if (!$result) {
                                    die("Error executing query: " . $conn->error);
                                }

                                // Display results in the table
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["invoice_id"] . "</td>";
                                        echo "<td>" . $row["CustomerName"] . "</td>";
                                        echo "<td>" . $row["project_id"] . "</td>";
                                        echo "<td>" . $row["payment_id"] . "</td>";
                                        echo "<td>" . $row["invoice_number"] . "</td>";
                                        echo "<td>" . $row["SpecializationName"] . "</td>";
                                        echo "<td>" . $row["description"] . "</td>";
                                        echo "<td>" . myFormatNumber($row["amount"]) . "</td>";
                                        echo "<td class='date-cell'>" . $row["invoice_date"] . "</td>";
                                        echo "<td>" . $row["PaymentMethodName"] . "</td>";
                                        echo "<td>" . $row["StoreName"] . "</td>";
                                        echo "<td>
                                                <a href='/Engineering_Projects_Management/photo/MaterialInvoices/". $row["invoice_image"] ."'>".$row['invoice_image']."</a>
                                            </td>";                                        
                                
                                        if (hasPermission($user_type, 11)) {
                                        echo    "<td>                                                    
                                                    <div class=\"action-buttons\">
                                                        <form class='botton_table' method='GET' action='edit_M_invoice.php' style='display: inline-block;'>
                                                        <input type='hidden' name='invoice_id' value='" . $row["invoice_id"] . "'>
                                                        <button class='button_edit' type='submit'>
                                                            <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                        </button>
                                                        ";
                                                        }
                                                        "    
                                                        </form>
                                                        <form class='botton_table' method='POST' action='delete_M_invoice.php'>
                                                        <input type='hidden' name='invoice_id' value='" . $row["invoice_id"] . "'>
                                                            ";
                                                            if (hasPermission($user_type, 12)) {
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
                                    echo "<tr><td colspan='12'>لا توجد بيانات</td></tr>";
                                }

                                // Close connection
                                $conn->close();
                            ?>

                        </tbody>
                    </table>
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