<?php
    session_start();

    include 'con_db.php';
    include 'hasPermission.php';


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
        </div>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo '
            <div class="left-section">
                <div >
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
                <div class="sidebar hidden" style = "  right: 0px; " id="sidebar" style="  top: 65px;">';
                    // استدعاء الـ Sidebar
                    include 'sidebar_for_index.php';;
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

<div class="contener" style = "  margin: 5px 120px; ">
    <div class="min-contener_ForIndex">
        
        <div class="content-box" style="margin-left: 110px;   text-align: right;  direction: rtl; ">
    <h1 style="font-size: 40px;">مرحبًا بكم في المكتب الليبي لإدارة المشاريع الهندسية</h1>
    <p style="font-size: 25px;   line-height: 1.6;">
        نقدم خدمات إدارة وتنفيذ المشاريع الهندسية بحرفية ودقة عالية. نتخصص في تنفيذ أعمال البناء بنظام Cost Plus لضمان تقديم الجودة والشفافية في جميع مراحل المشروع.
    </p>

    <h3 style="font-size: 28px;" >اتصل بنا</h3>
    <p style="font-size: 25px;   line-height: 1.6;">
        للمزيد من المعلومات حول خدماتنا وكيفية التعاون معنا، لا تتردد في الاتصال بنا. فريقنا مستعد للإجابة على جميع استفساراتكم وتقديم الدعم اللازم لتحقيق مشاريعكم بنجاح.
    </p>
    <p style="font-size: 20px;   line-height: 1.6;">
        <strong >عنوان المكتب: شارع الظل </strong> <br>
        <strong >البريد الإلكتروني: LibyanEngProjects@eng.ly</strong> <br>
        <strong >رقم الهاتف: 0912808288</strong>
    </p>
    <p style="font-size: 25px;   line-height: 1.6;">
        نحن هنا لتحقيق رؤيتكم بأعلى معايير الجودة والشفافية. ننتظر تواصلكم لنبدأ معًا رحلتكم نحو النجاح !
    </p>
</div>
        <!-- <br> -->

        <div class="home_container">
            <div class="box1">
            <div class="image-slider" id="imageSlider">
                <img src="../img/Home/a1.jpg" class="active" alt="صورة 1">
                <img src="../img/Home/a2.jpg" alt="صورة 2">
                <img src="../img/Home/a.jpg" alt="صورة a">

                <img src="../img/Home/a3.jpg" alt="صورة 3">
                <img src="../img/Home/a4.jpg" alt="صورة 4">

                <img src="../img/Home/1.png"  alt="صورة 1">
                <img src="../img/Home/2.png" alt="صورة 2">
                <img src="../img/Home/5.png" alt="صورة 4">
                <img src="../img/Home/6.png" alt="صورة 5">
                <img src="../img/Home/9.png" alt="صورة 6">
                <img src="../img/Home/10.png" alt="صورة 7">
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


    </script>

</body>
</html>
