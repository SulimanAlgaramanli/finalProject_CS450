<?php
function myFormatNumber($number) {
    // تحويل الرقم إلى float للتأكد من صحته كرقم عشري
    $number = (float)$number;

    // استخدام number_format لتنسيق الرقم مع رقمين بعد الفاصلة
    // واستخدام الفواصل كفصل للألوف
    $formattedNumber = number_format($number, 2, '.', ',');

    // إزالة الأصفار غير الضرورية بعد الفاصلة
    if (strpos($formattedNumber, '.') !== false) {
        $parts = explode('.', $formattedNumber);
        // إذا كان الجزء بعد الفاصلة هو '00'، إزالته
        if ($parts[1] === '00') {
            return $parts[0];
        } else {
            return $formattedNumber;
        }
    } else {
        return $formattedNumber;
    }
}

?>
