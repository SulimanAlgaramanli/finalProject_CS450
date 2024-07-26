<?php
    // include 'con_db.php';

    // function hasPermission($user_type_id, $permission_id) {
        

    //     $sql = "SELECT 1 
    //             FROM usertype_group_policy 
    //             WHERE user_type_id = ? AND group_policy_id = ?";

    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("ii", $user_type_id, $permission_id);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     $conn->close();

    //     return $result->num_rows > 0;
    // }

?>

<?php
include 'con_db.php'; // تأكد من تضمين ملف الاتصال بقاعدة البيانات

function hasPermission($user_type, $permission_id) {
    global $conn; // استخدام المتغير $conn من النطاق العام
    $stmt = $conn->prepare("SELECT 1 FROM usertype_group_policy WHERE user_type_id  = ? AND group_policy_id  = ?");
    $stmt->bind_param("ii", $user_type, $permission_id);
    $stmt->execute();
    $stmt->bind_result($permission_value);
    $stmt->fetch();
    $stmt->close();
    return $permission_value;
}
?>
