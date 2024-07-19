<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectID = isset($_POST['projectID']) ? $_POST['projectID'] : null;
    $accountantID = isset($_POST['accountantID']) ? $_POST['accountantID'] : null;
    $paymentNumber = isset($_POST['paymentNumber']) ? $_POST['paymentNumber'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $PaymentMethodID = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID'] : null;
    $paymentDate = isset($_POST['paymentDate']) ? $_POST['paymentDate'] : null;

    // التحقق من أن جميع الحقول المطلوبة ليست فارغة
    if ($projectID && $accountantID && $paymentNumber  && $amount && $paymentDate) {
        $sql = "INSERT INTO payments (ProjectID, accountantID, paymentNumber, Amount, PaymentMethodID, PaymentDate)
                VALUES ('$projectID', '$accountantID', '$paymentNumber', '$amount', '$PaymentMethodID', '$paymentDate')";
        
        if ($conn->query($sql) === TRUE) {
            // echo "تم إضافة الدفعة بنجاح";
            echo "<script>alert('تمت إضافة الدفعة بنجاح!');</script>";
            header("Location: Customers_Payment_Table.php");
            exit(); // تأكد من استخدام exit بعد header
        } else {
            echo "خطأ: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "جميع الحقول المطلوبة يجب أن تكون ممتلئة";
    }
}

// استعلام SQL لاسترجاع أسماء المحاسبين
$sql_accountants = "SELECT employeeId, employeeName FROM employees WHERE userType = 4 ORDER BY employeeName";
$result_accountants = $conn->query($sql_accountants);

// استعلام SQL لاسترجاع أرقام المشاريع
$sql_1 = "SELECT ProjectID FROM projects ORDER BY ProjectID";
$result_1 = $conn->query($sql_1);

// استعلام SQL لاسترجاع طرق الدفع
$sql_2 = "SELECT PaymentMethodID, PaymentMethodName FROM PaymentMethods ORDER BY PaymentMethodID";
$result_2 = $conn->query($sql_2);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة دفعة</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />
</head>
<body>
    <style>
        .body{
            text-align: center; /* توسيط المحتوى */
        }
        .form-container {
            width: 80%;
            max-width: 600px;
            height: 600px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* توسيط المحتوى */
        }
        .form-container .form-group {
            margin-bottom: 20px;
        }
        
        .form-container label {
            font-weight: bold;
            display: inline-block;
            width: 30%;
            text-align: right;
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .form-container input[type=text],
        .form-container input[type=date],
        .form-container input[type=number],
        .form-container input[type=file],
        .form-container textarea,
        .form-container select {
            width: 65%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        .button_save,
        .button_cancel {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            margin: 10px 10px;
        }

    </style>

    <div class="form-container">
        <h1> دفعة جديدة</h1>
        <form action="new_payment.php" method="post">
            <label for="projectID">رقم المشروع:</label>
            <select id="projectID" name="projectID" required>
                <option value="" disabled selected>اختر المشروع</option>
                <?php
                // عرض خيارات المشاريع من قاعدة البيانات
                if ($result_1->num_rows > 0) {
                    while ($row = $result_1->fetch_assoc()) {
                        echo "<option value='" . $row['ProjectID'] . "'>" . $row['ProjectID'] . "</option>";
                    }
                } else {
                    echo "<option value=''>لا توجد مشاريع متاحة</option>";
                }
                ?>
            </select>

            <label for="paymentNumber">رقم الدفعة:</label>
            <input type="text" id="paymentNumber" name="paymentNumber" readonly>

            <label for="accountantID">اسم المحاسب:</label>
            <select id="accountantID" name="accountantID" required>
                <option value="" disabled selected>اختر المحاسب</option>
                <?php
                // عرض خيارات المحاسبين من قاعدة البيانات
                if ($result_accountants->num_rows > 0) {
                    while ($row = $result_accountants->fetch_assoc()) {
                        echo "<option value='" . $row['employeeId'] . "'>" . $row['employeeName'] . "</option>";
                    }
                } else {
                    echo "<option value=''>لا توجد محاسبين متاحين</option>";
                }
                ?>
            </select>

            <label for="amount">القيمة:</label>
            <input type="number" step="0.01" id="amount" name="amount" required>

            <label for="PaymentMethodID">طريقة الدفع :</label>
            <select id="PaymentMethodID" name="PaymentMethodID" required>
                <option value="" disabled selected>اختر طريقة الدفع</option>
                <?php
                // عرض خيارات طرق الدفع من قاعدة البيانات
                if ($result_2->num_rows > 0) {
                    while ($row = $result_2->fetch_assoc()) {
                        echo "<option value='" . $row['PaymentMethodID'] . "'>" . $row['PaymentMethodName'] . "</option>";
                    }
                } else {
                    echo "<option value=''>لا توجد  </option>";
                }
                ?>
            </select>

            <label for="paymentDate">تاريخ الدفع:</label>
            <input type="date" id="paymentDate" name="paymentDate" required>
            <div class="button-container">
                    <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ </button>
                    <button type="button" class="button_cancel" onclick="window.location.href='Customers_Payment_Table.php';"><i class="fas fa-close"></i> إلغاء </button>
                </div>
                    
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
    $(document).ready(function(){
        // عند تغيير اختيار رقم المشروع
        $('#projectID').change(function(){
            var projectID = $(this).val();
            // استخدام AJAX لاستعلام قاعدة البيانات
            $.ajax({
                url: 'get_payment_number.php', // اسم ملف PHP للتعامل مع استعلام قاعدة البيانات
                method: 'POST',
                data: { projectID: projectID },
                success: function(response){
                    var data = JSON.parse(response);
                    $('#paymentNumber').val(data.paymentNumber); // تعيين قيمة الدفعة المستلمة من الاستعلام
                },
                error: function(){
                    alert('حدث خطأ أثناء استرداد رقم الدفعة.');
                }
            });
        });
    });
</script>



    <script src="script.js"></script>
</body>
</html>

