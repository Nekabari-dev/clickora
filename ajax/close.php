<?php
    include "../config.php";

    $user_id = $_SESSION['user_id'];

    mysqli_query($conn, "UPDATE users SET message_status='false' WHERE id='$user_id'");

    echo json_encode(['success' => true]);

?>
