<?php
// تأكد من بدء الجلسة إذا لم تكن قد بدأت بالفعل
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// تضمين الملفات الضرورية مرة واحدة لتجنب إعادة تعريف الدوال
include_once 'con_db.php';
include_once 'hasPermission.php';

// تأكد من أن المستخدم مسجل دخول
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$user_type = $_SESSION['user_type'];
?>
<div class="sidebar hidden"   id="sidebar" style=" right: 0px;  top: 10px;">
    <aside class="sidebar-content">
        <nav>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> الصفحة الرئيسية</a></li>
                <?php
                if (hasPermission($user_type, 1)) {
                    echo '<li><a href="Projects_Table.php"><i class="fas fa-project-diagram"></i> المشاريع</a></li>';
                }
                if (hasPermission($user_type, 5)) {
                    echo '<li><a href="Customers_Payment_Table.php"><i class="fas fa-dollar-sign"></i> دفعات الزبائن</a></li>';
                }
                if (hasPermission($user_type, 9)) {
                    echo '<li><a href="MaterialInvoices.php"><i class="fas fa-shopping-cart"></i> فواتير المواد</a></li>';
                }
                if (hasPermission($user_type, 13)) {
                    echo '<li><a href="Technician_Invoices_Table.php"><i class="fas fa-file-invoice"></i> فواتير الفنيين</a></li>';
                }
                if (hasPermission($user_type, 17)) {
                    echo '<li><a href="customers.php"><i class="fas fa-user-friends"></i> الزبائن</a></li>';
                }
                if (hasPermission($user_type, 21)) {
                    echo '<li><a href="employees.php"><i class="fas fa-user-tie"></i> الموظفين</a></li>';
                }
                if (hasPermission($user_type, 25)) {
                    echo '<li><a href="Technicians.php"><i class="fas fa-tools"></i> الفنيين</a></li>';
                }
                // if (hasPermission($user_type, 29)) {
                //     echo '<li><a href="Control_Board.php"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a></li>';
                // }
                ?>
            </ul>
        </nav>
    </aside>
</div>

<script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('active');
    }
</script>
