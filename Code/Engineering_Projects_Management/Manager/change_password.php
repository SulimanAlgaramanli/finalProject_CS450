<?php
session_start();

include 'con_db.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_name'])) {
  header('Location: login.php'); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول إذا لم يكن مسجلاً دخوله
  exit;
}

// معالجة طلب تغيير كلمة المرور إذا تم إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST'  &&     isset($_POST['new_password']) ) {
  
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($new_password !== $confirm_password) {
    echo "<script>alert('كلمتا المرور الجديدتان غير متطابقتين');</script>";
  } else {
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

      if ($_SESSION['user_type'] == 2) {
        $table_name = 'customers';
        $id_column = 'CustomerId';
        $password_column = 'password';
      } else {
        $table_name = 'employees';
        $id_column = 'employeeId';
        $password_column = 'password';
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
            echo "<script>alert('حدثت مشكلة أثناء تحديث كلمة المرور');</script>";
          }
        } else {
          echo "<script>alert('كلمة المرور الحالية غير صحيحة');</script>";
        }
      } else {        
        echo "<script>alert('لم يتم العثور على معلومات المستخدم');</script>";
      }
    }

    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();
  }
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
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
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
                    <span class="username"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
        <img src="../icons/user.png" class="img_user" alt="صورة المستخدم" />
    </div>

    <div class="contener">
        <div class="">
            <form class="change-password-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <h2>تغيير كلمة المرور</h2>
                <label for="current_password">كلمة المرور الحالية:</label>
                <input type="password" id="current_password" name="current_password" required>
                <label for="new_password">كلمة المرور الجديدة:</label>
                <input type="password" id="new_password" name="new_password" required>
                <label for="confirm_password">تأكيد كلمة المرور الجديدة:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <button type="submit">حفظ التغييرات</button>
            </form>
        </div>
    </div>
        
    <div class="footer">
        <p>المكتب الهندسي لإدارة المشاريع 2024 &copy;</p>
    </div>
</div>

<script src="script.js"></script>

</body>
</html>
