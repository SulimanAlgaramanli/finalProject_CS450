
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
    $paymentDate = isset($_POST['paymentDate']) ? $_POST['paymentDate'] : null;
    $materialInvoices = isset($_POST['materialInvoices']) ? $_POST['materialInvoices'] : null;
    $technicianInvoices = isset($_POST['technicianInvoices']) ? $_POST['technicianInvoices'] : null;
    $feesAmount = isset($_POST['feesAmount']) ? $_POST['feesAmount'] : null;
    $remainingAmount = isset($_POST['remainingAmount']) ? $_POST['remainingAmount'] : null;
    $settlementDate = isset($_POST['settlementDate']) ? $_POST['settlementDate'] : null;

    // التحقق من أن جميع الحقول المطلوبة ليست فارغة
    if ($projectID && $accountantID && $paymentNumber && $amount && $paymentDate) {
        // إدخال الدفعة الأولى للمشروع
        $sql1 = "INSERT INTO payments (ProjectID, accountantID, paymentNumber, Amount, PaymentDate, materialInvoices, technicianInvoices, feesAmount, remainingAmount, SettlementDate)
                VALUES ('$projectID', '$accountantID', '$paymentNumber', '$amount', '$paymentDate', '$materialInvoices', '$technicianInvoices', '$feesAmount', '$remainingAmount', '$settlementDate')";     
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

// استعلام SQL لاسترجاع أرقام المشاريع
$sql_1 = "SELECT ProjectID FROM projects
order by ProjectID";
$result = $conn->query($sql_1);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل دفعة </title>
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
</head>
<body>
    <div class="container">
    <h1>تعديل الدفعة</h1>
    <form method="POST" action="edit_payment.php">
        
        <label for="paymentid"> ID الدفعة:</label>
        <input type="text" id="payment_id" name="payment_id" value="<?php echo $payment['PaymentID']; ?>">

        <label for="projectID">رقم المشروع:</label>
            <select id="projectID" name="projectID" required>
                <option value="" disabled selected>اخترالمشروع</option>
                <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ProjectID'] . "'>" . $row['ProjectID'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>لا توجد مشاريع متاحة</option>";
                    }
                ?>
            </select>

            <label for="paymentNumber">رقم الدفعة:</label>
            <input type="text" id="paymentNumber" name="paymentNumber" >

        <label for="accountant_id">معرّف المحاسب:</label>
        <input type="number" id="accountant_id" name="accountant_id" value="<?php echo $payment['accountantID']; ?>" required><br>

        <label for="amount">المبلغ:</label>
        <input type="number" id="amount" name="amount" value="<?php echo $payment['Amount']; ?>" required><br>

        <label for="payment_date">تاريخ الدفع:</label>
        <input type="date" id="payment_date" name="payment_date" value="<?php echo $payment['PaymentDate']; ?>" required><br>

        <label for="material_invoices">فواتير المواد:</label>
        <input type="number" id="material_invoices" name="material_invoices" value="<?php echo $payment['materialInvoices']; ?>"><br>

        <label for="technician_invoices">فواتير الفنيين:</label>
        <input type="number" id="technician_invoices" name="technician_invoices" value="<?php echo $payment['technicianInvoices']; ?>"><br>

        <label for="fees_amount">قيمة الأتعاب:</label>
        <input type="number" id="fees_amount" name="fees_amount" value="<?php echo $payment['feesAmount']; ?>"><br>

        <label for="remaining_amount">القيمة الباقية:</label>
        <input type="number" id="remaining_amount" name="remaining_amount" value="<?php echo $payment['remainingAmount']; ?>"><br>

        <label for="settlement_date">تاريخ التسوية:</label>
        <input type="date" id="settlement_date" name="settlement_date" value="<?php echo $payment['SettlementDate']; ?>"><br>

        <button type="submit">تحديث</button>
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

</body>
</html> 

