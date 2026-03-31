<?php

include "../config.php";
include "../mail.php";

$newpassword=mysqli_real_escape_string($conn,$_POST['newPassword']);
$cpassword=mysqli_real_escape_string($conn,$_POST['confPassword']);
$userEmail=mysqli_real_escape_string($conn,$_POST['userEmail']);

if (empty($newpassword)) {
    echo "empty";
    exit;
}

if (empty($newpassword)) {
    echo "empty";
    exit;
}

if($newpassword==$cpassword){
    $password=password_hash($newpassword,PASSWORD_BCRYPT);
    
    $update=mysqli_query($conn,"UPDATE users SET `password`='$password' WHERE email='$userEmail' ");
    if($update){
        $nextstep='https://getclickora.xyz/register.php';
        $subject="Password reset completed";
        $message="Congrats, your password has been reset. you can now login to your dashboard";
        $to=$email;
        $sendMail = sendmail($to,$subject,$message);

        if($sendMail) {

            echo"success";

        }else{

            echo "mail problem";

        }
        
    }
}
else{
    echo"unmatched passwords";
}


?>