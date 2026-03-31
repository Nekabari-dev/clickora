<?php 

require "../config.php";
require "../mail.php";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

$adminMessage = "you have a new message from $email \n\n $message";

if(sendmail("$email","A user has contacted","$adminMessage",null,"$name")) {
    echo "sent";
}else{
    echo "error";
}

?>