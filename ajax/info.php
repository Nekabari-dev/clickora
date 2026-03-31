<?php
include "../config.php";
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

$sql = "
SELECT 
    i.id,
    i.info_type AS type,
    i.sub_heading AS title,
    i.info_body AS snippet,
    i.info_date AS date,
    CASE
        WHEN i.user_id = '$user_id' THEN i.is_read
        WHEN i.user_id = 0 AND ur.id IS NOT NULL THEN 1
        ELSE 0
    END AS is_read
FROM information i
LEFT JOIN user_notification_reads ur
    ON ur.info_id = i.id AND ur.user_id = '$user_id'
WHERE i.status = 'unused' AND i.user_id IN ('$user_id', 0)
ORDER BY i.info_date DESC
";

$result = mysqli_query($conn, $sql);

function makeLinksClickable($text) {
    $safe = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $pattern = '/(https?:\/\/[^\s]+)/';
    $replacement = '<a href=\"$1\" target=\"_blank\">$1</a>';
    return preg_replace($pattern, $replacement, $safe);
}

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    if (empty($row['type'])) $row['type'] = 'general';
    if (empty($row['title'])) $row['title'] = '(No Title)';
    if (empty($row['snippet'])) $row['snippet'] = '';

    $row['snippet'] = makeLinksClickable($row['snippet']);

    $rows[] = $row;
}
echo json_encode($rows);


?>
