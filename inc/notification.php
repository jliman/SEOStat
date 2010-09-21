<?php
function shutdown () {
	global $notification;
	$message = ob_get_clean();
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'From: SEOStat auroraku.com <sales@auroraku.com>' . "\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion();
	mail($notification, 'SEOStat Fetch Result '.date("Y-m-d H:i:s"), $message, $headers);
}
register_shutdown_function('shutdown');
?>