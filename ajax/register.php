<?php 

include "../config.php";
include "../mail.php";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$Cpassword = mysqli_real_escape_string($conn, $_POST['Cpassword']);
$coupon = mysqli_real_escape_string($conn, $_POST['coupon']);
$encoded_id = mysqli_real_escape_string($conn, $_POST['ref_id'] ?? 0);

$ref_id = base64_decode($encoded_id);

if(empty($name) OR empty($email) OR empty($password) OR empty($Cpassword) OR empty($coupon)) {
    echo "empty";
    exit;
}

$select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
if(mysqli_num_rows($select) > 0) {
    echo "Exists";
    exit;
}

$ip = $_SERVER['REMOTE_ADDR'];

// $fingerprint = $_POST['fingerprint'];
// $stmt = $conn->prepare("SELECT id FROM users WHERE device_id = ?");
// $stmt->bind_param("s", $fingerprint);
// $stmt->execute();
// $res = $stmt->get_result();
// if ($res->num_rows > 0 || !empty($_COOKIE['device_lock'])) {
//     echo "device";
//     exit;
// }


if($password != $Cpassword) {
    echo "Passwords Do Not Match";
    exit;
}

$check_coupon = mysqli_query($conn, "SELECT * FROM coupon WHERE code = '$coupon' AND status = 'true' ");
if(mysqli_num_rows($check_coupon) > 0) {
    echo "invalid_coupon";
    exit;
}

$pword = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("
    SELECT id FROM users 
    WHERE full_name = ? 
      AND email = ? 
      AND password = ? 
      AND ip_address = ? 
      AND device_id = ?
    LIMIT 1
");
$stmt->bind_param("sssss", $name, $email, $pword, $ip, $fingerprint);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "Exists";
    exit;
}

$stmt->close();

$valid_coupon = mysqli_query($conn, "SELECT * FROM coupon WHERE code = '$coupon' ");
if(mysqli_num_rows($valid_coupon) > 0) {
    mysqli_query($conn, "UPDATE coupon SET status = 'true' WHERE code = '$coupon' ");
}else{
    echo "non-existent_coupon";
    exit;
}

$stmt2 = $conn->prepare("
    INSERT INTO users (full_name, email, password, ip_address, device_id)
    VALUES (?, ?, ?, ?, ?)
");
$stmt2->bind_param("sssss", $name, $email, $pword, $ip, $fingerprint);

if ($stmt2->execute()) {

$stmt2->close();

$getId = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
$fetch = mysqli_fetch_assoc($getId);
$id = $fetch['id'];
$_SESSION['user_id'] = $id;
$_SESSION['is_logged_in'] = "is_logged_in";
setcookie("device_lock", $fingerprint, time() + (10*365*24*60*60), "/", "", false, true);

mysqli_query($conn, "UPDATE users SET balance = balance + 8000 WHERE id = '$id' ");
mysqli_query($conn, "UPDATE coupon SET user_id = '$id' WHERE code = '$coupon' ");

$subhead = "Welcome to the Family!";
$infoBody = "We'd love to stay in touch! Tap the link to join our Telegram group and get updates, tips, and warm support from our community.\nhttps://t.me/getclickora";
$infoBody = mysqli_real_escape_string($conn, $infoBody);
$type = "general";

mysqli_query($conn, "INSERT INTO information (user_id, sub_heading, info_body, info_type, status)
VALUES ('$id', '$subhead', '$infoBody', '$type', 'unused') ");


$client_message = "
    <p>Please, always check your info page to stay updated.</p>
    <div></div>
";

sendmail("$email", "Welcome To Clickora", "$client_message", null, "$name");

$Referral = mysqli_query($conn, "SELECT * FROM users WHERE id = '$ref_id' ");
if(mysqli_num_rows($Referral) > 0) {
    mysqli_query($conn, "UPDATE users SET ref_balance = ref_balance + 4000 WHERE id = '$ref_id' ");
    mysqli_query($conn, "INSERT INTO referral (ref_user_id, new_user_id) VALUES ('$ref_id', '$id') ");
}

$checkParent = mysqli_query($conn, "SELECT ref_user_id FROM referral WHERE new_user_id = '$ref_id' ");
if (mysqli_num_rows($checkParent) > 0) {
    $parent = mysqli_fetch_assoc($checkParent);
    $parent_id = $parent['ref_user_id'];
   mysqli_query($conn, "UPDATE users SET ref_balance = ref_balance + 500 WHERE id = '$parent_id' ");
}

echo "Successful";

} else {
    echo "wait";
}



?>
