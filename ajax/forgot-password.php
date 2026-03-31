<?php 

include "../config.php";
include "../mail.php";

$email=mysqli_real_escape_string($conn,$_POST['forgotEmail']);
$query=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($query)>0){
    $row=mysqli_fetch_assoc($query);
    $dbemail=$row['email'];
    $id=$row['id'];
    $link="https://getclickora.xyz/newpassword.php?id=$id&email=$dbemail";
    $message=
    "<p>The password for your account has been reset. Please follow the link below to enter your new password</p>
    <p><a href='$link'><button style='border: 1px solid #fb414f; background-color: #fb414f; 
    color: #fff; text-decoration: none; font-size: 18px; padding: 10px 20px;'>Reset password</button></a></p>
    ";
    $subject="Password reset confirmation";

    $sendmail=sendmail($dbemail,$subject,$message);

    if($sendmail){

        $display="none";
        echo"success";

    }else{

        echo "not sent";

    }

}else{
    echo "wrong email";
}


?>
