<!-- Credits to Srinivas Tamada Production
	for help with the email verification code.
-->

<?php
	function Send_Mail($to, $subject, $body){
		try {
			require 'class.phpmailer.php';
			$from = "donotreply <SlavehackLegacyMailbot@gmail.com>";
			$mail = new PHPMailer();
			$mail -> IsSMTP();
			$mail -> SMTPSecure = 'ssl';
			$mail -> IsHTML(true);
			$mail -> SMTPAuth = true;
			$mail -> Host = "smtp.gmail.com";
			$mail -> Port = 465;
			$mail -> Username = "SlavehackLegacyMailbot@gmail.com";
			$mail -> Password = "YVtYrqkMbxABsWm8";
			$mail -> From = "SlavehackLegacyMailbot@gmail.com";
			$mail -> FromName = "donotreply";
			$mail -> Subject = $subject;
			$mail -> MsgHTML($body);
			$address = $to;
			$mail -> AddAddress($address, $to);
			if(!$mail->Send()){
		    echo "Mailer Error: " . $mail->ErrorInfo;
		    }
		    else{}
		} catch (phpmailerException $e) {
			echo $e->getMessage();
		}
	}
?>