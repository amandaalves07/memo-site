<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	function mandarEmail($nomeDestinatario,$To,$Subject,$Message) {

		require('PHPMailer/src/PHPMailer.php');
		require('PHPMailer/src/Exception.php');
		require('PHPMailer/src/SMTP.php');

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Charset = 'UTF-8';
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Port = 587;
		$mail->Username = 'tccetecds2023';
		$mail->Password = 'srvckfevjxhzumav';
		$mail->From = 'tccetecds2023@gmail.com';
		$mail->FromName = utf8_decode('Recuperação de Senha');
		if (gettype($To)=="array") {
			foreach ($To as $key => $value) {
				$mail->addAddress($value);
			}
		} else {
			$mail->addAddress($To);
		}
		$mail->isHTML(true);

		$Message.="<br><br>Recuperação de senha MEMO";
		$mail->Subject = utf8_decode($Subject);
		$mail->Body    = utf8_decode($Message);
		$mail->AltBody = 'Seu email precisa ser capaz de usar HTML para mostrar essa mensagem! Verifique!';

		if(!$mail->send()) {
		    echo('Mensagem nao pode ser enviada: Mailer Error: ' . $mail->ErrorInfo);
		    return false;
		} else {
		    return true;
		}	
	}
?>