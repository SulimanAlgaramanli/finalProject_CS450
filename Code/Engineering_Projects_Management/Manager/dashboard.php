<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>الصفحة الرئيسية</title>
  <link rel="icon" href="../icons/engineering.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../Css/main.css" />

</head>
<body>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];

// إعداد صلاحيات المستخدم بناءً على نوعه
switch ($usertype) {
    case 'Manager':
        $permissions = "صلاحيات المدير";
        break;
    case 'Engineer':
        $permissions = "صلاحيات المهندس";
        break;
    case 'Customer':
        $permissions = "صلاحيات العميل";
        break;
    // يمكنك إضافة المزيد من الحالات بناءً على أنواع المستخدمين
    default:
        $permissions = "صلاحيات عامة";
        break;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <h1>مرحبا <?php echo htmlspecialchars($username); ?>!</h1>
    <p><?php echo $permissions; ?></p>
    <!-- محتوى الصفحة بناءً على صلاحيات المستخدم -->
</body>
</html>

  <div class="master">
    <div class="header">
      <div class="navbar">
        <div class="left-section">
          <div class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars" id="bar"></i>
          </div>
          <div class="search-box">
          <input type="text" placeholder="البحث..." />
          <span class="search-icon">&#128269;</span>
        </div>
        </div>
        
        <div class="icons">
          <i class="fas fa-bell icon"></i>
          <i class="fas fa-cog icon"></i>
        </div>
        <span class="username"><?php echo '$username' ?></span>
        <img src="../icons/user.png" class="img_user" alt="صورة المستخدم" />
      </div>
    </div>
    <div class="contener">
      <div class="sidebar hidden" id="sidebar">
        <aside class="sidebar-content">
          <nav>
            <ul>
              <li>
                <a href="index.php"><i class="fas fa-home"></i> الصفحة الرئيسية</a>
              </li>
              <li>
                <a href="customers.php"><i class="fas fa-users"></i> قسم الزبائن</a>
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
                  <li><a href="Customers_Payment_Table.php">جدول دفعات الزبائن</a></li>
                  <li><a href="Procurement_Covenant_Table.php">جدول عهد المشتريات</a></li>
                  <li><a href="Technician_Invoices_Table.php">جدول فواتير الفنيين</a></li>
                </ul>
              </li>
              <li class="has-submenu">
                <span onclick="toggleSubmenu(this)">
                  <i class="fas fa-shopping-cart"></i> قسم المشتريات
                  <i class="fas fa-chevron-down"></i>
                </span>
                <ul class="submenu">
                  <li><a href="Purchase_Invoices_Table.php">جدول فواتير المشتريات</a></li>
                </ul>
              </li>
              <li>
                <a href="Control_Board.php"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
              </li>
            </ul>
          </nav>
        </aside>
      </div>

      <div class="min-contener_ForIndex">

        <div class="image-slider" id="imageSlider">
            <img src="../img/Home/1.png" class="active" alt="صورة 1">
            <img src="../img/Home/2.png" alt="صورة 2">
            <img src="../img/Home/5.png" alt="صورة 4">
            <img src="../img/Home/6.png" alt="صورة 5">
            <img src="../img/Home/9.png" alt="صورة 6">
            <img src="../img/Home/10.png" alt="صورة 7">
          </div>

          <div class="home_container">
          <div class="box1">
          <div class="content-box">
          <h2>محتوى تعريفي</h2>
          <p>
            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
          </p>
        </div>
          </div>
          <div class="box2">
            <div class="video-container">
              <video id="myVideo" class="video" autoplay muted>
                <source id="videoSource" src="../videos/3.mp4" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
            </div>
          </div>
        </div>
        
      </div>

    </div>
    
    <div class="footer">
      <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
    </div>
  </div>
  
  <script>
    // Get the video element
    var video = document.getElementById('myVideo');
    var videoSource = document.getElementById('videoSource');
    var videoSources = ['../videos/3.mp4', '../videos/4.mp4', '../videos/5.mp4'];
    var currentIndex = 0;

    // Function to play the next video
    function playNextVideo() {
      currentIndex = (currentIndex + 1) % videoSources.length;
      videoSource.src = videoSources[currentIndex];
      video.load(); // Ensure the new video is loaded
      video.play();
      document.body.removeChild(preloadedVideo); // Remove the old preloaded video
      preloadedVideo = preloadNextVideo(); // Preload the next video
    }
    
    // Auto-play next video when current video ends
    video.addEventListener('ended', function() {
      playNextVideo();
    });

     // Initial autoplay for the first video
    video.play();

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


     // Image slider functionality
     var sliderIndex = 0;
    var images = document.querySelectorAll('#imageSlider img');

    function showNextImage() {
      images[sliderIndex].classList.remove('active');
      sliderIndex = (sliderIndex + 1) % images.length;
      images[sliderIndex].classList.add('active');
    }

    setInterval(showNextImage, 3000); // Change image every 3 seconds
  </script>
</body>
</html>
