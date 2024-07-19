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
    <title> فواتير الفنيين</title>
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
                        <li><a href="index.php"><i class="fas fa-home"></i> الصفحة الرئيسية</a></li>
                        <li><a href="Projects_Table.php"><i class="fas fa-project-diagram"></i>  المشاريع </a></li>
                        <li><a href="Customers_Payment_Table.php"><i class="fas fa-dollar-sign"></i> دفعات الزبائن </a></li>
                        <li><a href="MaterialInvoices.php"><i class="fas fa-shopping-cart"></i> فواتير المواد </a></li>
                        <li><a href="Technician_Invoices_Table.php"><i class="fas fa-file-invoice"></i> فواتير الفنيين </a></li>
                        <li><a href="customers.php"><i class="fas fa-user-friends"></i> الزبائن </a></li>
                        <li><a href="employees.php"><i class="fas fa-user-tie"></i> الموظفين </a></li>
                        <li><a href="Technicians.php"><i class="fas fa-tools"></i> الفنيين </a></li>
                        <li><a href="Control_Board.php"><i class="fas fa-tachometer-alt"></i> لوحة التحكم </a></li>
                    </ul>
                </nav>
            </aside>
        </div>

        <h1>بيانات فواتير الفنيين</h1>
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

                        <label class="fillter_label" for="search_tech"> الفني:</label>
                        <input type="text" name="search_tech" id="search_tech" class="filtter_input_search" placeholder="ابحث عن اسم الفني"  value="<?php echo isset($_GET['search_tech']) ? htmlspecialchars($_GET['search_tech']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                        <div id="space"></div>
                        
                        <label class="fillter_label" for="search_project"> المشروع:</label>
                        <input type="text" name="search_project" id="search_project" class="filtter_input_search" placeholder="ابحث عن رقم المشروع" value="<?php echo isset($_GET['search_project']) ? htmlspecialchars($_GET['search_project']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>
                        <div id="space"></div>

                        <label class="fillter_label" for="PaymentID"> الدفعة:</label>
                        <input type="text" name="PaymentID" id="PaymentID" class="filtter_input_search" placeholder="ابحث عن رقم الدفعة" value="<?php echo isset($_GET['PaymentID']) ? htmlspecialchars($_GET['PaymentID']) : ''; ?>" />
                        <button type="submit" class="filtter_icon_search">&#128269;</button>

                    </div>
                </div>

                <div class="div_print_add_button">
                    <button type="reset" class="button_reset" onclick="window.location.href='Technician_Invoices_Table.php'">
                            <i class="fas fa-refresh"></i>الفلترة 
                        </button>
                        <div id="space"></div>
                        <div id="space"></div>

                    <button class="button_print" onclick="printTable()">
                        <i class="fas fa-print"></i> طباعة
                    </button>
                    <button onclick="location.href='new_TechnicianInvoices.php'" type="button" class="button_add" id="add-Btn">
                        <i class="fas fa-plus"></i> إضافة
                    </button>
                </div>
            </form>

            <div class="table-container">
                <div class='table-wrapper'>
                    <table id="table_projects">
                        <thead>
                            <tr>
                                <th >رقم تسلسلي</th>
                                <th >اسم الفني</th>
                                <th >رقم المشروع</th>
                                <th >الدفعة الجارية</th>
                                <th >رقم الفاتورة</th>
                                <th >التخصص</th>
                                <th >القيمة د.ل</th>
                                <th >تاريخ الفاتورة</th>
                                <th >طريقة الدفع</th>  
                                <th >البيان</th>
                                <th >صورة الفاتورة</th>
                                <th >الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            <?php
                            

                                // Initialize variables for filters
                                $filter_year = isset($_GET['year']) ? $_GET['year'] : '';
                                $filter_store = isset($_GET['store']) ? $_GET['store'] : '';
                                $filter_specialization = isset($_GET['specialization']) ? $_GET['specialization'] : '';
                                $filter_paymentmethods = isset($_GET['paymentmethods']) ? $_GET['paymentmethods'] : '';
                                $search_tech = isset($_GET['search_tech']) ? $_GET['search_tech'] : '';
                                $search_project = isset($_GET['search_project']) ? $_GET['search_project'] : '';
                                $search_PaymentID = isset($_GET['PaymentID']) ? $_GET['PaymentID'] : '';


                                // Build SQL query with necessary joins
                                $sql = "SELECT ti.InvoiceID , tech.TechnicianName, ti.ProjectID , ti.PaymentID, ti.InvoiceNumber, s.SpecializationName, ti.Description, ti.amount, ti.InvoiceDate, pm.PaymentMethodName, ti.InvoiceImage
                                        FROM technicianinvoices ti          
                                        LEFT JOIN technicians  AS tech ON ti.TechnicianID  = tech.TechnicianID 
                                        LEFT JOIN specializations s ON ti.SpecializationID  = s.SpecializationID
                                        LEFT JOIN paymentmethods pm ON ti.PaymentMethodID  = pm.PaymentMethodID
                                        ";
                                $where_clauses = [];
                                if (isset($_GET['year']) && !empty($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $where_clauses[] = "YEAR(ti.InvoiceDate) = '$year'";
                                }
                                if (isset($_GET['specialization']) && !empty($_GET['specialization'])) {
                                    $specialization = $_GET['specialization'];
                                    $where_clauses[] = "ti.SpecializationID = '$specialization'";
                                }
                                if (isset($_GET['paymentmethods']) && !empty($_GET['paymentmethods'])) {
                                    $paymentmethods = $_GET['paymentmethods'];
                                    $where_clauses[] = "ti.PaymentMethodID = '$paymentmethods'";
                                }
                                if (isset($_GET['search_tech']) && !empty($_GET['search_tech'])) {
                                    $search_tech = $_GET['search_tech'];
                                    $where_clauses[] = "TechnicianName LIKE '%$search_tech%'";
                                }
                                if (isset($_GET['search_project']) && !empty($_GET['search_project'])) {
                                    $search_project = $_GET['search_project'];
                                    $where_clauses[] = "ti.ProjectID LIKE '%$search_project%'";
                                }
                                if (!empty($search_PaymentID)) {
                                    $where_clauses[] = "ti.PaymentID LIKE '%$search_PaymentID%'";
                                }


                                if (!empty($where_clauses)) {
                                    $sql .= " WHERE " . implode(" AND ", $where_clauses);
                                }
                                // $sql .= " ORDER BY ti.InvoiceID  ASC";
                                
                                
                                
                                // Execute SQL query
                                $result = $conn->query($sql);
                                if (!$result) {
                                    die("Error executing query: " . $conn->error);
                                }

                                // Display results in the table
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["InvoiceID"] . "</td>";
                                        echo "<td>" . $row["TechnicianName"] . "</td>";
                                        echo "<td>" . $row["ProjectID"] . "</td>";
                                        echo "<td>" . $row["PaymentID"] . "</td>";
                                        echo "<td>" . $row["InvoiceNumber"] . "</td>";
                                        echo "<td>" . $row["SpecializationName"] . "</td>";
                                        echo "<td>" . myFormatNumber($row["amount"]) . "</td>";
                                        echo "<td>" . $row["InvoiceDate"] . "</td>";
                                        echo "<td>" . $row["PaymentMethodName"] . "</td>";
                                        echo "<td>" . $row["Description"] . "</td>";
                                        echo "<td><a href='data:image;base64," . base64_encode($row['InvoiceImage']) . "' target='_blank'><img class='invoice-img' height='100' width='100' src='data:image;base64," . base64_encode($row['InvoiceImage']) . "'/></a></td>";
                                        echo "<td>    
                                                <div class=\"action-buttons\">
                                                    <form class='botton_table' method='GET' action='edit_T_invoice.php' style='display: inline-block;'>
                                                        <input type='hidden' name='InvoiceID' value='" . $row["InvoiceID"] . "'>
                                                        <button class='button_edit' type='submit'>
                                                            <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                        </button>
                                                    </form>
                                                    <form class='botton_table' method='POST' action='delete_T_invoice.php'>
                                                        <input type='hidden' name='InvoiceID' value='" . $row["InvoiceID"] . "'>
                                                        <button class='button_delet' type='submit' onclick='return confirm(\"هل أنت متأكد من الحذف؟\")'>
                                                            <i id='i_del' class='fas fa-trash-alt'></i> حذف
                                                        </button>
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