<?php 
require_once '../phpmailer/PHPMailerAutoload.php';
require_once '../db.php';
require_once '../functions.php';

function send_notification($db, $subject, $body) {
    $emails_query = mysqli_query($db, "SELECT * FROM emails_for_notifications");
    $emails_data = get_assoc_rows($emails_query);

    for($i = 0; $i < count($emails_data); $i++) {
        $email = $emails_data[$i]['email'];

        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'news24.notifications@gmail.com';
        $mail->Password = 'newsnotifications';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        
        $mail->setFrom('news24.notifications@gmail.com');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $host = $_SERVER['HTTP_HOST'];
        $body .= "<a href='http://$host/includes/users/unsubcribe_notifications.php?email=$email' style='display: block;margin-top: 20px;font-size: 11px;'>Відписатися від сповіщень</a>";
        
        $mail->Subject = $subject;
        $mail->Body = $body;

        if(!$mail->send())
            echo "Error";
    }
}