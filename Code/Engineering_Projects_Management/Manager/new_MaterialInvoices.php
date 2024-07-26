<?php

include 'con_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"      ) {
    // تعريف المتغيرات والتأكد من قيمها
    $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
    $invoice_number = isset($_POST['invoice_number']) ? $_POST['invoice_number'] : null;
    $payment_id = isset($_POST['payment_id']) ? $_POST['payment_id'] : null;
    $specialization_id = isset($_POST['specialization_id']) ? $_POST['specialization_id'] : null;
    $description = isset($_POST['Description']) ? $_POST['Description'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $invoice_date = isset($_POST['invoice_date']) ? $_POST['invoice_date'] : null;

    $payment_method_id = isset($_POST['payment_method_id']) ? $_POST['payment_method_id'] : null;
    $store_id = isset($_POST['store_id']) ? $_POST['store_id'] : null;


    $fileName = Null;
    if (!empty($_FILES['invoice_image']) && $_FILES['invoice_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['invoice_image']['tmp_name'];
        $fileName = $_FILES['invoice_image']['name'];
        $fileSize = $_FILES['invoice_image']['size'];
        $fileType = $_FILES['invoice_image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'C:\\xampp\\htdocs\\Engineering_Projects_Management\\photo\\MaterialInvoices\\';
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
    // echo "<script>alert('$fileName');</script>";




    // استعلام SQL لإدخال بيانات الفاتورة
    $sql = "INSERT INTO `MaterialInvoices` (`project_id`, `invoice_number`, `payment_id`,  `specialization_id`, `Description`, `amount`, `invoice_date`, `payment_method_id`, `store_id`, `invoice_image`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    // ربط المتغيرات بالاستعلام
    $stmt->bind_param("iiiisdsiis", $project_id, $invoice_number, $payment_id, $specialization_id, $description, $amount, $invoice_date, $payment_method_id, $store_id, $fileName);

    if ($stmt->execute()) {
        echo "<script>alert('تمت إضافة الفاتورة بنجاح!');</script>";
        header("Location: MaterialInvoices.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}


// استعلام SQL لاسترجاع أسماء الزبائن
$sql_cus = "SELECT CustomerId , CustomerName FROM Customers WHERE userType = 2 ORDER BY CustomerName";
$result_cus = $conn->query($sql_cus);


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

                    <label for="project_id">رقم المشروع:</label>
                    <select id="project_id" name="project_id" required>
                        <option value="" disabled selected>اختر المشروع</option>
                        <!-- سيتم تحديث هذه الخيارات باستخدام AJAX -->
                    </select>

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

                    <label for="Description"  rows="4" >البيان:</label>
                    <textarea id="Description" name="Description" rows="4" ></textarea><br />

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
                    
                    <label for="invoice_image">صورة الفاتورة:</label>
                    <input type="file" id="invoice_image" name="invoice_image"  /><br />
                </div>
                <button type="submit" class="button_save"><i class="fas fa-save"></i> حفظ </button>
                <button type="button" class="button_cancel" onclick="window.location.href='MaterialInvoices.php';"><i class="fas fa-close"></i> إلغاء </button>
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
                            $('#project_id').html(data);
                        },
                        error: function() {
                            alert('حدث خطأ أثناء استرداد المشاريع.');
                        }
                    });
                } else {
                    $('#project_id').html('<option value="">اختر الزبون أولاً</option>');
                }
            });

            $('#project_id').change(function(){
                var projectID = $(this).val();
                
                $.ajax({
                    url: 'get_M_invoice_number.php',
                    method: 'POST',
                    data: { projectID: projectID },
                    success: function(response){
                        var data = JSON.parse(response);
                        $('#invoice_number').val(data.invoiceNumber);
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
                        $('#payment_id').val(data.paymentNumber);
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
