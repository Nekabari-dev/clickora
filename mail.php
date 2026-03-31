<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require "PHPMailer/vendor/autoload.php";
 function sendmail($to,$subject,$message,$attachment=null,$name=""){
     
     $to=$to;
     $subject=$subject;
     
     $file="https://tatcoin.net/images/w_logo.png";
     $body="<html>  
     <body style='color: #000; font-size: 16px; text-decoration: none; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; background-color: #efefef;'>
         
         <div id='wrapper' style='max-width: 600px; margin: auto auto; padding: 20px;'>
             
             <div id='logo' style='color:#E1B530;padding:10px;'>
                 <center><h1 style='margin: 0px;'>
                 <img src='https://getclickora.xyz/logo/logo1.png' style='width:150px'/>
                 </h1></center>
             </div>
                 
             <div id='content' style='font-size: 16px; padding: 0px; background-color: #fff;
                 
                 ;position:relative;top:0px;'>
 
                 <h1 style='font-size: 22px; padding:10px; background-color:#4686ac; color:#fff'><center>$subject</center></h1>
                 
 <div style='padding:20px'>
     $message
     
      <p> 
                 Best Regards!<br>
                 Management,<br>
                 clickora
                 
                 </p>
 </div>
  <div id='footer' style='background-color:#4686ac;margin-bottom: 0px; padding: 10px 8px; text-align: center;position:relative;top:0px;color:#fff'>

                  Copyright clickora 2025.
             </div>
                  

                
                
               
                 
             </div>
             <div id='footer1' style='margin-bottom: 20px; padding: 0px 8px; text-align: center;background-color: #e5e7e9; padding: 10px;position:relative;top:0px;'>
             
             Have a problem? contact us. We're active from Mondays to Fridays 8am - 5pm, then Saturdays 10am - 4pm
           
             
        </div>
            
         </div>
     </body>
 </html>
 ";




$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = "smtp.hostinger.com";
    $mail->Username   = "support@getclickora.xyz";
    $mail->Password   = "@Clickora1";
    
    // SSL
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    
    $mail->isHTML(true);
    $mail->setFrom("support@getclickora.xyz", "clickora");
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    if ($attachment) {
        $mail->addAttachment($attachment);
    }
    
        $mail->send();
        return true;
    
} catch (Exception $e) {
    error_log("Mailer Error: " . $mail->ErrorInfo);
    return false;
}





/*$headers ='From: ctbankingconnect <support@ctbankingconnect.com>'. "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html;charset=UTF-8"."\r\n";
$sendmail=mail($to,$subject,$body,$headers);
*/
 }

?>