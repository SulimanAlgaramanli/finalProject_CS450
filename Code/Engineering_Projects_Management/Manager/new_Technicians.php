<?php
include 'con_db.php';

// إذا تم إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $technicianName = $_POST['technicianName'];
    $nationality = $_POST['nationality'];
    $phoneNumber = $_POST['phoneNumber'];
    $joinDate = $_POST['joinDate'];
    $specializations = $_POST['specializations'];

    // تحقق من وجود بيانات
    if (!empty($technicianName) && !empty($nationality) && !empty($phoneNumber) && !empty($joinDate)) {
        // إدراج بيانات الفني
        $sql = "INSERT INTO Technicians (TechnicianName, Nationality, PhoneNumber, JoinDate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $technicianName, $nationality, $phoneNumber, $joinDate);

        if ($stmt->execute()) {
            $technicianID = $stmt->insert_id; // الحصول على ID الفني الجديد

            // إدراج التخصصات إذا كانت موجودة
            if (!empty($specializations)) {
                foreach ($specializations as $specializationID) {
                    $sqlSpecialization = "INSERT INTO technician_specializations (TechnicianID, SpecializationID) VALUES (?, ?)";
                    $stmtSpecialization = $conn->prepare($sqlSpecialization);
                    $stmtSpecialization->bind_param("ii", $technicianID, $specializationID);
                    $stmtSpecialization->execute();
                }
            }

            echo "تمت إضافة الفني بنجاح!";
        } else {
            echo "خطأ في الإدخال: " . $conn->error;
        }
    } else {
        echo "الرجاء ملء جميع الحقول.";
    }
}

// استعلام لجلب التخصصات من قاعدة البيانات
$specializationsQuery = "SELECT SpecializationID, SpecializationName FROM specializations";
$specializationsResult = $conn->query($specializationsQuery);

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة فني</title>
    <link rel="icon" href="../icons/engineer.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/main.css">
    <style>
        
        .form-container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: auto;
            position: relative;
            top: 30%;
            left: 0;
            transform: none;
        }
        .form-container label {
            font-weight: bold;
            display: block;
            width: 30%;
            text-align: right;
            font-size: 16px; 
            margin-bottom: 10px;
            display: inline-block;
        }
        .form-container input[type=text],
        .form-container input[type=date],
        .form-container input[type=number],
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
        .form-container select {
            width: calc(65% + 18px);
            padding-right: 18px;
        }
        .form-container button {
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
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

        <div class="min-contener">
            <div class="form-container">
                <h1 style="text-align: center;">إضافة فني</h1>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="technicianName">اسم الفني:</label>
                        <input type="text" id="technicianName" name="technicianName" required>
                    </div>

                    <div class="form-group">
                        <label for="nationality">الجنسية:</label>
                        <input type="text" id="nationality" name="nationality" required>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">الهاتف:</label>
                        <input type="text" id="phoneNumber" name="phoneNumber" required>
                    </div>

                    <div class="form-group">
                        <label for="joinDate">تاريخ الانضمام:</label>
                        <input type="date" id="joinDate" name="joinDate" required>
                    </div>

                    <div class="form-group">
                        <label for="specializations">التخصصات:</label>
                        <select id="specializations" name="specializations[]" multiple>
                            <?php
                            if ($specializationsResult->num_rows > 0) {
                                while ($row = $specializationsResult->fetch_assoc()) {
                                    echo "<option value='" . $row["SpecializationID"] . "'>" . $row["SpecializationName"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit">إضافة فني</button>
                </form>
            </div>
        </div>


<script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
