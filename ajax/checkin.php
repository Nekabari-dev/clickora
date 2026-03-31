<?php
require("../config.php");
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'checkin') {
    $today     = date("Y-m-d");
    $yesterday = date("Y-m-d", strtotime("-1 day"));

    $lastRes = mysqli_query($conn, "SELECT * FROM user_checkins WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
    $lastRow = mysqli_fetch_assoc($lastRes);

    $day_number = 1;
    $streak     = 1;
    $reset      = false;

    if ($lastRow) {
        $lastDate = $lastRow['checkin_date'];

        if ($lastDate === $today) {
            echo json_encode(["success" => false, "message" => "Already checked in today"]);
            exit;
        } elseif ($lastDate === $yesterday) {
            $streak     = intval($lastRow['streak_count']) + 1;
            $day_number = ($lastRow['day_number'] % 30) + 1;
        } else {
            mysqli_query($conn, "DELETE FROM user_checkins WHERE user_id='$user_id'");
            $streak     = 1;
            $day_number = 1;
            $reset      = true;
        }
    }

    $sql = "INSERT INTO user_checkins (user_id, day_number, checkin_date, streak_count)
            VALUES ('$user_id','$day_number','$today','$streak')";
    if (!mysqli_query($conn, $sql)) {
        echo json_encode(["success" => false, "message" => "Database insert failed"]);
        exit;
    }

    mysqli_query($conn, "UPDATE users SET balance = balance + 100 WHERE id = '$user_id'");

    if ($day_number == 30) {
        $reset = true;
    }

    echo json_encode([
        "success"    => true,
        "day_number" => $day_number,
        "streak"     => $streak,
        "reset"      => $reset
    ]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'streak') {
    $lastRes = mysqli_query($conn, "SELECT * FROM user_checkins WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1");
    $lastRow = mysqli_fetch_assoc($lastRes);
    $streak = $lastRow ? intval($lastRow['streak_count']) : 0;

    $checked_days = [];
    $cycleRes = mysqli_query($conn, "SELECT day_number FROM user_checkins WHERE user_id='$user_id' ORDER BY id DESC LIMIT 30");
    while ($r = mysqli_fetch_assoc($cycleRes)) {
        $dn = intval($r['day_number']);
        if ($dn >= 1 && $dn <= 30 && !in_array($dn, $checked_days, true)) {
            $checked_days[] = $dn;
        }
    }

    echo json_encode([
        "success" => true,
        "streak" => $streak,
        "checked_days" => $checked_days
    ]);
    exit;
}



?>