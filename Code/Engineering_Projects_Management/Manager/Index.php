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
            
            <h1 style="margin:40px;">مكتب لإدارة المشاريع الهندسية</h1>
            <link rel="icon" href="../icons/engineering.png" type="image/x-icon" />
          </div>
          
          <form action="login.php" method="get">
            <button type="submit" id="button_login">تسجيل الدخول</button>
        </form>          


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
          <h2> محتوى تعريفي بالمكتب</h2>
          <p>
            هذا المكتب يقوم بتنفيذ اعمال البناء بنظام Cost Plus
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
