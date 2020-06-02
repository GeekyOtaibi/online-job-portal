<?php

if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){
require_once ('mail/class.phpmailer.php');


if(isset($_POST['send']))
{
    //Retriieve POST values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


 include 'send-email.php';
    //Create an Object to the PHPMailer Class
    $mail = new PHPMailer();

    //Set the From Address - What user entered
    $mail->From =$email;
    $mail->FromName = $name;
    $mail->AddAttachment("C:\xampp\htdocs\OnlineJobPortal\Filename.pdf", "Filename.pdf");
   // $email= array('mmkhan@kfu.edu.sa','mmkhanccsit@gmail.com');
    //Set the To Address
    //foreach ($email as $mail1) {
        //$mail1='mmkhanccsit@gmail.com';
    $vname=$_SESSION['name'];
        $mail->AddAddress('$vname@jobportal.com');
    
    //Set the Subject and the Message Body
    $mail->Subject = "You have been contacted from online job portal";
    $mail->Body = ""."hi man there is someone need you..";
    
   

    //SMTP Settings
     $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.drmisbha.net";               //tls://smtp.gmail.com
    $mail->Port = 587;                              //465 for gmail
    $mail->Username = 'test@drmisbha.net';          //mmkhanccsit@gmail.com
    $mail->Password = 'ccsit_Kfu2013';              //ccsit_Kfu2013

    //Success or Failure
    if($mail->Send())
    {
        header('Location:index.php?page=0&status=send');
    }
    else {
        //header('Location: contact.php?status=error');
        echo $mail->ErrorInfo;
        exit;
    }
    
}


}
?>