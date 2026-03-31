<?php
require("../config.php");
header('Content-Type: application/json');

date_default_timezone_set("Africa/Lagos");

$user_id = $_SESSION['user_id'] ?? 0;
if (!$user_id) {
    echo json_encode(["success"=>false,"message"=>"User not logged in"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'claim') {
    $ad_id = intval($_POST['ad_id']);
    $now = date("Y-m-d H:i:s");

    $check = mysqli_query($conn, "
        SELECT claim_date
        FROM user_ad_claims
        WHERE user_id = '$user_id' AND ad_id = '$ad_id'
        ORDER BY claim_date DESC
        LIMIT 1
    ");

    if ($row = mysqli_fetch_assoc($check)) {
        $last_claim = strtotime($row['claim_date']);
        $diff_seconds = time() - $last_claim;

        if ($diff_seconds < 86400) {
            $remaining = 86400 - $diff_seconds;
            $expires_at = $last_claim + 86400; 
            echo json_encode([
                'success' => false,
                'message' => 'Available again in ' . floor($remaining/3600) . 'h ' . floor(($remaining%3600)/60) . 'm.',
                'expires_at' => $expires_at
            ]);
            exit;
        }
    }

    mysqli_query($conn, "INSERT INTO user_ad_claims (user_id, ad_id, claim_date)
    VALUES ('$user_id','$ad_id','$now')");
    mysqli_query($conn, "UPDATE users SET balance = balance + 100 WHERE id = '$user_id'");

    $expires_at = strtotime($now) + 86400;
    echo json_encode([
        'success' => true,
        'message' => 'Ad claimed successfully! You earned ₳ᗪ₵100.',
        'expires_at' => $expires_at
    ]);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'claimed') {
    $claimed = [];
    $res = mysqli_query($conn, "
        SELECT ad_id, MAX(claim_date) AS latest_claim
        FROM user_ad_claims
        WHERE user_id = '$user_id'
        GROUP BY ad_id
    ");
    while ($row = mysqli_fetch_assoc($res)) {
        $last_claim = strtotime($row['latest_claim']);
        $diff_seconds = time() - $last_claim;

        if ($diff_seconds < 86400) {
            $expires_at = $last_claim + 86400;
            $claimed[] = [
                'ad_id' => intval($row['ad_id']),
                'expires_at' => $expires_at
            ];
        }
    }
    echo json_encode([
        'success' => true,
        'claimed_ads' => $claimed
    ]);
    exit;
}

?>
