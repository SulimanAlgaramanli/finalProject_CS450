<?php
session_start();
include 'con_db.php';
include 'formatNumber.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>فنيين المشروع</title>
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
                ';
            } else {
                header("Location: index.php");
                exit();
            }
            ?>
        </div>
    </div>

    <div class="contener">
        <?php

        $project_id = isset($_GET['ProjectID']) ? $_GET['ProjectID'] : '';


        if (isset($_SESSION['user_name'])) {
            include 'sidebar.php';
        }
        ?>

        <h1>بيانات الفنيين</h1>
        <div class="min-contener" style="margin-right: 160px;">
            <form class="form_fillter" method="GET" action="">
                <div class="filters-container">
                    <div class="box_fillter1">
                        
                    </div>

                    <div class="box_fillter3">
                        <div class="search-container">
                            <input type="text" name="search_name" id="search_name" class="filtter_input_search" placeholder="ابحث عن اسم الفني" value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>" />
                            <button type="submit" class="filtter_icon_search">&#128269;</button>
                        </div>
                    </div>
                </div>

                <!-- أزرار الطباعة والإضافة -->
                <div class="div_print_add_button">
                <?php
                if (hasPermission($user_type, 41)) {
                    echo '
                    <button class="button_print" onclick="printTable()">
                        <i class="fas fa-print"></i> طباعة
                    </button>
                    ';
                }

                if (hasPermission($user_type, 38)) {
                    echo '
                    <button onclick="location.href=\'new_TechInProject.php\'" type="button" class="button_add" id="add-Btn">
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
                                <th>رقم الفني</th>
                                <th>اسم الفني</th>
                                <th>التخصص</th>    
                                <th>أمر التكليف</th>
                                <?php
                                if (hasPermission($user_type, 39)) {
                                    echo "<th>الإجراءات</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // استلام قيم الفلاتر من طلب GET
                        $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
            echo $project_id;
            // echo "dssasdsds";
                        // بناء استعلام SQL مع الفلاتر
                        $sql = "SELECT tech.TechnicianID, tech.TechnicianName, sp.SpecializationName, pt.ProjectID, pt.task_image
                                FROM projecttechnicians AS pt
                                LEFT JOIN Technicians AS tech ON tech.TechnicianID = pt.TechnicianID
                                LEFT JOIN specializations AS sp ON pt.SpecializationID = sp.SpecializationID
                                WHERE pt.ProjectID = $project_id
                                ";

                        // إضافة الفلاتر إذا كانت موجودة
                        $conditions = array();

                        if (!empty($search_name)) {
                            $conditions[] = "tech.TechnicianName LIKE '%$search_name%'";
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
                                    echo "<td>" . $row["TechnicianID"] . "</td>";
                                    echo "<td>" . $row["TechnicianName"] . "</td>";
                                    echo "<td>" . $row["SpecializationName"] . "</td>";
                                    echo "<td>
                                        <a href='/Engineering_Projects_Management/photo/taskImage/". $row["task_image"] ."'>".$row['task_image']."</a>
                                    </td>";

                                    if (hasPermission($user_type, 39)) {
                                        echo "<td>
                                                <div class=\"action-buttons\">
                                                    <form class='botton_table' method='GET' action='edit_tech_project.php' style='display: inline-block;'>
                                                        <input type='hidden' name='ProjectID' value='" . $row["ProjectID"] . "'>
                                                        <input type='hidden' name='TechnicianID' value='" . $row["TechnicianID"] . "'>
                                                        <button class='button_edit' type='submit'>
                                                            <i id='i_edit' class='fas fa-edit'></i> تعديل
                                                        </button>
                                                        ";
                                                        }
                                                        "  
                                                    </form>
                                                    <form class='botton_table' method='POST' action='delete_tech_project.php' style='display: inline-block;'>
                                                        <input type='hidden' name='ProjectID' value='" . $row["ProjectID"] . "'>
                                                        <input type='hidden' name='TechnicianID' value='" . $row["TechnicianID"] . "'>
                                                        ";
                                                            if (hasPermission($user_type, 40)) {
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
                                    }

                                    echo "</tr>";
                                }
                            else {
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
<script src="script.js"></script>
</body>
</html>
