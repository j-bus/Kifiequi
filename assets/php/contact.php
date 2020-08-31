<?php require("PHPMailer/PHPMailerAutoload.php");

// ADD your Email and Name
$recipientEmail='kifiequi@gmail.com';
$recipientName='Maria Garcia';

//collect the posted variables into local variables before calling $mail = new mailer

$senderName = $_POST['name'];
$senderPhone = $_POST['phone'];
$senderEmail = $_POST['email'];
$senderComment = $_POST['comment'];
$senderSubject = 'New Message From ' . $senderName;
$senderType = $_POST['user'];
$senderSpeciality = $_POST['speciality'];

//Create a new PHPMailer instance
$mail = new PHPMailer();

//Set who the message is to be sent from
$mail->setFrom($recipientEmail, $recipientName);
//Set an alternative reply-to address
$mail->addReplyTo($senderEmail,$senderName);
//Set who the message is to be sent to
$mail->addAddress($senderEmail, $senderName );
//Set the subject line
$mail->Subject = $senderSubject;

$mail->Body = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);
$mail->AddAddress($recipientEmail, $recipientName);

//$mail-&gt;AddAttachment("images/phpmailer.gif"); // attachment
//$mail-&gt;AddAttachment("images/phpmailer_mini.gif"); // attachment

//now make those variables the body of the emails
$message = '<html><body>';
$message .= '<table rules="all" style="border:1px solid #666;width:300px;" cellpadding="10">';
$message .= ($senderName) ? "<tr style='background: #eee;'><td><strong>Nombre:</strong> </td><td>" . $senderName . "</td></tr>" : '';
$message .= ($senderPhone) ?"<tr><td><strong>Teléfono:</strong> </td><td>" . $senderPhone . "</td></tr>" : '';
$message .= ($senderEmail) ?"<tr><td><strong>Email:</strong> </td><td>" . $senderEmail . "</td></tr>" : '';
$message .= ($senderComment) ?"<tr><td><strong>Comentario:</strong> </td><td>" . $senderComment . "</td></tr>" : '';
$message .= "</table>";
$message .= "</body></html>";

$mail->Body = $message;

// $mail->Body="
// Name:$senderName<br/>
// Email: $senderEmail<br/>
// Suburb: $senderSubject<br/>
// Message: $senderMessage";

if(!$mail->Send()) {
	echo '<div class="alert alert-danger" role="alert">Error: '. $mail->ErrorInfo.'</div>';
} else {
	echo '<div class="alert alert-success" role="alert">Thank you. We will contact you shortly.</div>';
}
?>