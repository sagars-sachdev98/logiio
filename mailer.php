<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $password;
global $name;
global $email;
global $message;
global $mail;
$mail = '';
$message = "NA";

require 'vendor/autoload.php';



function sendMail()
{
	$mail = new PHPMailer(true);
	global $finalMessage;

	$password = "rahkavlit";
	try {
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
		}
		if (isset($_POST['message'])) {
			$message = $_POST['message'];
		}
		$mail->SMTPDebug = 1;
		$mail->isSMTP();
		$mail->Host	 = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = '08rahul.sharma01@gmail.com';
		$mail->Password = $password;
		$mail->SMTPSecure = 'tls';
		$mail->Port	 = 587;
		$mail->setFrom('08rahul.sharma01@gmail.com', 'Rahul');
		$mail->addAddress('08rahul.sharma01@gmail.com');

		$mail->isHTML(true);
		$mail->Subject = 'Logiio Enquiry';
		$finalMessage .= "Name : " . $name . "\n";
		$finalMessage .= "Email : " . $email . "\n";
		$finalMessage .= "Message : " . $message . "\n";

		$htmlContent = '
			<html>
			<body>
				<h1>You have got an enquiry!</h1>
				<p>The details are as follows</p>
				<ul style="line-height: 1.5">
					<li>Name: ' . $name . '</li>
					<li>Email: ' . $email . '</li>
					<li>Message: ' . $message . '</li>
				</ul>
			</body>
			</html>';

		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


		// $finalMessage = "Name: " . $name .  ",\r\n Email: " . $email . ",\r\n Message: " . $message;
		// $mail->Body = 'HTML message body in <b>bold</b> ';
		$mail->Body = $htmlContent;
		$mail->AltBody = 'Body in plain text for non-HTML mail clients';
		$mail->send();
		setrawcookie('name', rawurlencode($name));
		setrawcookie('email', rawurlencode($email));
		setrawcookie('message', rawurlencode($message));



		header("Location:mailSuccess.php");
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
