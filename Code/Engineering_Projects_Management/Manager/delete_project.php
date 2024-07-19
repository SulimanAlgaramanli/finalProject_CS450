<?php
    include 'con_db.php'; // تأكد من تضمين ملف الاتصال بقاعدة البيانات

    if (isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];

        // تحقق من أن $project_id هو رقم صحيح
        if (is_numeric($project_id)) {
            // إعداد استعلام الحذف
            $sql = "DELETE FROM projects WHERE ProjectID = ?";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $project_id);

                if ($stmt->execute()) {
                    // إعادة توجيه المستخدم إلى صفحة المشاريع بعد الحذف
                    header("Location: Projects_Table.php");
                    exit;
                } else {
                    echo "خطأ في تنفيذ الاستعلام: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "خطأ في إعداد الاستعلام: " . $conn->error;
            }
        } else {
            echo "معرف المشروع غير صحيح.";
        }
    } else {
        echo "معرف المشروع غير موجود.";
    }

    $conn->close();
?>
