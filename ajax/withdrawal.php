<?php 

require("../config.php");

date_default_timezone_set("Africa/Lagos");

$user_id = $_SESSION['user_id'];

$accountName = $_POST['accountName'];
$bankName = $_POST['bankName'];
$accountNumber = $_POST['accountNumber'];
$amount = $_POST['amount'];
$withdrawalNote = $_POST['withdrawalNote'];

$currentDay   = date("d");     
$currentHour  = date("H");     
$currentMinute = date("i");    
$currentTime  = (int)($currentHour . $currentMinute); 

if ($currentDay != "16") {
    echo "locked";
    exit;
}

if ($currentHour < 5 || $currentHour > 6) {
    echo "outside_hours";
    exit;
}


$getWithrawBal = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id' ");
$fetchWithrawBal = mysqli_fetch_assoc($getWithrawBal);
$balance = $fetchWithrawBal['balance'];
$ref_bonus = $fetchWithrawBal['ref_balance'];

$withdrawableBalance = $balance;

if($withdrawableBalance < 60000) {

    echo "min_withdraw";

}else if($amount > $withdrawableBalance) {

    echo "insufficient";

}else{

    if (empty($accountName) || empty($bankName) || empty($accountNumber) || empty($amount)) {

        echo "required";
        exit;

    }

    $stmt = $conn->prepare("
        INSERT INTO transaction (user_id, type, account_name, bank_name, account_number, amount, description)
        VALUES (?, 'withdrawal', ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("isssds", $user_id, $accountName, $bankName, $accountNumber, $amount, $withdrawalNote);

    if ($stmt->execute()) {

        echo "successful";

    } else {

        echo "Failed";

    }
    $stmt->close();


}




?>