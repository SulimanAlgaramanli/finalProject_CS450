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
    $PaymentMethods = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodName'] : null;
    $paymentDate = isset($_POST['paymentDate']) ? $_POST['paymentDate'] : null;



    // التحقق من أن جميع الحقول المطلوبة ليست فارغة
    if ($projectID && $accountantID && $paymentNumber && $amount && $paymentDate) {
        $sql = "INSERT INTO payments (ProjectID, accountantID, paymentNumber, Amount, $PaymentMethods, PaymentDate, materialInvoices, technicianInvoices, feesAmount, SettlementDate)
                VALUES ('$projectID', '$accountantID', '$paymentNumber', '$amount', '$PaymentMethods', '$paymentDate', '0', '0', '0', '$SettlementDate')";
        
        if ($conn->query($sql) === TRUE) {
            // echo "تم إضافة الدفعة بنجاح";
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
$sql_1 = "SELECT ProjectID FROM projects
order by ProjectID";
$result_1 = $conn->query($sql_1);

// استعلام SQL لاسترجاع أرقام المشاريع
$sql_2 = "SELECT PaymentMethodID FROM PaymentMethods
order by PaymentMethodID";
$result_2 = $conn->query($sql_2);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة دفعة جديدة</title>
    
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            direction: rtl; /* توجيه النصوص إلى اليمين */
        }

        h1 {
            color: #333;
            text-align: center;
            padding: 30px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"],
        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>


    <div class="container">
        <h1>إضافة دفعة جديدة</h1>
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

            <button type="submit">إضافة الدفعة</button>
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
                        $('#paymentNumber').val(response); // تعيين قيمة الدفعة المستلمة من الاستعلام
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
