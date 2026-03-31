<?php 
require ("../config.php");
date_default_timezone_set("Africa/Lagos");

$user_id = $_SESSION['user_id'] ?? 0;

$count = mysqli_query($conn, "SELECT COUNT(*) AS ref_count FROM referral WHERE ref_user_id = '$user_id'");
$ref_number = mysqli_fetch_assoc($count)['ref_count'] ?? 0;

$sqlPersonal = "
    SELECT COUNT(*) AS cnt
    FROM information
    WHERE user_id = '$user_id' AND is_read = 0
";

$sqlGeneral = "
    SELECT COUNT(*) AS cnt
    FROM information i
    WHERE i.user_id = 0
      AND NOT EXISTS (
          SELECT 1 FROM user_notification_reads ur
          WHERE ur.info_id = i.id AND ur.user_id = '$user_id'
      )
";

$resPersonal = mysqli_query($conn, $sqlPersonal);
$resGeneral = mysqli_query($conn, $sqlGeneral);

$personalCount = mysqli_fetch_assoc($resPersonal)['cnt'] ?? 0;
$generalCount  = mysqli_fetch_assoc($resGeneral)['cnt'] ?? 0;

$notificationCount = $personalCount + $generalCount;


$getUsersDet = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
$fetchUserDet = mysqli_fetch_assoc($getUsersDet);
$full_name = $fetchUserDet['full_name'] ?? '';
$balance = (float)($fetchUserDet['balance'] ?? 0);
$ref_bonus = (float)($fetchUserDet['ref_balance'] ?? 0);

$dashboard_balance = $balance;

$since = date("Y-m-d H:i:s", time() - 24*3600);

$adsRes = mysqli_query($conn, "
    SELECT COUNT(*) AS total_recent
    FROM user_ad_claims
    WHERE user_id = '$user_id'
      AND claim_date >= '$since'
");
$adsRow = mysqli_fetch_assoc($adsRes);
$total_ads_recent = $adsRow ? (int)$adsRow['total_recent'] : 0;

$profit_recent = $total_ads_recent * 100;

$daily_target = 1500;
$progress_percent = min(100, ($profit_recent / $daily_target) * 100);

echo json_encode([
    "full_name" => "Welcome, $full_name",
    "ref_bonus" => "₳ᗪ₵ " . number_format($ref_bonus, 2),
    "withdrawalBonus" => "₦" . number_format($ref_bonus, 2),
    "ref_number" => "+" . $ref_number . " invites converted",
    "balance" => "₳ᗪ₵ " . number_format($dashboard_balance, 2),
    "total_ads_today" => $total_ads_recent . " / 16",
    "profit_today" => "+ ₳ᗪ₵ " . number_format($profit_recent, 2),
    "progress_percent" => $progress_percent,
    "notification_count" => $notificationCount
]);

?>
