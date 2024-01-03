<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="phpstylesheet.css">

</head>

<body>
    <section class="header2">
        <div class="container2">
            <h1> we cant wait to see you'$name'</h1>
            <p id="P3">Neither can he XD</p>
            <p id="P2">Hosted by Kimiko Entertainment.</p>


        </div>
        <fieldset class="frame">
            <p>you'll receive an email from us confirming your interest in Comicon 2023</p>
            <p>as well any changes to occur with the event as well as promotional material for the catergories you selected</p>
        </fieldset>
        <div class="image">
            <img src="images/3.png" alt="">
        </div>
    </section>

</body>

</html>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\laragon\www\comicon\PHPMailer-master\src/Exception.php';
require 'C:\laragon\www\comicon\PHPMailer-master\src/PHPMailer.php';
require 'C:\laragon\www\comicon\PHPMailer-master\src/SMTP.php';
error_reporting(E_ALL ^ E_NOTICE);

if (isset($_POST['submit'])) {

    //Matching column names from form
    $name = $_POST['name'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $cos = $_POST['cos'];
    $comics = $_POST['comics'];
    $QnA = $_POST['QnA'];
    $Merchandise = $_POST['Merchandise'];
    $Wusername = $_POST['username'];
    $password = $_POST['password'];
    $bigtext = $_POST['BigText'];


    //Database details:
    $servername = "localhost";
    $username = 'root';
    $password = 'Jubs1409';
    $dbname = "comicon_guests";

    //Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //checking conn
    if (!$conn) {
        die("Connection Failed!" . mysqli_connect_error());
    }

    $sql = "INSERT INTO guests (first_name,last_name,email,qnA,merchandise,comics,cosplay,username,pass,suggestions) VALUES
    ('$name','$last','$email','$QnA','$Merchandise','$comics','$cos','$Wusername','$password','$bigtext')";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                            // Set mailer to use SMTP 
        $mail->Host = 'smtp.gmail.com.';
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        // Specify main and backup SMTP servers 
        $mail->SMTPAuth = true;
        // $mail->SMTPSecure = PHPMailer::encryption_StartTTLs;                // Enable SMTP authentication 
        $mail->Username = 'concomic662@gmail.com';       // SMTP username 
        $mail->Password = 'Jubs1409';        // SMTP password 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                 // Enable TLS encryption, `ssl` also accepted 
        $mail->Port = 465;

        $mail->setFrom('concomic662@gmail.com', 'kiminko');
        $mail->addAddress($email, $name);

        //$mail->addCC('cc@example.com'); 
        //$mail->addBCC('bcc@example.com'); 

        // Set email format to HTML 
        $mail->isHTML(true);

        // Mail subject 
        $mail->Subject = 'Welcome to Comicon 2023';

        // Mail body content 
        $bodyContent = '<h1>welcome</h1>';
        $bodyContent .= '<p>thank you in your interest in Comicon!</b></p>';
        $mail->Body    = $bodyContent;

        // Send email 
        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        } // TCP port to connect to 



    } else {
        echo mysqli_error($conn);
    }

    //Closing conn
    mysqli_close($conn);
}
