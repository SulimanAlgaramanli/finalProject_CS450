<?php


include 'con_db.php';

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

    $fileName = Null;
    if (!empty($_FILES['InvoiceImage']) && $_FILES['InvoiceImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['InvoiceImage']['tmp_name'];
        $fileName = $_FILES['InvoiceImage']['name'];
        $fileSize = $_FILES['InvoiceImage']['size'];
        $fileType = $_FILES['InvoiceImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'C:\\xampp\\htdocs\\Engineering_Projects_Management\\photo\\TechnicianInvoices\\';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // echo 'File is successfully uploaded.';
            } else {
                // echo 'There was an error moving the uploaded file.';
            }
        } else {
            // echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    }


    // استعلام SQL لإدخال بيانات الفاتورة
    $sql = "INSERT INTO `technicianinvoices` (`ProjectID`, `InvoiceNumber`, `PaymentID`, `SpecializationID`, `Description`, `Amount`, `InvoiceDate`, `PaymentMethodID`, `TechnicianID`, `InvoiceImage`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // ربط المتغيرات بالاستعلام
    $stmt->bind_param("iiiisdsiis", $ProjectID, $InvoiceNumber, $PaymentID, $SpecializationID, $Description, $Amount, $InvoiceDate, $PaymentMethodID, $TechnicianID, $fileName);

    if ($stmt->execute()) {
        echo "<script>alert('تمت إضافة الفاتورة بنجاح!');</script>";
        header("Location: Technician_Invoices_Table.php");
        exit(); // تأكد من استخدام exit بعد header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}


// استعلام SQL لاسترجاع أسماء الزبائن
$sql_cus = "SELECT CustomerId , CustomerName FROM Customers WHERE userType = 2 ORDER BY CustomerName";
$result_cus = $conn->query($sql_cus);


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


                    <label for="CustomerId">اسم الزبون:</label>
                    <select id="CustomerId" name="CustomerId" required>
                        <option value="" disabled selected>اختر الزبون</option>
                        <?php
                        if ($result_cus->num_rows > 0) {
                            while ($row = $result_cus->fetch_assoc()) {
                                echo "<option value='" . $row['CustomerId'] . "'>" . $row['CustomerName'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>لا يوجد زبائن متاحين</option>";
                        }
                        ?>
                    </select>

                    <label for="ProjectID">رقم المشروع:</label>
                    <select id="ProjectID" name="ProjectID" required>
                        <option value="" disabled selected>اختر المشروع</option>
                        <!-- سيتم تحديث هذه الخيارات باستخدام AJAX -->
                    </select>
                    
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

                    <label for="InvoiceImage">صورة الفاتورة:</label>
                    <input type="file" id="InvoiceImage" name="InvoiceImage"  /><br />
                </div>
                <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ </button>
                <button type="button" class="button_cancel" onclick="window.location.href='Technician_Invoices_Table.php';"><i class="fas fa-close"></i> إلغاء </button>            
            </div>
        </form>
    </div>



    <script>
        $(document).ready(function() {
            $('#CustomerId').change(function(){
                var customerId = $(this).val();
                if (customerId) {
                    $.ajax({
                        url: 'get_projects.php',
                        type: 'POST',
                        data: {CustomerId: customerId},
                        success: function(data) {
                            $('#ProjectID').html(data);
                        },
                        error: function() {
                            alert('حدث خطأ أثناء استرداد المشاريع.');
                        }
                    });
                } else {
                    $('#ProjectID').html('<option value="">اختر الزبون أولاً</option>');
                }
            });

            $('#ProjectID').change(function(){
                var projectID = $(this).val();
                
                $.ajax({
                    url: 'get_T_invoice_number.php',
                    method: 'POST',
                    data: { projectID: projectID },
                    success: function(response){
                        var data = JSON.parse(response);
                        $('#InvoiceNumber').val(data.invoiceNumber);
                    },
                    error: function(){
                        alert('حدث خطأ أثناء استرداد رقم الفاتورة.');
                    }
                });

                $.ajax({
                    url: 'get_payment_number_invoice.php',
                    method: 'POST',
                    data: { projectID: projectID },
                    success: function(response){
                        var data = JSON.parse(response);
                        $('#PaymentID').val(data.paymentNumber);
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


