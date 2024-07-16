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
    $projectID = isset($_POST['ProjectID']) ? $_POST['ProjectID'] : null;
    $InvoiceNumber = isset($_POST['InvoiceNumber']) ? $_POST['InvoiceNumber'] : null;
    $specialty = isset($_POST['specialty']) ? $_POST['specialty'] : null;
    $Description = isset($_POST['Description']) ? $_POST['Description'] : null;
    $Amount = isset($_POST['Amount']) ? $_POST['Amount'] : null;
    $InvoiceDate = isset($_POST['InvoiceDate']) ? $_POST['InvoiceDate'] : null;
    $PaymentMethod = isset($_POST['PaymentMethod']) ? $_POST['PaymentMethod'] : null;
    $StoreName = isset($_POST['StoreName']) ? $_POST['StoreName'] : null;

    
    // التحقق من صورة الفاتورة وتحويلها إلى Base64
    $imgContent = null;
    if (isset($_FILES['InvoiceImagePath']) && $_FILES['InvoiceImagePath']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['InvoiceImagePath']['tmp_name'];
        $imgContent = base64_encode(file_get_contents($fileTmpPath));
    }

    // استعلام SQL لإدخال بيانات الفاتورة
    $sql = "INSERT INTO `MaterialInvoices` (`ProjectID`, `InvoiceNumber`, `specialty`, `Description`, `Amount`, `InvoiceDate`, `PaymentMethod`, `StoreName`, `InvoiceImage`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // ربط المتغيرات بالاستعلام
    $stmt->bind_param("isssdssss", $projectID, $InvoiceNumber, $specialty, $Description, $Amount, $InvoiceDate, $PaymentMethod, $StoreName, $imgContent);

    if ($stmt->execute()) {
        echo "<script>alert('تمت إضافة الفاتورة بنجاح!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>إضافة فاتورة</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../Css/main.css" />
    <style>
        /* تنسيق النموذج */
        .form-container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* تنسيق الحقول والتسميات */
        .form-container label {
            font-weight: bold;
            display: block;
            width: 30%;
            text-align: right;
            font-size: 20px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .form-container input[type=text],
        .form-container input[type=date],
        .form-container input[type=number],
        .form-container input[type=checkbox],
        .form-container input[type=radio],
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

        /* تنسيق الزر */

        .button-container {
            align-items: center;
            text-align: center;
        }

        .form-container .button_save,
        .form-container .button_cancel {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .form-container .button_cancel {
            background-color: #f44336;
            margin-right: 10px;
        }

        .form-container .button_save:hover,
        .form-container .button_cancel:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="min-contener">
        <form id="invoiceForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-container">
                <h1>إضافة فاتورة</h1>

                <div class="form-group">
                    <label for="ProjectID">معرف المشروع:</label>
                    <input type="number" id="ProjectID" name="ProjectID" required /><br />

                    <label for="InvoiceNumber">رقم الفاتورة:</label>
                    <input type="text" id="InvoiceNumber" name="InvoiceNumber" required /><br />

                    <label for="specialty">التخصص:</label>
                    <input type="text" id="specialty" name="specialty" required /><br />

                    <label for="Description">الوصف:</label>
                    <textarea id="Description" name="Description" rows="4" required></textarea><br />

                    <label for="Amount">المبلغ:</label>
                    <input type="number" step="0.01" id="Amount" name="Amount" required /><br />

                    <label for="InvoiceDate">تاريخ الدفع:</label>
                    <input type="date" id="InvoiceDate" name="InvoiceDate" required /><br />

                    <label for="PaymentMethod">طريقة الدفع:</label>
                    <input type="text" id="PaymentMethod" name="PaymentMethod" required /><br />

                    <label for="StoreName">اسم المتجر:</label>
                    <input type="text" id="StoreName" name="StoreName" required /><br />

                    <label for="InvoiceImagePath">صورة الفاتورة:</label>
                    <input type="file" id="InvoiceImagePath" name="InvoiceImagePath" /><br />
                </div>
            </div>

            <div class="button-container">
                <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ</button>
                <button type="button" class="button_cancel"><i class="fas fa-close"></i> إلغاء</button>
            </div>
        </form>
    </div>
</body>
</html>
