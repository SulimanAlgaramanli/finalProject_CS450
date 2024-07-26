<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// اتصال قاعدة البيانات
include 'con_db.php';

// استعلام لجلب البيانات
$sql = "SELECT 
             projects.ProjectID, 
             cus.CustomerName, 
             eng.employeeName AS engineer_username, 
             projects.LandLocation, 
             projects.ProjectStartDate, 
             projects.ProjectEndDate, 
             projectstatus.statusname, 
             projects.ProgressPercentage, 
             COALESCE(SUM(py.amount), 0) AS totalPayments, 
             COALESCE(SUM(
                 IFNULL((py.Amount - (IFNULL(py.Amount, 0)  / (1 + (projects.rate_Of_CostPlus / 100)))) , 0) 
                 + IFNULL((SELECT SUM(mi.amount) FROM materialinvoices AS mi WHERE mi.project_id = projects.ProjectID AND mi.payment_id = py.paymentNumber), 0) 
                 + IFNULL((SELECT SUM(ti.amount) FROM technicianinvoices AS ti WHERE ti.ProjectID = projects.ProjectID AND ti.PaymentID = py.paymentNumber), 0)
             ), 0) AS TotalExpenses 
         FROM 
             projects 
         JOIN projectstatus ON projects.ProjectStatus = projectstatus.id 
         JOIN customers AS cus ON projects.CustomerID = cus.CustomerId 
         JOIN employees AS eng ON projects.SupervisingEngineerID = eng.employeeId 
         LEFT JOIN payments AS py ON projects.ProjectID = py.ProjectID 
         GROUP BY
             projects.ProjectID, 
             cus.CustomerName, 
             eng.employeeName, 
             projects.LandLocation, 
             projects.ProjectStartDate, 
             projects.ProjectEndDate, 
             projectstatus.statusname, 
             projects.ProgressPercentage";

$result = $conn->query($sql);

// إنشاء كائن جديد لجدول البيانات
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// إضافة رؤوس الأعمدة
$sheet->setCellValue('A1', 'رقم المشروع');
$sheet->setCellValue('B1', 'اسم الزبون');
$sheet->setCellValue('C1', 'الموقع');
$sheet->setCellValue('D1', 'تاريخ البدء');
$sheet->setCellValue('E1', 'تاريخ الانتهاء');
$sheet->setCellValue('F1', 'حالة المشروع');
$sheet->setCellValue('G1', 'نسبة الانجاز');
$sheet->setCellValue('H1', 'إجمالي الدفعات د.ل');
$sheet->setCellValue('I1', 'اجمالي المصروفات د.ل');
$sheet->setCellValue('J1', 'مدير المشروع');
$sheet->setCellValue('K1', 'فنيين المشروع');

// إضافة البيانات إلى الجدول
if ($result->num_rows > 0) {
    $rowNumber = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row["ProjectID"]);
        $sheet->setCellValue('B' . $rowNumber, $row["CustomerName"]);
        $sheet->setCellValue('C' . $rowNumber, $row["LandLocation"]);
        $sheet->setCellValue('D' . $rowNumber, $row["ProjectStartDate"]);
        $sheet->setCellValue('E' . $rowNumber, $row["ProjectEndDate"]);
        $sheet->setCellValue('F' . $rowNumber, $row["statusname"]);
        $sheet->setCellValue('G' . $rowNumber, $row["ProgressPercentage"] . " %");
        $sheet->setCellValue('H' . $rowNumber, $row["totalPayments"]);
        $sheet->setCellValue('I' . $rowNumber, $row["TotalExpenses"]);
        $sheet->setCellValue('J' . $rowNumber, $row["engineer_username"]);
        $sheet->setCellValue('K' . $rowNumber, 'تفاصيل');
        $rowNumber++;
    }
}

// إنشاء ملف إكسل
$writer = new Xlsx($spreadsheet);
$fileName = 'projects_' . date('Y-m-d') . '.xlsx';

// إرسال الملف إلى المتصفح للتحميل
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$writer->save('php://output');

$conn->close();
?>
