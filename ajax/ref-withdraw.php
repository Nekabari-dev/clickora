<?php 

include "../config.php";

$user_id = $_SESSION['user_id'];
$accountName = $_POST['accountName'];
$bankName = $_POST['bankName'];
$accountNumber = $_POST['accountNumber'];
$amount = $_POST['amount'];
$withdrawalNote = $_POST['withdrawalNote'];
$currentDay = $_POST['currentDay'];

$select = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id' ");
$ref_balance = mysqli_fetch_assoc($select)['ref_balance'];

if(empty($amount) OR empty($accountName) OR empty($bankName) OR empty($accountNumber)) {
    echo "empty";
    exit;
}

if($amount > $ref_balance) {
    echo "insufficient";
    exit;
}

if($ref_balance < 6000) {
    echo "min_withdraw";
    exit;
}

if ($currentDay != "Friday") {
    echo "locked";
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO transaction (user_id, type, account_name, bank_name, account_number, amount, description)
    VALUES (?, 'referral', ?, ?, ?, ?, ?)
");

$stmt->bind_param("isssds", $user_id, $accountName, $bankName, $accountNumber, $amount, $withdrawalNote);

if ($stmt->execute()) {

    echo "successful";

} else {

    echo "Failed";

}
$stmt->close();





?>