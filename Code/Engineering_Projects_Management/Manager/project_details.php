<?php
    
    include 'con_db.php';
    include 'formatNumber.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تفاصيل المشروع</title>
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

body {
    font-family: Arial, sans-serif;
    direction: rtl; /* لتنسيق النص من اليمين إلى اليسار */
}

.navbar {
    background-color: #333;
    overflow: hidden;
}

.nav-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-start; /* عناصر الشريط من اليمين إلى اليسار */
}

.nav-item {
    margin-left: 20px;
}

.nav-item a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

.nav-item a:hover {
    background-color: #575757;
}

.content {
    padding: 20px;
}

.content section {
    margin-bottom: 40px;
}

h2 {
    color: #333;
}

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
            <ul class="nav-list">
                    <li class="nav-item"><a href="#documents">المستندات</a></li>
                    <li class="nav-item"><a href="#designs">التصاميم</a></li>
                    <li class="nav-item"><a href="#construction-stages">مراحل البناء</a></li>
                </ul>
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

            
    
    <div class="content">
        <section id="documents">
            <h2>المستندات</h2>
            <p>تفاصيل المستندات الخاصة بالمشروع.</p>
        </section>
        
        <section id="designs">
            <h2>التصاميم</h2>
            <p>تفاصيل التصاميم الخاصة بالمشروع.</p>
        </section>
        
        <section id="construction-stages">
            <h2>مراحل البناء</h2>
            <p>تفاصيل مراحل البناء الخاصة بالمشروع.</p>
        </section>
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



