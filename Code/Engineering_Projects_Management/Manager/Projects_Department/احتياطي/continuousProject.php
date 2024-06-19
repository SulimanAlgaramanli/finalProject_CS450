<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>المشاريع تحت الانجاز</title>
    <link rel="stylesheet" href="../../css/main.css" />
  </head>
  <body>
    
    <div class="container">
      <div class="main-content">
        <header>
          <div class="search-container">
            <input
              type="search"
              placeholder="إبحث هنا..."
              class="search-input"
            />
            <span class="search-icon">&#128269;</span>
          </div>
          <div class="user-notifications-Settings">
            <img
              src="../../img/Settings.png"
              alt="Settings"
              class="settings-icon"
            />
            <span class="notification-icon">🔔</span>
            <img src="../../img/user.png" alt="User" class="user-icon" />
          </div>
        </header>

        <main>
          <section class="projects-section"  style="direction:ltr" >
            
           <?php
                // تعيين معلومات الاتصال بقاعدة البيانات
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "engineering_projects_management";

                // إنشاء اتصال
                $conn = new mysqli($servername, $username, $password, $dbname);

                // التحقق من الاتصال
                if ($conn->connect_error) {
                    die("فشل الاتصال: " . $conn->connect_error);
                }

                // استعلام SQL لاسترجاع البيانات
                $sql = "SELECT * FROM projects";
                $result = $conn->query($sql);

                // عرض البيانات في جدول HTML
                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                    <tr>
                        <th>ProjectID</th>
                        <th>CustomerID</th>
                        <th>SupervisingEngineerID</th>
                        <th>ContractSignDate</th>
                        <th>LandLocation</th>
                        <th>IsInPlan</th>
                        <th>HasBuildingPermit</th>
                        <th>PropertyType</th>
                        <th>LandArea</th>
                        <th>CoveredArea</th>
                        <th>DesignerOfficeName</th>
                        <th>DesignMapsSoftwareVersion</th>
                        <th>ProjectStartDate</th>
                        <th>ProjectEndDate</th>
                        <th>ProjectStatus</th>
                        <th>ProgressPercentage</th>
                        <th>TotalAmountPaid</th>
                        <th>AmountSpent</th>
                        <th>PropertyDescription</th>
                    </tr>";

                    // عرض البيانات الناتجة
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>".$row["ProjectID"]."</td>
                            <td>".$row["CustomerID"]."</td>
                            <td>".$row["SupervisingEngineerID"]."</td>
                            <td>".$row["ContractSignDate"]."</td>
                            <td>".$row["LandLocation"]."</td>
                            <td>".$row["IsInPlan"]."</td>
                            <td>".$row["HasBuildingPermit"]."</td>
                            <td>".$row["PropertyType"]."</td>
                            <td>".$row["LandArea"]."</td>
                            <td>".$row["CoveredArea"]."</td>
                            <td>".$row["DesignerOfficeName"]."</td>
                            <td>".$row["DesignMapsSoftwareVersion"]."</td>
                            <td>".$row["ProjectStartDate"]."</td>
                            <td>".$row["ProjectEndDate"]."</td>
                            <td>".$row["ProjectStatus"]."</td>
                            <td>".$row["ProgressPercentage"]."</td>
                            <td>".$row["TotalAmountPaid"]."</td>
                            <td>".$row["AmountSpent"]."</td>
                            <td>".$row["PropertyDescription"]."</td>
                        </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 نتائج";
                }

                // إغلاق الاتصال
                $conn->close();
            ?>

          </section>
        </main>
        <footer>
          <p>&copy; 2024 منصة لإدارة المكتب الهندسي</p>
        </footer>
      </div>

      <aside class="sidebar">
        <nav>
          <ul>
            <li><a href="../index.html">الصفحة الرئيسية</a></li>
            <li><a href="project.html">المشاريع</a></li>
            <li><a href="../financialDepartment.html">القسم المالي</a></li>
            <li><a href="../customers.html">الزبائن</a></li>
            <li><a href="../engineers.html">المهندسين</a></li>
            <li><a href="../technicians.html">الفنيين</a></li>
            <li><a href="../market.html">الورش / المعارض</a></li>
            <li><a href="../administrator.html">الصلاحيات</a></li>
            <li><a href="../reports.html">التقارير</a></li>
            <li><a href="../agreements.html">العقود</a></li>
          </ul>
        </nav>
      </aside>
    </div>

    <script src="script.js"></script>
  </body>
</html>