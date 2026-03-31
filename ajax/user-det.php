<?php 
require ("../config.php");
date_default_timezone_set("Africa/Lagos");

$user_id = $_SESSION['user_id'] ?? 0;

$count = mysqli_query($conn, "SELECT COUNT(*) AS ref_count FROM referral WHERE ref_user_id = '$user_id'");
$ref_number = mysqli_fetch_assoc($count)['ref_count'] ?? 0;


$getUsersDet = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$fetchUserDet = mysqli_fetch_assoc($getUsersDet);
$full_name = $fetchUserDet['full_name'] ?? '';
$balance = (float)($fetchUserDet['balance'] ?? 0);
$ref_bonus = (float)($fetchUserDet['ref_balance'] ?? 0);


echo json_encode([
    "full_name" => $full_name,
    "active" => "Active members • ",
    "ref_number" => $ref_number . " " . "referred"
]);

?>
