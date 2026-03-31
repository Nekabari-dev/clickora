<?php

include "../config.php";

$pin = $_POST['pin'] ?? '';

if (empty($pin)) {
    echo "required";
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM admin WHERE role = 'admin'");
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
    $dbpass = $fetch['password'];

    if (password_verify($pin, $dbpass)) {
        $_SESSION['admin_rightsss!'] = "admin_rightsss!";
        echo "successful";
    } else {
        echo "invalid";
    }
}

?>
