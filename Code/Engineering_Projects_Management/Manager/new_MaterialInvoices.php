<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Engineering_Projects_Management";

// اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // تعريف المتغيرات والتأكد من قيمها
    $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
    $invoice_number = isset($_POST['invoice_number']) ? $_POST['invoice_number'] : null;
    $payment_id = isset($_POST['payment_id']) ? $_POST['payment_id'] : null;
    $specialization_id = isset($_POST['specialization_id']) ? $_POST['specialization_id'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : null;

    $payment_method_id = isset($_POST['payment_method_id']) ? $_POST['payment_method_id'] : null;
    $store_id = isset($_POST['store_id']) ? $_POST['store_id'] : null;



    // التحقق من صورة الفاتورة وتحويلها إلى Base64
    $imgContent = null;
    if (isset($_FILES['InvoiceImagePath']) && $_FILES['InvoiceImagePath']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['InvoiceImagePath']['tmp_name'];
        $imgContent = base64_encode(file_get_contents($fileTmpPath));
    }

    // استعلام SQL لإدخال بيانات الفاتورة
    $sql = "INSERT INTO `MaterialInvoices` (`project_id`, `invoice_number`, `payment_id`,  `specialization_id`, `description`, `amount`, `invoice_date`, `payment_method_id`, `store_id`, `invoice_image`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // ربط المتغيرات بالاستعلام
    $stmt->bind_param("iiiissisis", $project_id, $invoice_number, $payment_id, $specialization_id, $description, $amount, $invoice_date, $payment_method_id, $store_id, $imgContent);

    if ($stmt->execute()) {
        echo "<script>alert('تمت إضافة الفاتورة بنجاح!');</script>";
        header("Location: MaterialInvoices.php");
        exit(); // تأكد من استخدام exit بعد header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// جلب البيانات من جداول المشاريع، التخصصات، طرق الدفع والمتاجر
$projects = $conn->query("SELECT ProjectID FROM projects   ORDER BY ProjectID  ASC");
$specializations = $conn->query("SELECT SpecializationID, SpecializationName FROM specializations  ORDER BY SpecializationID  ASC");
$paymentMethods = $conn->query("SELECT PaymentMethodID, PaymentMethodName FROM paymentmethods  ORDER BY PaymentMethodID  ASC ");
$stores = $conn->query("SELECT StoreID, StoreName FROM stores  ORDER BY StoreID  ASC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة فاتورة مواد</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />



    <style>
        .form-container {
            width: 80%;
            max-width: 600px;
            height: 800px;
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
        .form-container label {
            font-weight: bold;
            display: block;
            width: 30%;
            text-align: right;
            font-size: 20px;
            margin-bottom: 10px;
            display: inline-block;
            justify-content: center;
            align-items: center;
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
            display: inline-block;
            box-sizing: border-box;
        }

    </style> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="min-contener" style="  align-items: center; text-align: center;">
        <form id="invoiceForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <h1>إضافة فاتورة مواد</h1>
                <div class="form-group">
                    <label for="project_id">رقم المشروع:</label>
                    <select id="project_id" name="project_id" required>
                        <option value="" disabled selected>اختر المشروع</option>
                        <?php
                        if ($projects->num_rows > 0) {
                            while($row = $projects->fetch_assoc()) {
                                echo "<option value='" . $row["ProjectID"] . "'>" . $row["ProjectID"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />
                    
                    <label for="invoice_number">رقم الفاتورة:</label>
                    <input type="text" id="invoice_number" name="invoice_number" readonly required /><br />


                    <label for="payment_id">رقم الدفعه:</label>
                    <input type="text" id="payment_id" name="payment_id" readonly /><br />


                    <label for="specialization_id">التخصص:</label>
                    <select id="specialization_id" name="specialization_id" required>
                        <option value="" disabled selected>اختر التخصص</option>
                        <?php
                        if ($specializations->num_rows > 0) {
                            while($row = $specializations->fetch_assoc()) {
                                echo "<option value='" . $row["SpecializationID"] . "'>" . $row["SpecializationName"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />
                    <label for="store_id">اسم المتجر:</label>
                    <select id="store_id" name="store_id" required>
                        <option value="" disabled selected>اختر المتجر</option>
                        <?php
                        if ($stores->num_rows > 0) {
                            while($row = $stores->fetch_assoc()) {
                                echo "<option value='" . $row["StoreID"] . "'>" . $row["StoreName"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />

                    <label for="description">البيان:</label>
                    <textarea id="description" name="description" rows="4" ></textarea><br />

                    <label for="amount">المبلغ:</label>
                    <input type="number" step="0.01" id="amount" name="amount" required /><br />

                    <label for="invoice_date">تاريخ الدفع:</label>
                    <input type="date" id="invoice_date" name="invoice_date" required /><br />

                    <label for="payment_method_id">طريقة الدفع:</label>
                    <select id="payment_method_id" name="payment_method_id" required>
                        <option value="" disabled selected>اختر طريقة الدفع</option>
                        <?php
                        if ($paymentMethods->num_rows > 0) {
                            while($row = $paymentMethods->fetch_assoc()) {
                                echo "<option value='" . $row["PaymentMethodID"] . "'>" . $row["PaymentMethodName"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />

                    

                    <label for="InvoiceImagePath">صورة الفاتورة:</label>
                    <input type="file" id="InvoiceImagePath" name="InvoiceImagePath" /><br />
                </div>
                <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ </button>
                <button type="button" class="button_cancel" onclick="window.location.href='MaterialInvoices.php';"><i class="fas fa-close"></i> إلغاء </button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function(){
    // عند تغيير اختيار رقم المشروع
    $('#project_id').change(function(){
        var projectID = $(this).val();
        
        // استخدام AJAX لجلب رقم الفاتورة
        $.ajax({
            url: 'get_M_invoice_number.php',
            method: 'POST',
            data: { projectID: projectID },
            success: function(response){
                var data = JSON.parse(response);
                $('#invoice_number').val(data.invoiceNumber); // تعيين قيمة رقم الفاتورة
            },
            error: function(){
                alert('حدث خطأ أثناء استرداد رقم الفاتورة.');
            }
        });

        // استخدام AJAX لجلب رقم الدفعة
        $.ajax({
            url: 'get_payment_number_invoice.php',
            method: 'POST',
            data: { projectID: projectID },
            success: function(response){
                var data = JSON.parse(response);
                $('#payment_id').val(data.paymentNumber); // تعيين قيمة رقم الدفعة
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
