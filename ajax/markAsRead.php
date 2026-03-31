<?php
include "../config.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$info_id = intval($data['id']);
$user_id = $_SESSION['user_id'];

$res = mysqli_query($conn, "SELECT user_id FROM information WHERE id = '$info_id' LIMIT 1");
$row = mysqli_fetch_assoc($res);

if ($row) {
    if ($row['user_id'] == 0) {
        $sql = "INSERT INTO user_notification_reads (user_id, info_id)
            VALUES ('$user_id', '$info_id')
            ON DUPLICATE KEY UPDATE read_at = NOW()";
    } else {
        $sql = "UPDATE information SET is_read = 1 WHERE id = '$info_id' AND user_id = '$user_id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
}

?>