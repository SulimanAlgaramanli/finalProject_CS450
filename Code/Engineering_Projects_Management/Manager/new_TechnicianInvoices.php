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
    $ProjectID = isset($_POST['ProjectID']) ? $_POST['ProjectID'] : null;
    $InvoiceNumber = isset($_POST['InvoiceNumber']) ? $_POST['InvoiceNumber'] : null;
    $PaymentID = isset($_POST['PaymentID']) ? $_POST['PaymentID'] : null;
    $SpecializationID = isset($_POST['SpecializationID']) ? $_POST['SpecializationID'] : null;
    $Description = isset($_POST['Description']) ? $_POST['Description'] : null;
    $Amount = isset($_POST['Amount']) ? $_POST['Amount'] : null;
    $InvoiceDate = isset($_POST['InvoiceDate']) ? $_POST['InvoiceDate'] : null;
    $PaymentMethodID = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID'] : null;
    $TechnicianID = isset($_POST['TechnicianID']) ? $_POST['TechnicianID'] : null;

    // التحقق من صورة الفاتورة وتحويلها إلى Base64
    $imgContent = null;
    if (isset($_FILES['InvoiceImagePath']) && $_FILES['InvoiceImagePath']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['InvoiceImagePath']['tmp_name'];
        $imgContent = file_get_contents($fileTmpPath);
    }

    // استعلام SQL لإدخال بيانات الفاتورة
    $sql = "INSERT INTO `technicianinvoices` (`ProjectID`, `InvoiceNumber`, `PaymentID`, `SpecializationID`, `Description`, `Amount`, `InvoiceDate`, `PaymentMethodID`, `TechnicianID`, `InvoiceImage`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // ربط المتغيرات بالاستعلام
    $stmt->bind_param("iiiissisis", $ProjectID, $InvoiceNumber, $PaymentID, $SpecializationID, $Description, $Amount, $InvoiceDate, $PaymentMethodID, $TechnicianID, $imgContent);

    if ($stmt->execute()) {
        echo "<script>alert('تمت إضافة الفاتورة بنجاح!');</script>";
        header("Location: Technician_Invoices_Table.php");
        exit(); // تأكد من استخدام exit بعد header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

// جلب البيانات من جداول المشاريع، التخصصات، طرق الدفع والمتاجر
$projects = $conn->query("SELECT ProjectID FROM projects ORDER BY ProjectID ASC");
$specializations = $conn->query("SELECT SpecializationID, SpecializationName FROM specializations ORDER BY SpecializationID ASC");
$paymentMethods = $conn->query("SELECT PaymentMethodID, PaymentMethodName FROM paymentmethods ORDER BY PaymentMethodID ASC");
$Technicians = $conn->query("SELECT TechnicianID, TechnicianName FROM technicians ORDER BY TechnicianID ASC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة فاتورة فني</title>
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
    <div class="min-contener">
        <form id="invoiceForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <h1>إضافة فاتورة فني</h1>
                <div class="form-group">
                    <label for="ProjectID">رقم المشروع:</label>
                    <select id="ProjectID" name="ProjectID" required>
                        <option value="" disabled selected>اختر المشروع</option>
                        <?php
                        if ($projects->num_rows > 0) {
                            while($row = $projects->fetch_assoc()) {
                                echo "<option value='" . $row["ProjectID"] . "'>" . $row["ProjectID"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />
                    
                    <label for="InvoiceNumber">رقم الفاتورة:</label>
                    <input type="text" id="InvoiceNumber" name="InvoiceNumber" readonly required /><br />

                    <label for="PaymentID">رقم الدفعة:</label>
                    <input type="text" id="PaymentID" name="PaymentID" readonly /><br />

                    <label for="TechnicianID">اسم الفني:</label>
                    <select id="TechnicianID" name="TechnicianID" required>
                        <option value="" disabled selected>اختر الفني</option>
                        <?php
                        if ($Technicians->num_rows > 0) {
                            while($row = $Technicians->fetch_assoc()) {
                                echo "<option value='" . $row["TechnicianID"] . "'>" . $row["TechnicianName"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />

                    <label for="SpecializationID">التخصص:</label>
                    <select id="SpecializationID" name="SpecializationID" required>
                        <option value="" disabled selected>اختر التخصص</option>
                        <?php
                        if ($specializations->num_rows > 0) {
                            while($row = $specializations->fetch_assoc()) {
                                echo "<option value='" . $row["SpecializationID"] . "'>" . $row["SpecializationName"] . "</option>";
                            }
                        }
                        ?>
                    </select><br />

                    <label for="Description">الوصف:</label>
                    <textarea id="Description" name="Description" rows="4"></textarea><br />

                    <label for="Amount">المبلغ:</label>
                    <input type="number" step="0.01" id="Amount" name="Amount" required /><br />

                    <label for="InvoiceDate">تاريخ الدفع:</label>
                    <input type="date" id="InvoiceDate" name="InvoiceDate" required /><br />

                    <label for="PaymentMethodID">طريقة الدفع:</label>
                    <select id="PaymentMethodID" name="PaymentMethodID" required>
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
                    <input type="file" id="InvoiceImagePath" name="InvoiceImagePath" accept="image/*" /><br />
                </div>
                <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ </button>
                <button type="button" class="button_cancel" onclick="window.location.href='Technician_Invoices_Table.php';"><i class="fas fa-close"></i> إلغاء </button>            
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function(){
    // عند تغيير اختيار رقم المشروع
    $('#ProjectID ').change(function(){
        var projectID = $(this).val();
        
        // استخدام AJAX لجلب رقم الفاتورة
        $.ajax({
            url: 'get_T_invoice_number.php',
            method: 'POST',
            data: { projectID: projectID },
            success: function(response){
                var data = JSON.parse(response);
                $('#InvoiceNumber').val(data.invoiceNumber); // تعيين قيمة رقم الفاتورة
            },
            error: function(){
                alert('حدث خطأ أثناء استرداد رقم الفاتورة.');
            }
        });

        // استخدام AJAX لجلب رقم الدفعة
        $.ajax({
            url: 'get_payment_number.php',
            method: 'POST',
            data: { projectID: projectID },
            success: function(response){
                var data = JSON.parse(response);
                $('#PaymentID').val(data.paymentNumber); // تعيين قيمة رقم الدفعة
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
