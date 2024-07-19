<?php
include 'con_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['project_id'])) {
        $customerId = $_POST['project_id'];

        // التحقق من أن ID الزبون موجود
        if (!empty($customerId)) {
            $sql = "DELETE FROM Customers WHERE CustomerId = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $customerId);

            if ($stmt->execute()) {
                // نجاح الحذف
                header("Location: customers.php?message=success");
                exit();
            } else {
                echo "خطأ في حذف البيانات: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "معرف الزبون غير محدد";
        }
    } else {
        echo "بيانات غير صحيحة";
    }
} else {
    echo "طلب غير صحيح";
}

$conn->close();
?>
