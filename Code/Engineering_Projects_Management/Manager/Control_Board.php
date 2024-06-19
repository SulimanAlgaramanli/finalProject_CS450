<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>لوحة التحكم</title>
    <link rel="icon" href="../icons/engineer (1).png" type="image/x-icon" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../Css/style.css" />
  </head>
  <body>
    <div class="master">
      <div class="header">
        <div class="navbar">
          <div class="left-section">
            <div class="sidebar-toggle" onclick="toggleSidebar()">
              <i class="fas fa-bars"></i>
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
          <img src="../img/user.png" class="img_user" alt="صورة المستخدم" />
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
        <div>
          <img src="../img/Home/1.png" class="shap_img" alt="" />
          <img src="../img/Home/2.png" class="shap_img" alt="" />
          <img src="../img/Home/3.png" class="shap_img" alt="" />
          <img src="../img/Home/4.png" class="shap_img" alt="" />
          <img src="../img/Home/5.png" class="shap_img" alt="" />
          <img src="../img/Home/6.png" class="shap_img" alt="" />
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
