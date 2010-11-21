<?php
function shutdown () {
	global $notification_recipient, $notification_sender;
	$message = ob_get_clean();
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: SEOStat <'.$notification_sender.'>' . "\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion();
	mail($notification_recipient, 'SEOStat Fetch Result '.date("Y-m-d H:i:s"), $message, $headers);
	//echo $message;
}
register_shutdown_function('shutdown');
?>