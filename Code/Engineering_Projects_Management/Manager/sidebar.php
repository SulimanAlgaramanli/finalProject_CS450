
    <div class="sidebar" id="sidebar">
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

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>