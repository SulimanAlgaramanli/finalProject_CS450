<?php
include 'con_db.php';

// التحقق من استلام قيمة TechnicianID من الطلب GET
if (isset($_GET['project_id'])) {
    $technicianID = $_GET['project_id'];

    // استعلام لجلب بيانات الفني بناءً على TechnicianID
    $sql = "SELECT * FROM Technicians WHERE TechnicianID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $technicianID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $technician = $result->fetch_assoc();
    } else {
        echo "لم يتم العثور على بيانات الفني.";
        exit();
    }

    // استعلام لجلب التخصصات الخاصة بالفني
    $sqlSpecializations = "SELECT sp.SpecializationID, sp.SpecializationName 
                            FROM specializations AS sp 
                            JOIN technician_specializations AS ts 
                            ON sp.SpecializationID = ts.SpecializationID 
                            WHERE ts.TechnicianID = ?";
    $stmtSpecializations = $conn->prepare($sqlSpecializations);
    $stmtSpecializations->bind_param("i", $technicianID);
    $stmtSpecializations->execute();
    $resultSpecializations = $stmtSpecializations->get_result();

    $technicianSpecializations = [];
    while ($row = $resultSpecializations->fetch_assoc()) {
        $technicianSpecializations[] = $row['SpecializationName'];
    }

    $stmt->close();
    $stmtSpecializations->close();
} else {
    echo "معرف الفني غير محدد.";
    exit();
}

// تحديث البيانات عند تقديم النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $technicianName = $_POST['technicianName'];
    $specializations = $_POST['specializations'];
    $nationality = $_POST['nationality'];
    $phoneNumber = $_POST['phoneNumber'];
    $joinDate = $_POST['joinDate'];

    // تحديث بيانات الفني
    $updateSql = "UPDATE Technicians SET TechnicianName = ?, Nationality = ?, PhoneNumber = ?, JoinDate = ? WHERE TechnicianID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssi", $technicianName, $nationality, $phoneNumber, $joinDate, $technicianID);

    if ($updateStmt->execute()) {
        echo "<script>alert('تم تحديث بيانات الفني بنجاح');</script>";
        header("Location: Technicians.php");
        exit(); 
    } else {
        echo "خطأ في التحديث: " . $conn->error;
    }

    // حذف التخصصات القديمة وإعادة إدراج التخصصات الجديدة
    $deleteSpecializationsSql = "DELETE FROM technician_specializations WHERE TechnicianID = ?";
    $deleteStmt = $conn->prepare($deleteSpecializationsSql);
    $deleteStmt->bind_param("i", $technicianID);
    $deleteStmt->execute();
    $deleteStmt->close();

    foreach ($specializations as $specializationID) {
        $insertSpecializationSql = "INSERT INTO technician_specializations (TechnicianID, SpecializationID) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSpecializationSql);
        $insertStmt->bind_param("ii", $technicianID, $specializationID);
        $insertStmt->execute();
        $insertStmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تعديل بيانات الفني</title>
    <link rel="stylesheet" href="../Css/main.css" />
    <style>
        /* يمكن إضافة تنسيقات CSS إضافية هنا إذا لزم الأمر */
    

        .container {
    width: 80%;
    max-width: 600px;
    height: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}


        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        .form-group .warning {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style=" text-align: center;">تعديل بيانات الفني</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="technicianName">اسم الفني:</label>
                <input type="text" id="technicianName" name="technicianName" value="<?php echo htmlspecialchars($technician['TechnicianName']); ?>" required />
            </div>

            <div class="form-group">
                <label for="specializations">التخصصات:</label>
                <select id="specializations" name="specializations[]" multiple>
                    <?php
                    // استعلام لجلب جميع التخصصات المتاحة
                    $sqlAllSpecializations = "SELECT * FROM specializations";
                    $resultAllSpecializations = $conn->query($sqlAllSpecializations);

                    while ($row = $resultAllSpecializations->fetch_assoc()) {
                        $selected = in_array($row['SpecializationID'], $technicianSpecializations) ? 'selected' : '';
                        echo "<option value='" . $row['SpecializationID'] . "' $selected>" . htmlspecialchars($row['SpecializationName']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nationality">الجنسية:</label>
                <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($technician['Nationality']); ?>" required />
            </div>

            <div class="form-group">
                <label for="phoneNumber">الهاتف:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($technician['PhoneNumber']); ?>" required />
            </div>

            <div class="form-group">
                <label for="joinDate">تاريخ الانضمام:</label>
                <input type="date" id="joinDate" name="joinDate" value="<?php echo htmlspecialchars($technician['JoinDate']); ?>" required />
            </div>

            <div class="form-group">
                <button type="submit">تحديث</button>
            </div>
        </form>
    </div>
</body>
</html>
