<?php 

include "../config.php";

$user_id = $_SESSION['user_id'];
$redeemCode = $_POST['redeem'];

if (empty($redeemCode)) {
    echo "empty";
    exit;
}

$check = mysqli_query($conn, "SELECT * FROM information WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1 ");
if(mysqli_num_rows($check) > 0) {

    $fetch_code = mysqli_fetch_assoc($check);
    $code = $fetch_code['code'];
    $status = $fetch_code['status'];

    if($redeemCode !== $code) {

        echo "invalid";

    }else if($status == "used") {

        echo "used";

    }else{

        $update = mysqli_query($conn, "UPDATE information SET status = 'used' WHERE user_id = '$user_id' AND status = 'unused' ORDER BY id DESC LIMIT 1 ");

        if($update) {

            mysqli_query($conn, "UPDATE users SET balance = balance + 500 WHERE id = '$user_id' ");
            echo "earned";

        }

    }

}


?>