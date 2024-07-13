<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_name'])) {
  header('Location: login.php'); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول إذا لم يكن مسجلاً دخوله
  exit;
}

// معالجة طلب تغيير كلمة المرور إذا تم إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // تعيين معلومات الاتصال بقاعدة البيانات
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "Engineering_Projects_Management";

  // إنشاء اتصال بقاعدة البيانات
  $conn = new mysqli($servername, $username, $password, $dbname);

  // التحقق من الاتصال
  if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
  }

  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];

  // التحقق من نوع المستخدم
  $sql = "SELECT * FROM usertype WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $_SESSION['user_type']);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_type = $row['type'];

    // تحديد الجدول المراد التعديل عليه بناءً على نوع المستخدم
    $table_name = '';
    $id_column = '';
    $password_column = '';

    if ($user_type === 'customer') {
      $table_name = 'customers';
      $id_column = 'CustomerId';
      $password_column = 'password';
    } elseif ($user_type === 'employee') {
      $table_name = 'employees';
      $id_column = 'employeeId';
      $password_column = 'password';
    } else {
      echo "نوع المستخدم غير معروف.";
      exit;
    }

    // تحقق من صحة كلمة المرور الحالية
    $sql_check_password = "SELECT $password_column FROM $table_name WHERE $id_column = ?";
    $stmt_check_password = $conn->prepare($sql_check_password);
    $stmt_check_password->bind_param('i', $_SESSION['user_id']);
    $stmt_check_password->execute();
    $result_check_password = $stmt_check_password->get_result();

    if ($result_check_password->num_rows > 0) {
      $row_check_password = $result_check_password->fetch_assoc();
      if (password_verify($current_password, $row_check_password[$password_column])) {
        // تجزئة كلمة المرور الجديدة
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        // تحديث كلمة المرور
        $sql_update_password = "UPDATE $table_name SET $password_column = ? WHERE $id_column = ?";
        $stmt_update_password = $conn->prepare($sql_update_password);
        $stmt_update_password->bind_param('si', $hashed_password, $_SESSION['user_id']);

        if ($stmt_update_password->execute()) {
          // توجيه المستخدم إلى الصفحة الرئيسية بعد تغيير كلمة المرور
          header('Location: index.php');
          exit;
        } else {
          echo "حدثت مشكلة أثناء تحديث كلمة المرور.";
        }
      } else {
        echo "كلمة المرور الحالية غير صحيحة.";
      }
    } else {
      echo "لم يتم العثور على معلومات المستخدم.";
    }
  }

  // إغلاق الاتصال بقاعدة البيانات
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تغيير كلمة المرور</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../Css/main.css">
  <style>
    /* أنماط CSS للنموذج */
    .change-password-form {
      max-width: 400px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: #f9f9f9;
      text-align: right;
    }

    .change-password-form h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .change-password-form label {
      display: block;
      margin-bottom: 10px;
    }

    .change-password-form input[type="password"] {
      width: calc(100% - 20px);
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 3px;
      font-size: 16px;
    }

    .change-password-form button {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
    }

    .change-password-form button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

<div class="master">
    <div class="header">
        <div class="navbar">
            <div class="left-section">
                <!-- <h1 style="margin: 40px;">مكتب لإدارة المشاريع الهندسية</h1> -->
            </div>
        <span class="username"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
        <img src="../icons/user.png" class="img_user" alt="صورة المستخدم" />
        <div class="sidebar-close" onclick="closeSidebar()"></div>
    </div>

    <div class="contener">
        <div class="">
            <h2>تغيير كلمة المرور</h2>
            <form class="change-password-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="current_password">كلمة المرور الحالية:</label>
                <input type="password" id="current_password" name="current_password" required>
                <label for="new_password">كلمة المرور الجديدة:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">حفظ التغييرات</button>
            </form>
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
</script>
<script src="script.js"></script>

</body>
</html>
