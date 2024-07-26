<?php
include 'con_db.php';

if (isset($_POST['delete']) && isset($_POST['delete_invoice_id'])) {
    $invoice_id = $_POST['delete_invoice_id'];
    $delete_sql = "DELETE FROM MaterialInvoices WHERE invoice_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $invoice_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('تم حذف الفاتورة بنجاح.'); window.location.href='MaterialInvoices.php';</script>";
    } else {
        echo "<script>alert('فشل في حذف الفاتورة.'); window.location.href='MaterialInvoices.php';</script>";
    }
    
    $stmt->close();
}


?>
