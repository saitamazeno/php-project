
<?php

////Import PHPMailer classes into the global namespace
////These must be at the top of your script, not inside a function
//use PHPMailer\PHPMailer\PHPMailer;
////use PHPMailer\PHPMailer\SMTP;
//use PHPMailer\PHPMailer\Exception;
//
//require 'PHPMailer/src/Exception.php';
//require 'PHPMailer/src/PHPMailer.php';
//require 'PHPMailer/src/SMTP.php';
//
////Create an instance; passing `true` enables exceptions
//$mail = new PHPMailer(true);
//
//try {
//    //Server settings
//    $mail->SMTPDebug = 0;                      //Enable verbose debug output
//    $mail->isSMTP();                                            //Send using SMTP
//    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
//    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
//    $mail->Username = 'vanhau100375@gmail.com';                     //SMTP username
//    $mail->Password = 'nguyenhau1003';                               //SMTP password
//    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
//    $mail->Port = 587;
//    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//    $mail->CharSet = 'UTF-8';
//    //Recipients
//    $mail->setFrom('vanhau100375@gmail.com', 'Unitop');
//    $mail->addAddress('duyhanh0810@gmail.com', 'Nguyen Duy Hanh');     //Add a recipient
////    $mail->addAddress('ellen@example.com');               //Name is optional
//    $mail->addReplyTo('vanhau100375@gmail.com', 'Unitop');
////    $mail->addCC('cc@example.com');
////    $mail->addBCC('bcc@example.com');
//    //Attachments
////    $mail->addAttachment('phan_van_cuong.png');         //Add attachments
//    $mail->addAttachment('phan_van_cuong.png', 'cuong.png');    //Optional name
//    //Content
//    $mail->isHTML(true);                                  //Set email format to HTML
//    $mail->Subject = '[PHP MASTER] Gửi mail từ unitop';
//    $mail->Body = 'Thông tin được gửi từ chương trình <b>Php Master</b>';
////    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//    $mail->send();
//    echo 'Đã gửi thành công';
//} catch (Exception $e) {
//    echo 'Email không được gửi:chi tiết lỗi', $mail->ErrorInfo;
//}



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $option = array()) {
    global $config;
    $config_email = $config['email'];
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = $config_email['smtp_host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = $config_email['smtp_user'];                     //SMTP username
        $mail->Password = $config_email['smtp_pass'];                             //SMTP password
        $mail->SMTPSecure = $config_email['smtp_secure'];            //Enable implicit TLS encryption
        $mail->Port = $config_email['smtp_port'];
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);     //Add a recipient
//    $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
        //Attachments
//    $mail->addAttachment('phan_van_cuong.png');         //Add attachments
//        $mail->addAttachment('phan_van_cuong.png', 'cuong.png');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return 'Email không được gửi:chi tiết lỗi' . $mail->ErrorInfo;
    }
}


