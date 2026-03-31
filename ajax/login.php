<?php 

include "../config.php";

$email = mysqli_real_escape_string($conn, $_POST['loginEmail']);
$password = $_POST['loginPassword'];

$select = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");
if(mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
    $verifyEmail = $fetch['email'];
    $dbpass = $fetch['password'];
    $user_id = $fetch['id'];

    if(password_verify($password, $dbpass)) {
        
        $_SESSION['user_id'] = $fetch['id'];
        $_SESSION['is_logged_in'] = "is_logged_in";

        mysqli_query($conn, "UPDATE users SET message_status = 'true' WHERE id = '$user_id' ");

        echo "Login Successful, Please Wait..";

    }else{
        echo "Incorrect User Password";
    }

}else{
    echo "Invalid Email Address";
}




?>
