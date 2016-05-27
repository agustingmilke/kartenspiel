<?php
	require('class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->Host = "192.241.188.222";
	$mail->From = "kartenspiel.soporte@gmail.com";
	$mail->FromName = “KartenSpiel”;
	$mail->Subject = "Correo de Confirmacion";
	$mail->AddAddress("".$_POST["correo"]."");
	$body = 'Favor de confirmar el correo ingresado para el registro de este correo con el codigo siguiente: 1997';
	$mail->Body = $body;
	$mail->Send();
?>