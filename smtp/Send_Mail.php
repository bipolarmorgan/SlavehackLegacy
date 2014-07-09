<!-- Credits to Srinivas Tamada Production
	for help with the email verification code.
-->

<?php
	function Send_Mail($to, $subject, $body){
		require 'class.phpmailer.php';
		$from = "WitheredGryphon@gmail.com";
		$mail = new PHPMailer();
		$mail -> IsSMTP();
		$mail -> SMTPSecure = 'ssl';
		$mail -> IsHTML(true);
		$mail -> SMTPAuth = true;
		$mail -> Host = "smtp.gmail.com";
		$mail -> Port = 465;
		$mail -> Username = "WitheredGryphon@gmail.com";
		$mail -> Password = "3256924752049521169490";
		$mail -> SetFrom($from, 'Slavehack Legacy Mailbot');
		$mail -> AddReplyTo($from, 'Slavehack Legacy Mailbot');
		$mail -> Subject = $subject;
		$mail -> MsgHTML($body);
		$address = $to;
		$mail -> AddAddress($address, $to);
		if(!$mail->Send()){
	    echo "Mailer Error: " . $mail->ErrorInfo;
	    }
	    else{ echo "Mailing successful. "; }
	}
?>