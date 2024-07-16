<?php
session_start();
?>
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

  <div class="master">
  <div class="header">
    <div class="navbar">
        <div class="left-section">
            <!-- <h1 style="margin: 40px;">مكتب لإدارة المشاريع الهندسية</h1> -->
        </div>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo '
            <div class="left-section">
                <div class="" onclick="toggleSidebar()">
                    <i class="fas fa-bars" id="bar" ></i>
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
                <div class="sidebar-close" onclick="closeSidebar()"></div>
                <div class="sidebar hidden" id="sidebar" style="  top: 65px;">
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
            ';
        } else {
            echo '
                <form action="login.php" method="post">
                    <button type="submit" id="button_login">تسجيل الدخول</button>
                </form>
            ';
        }
        ?>
    </div>
</div>

<div class="contener">
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
                    <h2>محتوى تعريفي بالمكتب</h2>
                    <p>
                        هذا المكتب يقوم بتنفيذ أعمال البناء بنظام Cost Plus
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
    }
    
    // Auto-play next video when current video ends
    video.addEventListener('ended', function() {
      playNextVideo();
    });

    // Initial autoplay for the first video
    video.play();

    // Image slider functionality
    var sliderIndex = 0;
    var images = document.querySelectorAll('#imageSlider img');

    function showNextImage() {
      images[sliderIndex].classList.remove('active');
      sliderIndex = (sliderIndex + 1) % images.length;
      images[sliderIndex].classList.add('active');
    }

    setInterval(showNextImage, 3000); // Change image every 3 seconds

    // Function to close the sidebar
    function closeSidebar() {
      var sidebar = document.getElementById('sidebar');
      sidebar.classList.add('hidden');
    }

    // Function to toggle the sidebar
    function toggleSidebar() {
      var sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>
  <script src="script.js"></script>

</body>
</html>
